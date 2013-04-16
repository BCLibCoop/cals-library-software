<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
#*********************************************************************************
#*  adminchecklogin.php
#*  Description: Used to verify signon token on every secured page.
#*               Redirects to the login page if token not valid.
#*********************************************************************************

  require_once('../classes/SessionQuery.php');

  #****************************************************************************
  #*  Checking to see if we are in demo mode and if we should not execute this
  #*  page.
  #****************************************************************************
  if (isset($restrictInDemo) && $restrictInDemo && OBIB_DEMO_FLG) {
    include('../shared/demo_msg.php');
  }
  
	$pages = array(
      'home'=>'../home/index.php',
      'users'=>'../users/index.php',
      'devices'=>'../devices/index.php',
      'catalog'=>'../catalog/index.php',
      'admin'=>'../admin/index.php',
      'reports'=>'../reports/index.php'
    );
   
  $returnPage = ((isset($tab))&&($tab!=''))?$pages[$tab]:$pages['home'];
  $_SESSION['_admin']['returnPage'] = $returnPage;

  #****************************************************************************
  #*  Checking to see if session variables exist
  #****************************************************************************
    
  if (!isset($_SESSION['_admin']['staffid']) or ($_SESSION['_admin']['staffid'] == '')) {
    header('Location: ../admin/adminLogin.php');
    exit();
  }
  if (!isset($_SESSION['_admin']['token']) or ($_SESSION['_admin']['token'] == '')) {
    header('Location: ../admin/adminLogin.php');
    exit();
  }

  #****************************************************************************
  #*  Checking session table to see if session_id has timed out
  #****************************************************************************
  $sessQ = new SessionQuery();
  if (!$sessQ->validToken('Admin'.$_SESSION['_admin']['staffid'], $_SESSION['_admin']['token'], false)) 
  {
    header('Location: ../admin/adminLogin.php?RET='.U($returnPage));
    exit();
  }
  unset($sessQ);
  
  #****************************************************************************
  #*  Checking authorization for this tab
  #*  The session authorization flags were set at login in login.php
  #****************************************************************************
  	$isValid = false;
  	switch ($tab)
  	{
  		case 'users':
  			$isValid = ($_SESSION['_admin']['hasUsersAuth']);
  			break;
  		case 'devices':
  			$isValid = ($_SESSION['_admin']['hasDevicesAuth']);
  			break;
  		case 'catalog':
  			$isValid = ($_SESSION['_admin']['hasCatalogAuth']);
  			break;
  		case 'admin':
  			$isValid = ($_SESSION['_admin']['hasAdminAuth']);
  			break;
  		case 'reports':
  			$isValid = ($_SESSION['_admin']['hasReportsAuth']);
  			break;
  		case 'home':
  			$isValid = true;
  			break;
  		default:
  			$isValid = false;
  			break;
  	}
  	
  	if (!$isValid)
  	{
  		$smarty->assign('contentStatusMsg',$loc->getText('notAuthMsg'));
  		$smarty->display('private/noAuth.tpl','admin');
  		exit;
  	}
  