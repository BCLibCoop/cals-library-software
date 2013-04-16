<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "admin";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

	$nav = "summary";

  	require_once(__ROOT__.'admin/header_admin.php');
	$smarty->assign("adminSummaryHeader",$loc->getText("adminSummaryHeader"));
	$smarty->assign("adminSummaryDesc",$loc->getText("adminSummaryDesc"));
	$smarty->display("admin/index.tpl","admin");
