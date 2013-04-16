<?php

	if((!isset($_GET)) || (!isset($_GET['uid'])))
		exit;

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(__ROOT__."classes/UserQuery.php");

	$userid = $_GET['uid'];
	$histQ = new UserHistoryQuery();
	$hist = $histQ->getReadingHistory($userid,(isset($_GET['fh'])));
	unset($histQ);
	$smarty->assign('readHist',$hist);
	echo $smarty->fetch('users/user_history_body.tpl','users');
	$smarty->assign('readHist',null);
	exit;

