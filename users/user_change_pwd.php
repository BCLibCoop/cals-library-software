<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "users";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "changePasswd";
  $restrictInDemo = true;

  	if (!isset($_GET["uid"]) && (empty($_POST))){
    	header("Location: ../users/user_search.php");
    	exit();
    }

  	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/User.php");
	require_once(__ROOT__."classes/UserQuery.php");

  	$uid = $staff = null;
	$uid=(isset($_GET["uid"]))?$_GET["uid"]:$_POST['uid'];

	$userQ = new UserQuery();
	$user = new User();
    $user = $userQ->getuser($uid);


  	$info['pass'] = array('label'=>$loc->getText("userNew_password"),
  							'validate'=>array('passEmpty'=>$loc->getText("userValidate_passwordNotEmpty")));
   	$info['pass2'] = array('label'=>$loc->getText("userNew_passwordValidate"),
  							'validate'=>array('pass2Empty'=>$loc->getText("userValidate_passwordNotEmpty"),
  												'passNE'=>$loc->getText("userValidate_passwordNotEqual")));

    $smarty->assign('uid',$uid);
    $smarty->assign('contentHeader',$loc->getText('userPassword_changeContentHeader',array('name'=>$user->getFullName())));
  	//$smarty->assign('formHeaderLabel',$loc->getText("adminStaff_passwordFormHeader"));
  	$smarty->assign('submitButtonLabel',$loc->getText("userUpdate"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("userCancel"));

  	if(empty($_POST))
	{
		// new form, we (re)set the session data
        SmartyValidate::connect($smarty, true);
        // register our validators
        SmartyValidate::register_validator('v_passEmpty', 'pass', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_pass2Empty', 'pass2', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_passNE', 'pass:pass2', 'isEqual', false, false, 'trim');

  		$smarty->assign('info',$info);
		$smarty->display('users/user_change_pwd.tpl','users');
	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();

			$user->setPassword($_POST['pass']);
			$user->setUserId($uid);
			$user->setChangedByStaffId($_SESSION['_admin']['staffid']);

			if ($userQ->updatePassword($user))
				$msg = $loc->getText("userPassword_pwdResetSuccess").$user->getFullname();
			else
			    $msg = "Error Updating user, ".$user->getFullname();

			unset($_POST);


			header("Location: ../users/user_search.php?msg=".HURL($msg));
			exit;
       	} else {
        	// error, redraw the form

           	$smarty->assign($_POST);
           	$info['pass']['value'] = $_POST['pass'];
           	$info['pass2']['value'] = $_POST['pass2'];
           	$smarty->assign('info',$info);
           	$smarty->display('users/user_change_pwd.tpl','users');
       		exit;
       	}
  	}
