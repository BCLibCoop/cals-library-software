<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
	$tab = "users";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  	$nav = "new";
  	$helpPage = "users";

  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/DmQuery.php");

	#****************************************************************************
  	#*  Loading a few domain tables into associative arrays
  	#****************************************************************************

	$dmQ = new DmQuery();
  	$userClassifications = $dmQ->getAssoc('user_classify_dm');
  	$userStatusTypes = $dmQ->getAssoc('user_status_type_dm','status','statusid');
  	$userTitleTypes = $dmQ->getAssoc('user_titles_dm','title','titleid');
  	// add a blank choice for the title types as there is no 0 in the db
  	$userTitleTypes[0] = '';
  	asort($userTitleTypes);
  	$userAddressTypes = $dmQ->getAssoc('user_address_type_dm','type','typeid');
	$userProfileTypes = $dmQ->getAssoc('user_profile_type_dm','descr','typeid');
	$readingLevels = $dmQ->getAssoc('audience_dm');
	unset($dmQ);

	$smarty->assign('contentHeader',$loc->getText('userNew_addUserContentMsg'));
	$smarty->assign('noProfilesMsg',$loc->getText('userNew_noProfilesMsg'));
	$smarty->assign('noHistoryMsg',$loc->getText('userNew_noHistoryMsg'));
	$smarty->assign('noRequestsMsg',$loc->getText('userNew_noRequestsMsg'));
	$smarty->assign('submitButtonLabel',$loc->getText('userNew_addUserButtonLabel'));
	$smarty->assign('cancelButtonLabel',$loc->getText('userCancel'));

	// !--------- General Info (Label & Field) ----------
	$infoLeft = array('title'=>array('label'=>$loc->getText('userEdit_title'),
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
					'pass'=>array('label'=>$loc->getText('userNew_password'),
									'field'=>array('type'=>'password',
	    											'name'=>'pwd',
	    											'options'=>array('size'=>'20','maxlength'=>'20')),
	    							'validate'=>array('v_passEmpty'=>$loc->getText("userValidate_passwordNotEmpty"))),
					'pass2'=>array('label'=>$loc->getText('userNew_passwordValidate'),
									'field'=>array('type'=>'password',
	    											'name'=>'pwdval',
	    											'options'=>array('size'=>'20','maxlength'=>'20')),
	    							'validate'=>array('v_pass2Empty'=>$loc->getText("userValidate_passwordNotEmpty"),
  												'v_passNE'=>$loc->getText("userValidate_passwordNotEqual"))),
	    			'email'=>array('label'=>$loc->getText('userView_email'),
									'field'=>array('type'=>'text',
	    											'name'=>'email',
	    											'options'=>array('size'=>'40','maxlength'=>'100'))),
	    			'comments'=>array('label'=>$loc->getText('userView_comments'),
										'field'=>array('type'=>'text',
	    											'name'=>'comms',
	    											'options'=>array('size'=>'40','maxlength'=>'500'))),
	    			'recom'=>array('label'=>$loc->getText('userView_wantsRecommend'),
									'field'=>array('type'=>'checkbox',
	    									'name'=>'recom',
	    									'value'=>'1'))
	);

	$infoRight = array('dob'=>array('label'=>$loc->getText('userView_birthDate'),
									'field'=>array('type'=>'text',
	    											'name'=>'dob',
	    											'options'=>array('size'=>'10','maxlength'=>'10')),
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

					'readLvl'=>array('label'=>$loc->getText('userView_readingLevel'),
										'field'=>array('type'=>'select',
	    									'name'=>'rdlvl',
	    									'options'=>$readingLevels))
	);

	// !--------- Addresses (Label & Field) ----------
	$addrSelector = array('name'=>'addrtyp','options'=>$userAddressTypes);
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


	// !--------- Preferences (Label & Field) ----------
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
	    									'value'=>'1')),
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

	require_once(__ROOT__."classes/UserQuery.php");
	$userQ = new UserQuery();
	SmartyValidate::register_object('userQry',$userQ);

	if(empty($_POST))
	{
		// new form, we (re)set the session data
        SmartyValidate::connect($smarty, true);

        // register our custom criteria
       	SmartyValidate::register_criteria('isValidUsername','userQry->validateUsername');
       	// register validators
       	SmartyValidate::register_validator('v_snmEmpty', 'sname', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_unmEmpty', 'uname', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_unmInvalid', 'uname', 'isValidUsername', false, false, 'trim');
        SmartyValidate::register_validator('v_passEmpty', 'pwd', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_pass2Empty', 'pwd', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_passNE', 'pwd:pwdval', 'isEqual', false, false, 'trim');
		SmartyValidate::register_validator('v_dobIsDate', 'dob', 'isDate', true, false, 'trim'); // true denotes allowed to be empty

		require_once(__ROOT__."classes/UserPrefs.php");
		// set the defaults for the user prefs
		$userPrefs = new UserPrefs();
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

		$infoRight['class']['field']['selected']=1;

	}
	else
	{
		// validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();

		  	#**************************************************************************
	   		#*  Insert new library user
	   		#**************************************************************************
	   		require_once(__ROOT__."classes/User.php");
	   		$aUser = new User();

			$aUser->setUsername($_POST['uname']);
			$aUser->setBirthDate((isset($_POST['dob']))?$_POST['dob']:$aUser->getBirthDate());
			$aUser->setPassword($_POST['pwd']);
			$aUser->setJadeid((isset($_POST['jid']))?$_POST['jid']:'');
		    $aUser->setFirstname((isset($_POST['fname']))?$_POST['fname']:'');
			$aUser->setSurname($_POST['sname']);
			$aUser->setTitleId($_POST['tid']);
			$aUser->setMobilePhone((isset($_POST['mobph']))?$_POST['mobph']:'');
			$aUser->setEmail((isset($_POST['email']))?$_POST['email']:'');
			$aUser->setClassification($_POST['class']);
			$aUser->setAutoRecommend(isset($_POST['recom']));
			$aUser->setComments((isset($_POST['comms']))?$_POST['comms']:'');
			$aUser->setReadingLevelId($_POST['rdlvl']);

			$userid = $userQ->addUser($aUser);
			if($userid == false)
			{
				$msg = $loc->getText('userNew_CreateError');
				header("Location: user_search.php?msg=".HURL($msg));
				exit;
			}

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
			$prefQ->addPrefs($prefs);

			// check for a non empty set of address fields
			// if even 1 field has data an address will be created
			if(!((isset($_POST['addr']) && $_POST['addr']=='')
				&& (isset($_POST['addrcity']) && $_POST['addrcity']=='')
				&& (isset($_POST['addrstate']) && $_POST['addrstate']=='')
				&& (isset($_POST['addrpcode']) && $_POST['addrpcode']=='')
				&& (isset($_POST['addrcntry']) && $_POST['addrcntry']=='')
				&& (isset($_POST['addrphone']) && $_POST['addrphone']=='')
				&& (isset($_POST['addrcont']) && $_POST['addrcont']=='')
				&& (isset($_POST['addrcontphn']) && $_POST['addrcontphn']=='')
				&& (isset($_POST['addrcomm']) && $_POST['addrcomm']=='')))
			{
				// process address
				require_once(__ROOT__."classes/UserAddress.php");
				$address = new UserAddress();
				$address->setUserId($userid);
				$address->setTypeId($_POST['addrtyp']);
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
				$addrQ->addAddress($address);
			}

			$msg = $loc->getText('userNew_CreateSuccess');
			header("Location: user_view.php?uid=".HURL($userid)."&msg=".HURL($msg));
			exit;
		}
		else
		{
			// error, redraw the form
           	$smarty->assign($_POST);

           	$infoLeft['title']['field']['selected'] = $_POST['tid'];
           	$infoLeft['fname']['field']['value'] = $_POST['fname'];
           	$infoLeft['sname']['field']['value'] = $_POST['sname'];
           	$infoLeft['uname']['field']['value'] = $_POST['uname'];
           	$infoLeft['pass']['field']['value'] = $_POST['pwd'];
           	$infoLeft['pass2']['field']['value'] = $_POST['pwdval'];
           	$infoLeft['email']['field']['value'] = $_POST['email'];
           	$infoLeft['comments']['field']['value'] = $_POST['comms'];
           	$infoLeft['recom']['field']['checked'] = (isset($_POST['recom']));

           	$infoRight['dob']['field']['value'] = $_POST['dob'];
            $infoRight['jade']['field']['value'] = $_POST['jid'];
           	$infoRight['class']['field']['selected'] = $_POST['class'];
            $infoRight['mobile']['field']['value'] = $_POST['mobph'];
          	$infoRight['readLvl']['field']['selected'] = $_POST['rdlvl'];


 			$addrSelector['selected'] = $_POST['addrtyp'];
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
		}

	}

	$smarty->assign('infoLeft',$infoLeft);
	$smarty->assign('infoRight',$infoRight);
	$smarty->assign('addrSel',$addrSelector);
	$smarty->assign('addrFields',$addrFields);
	$smarty->assign('addressBody',$smarty->fetch('users/user_address_body.tpl','users'));
	$smarty->assign('addrFields',null); // no need to pass these values after they have been processed
	$smarty->assign('prefs',$prefs);

	$smarty->display('users/user_new.tpl','users');
	exit;
