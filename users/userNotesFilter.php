<?php

	if ((!isset($_POST)) || (!isset($_GET['uid']))) 
	{
    	exit;
   	}
	
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UserQuery.php");

	$userid = $_GET['uid'];
	$noteContent = $_POST['nt'];
	
	$noteQ = new UserNoteQuery();
	if($noteContent != "")
		$notes = $noteQ->notesWithContent($userid,$noteContent);
	else
		$notes = $noteQ->getNotes($userid,(isset($_GET["sa"])));
	
	$smarty->assign("notesHist",$notes);
	echo $smarty->fetch('users/user_notes_body.tpl','users');
	unset($noteQ);
	unset($_POST);
	unset($_GET);