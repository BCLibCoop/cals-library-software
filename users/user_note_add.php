<?php

	if ((!isset($_POST)) || (!isset($_GET['uid']))) 
	{
    	echo "";
   	}
	
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UserQuery.php");

	$userid = $_GET['uid'];
	$noteContent = $_POST['nt'];
	unset($_POST);
	unset($_GET);
	
	$noteQ = new UserNoteQuery();
	
	if(($noteQ->addNote($userid,$noteContent)))
	{
		$notes = $noteQ->getNotes($userid);
		$smarty->assign("notesHist",$notes);
		echo $smarty->fetch('users/user_notes_body.tpl','users');
		unset($noteQ);
	}	
	
	
