<?php
	if((!isset($_POST) || empty($_POST)) || (!isset($_POST['n']) && !isset($_POST['u']) && !isset($_POST['p']) && !isset($_POST['j']) && !isset($_POST['a']))) 
		exit;
	
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(__ROOT__."classes/UserQuery.php");	
	$userQ = new UserQuery();

	$keys = array_keys($_POST);
	$vals = array_values($_POST);
	
	$someUsers = array();
	$vals[0] = trim($vals[0]);
	if (!strlen($vals[0]))
	{
		echo "";
		return;
	} 
	$someUsers = $userQ->usersWithCriteria($keys[0],$vals[0]);
	
	header("Expires: Sun, 19 Nov 1978 05:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	$smarty->assign('clients',$someUsers);
	echo $smarty->fetch('users/user_search_body.tpl','users');
	
