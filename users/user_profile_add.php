<?php

	// ignore empty content
	if ((!isset($_POST)) || (!isset($_GET['uid'])) || (!isset($_POST['c'])) || ($_POST['c']==''))
	{
    	exit;
   	}

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UserQuery.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UserProfile.php");

	$prof = new UserProfile();
	$prof->setUserId($_GET['uid']);
	$prof->setLanguage($_POST['l']);
	$prof->setTypeId($_POST['t']);
	$prof->setPreferred((boolean)$_POST['p']);
	$prof->setContent($_POST['c']);
	unset($_POST);
	unset($_GET);

	$profileQ = new UserProfileQuery();
	if(($profileQ->addProfile($prof)))
	{
		$dmQ = new DmQuery();
		$userProfileTypes = $dmQ->getAssoc('user_profile_type_dm','descr','typeid');
		$languages = $dmQ->getAssoc("languages_dm","short_descr");
		$userProfiles = $profileQ->getProfiles($prof->getUserId());
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

		$smarty->assign("profiles",$profiles);
		echo $smarty->fetch('users/user_profiles_body.tpl','users');
		unset($prof);
		unset($profileQ);
	}


