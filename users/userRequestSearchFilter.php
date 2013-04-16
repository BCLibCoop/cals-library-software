<?php
	//print_r($_POST);exit;

	if((!isset($_POST) || empty($_POST)) || (!isset($_POST['t']) && !isset($_POST['a']) && !isset($_POST['g']) && !isset($_POST['s']))) 
		exit;

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(__ROOT__."classes/BiblioQuery.php");	
	$bibQ = new BiblioQuery();

	$keys = array_keys($_POST);
	$vals = array_values($_POST);
	
	$userid = $_POST['uid'];
	$showAll = (isset($_POST['sa']))?true:false;
	
	$someEntries = array();
	$mode = $keys[0];
	$srchVals = trim($vals[0]);
	if (!strlen($srchVals))
	{
		echo "";
		return;
	} 
	
	switch($mode)
	{
		case 't':
			$someEntries = $bibQ->catalogEntriesWithCriteria("t",$srchVals,$userid,$showAll);
		break;
		case 'a':
			$someEntries = $bibQ->catalogEntriesWithCriteria("a",$srchVals,$userid,$showAll);
		break;
		case 'g':
			$someEntries = $bibQ->catalogEntriesWithCriteria("g",$srchVals,$userid,$showAll);
		break;
		case 's':
			$someEntries = $bibQ->catalogEntriesWithCriteria("s",$srchVals,$userid,$showAll);
		break;
		default:
		break;
	}
	
	header("Expires: Sun, 19 Nov 1978 05:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	$smarty->assign('entries',$someEntries);
	echo $smarty->fetch('users/user_request_search_body.tpl','users');
	
