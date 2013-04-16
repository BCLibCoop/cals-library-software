<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	require_once(__ROOT__."functions/sessionFuncs.php");

	$isGuest = isGuest();

	if($isGuest)
		$smarty->assign('loginOutButton',array('label'=>'Login','ref'=>'login.php'));
	else
		$smarty->assign('loginOutButton',array('label'=>'Logout','ref'=>'logout.php'));
