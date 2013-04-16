<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

 	$tab = (isset($tab)&&$tab!='')?$tab:"home";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	$nav = "";


	$headerLoc = new Localize(OBIB_LOCALE,'shared');
	//require_once(__ROOT__.'admin/header_admin.php');
	require_once(__ROOT__.'classes/StaffQuery.php');
	require_once(__ROOT__.'classes/Staff.php');
	require_once(__ROOT__.'classes/SessionQuery.php');

	$smarty->assign('formHeader',$headerLoc->getText("loginFormTbleHdr"));
	$smarty->assign('usernameLabel',$headerLoc->getText("loginFormUsername"));
	$smarty->assign('passwordLabel',$headerLoc->getText("loginFormPassword"));
	$smarty->assign('submitButtonLabel',$headerLoc->getText("loginFormLogin"));
	$smarty->assign('invalidLoginMsg','Invalid login');
	$smarty->assign('loginOutButton',null);

	$staffQ = new StaffQuery();
    SmartyValidate::register_object('staffQry',$staffQ);

	if(empty($_POST))
	{
		// new form, we (re)set the session data
		SmartyValidate::connect($smarty, true);

        // register our validators
        SmartyValidate::register_criteria('isValidLogin','staffQry->validateLogin');
        SmartyValidate::register_validator('v_login', 'uname:pwd', 'isValidLogin', false, false, 'trim');

		$smarty->display('admin/login.tpl','admin');
	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();

  			$staff = $staffQ->getStaffMember();
  			if (!isset($staff)) header("Location: ../admin/index.php");


  			#****************************************************************************
			#*  Redirect to suspended message if suspended
			#****************************************************************************
			if ($staff->isSuspended()) {
			  header('Location: ../shared/suspended.php');
			  exit();
			}

			#**************************************************************************
			#*  Insert new session row with random token
			#**************************************************************************

			$sessionQ = new SessionQuery();
			$token = $sessionQ->getToken('Admin'.$staff->getStaffid(),false);
			if ($token === false) {
			  // failed to get token
			  header("Location: ../admin/index.php");
			}
			unset($sessionQ);

  			$_SESSION['_admin']['username'] = $staff->getUsername();
			$_SESSION['_admin']['staffid'] = $staff->getStaffid();
			$_SESSION['_admin']['token'] = $token;
			$_SESSION['_admin']['loginAttempts'] = 0;
			$_SESSION['_admin']['hasAdminAuth'] = $staff->hasAdminAuth();
			$_SESSION['_admin']['hasUsersAuth'] = $staff->hasUsersAuth();
			$_SESSION['_admin']['hasDevicesAuth'] = $staff->hasDevicesAuth();
			$_SESSION['_admin']['hasCatalogAuth'] = $staff->hasCatalogAuth();
			$_SESSION['_admin']['hasReportsAuth'] = $staff->hasReportsAuth();

  			#**************************************************************************
			#*  Redirect to return page
			#**************************************************************************

		  	// check that the return page is set
  			// stops blank page if user uses browser history and starts at the admin login page
  			$retPage = (isset($_SESSION['_admin']['returnPage']))?$_SESSION['_admin']['returnPage']:null;
  			$_SESSION['_admin']['returnPage'] = ((!isset($retPage)) || ($retPage==''))?'../home/index.php':$retPage;
			header('Location: '.$_SESSION['_admin']['returnPage']);

       	} else {
        	// error, redraw the form
           	$smarty->assign($_POST);
           	$smarty->display('admin/login.tpl','admin');
       	}
    }

	exit;
