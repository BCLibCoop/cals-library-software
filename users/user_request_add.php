<?php

	if ((!isset($_POST)) || ((!isset($_POST['bid'])) || ($_POST['bid'] == '')) || ((!isset($_POST['uid'])) || ($_POST['uid'] == '')) ) {
    	header("Location: ../users/index.php");
    	exit();
    }
	
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UserQuery.php");

	$userid = $_POST['uid'];
	$catid = $_POST['bid'];
	unset($_POST);
	
	$requestsQuery = new UserRequestsQuery();
	
	if(($requestsQuery->addRequest($userid,$catid)))
		$msg = "Sucessfully added request";	
	else
		$msg = "Error adding request";
	
    header("Location: ../users/user_request.php?uid=".H($userid)."&msg=".H($msg));
    exit();
