<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

 	$tab = "users";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	session_cache_limiter(null);

  	$nav = "view";
  	$helpPage = "users";



	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

  if (count($_GET) == 0) {
    header("Location: ../users/index.php");
    exit();
  }


  	$userid = $_GET['uid'];
//	$addrId = (isset($_GET['addrid']))? (int)$_GET['addrid'] : null;
 	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/User.php");
  	require_once(__ROOT__."classes/UserQuery.php");
  	require_once(__ROOT__."classes/UserPrefs.php");
  	require_once(__ROOT__."classes/UserAddress.php");
  	require_once(__ROOT__."classes/UserProfile.php");
  	require_once(__ROOT__."classes/DmQuery.php");
  	require_once(__ROOT__."functions/arrayFuncs.php");

  	#****************************************************************************
  	#*  Loading a few domain tables into associative arrays
  	#****************************************************************************

	$dmQ = new DmQuery();
  	$userClassifications = $dmQ->getAssoc('user_classify_dm');
  	$userStatusTypes = $dmQ->getAssoc('user_status_type_dm','status','statusid');
  	$userTitleTypes = $dmQ->getAssoc('user_titles_dm','title','titleid');
  	$userTitleTypes[0] = '';
  	asort($userTitleTypes);
  	$userAddressTypes = $dmQ->getAssoc('user_address_type_dm','type','typeid');
	$userProfileTypes = $dmQ->getAssoc('user_profile_type_dm','descr','typeid');
	$profileValues = array_flip($dmQ->getAssoc('subject_list_dm','subjectid','descr'));
	$readingLevels = $dmQ->getAssoc('audience_dm');
	//$languages = $dmQ->getAssoc("languages_dm","short_descr");
	$langRows = $dmQ->getRowsForFlag("languages_dm",'in_use_flg');
	$languages=array();
	foreach ($langRows as $row)
	{
	 	$languages[$row->code] = $row->short_descr;
	}
	$defLang = $dmQ->getDefault("languages_dm");
	$defLang = $defLang->getCode();
	unset($dmQ);
	unset($langRows);

	// !--------- General Info ----------

	$userQ = new UserQuery();
	$user = $userQ->getUser($userid);
	unset($userQ);

	// check we found a user
	if ($user === false)
	{
		header("Location: user_search.php?msg=".HURL($loc->getText('userError_NotFound')));
		exit;
	}

	$info = array('name'=>array('label'=>$loc->getText('userView_fullname'),
									'value'=>$user->getFullName()),
					'uname'=>array('label'=>$loc->getText('userView_username'),
									'value'=>$user->getUsername()),
					'dob'=>array('label'=>$loc->getText('userView_birthDate'),
									'value'=>$user->getBirthDate()),
					'jade'=>array('label'=>$loc->getText('userView_jadeId'),
									'value'=>$user->getJadeId()),
					'class'=>array('label'=>$loc->getText('userView_class'),
									'value'=>$userClassifications[$user->getClassification()]),
					'mobile'=>array('label'=>$loc->getText('userView_mobilePhone'),
									'value'=>$user->getMobilePhone()),
					'email'=>array('label'=>$loc->getText('userView_email'),
									'value'=>$user->getEmail()),
					'readLvl'=>array('label'=>$loc->getText('userView_readingLevel'),
									'value'=>$readingLevels[$user->getReadingLevelId()]),
					'recom'=>array('label'=>$loc->getText('userView_wantsRecommend'),
									'value'=>($user->getAutoRecommend())?'Yes':'No'),
					'comments'=>array('label'=>$loc->getText('userView_comments'),
									'value'=>$user->getComments()),
					'status'=>array('label'=>$loc->getText('userView_status'),
									'value'=>$userStatusTypes[$user->getStatusId()])
	);

	$smarty->assign('info',$info);

	// !--------- Addresses ----------

	$addrQ = new UserAddressQuery();
	$userAddresses = $addrQ->getAddresses($userid);
	unset($addrQ);

	if( (count($userAddresses)>0))
	{
		$addrSelector = array('name'=>'addrSel','onChange'=>'','id'=>'addrSel');
		// build the list of user address types
  		while (list(,$addr) = each($userAddresses))
  		{
  			$addrSelector['options'][$addr->getAddressId()] = $userAddressTypes[$addr->getTypeId()];

  		}

		$addrFields = array('addr'=>array('label'=>$loc->getText('userAddrAddress'),
  		    								'value'=>$userAddresses[0]->getAddress()),
  		    				'city'=>array('label'=>$loc->getText('userAddrCity'),
  		    								'value'=>$userAddresses[0]->getCity()),
  		    				'state'=>array('label'=>$loc->getText('userAddrState'),
  		    								'value'=>$userAddresses[0]->getState()),
  		    				'pcode'=>array('label'=>$loc->getText('userAddrPostCode'),
  		    								'value'=>$userAddresses[0]->getPostCode()),
  		    				'count'=>array('label'=>$loc->getText('userAddrCountry'),
  		    								'value'=>$userAddresses[0]->getCountry()),
  		    				'phone'=>array('label'=>$loc->getText('userAddrPhone'),
  		    								'value'=>$userAddresses[0]->getPhone()),
  		    				'contact'=>array('label'=>$loc->getText('userAddrContactName'),
  		    								'value'=>$userAddresses[0]->getContactName()),
  		    				'contactPhn'=>array('label'=>$loc->getText('userAddrContactPhone'),
  		    								'value'=>$userAddresses[0]->getContactAltPhone()),
  		    				'comments'=>array('label'=>$loc->getText('userAddrComments'),
  		    								'value'=>$userAddresses[0]->getComments()));

		$smarty->assign('addrFields',$addrFields);
		$smarty->assign('addrSel',$addrSelector);
		$smarty->assign('addressBody',$smarty->fetch('users/user_address_body.tpl','users'));
  		$smarty->assign('addrFields',null);


	}
	else
  	{ // no addresses for this user
   		$addrSelector = null;
  	}



	// !--------- Preferences ----------

	$prefsQ = new UserPrefsQuery();
  	$userPrefs = $prefsQ->getPrefs($userid);
  	unset($prefsQ);

	$prefs = array('narrM'=>array('label'=>$loc->getText('userPrefNarratorMale') ,
									'value'=>$userPrefs->getNarratorMale() ),
					'narrS'=>array('label'=>$loc->getText('userPrefNarratorSynth'),
									'value'=>$userPrefs->getNarratorSynth() ),
					'narrF'=>array('label'=>$loc->getText('userPrefNarratorFemale') ,
									'value'=>$userPrefs->getNarratorFemale() ),
					'lang'=>array('label'=>$loc->getText('userPrefContentLanguage') ,
									'value'=>$userPrefs->getContentLanguage() ),
					'sex'=>array('label'=>$loc->getText('userPrefContentSex') ,
									'value'=>$userPrefs->getContentSex() ),
					'viol'=>array('label'=>$loc->getText('userPrefContentViolence') ,
									'value'=>$userPrefs->getContentViolence() ),
					'bookS'=>array('label'=>$loc->getText('userPrefBooksShort') ,
									'value'=>$userPrefs->getBooksShort() ),
					'bookL'=>array('label'=>$loc->getText('userPrefBooksLong') ,
									'value'=>$userPrefs->getBooksLong() ),
					'brail'=>array('label'=>$loc->getText('userPrefBraille') ,
									'value'=>$userPrefs->getBraille()),
					'perDev'=>array('label'=>$loc->getText('userPrefBooksPerDevice') ,
									'value'=>$userPrefs->getBooksPerDevice()),
					'maxQ'=>array('label'=>$loc->getText('userPrefMaxQueuedRequests') ,
									'value'=>$userPrefs->getMaxQueuedReqs())

					);

	$smarty->assign('prefs',$prefs);

	// !--------- Profiles ----------

	$profQ = new UserProfileQuery();
  	$userProfiles = $profQ->getProfiles($userid);
	unset($profQ);


	$profiles = array();
	if(isset($userProfiles))
	{
		while (list(,$aProf) = each($userProfiles))
		{

			$profiles[] = array('type'=>$userProfileTypes[$aProf->getTypeId()],
								'content'=>$aProf->getContent(),
								'prefers'=>$aProf->getPreferred(),
								'lang'=>$languages[$aProf->getLanguage()]
								);

		}
	}

	$smarty->assign('profiles',$profiles);
	$smarty->assign("profSel",array("options"=>$userProfileTypes,"selected"=>"2"));
	$smarty->assign("profLangSel",array("options"=>$languages,"selected"=>$defLang));
	$smarty->assign('profileValues',$profileValues);
	$smarty->assign("profilesBody",$smarty->fetch('users/user_profiles_body.tpl','users'));
	$smarty->assign("profiles",null);
	unset($profiles);

	// !--------- Requests ----------

	$reqsQ = new UserRequestsQuery();
	$requests = $reqsQ->getRequests($userid);
	unset($reqsQ);
	$smarty->assign('requests',$requests);
	$smarty->assign('addRequestButtonLabel',$loc->getText("userView_addRequestButtonLabel"));
	$smarty->assign('reqDeleteButtonLabel',$loc->getText("userView_requestDeleteButtonLabel"));

	// !--------- Reading History ----------

	$histQ = new UserHistoryQuery();
	$hist = $histQ->getReadingHistory($userid);
	unset($histQ);
	$smarty->assign('readHist',$hist);
	$smarty->assign('historyBody',$smarty->fetch('users/user_history_body.tpl','users'));
	$smarty->assign('readHist',null);

	// !--------- Notes -----------


	$notesQ = new UserNoteQuery();
	$notes = $notesQ->getNotes($userid);
	unset($notesQ);

	$smarty->assign("notesHist",$notes);
	$smarty->assign("notesBody",$smarty->fetch('users/user_notes_body.tpl','users'));
	$smarty->assign("notesHist",null);
	unset($notesQ);
	$noteLabels = array("search"=>$loc->getText("userSearch"),
						"date"=>$loc->getText("userDate"));
	$smarty->assign("noteLabels",$noteLabels);

	// !--------- Common ----------
	$smarty->assign('editButtonLabel',$loc->getText("userView_editUserLabel"));
	$smarty->assign('changePwdButtonLabel',$loc->getText("userView_changePasswordButtonLabel"));
	$smarty->assign('backButtonLabel',$loc->getText("userView_backToSearchLabel"));
	$smarty->assign('uid',$userid);
	$smarty->assign('contentHeader',$loc->getText("userView_contentHeader",array('name'=>$user->getFullName())));
	$smarty->display('users/user_view.tpl','users');

	exit;
