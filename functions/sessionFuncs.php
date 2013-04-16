<?php

/* Session Functions */


function isGuest()
{
	$isGuest = true;

	if (!isset($_SESSION['_user']['id']) || ($_SESSION['_user']['id'] == '')) {
		goto BAIL;
	}
	if (!isset($_SESSION['_user']['token']) || ($_SESSION['_user']['token'] == '')) {
		goto BAIL;
	}

	require_once(dirname(__FILE__)."/../classes/SessionQuery.php");
	$sessionQ = new SessionQuery();
	$token = $sessionQ->getToken('User'.$_SESSION['_user']['id'],false);
	if (($token === false) || ($token !== $_SESSION['_user']['token']) ) {
		session_destroy();
	}
	else
		$isGuest = false;

	unset($sessionQ);

BAIL:

	return $isGuest;
}
