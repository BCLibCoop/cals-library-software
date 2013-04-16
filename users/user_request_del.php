<?php

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

	#****************************************************************************
  	#*  Checking for POST vars.  Go back to form if none found.
	#****************************************************************************
	
	if ((!isset($_POST)) || ((!isset($_POST['reqid'])) || ($_POST['reqid'] == '')) || ((!isset($_POST['userid'])) || ($_POST['userid'] == '')) ) {
    	header("Location: ../users/index.php");
    	exit();
    }

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UserQuery.php");

	$userid = $_POST['userid'];
	$reqid = $_POST['reqid'];
		
	unset($_POST);
	
	$requestsQuery = new UserRequestsQuery();
	if(($requestsQuery->deleteRequest($reqid)))  
		$msg = "Request removed.";	
	else
		$msg = "Error Removing Request";
	
    header("Location: ../users/user_view.php?userid=".H($userid)."&msg=".H($msg).'#5');
    exit();
