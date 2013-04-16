<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "admin";
 	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  	$nav = "tasks";
	$restrictInDemo = true;

  	require_once(__ROOT__."admin/header_admin.php");
	$smarty->display("admin/tasks.tpl","admin");
