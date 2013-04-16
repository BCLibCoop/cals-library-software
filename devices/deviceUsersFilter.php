<?php

	if((!isset($_POST)) || (!isset($_POST['n'])))
		exit;

	$tab="devices";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

	require_once(__ROOT__."classes/UserQuery.php");
	$userQ = new UserQuery();
	$someUsers = $userQ->fetchAllUserNames($_POST['n']);
	$smarty->assign('clientNames',$someUsers);
	echo $smarty->fetch('devices/device_edit_body.tpl','devices');

