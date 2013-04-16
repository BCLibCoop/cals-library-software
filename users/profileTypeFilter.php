<?php

	if ((!isset($_POST)) || (!isset($_GET['pt'])))
	{
    	exit;
   	}

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Dm.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");

	$field = array();
	//$smarty->assign('id',$_GET['pt']);
	if($_GET['pt']==2) // check for subject/genre
	{
		$dmQ = new DmQuery();
		$field['type']='select';
		$field['content'] = array_flip($dmQ->getAssoc('subject_list_dm','subjectid','descr'));
		$field['name'] = 'profvalue';

		goto DISPLAY;
	}
	else
	{

	}

DISPLAY:
	$smarty->assign('field', $field);

	echo $smarty->fetch('users/profile_type.tpl','users');

