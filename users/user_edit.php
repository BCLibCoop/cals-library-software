<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

    if ((empty($_GET)) && empty($_POST)) {
		header("Location: ../users/index.php");
    	exit();
  	}

 	if ((!isset($_GET['uid'])) &&  (!isset($_POST['uid']))) {
    	header("Location: ../users/index.php");
    	exit();
  	}

  	$tab = "users";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	session_cache_limiter(null);


  	$nav = "edit";
  	$helpPage = "users";

	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

  	require_once(__ROOT__."admin/header_admin.php");
  	$userid = (isset($_GET['uid']))?$_GET['uid']:$_POST['uid'];

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
	$userAddressTypes = $dmQ->getAssoc('user_address_type_dm','type','typeid');

  	$userClassifications = $dmQ->getAssoc('user_classify_dm');
  	$userStatusTypes = $dmQ->getAssoc('user_status_type_dm','status','statusid');
  	$userTitleTypes = $dmQ->getAssoc('user_titles_dm','title','titleid');
  	// add a blank choice for the title types as there is no 0 in the db
  	$userTitleTypes[0] = '';
  	asort($userTitleTypes);

	$userProfileTypes = $dmQ->getAssoc('user_profile_type_dm','descr','typeid');
	$readingLevels = $dmQ->getAssoc('audience_dm');
	unset($dmQ);

  	#****************************************************************************
  	#*  Setup of common labels and field basics
  	#****************************************************************************

	// !--------- General Info (Label & Field) ----------
	$info = array('title'=>array('label'=>$loc->getText('userEdit_title'),
									'field'=>array('type'=>'select',
	    									'name'=>'tid',
	    									'options'=>$userTitleTypes)),
					'fname'=>array('label'=>$loc->getText('userEdit_firstname'),
									'field'=>array('type'=>'text',
	    											'name'=>'fname',
	    											'options'=>array('size'=>'30','maxlength'=>'40'))),
					'sname'=>array('label'=>$loc->getText('userEdit_surname'),
									'field'=>array('type'=>'text',
	    											'name'=>'sname',
	    											'options'=>array('size'=>'30','maxlength'=>'40')),
	    							'validate'=>array('v_snmEmpty'=>'Surname cannot be empty.')),
					'uname'=>array('label'=>$loc->getText('userView_username'),
									'field'=>array('type'=>'text',
	    											'name'=>'uname',
	    											'options'=>array('size'=>'20','maxlength'=>'20')),
	    							'validate'=>array('v_unmEmpty'=>'Username cannot be empty.',
	    											'v_unmInvalid'=>'Username is already in use.')),
					'dob'=>array('label'=>$loc->getText('userView_birthDate'),
									'field'=>array('type'=>'text',
	    											'name'=>'dob',
	    											'options'=>array('size'=>'12','maxlength'=>'10')),
	    							'validate'=>array('v_dobIsDate'=>$loc->getText("userValidate_dateInvalid"))),
					'jade'=>array('label'=>$loc->getText('userView_jadeId'),
									'field'=>array('type'=>'text',
	    											'name'=>'jid',
	    											'options'=>array('size'=>'7','maxlength'=>'7'))),
					'class'=>array('label'=>$loc->getText('userView_class'),
									'field'=>array('type'=>'select',
	    									'name'=>'class',
	    									'options'=>$userClassifications)),
					'mobile'=>array('label'=>$loc->getText('userView_mobilePhone'),
									'field'=>array('type'=>'text',
	    											'name'=>'mobph',
	    											'options'=>array('size'=>'15','maxlength'=>'20'))),
					'email'=>array('label'=>$loc->getText('userView_email'),
									'field'=>array('type'=>'text',
	    											'name'=>'email',
	    											'options'=>array('size'=>'40','maxlength'=>'100'))),
					'readLvl'=>array('label'=>$loc->getText('userView_readingLevel'),
										'field'=>array('type'=>'select',
	    									'name'=>'rdlvl',
	    									'options'=>$readingLevels)),
					'recom'=>array('label'=>$loc->getText('userView_wantsRecommend'),
									'field'=>array('type'=>'checkbox',
	    									'name'=>'recom',
	    									'value'=>'1')),
					'comments'=>array('label'=>$loc->getText('userView_comments'),
										'field'=>array('type'=>'text',
	    											'name'=>'comms',
	    											'options'=>array('size'=>'40','maxlength'=>'500'))),
					'status'=>array('label'=>$loc->getText('userView_status'),
									'field'=>array('type'=>'select',
	    									'name'=>'sts',
	    									'options'=>$userStatusTypes))
	);

	// !--------- Addresses (Label & Field) ----------
	$addrQ = new UserAddressQuery();
	$userAddresses = $addrQ->getAddresses($userid);
	unset($addrQ);

	if( (count($userAddresses)>0))
	{
		// add an empty item to the beginning of the change to types selector
		$chgTypes = array_reverse($userAddressTypes,true);
		$chgTypes['0']='';
		$chgTypes = array_reverse($chgTypes,true);
		$addrChgSel = array('name'=>'addrchgtyp','options'=>$chgTypes);

		// build the list of user address types
		$addrSelector = array('name'=>'addrid','id'=>'addrid');
  		while (list(,$addr) = each($userAddresses))
  		{
  			$addrSelector['options'][$addr->getAddressId()] = $userAddressTypes[$addr->getTypeId()];
  		}

		$addrFields = array('addr'=>array('label'=>$loc->getText('userAddrAddress'),
											'field'=>array('type'=>'text',
	    													'name'=>'addr',
	    													'options'=>array('id'=>'addr','size'=>'60','maxlength'=>'128'))),
  		    				'city'=>array('label'=>$loc->getText('userAddrCity'),
  		    								'field'=>array('type'=>'text',
	    													'name'=>'addrcity',
	    													'options'=>array('size'=>'60','maxlength'=>'128'))),

  		    				'state'=>array('label'=>$loc->getText('userAddrState'),
 				 		    				'field'=>array('type'=>'text',
 					    									'name'=>'addrstate',
 					    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'pcode'=>array('label'=>$loc->getText('userAddrPostCode'),
  						    				'field'=>array('type'=>'text',
  					    									'name'=>'addrpcode',
  					    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'cntry'=>array('label'=>$loc->getText('userAddrCountry'),
 				 		    				'field'=>array('type'=>'text',
 					    									'name'=>'addrcntry',
 					    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'phone'=>array('label'=>$loc->getText('userAddrPhone'),
				  		    				'field'=>array('type'=>'text',
					    									'name'=>'addrphone',
					    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'contact'=>array('label'=>$loc->getText('userAddrContactName'),
				  		    				'field'=>array('type'=>'text',
					    									'name'=>'addrcont',
					    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'contactPhn'=>array('label'=>$loc->getText('userAddrContactPhone'),
 					 		    				'field'=>array('type'=>'text',
 						    									'name'=>'addrcontphn',
 						    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'comments'=>array('label'=>$loc->getText('userAddrComments'),
  		    									'field'=>array('type'=>'text',
	    														'name'=>'addrcomm',
	    														'options'=>array('size'=>'60','maxlength'=>'128'))));
	}
	else
  	{ // no addresses for this user
   		$addrSelector = null;
   		$addrChgSel = null;
  	}

	// !--------- Preferences (Label & Field) ----------
	$prefsQ = new UserPrefsQuery();
  	$userPrefs = $prefsQ->getPrefs($userid);
  	unset($prefsQ);

	$prefs = array('narrM'=>array('label'=>$loc->getText('userPrefNarratorMale') ,
									'field'=>array('type'=>'checkbox',
	    									'name'=>'narm',
	    									'value'=>'1')),
					'narrS'=>array('label'=>$loc->getText('userPrefNarratorSynth'),
									'field'=>array('type'=>'checkbox',
	    									'name'=>'nars',
	    									'value'=>'1')),
					'narrF'=>array('label'=>$loc->getText('userPrefNarratorFemale') ,
									'field'=>array('type'=>'checkbox',
	    									'name'=>'narf',
	    									'value'=>'1',
	    									'checked'=>$userPrefs->getNarratorFemale())),
					'lang'=>array('label'=>$loc->getText('userPrefContentLanguage') ,
									'field'=>array('type'=>'checkbox',
	    									'name'=>'lang',
	    									'value'=>'1')),
					'sex'=>array('label'=>$loc->getText('userPrefContentSex') ,
									'field'=>array('type'=>'checkbox',
	    									'name'=>'sex',
	    									'value'=>'1')),
					'viol'=>array('label'=>$loc->getText('userPrefContentViolence') ,
									'field'=>array('type'=>'checkbox',
	    									'name'=>'viol',
	    									'value'=>'1')),
					'bookS'=>array('label'=>$loc->getText('userPrefBooksShort') ,
									'field'=>array('type'=>'checkbox',
	    									'name'=>'books',
	    									'value'=>'1')),
					'bookL'=>array('label'=>$loc->getText('userPrefBooksLong') ,
									'field'=>array('type'=>'checkbox',
	    									'name'=>'bookl',
	    									'value'=>'1')),
					'brail'=>array('label'=>$loc->getText('userPrefBraille') ,
									'field'=>array('type'=>'checkbox',
	    									'name'=>'brail',
	    									'value'=>'1')),
					'perDev'=>array('label'=>$loc->getText('userPrefBooksPerDevice') ,
									'field'=>array('type'=>'text',
	    									'name'=>'perdev',
	    									'options'=>array('size'=>'2','maxlength'=>'2'))),
					'maxQ'=>array('label'=>$loc->getText('userPrefMaxQueuedRequests') ,
									'field'=>array('type'=>'text',
	    									'name'=>'maxq',
	    									'options'=>array('size'=>'3','maxlength'=>'3')))

					);

	// !--------- Profiles (Label & Field) ----------
	$profQ = new UserProfileQuery();
  	$userProfiles = $profQ->getProfiles($userid);
	unset($profQ);

	// !TODO make these language codes into a table
	$profLangs= array('en'=>'English','it'=>'Italian','fr'=>'French','gr'=>'Greek',"zh"=>"Chinese");

	$profiles = array();
	if(isset($userProfiles))
	{
		while (list(,$aProf) = each($userProfiles))
		{

			$profiles[(int)$aProf->getProfileId()] = array('proftype'=>array('field'=>array('type'=>'select',
																	'name'=>"ptypeid[".$aProf->getProfileId()."]",
																	'options'=>$userProfileTypes)),
									'profcont'=>array('field'=>array('type'=>'text',
																	'name'=>"pcont[".$aProf->getProfileId()."]",
																	'options'=>array('size'=>'35','maxlength'=>'60'))),
									'prefer'=>array('field'=>array('type'=>'checkbox',
																	'name'=>"ppref[".$aProf->getProfileId()."]",
																	'value'=>'1')),
									'proflang'=>array('field'=>array('type'=>'select',
																	'name'=>"plang[".$aProf->getProfileId()."]",
																	'options'=>$profLangs))
								);

		}
	}
	unset($profLangs);

	// !--------- Requests (Values dont change) ----------
	$reqsQ = new UserRequestsQuery();
	$requests = $reqsQ->getRequests($userid);
	unset($reqsQ);
	$smarty->assign('requests',$requests);
	$smarty->assign('reqDeleteButtonLabel',$loc->getText("userView_requestDeleteButtonLabel"));

	$userQ = new UserQuery();
	$user = $userQ->getUser($userid);
	SmartyValidate::register_object('userQry',$userQ);

	// !-- empty post
	if (empty($_POST))
	{

		SmartyValidate::connect($smarty,true);
		// register our custom criteria
       	SmartyValidate::register_criteria('isValidUsername','userQry->validateUsername');
       	// register validators
      	SmartyValidate::register_validator('v_snmEmpty', 'sname', 'notEmpty', false, false, 'trim');
		SmartyValidate::register_validator('v_unmEmpty', 'uname', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_unmInvalid', 'uname:uid', 'isValidUsername', false, false, 'trim');
		SmartyValidate::register_validator('v_dobIsDate', 'dob', 'isDate', true, false, 'trim'); // true denotes allowed to be empty

		// get values from db
		//* !--------- General (Initial Values) ---------- *

		$info['title']['field']['selected'] = $user->getTitleId();
		$info['fname']['field']['value'] = $user->getFirstname();
		$info['sname']['field']['value'] = $user->getSurname();
		$info['uname']['field']['value'] = $user->getUsername();
		$info['dob']['field']['value'] = $user->getBirthDate();
		$info['jade']['field']['value'] = $user->getJadeId();
		$info['class']['field']['selected'] = $user->getClassification();
		$info['mobile']['field']['value'] = $user->getMobilePhone();
		$info['email']['field']['value'] = $user->getEmail();
		$info['readLvl']['field']['selected'] = $user->getReadingLevelId();
		$info['recom']['field']['checked'] = $user->getAutoRecommend();
		$info['comments']['field']['value'] = $user->getComments();
		$info['status']['field']['selected'] = $user->getStatusId();

		//* !--------- Preferences (Initial Values)---------- *
		$prefsQ = new UserPrefsQuery();
	  	$userPrefs = $prefsQ->getPrefs($userid);
	  	unset($prefsQ);

		$prefs['narrM']['field']['checked'] = $userPrefs->getNarratorMale();
		$prefs['narrS']['field']['checked'] = $userPrefs->getNarratorSynth();
		$prefs['narrF']['field']['checked'] = $userPrefs->getNarratorFemale();
		$prefs['lang']['field']['checked'] = $userPrefs->getContentLanguage();
		$prefs['sex']['field']['checked'] = $userPrefs->getContentSex();
		$prefs['viol']['field']['checked'] = $userPrefs->getContentViolence();
		$prefs['bookS']['field']['checked'] = $userPrefs->getBooksShort();
		$prefs['bookL']['field']['checked'] = $userPrefs->getBooksLong();
		$prefs['brail']['field']['checked'] = $userPrefs->getBraille();
		$prefs['perDev']['field']['value'] = $userPrefs->getBooksPerDevice();
		$prefs['maxQ']['field']['value'] = $userPrefs->getMaxQueuedReqs();
		unset($userPrefs);

		// !--------- Addresses (Initial Values) ----------
		if(!count($userAddresses))
			goto PROFILE_VALS;

		$addrFields['addr']['field']['value'] = $userAddresses[0]->getAddress();
		$addrFields['city']['field']['value'] = $userAddresses[0]->getCity();
		$addrFields['state']['field']['value'] = $userAddresses[0]->getState();
		$addrFields['pcode']['field']['value'] = $userAddresses[0]->getPostCode();
		$addrFields['cntry']['field']['value'] = $userAddresses[0]->getCountry();
		$addrFields['phone']['field']['value'] = $userAddresses[0]->getPhone();
		$addrFields['contact']['field']['value'] = $userAddresses[0]->getContactName();
		$addrFields['contactPhn']['field']['value'] = $userAddresses[0]->getContactAltPhone();
		$addrFields['comments']['field']['value'] = $userAddresses[0]->getComments();
		unset($userAddresses);

	PROFILE_VALS:

		// !--------- Profiles (Initial Values) ----------
		if(!isset($userProfiles))
			goto PROCESS;

		reset($userProfiles);
		while (list(,$aProf) = each($userProfiles))
		{
			$profiles[(int)$aProf->getProfileId()]['proftype']['field']['selected'] = $aProf->getTypeId();
			$profiles[(int)$aProf->getProfileId()]['profcont']['field']['value'] = $aProf->getContent();
			$profiles[(int)$aProf->getProfileId()]['prefer']['field']['checked'] = $aProf->getPreferred();
			$profiles[(int)$aProf->getProfileId()]['proflang']['field']['selected'] = $aProf->getLanguage();
			$profiles[(int)$aProf->getProfileId()]['profid'] = $aProf->getProfileId();
		}

	PROCESS:
		unset($userProfiles);
		unset($profQ);

	}
	else
	{

	    // !-- validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
       		// no errors
       		SmartyValidate::disconnect();

       		#**************************************************************************
	   		#*  update library user
	   		#**************************************************************************
	   		require_once(__ROOT__."classes/User.php");
	   		$user = new User();

			$user->setUsername($_POST['uname']);
			$user->setBirthDate((isset($_POST['dob']))?$_POST['dob']:'');
			$user->setJadeid((isset($_POST['jid']))?$_POST['jid']:'');
		    $user->setFirstname((isset($_POST['fname']))?$_POST['fname']:'');
			$user->setSurname($_POST['sname']);
			$user->setTitleId($_POST['tid']);
			$user->setMobilePhone((isset($_POST['mobph']))?$_POST['mobph']:'');
			$user->setEmail((isset($_POST['email']))?$_POST['email']:'');
			$user->setClassification($_POST['class']);
			$user->setAutoRecommend(isset($_POST['recom']));
			$user->setComments((isset($_POST['comms']))?$_POST['comms']:'');
			$user->setReadingLevelId($_POST['rdlvl']);
	   		$user->setStatusId($_POST['sts']);

			if($userQ->updateUser($user) === false)
			{
				$msg = $loc->getText('userEdit_UpdateError');
				header("Location: user_search.php?msg=".HURL($msg));
				exit;
			}
			unset($userQ);
			unset($user);

			require_once(__ROOT__."classes/UserPrefs.php");

			$prefs = new UserPrefs();
			$prefs->setUserId($userid);
	    	$prefs->setContentSex(isset($_POST['sex']));
			$prefs->setContentViolence(isset($_POST['viol']));
			$prefs->setContentLanguage(isset($_POST['lang']));
			$prefs->setNarratorMale(isset($_POST['narm']));
			$prefs->setNarratorFemale(isset($_POST['narf']));
			$prefs->setNarratorSynth(isset($_POST['nars']));
			$prefs->setBooksShort(isset($_POST['books']));
			$prefs->setBooksLong(isset($_POST['bookl']));
			$prefs->setBraille(isset($_POST['brail']));
			$prefs->setBooksPerDevice($_POST['perdev']);
			$prefs->setMaxQueuedReqs($_POST['maxq']);

			$prefQ = new UserPrefsQuery();
			$prefQ->updatePrefs($prefs);
			unset($prefQ);
			unset($prefs);


			if(isset($_POST['addrid']))
			{
				// process address
				require_once(__ROOT__."classes/UserAddress.php");
				$address = null;
				// get the selected address
				foreach($userAddresses as $anAddress)
				{
					if($anAddress->getAddressId()==$_POST['addrid'])
					{
						$address = $anAddress;
						break;
					}
				}

				// check if we are changing the address type
				if ($_POST['addrchgtyp']>0)
					{ $address->setTypeId((int)$_POST['addrchgtyp']); }

				$address->setAddress((isset($_POST['addr']))?$_POST['addr']:'');
				$address->setCity((isset($_POST['addrcity']))?$_POST['addrcity']:'');
				$address->setState((isset($_POST['addrstate']))?$_POST['addrstate']:'');
				$address->setPostCode((isset($_POST['addrpcode']))?$_POST['addrpcode']:'');
				$address->setCountry((isset($_POST['addrcntry']))?$_POST['addrcntry']:'');
				$address->setPhone((isset($_POST['addrphone']))?$_POST['addrphone']:'');
				$address->setContactName((isset($_POST['addrcont']))?$_POST['addrcont']:'');
				$address->setContactAltPhone((isset($_POST['addrcontphn']))?$_POST['addrcontphn']:'');
				$address->setComments((isset($_POST['addrcomm']))?$_POST['addrcomm']:'');

				$addrQ = new UserAddressQuery();
				$addrQ->updateAddress($address);
				unset($address);
				unset($addrQ);
			}

			CHECK_PROFILES:
			if(!isset($_POST['ptypeid'])) goto UPDATE_COMPLETE;
			// profiles
			// iterate through the profile values if any
			// so we can rebuild the list for updating
			require_once(__ROOT__."classes/UserProfile.php");
			$profileUpdates = array();
			while (list($pid,$val) = each($_POST['ptypeid']))
			{
				$aProf = new UserProfile();
				$aProf->setProfileId($pid);
				$aProf->setUserId($userid);
				$aProf->setTypeId($val);
				$aProf->setContent($_POST['pcont'][$pid]);
				$aProf->setPreferred(isset($_POST['ppref'][$pid]));
				$aProf->setLanguage($_POST['plang'][$pid]);
				$profileUpdates[] = $aProf;
			}
			$profQ = new UserProfileQuery();
			$profQ->updateProfiles($profileUpdates);
			unset($profQ);
			unset($profileUpdates);

		UPDATE_COMPLETE:
			$msg = $loc->getText('userEdit_UpdateSuccess');
			header("Location: user_view.php?uid=".HURL($userid)."&msg=".HURL($msg));
			exit;

       	}
		else // invalid data entered
		{
			$smarty->assign($_POST);

			$info['title']['field']['selected'] = $_POST['tid'];
           	$info['fname']['field']['value'] = $_POST['fname'];
           	$info['sname']['field']['value'] = $_POST['sname'];
           	$info['uname']['field']['value'] = $_POST['uname'];
           	$info['email']['field']['value'] = $_POST['email'];
           	$info['comments']['field']['value'] = $_POST['comms'];
           	$info['recom']['field']['checked'] = (isset($_POST['recom']));

           	$info['dob']['field']['value'] = $_POST['dob'];
            $info['jade']['field']['value'] = $_POST['jid'];
           	$info['class']['field']['selected'] = $_POST['class'];
            $info['mobile']['field']['value'] = $_POST['mobph'];
          	$info['readLvl']['field']['selected'] = $_POST['rdlvl'];
            $info['status']['field']['selected'] = $_POST['sts'];

 			$addrSelector['selected'] = $_POST['addrid'];

 			$addrFields['addr']['field']['value'] = $_POST['addr'];
 			$addrFields['city']['field']['value'] = $_POST['addrcity'];
  			$addrFields['state']['field']['value'] = $_POST['addrstate'];
  			$addrFields['pcode']['field']['value'] = $_POST['addrpcode'];
 			$addrFields['cntry']['field']['value'] = $_POST['addrcntry'];
  			$addrFields['phone']['field']['value'] = $_POST['addrphone'];
  			$addrFields['contact']['field']['value'] = $_POST['addrcont'];
 			$addrFields['contactPhn']['field']['value'] = $_POST['addrcontphn'];
  			$addrFields['comments']['field']['value'] = $_POST['addrcomm'];

          	$prefs['narrM']['field']['checked'] = $_POST['narm'];
			$prefs['narrS']['field']['checked'] = $_POST['nars'];
			$prefs['narrF']['field']['checked'] = $_POST['narf'];
			$prefs['lang']['field']['checked'] = $_POST['lang'];
			$prefs['sex']['field']['checked'] = $_POST['sex'];
			$prefs['viol']['field']['checked'] = $_POST['viol'];
			$prefs['bookS']['field']['checked'] = $_POST['books'];
			$prefs['bookL']['field']['checked'] = $_POST['bookl'];
			$prefs['brail']['field']['checked'] = $_POST['brail'];
			$prefs['perDev']['field']['value'] = $_POST['perdev'];
			$prefs['maxQ']['field']['value'] = $_POST['maxq'];

			// iterate through the profile values
			// so we can rebuild the list for smarty
			while (list($pid,$val) = each($_POST['ptypeid']))
			{
				$profiles[(int)$pid]['proftype']['field']['selected'] = $val;
				$profiles[(int)$pid]['profcont']['field']['value'] = $_POST['pcont'][$pid];
				$profiles[(int)$pid]['prefer']['field']['checked'] = isset($_POST['ppref'][$pid]);
				$profiles[(int)$pid]['proflang']['field']['selected'] = $_POST['plang'][$pid];
			}
		}
	}

	// !-------- Content Assigning ---------
	$smarty->assign('contentHeader',$loc->getText("userEdit_contentHeader",array('name'=>$user->getFullName())));
	$smarty->assign('info',$info);
	$smarty->assign('addrSel',$addrSelector);
	$smarty->assign('addrChgSel',$addrChgSel);
	$smarty->assign('addrFields',$addrFields);
	$smarty->assign('addressBody',$smarty->fetch('users/user_address_body.tpl','users'));
	$smarty->assign('addrFields',null); // no need to pass these values after they have been processed

	$smarty->assign('prefs',$prefs);
	$smarty->assign('profiles',$profiles);
	$smarty->assign('uid',$userid);

	$smarty->display('users/user_edit.tpl','users');
	exit;
