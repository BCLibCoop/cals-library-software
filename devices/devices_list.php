<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

 	$tab = "devices";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	session_cache_limiter(null);

  	$nav = "list";
  	$helpPage = "devices";

  	require_once(__ROOT__."admin/header_admin.php");

	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

	$smarty->assign("contentHeader",$loc->getText("devicesList_contentHeader"));
	$smarty->assign("userSearchLabel",$loc->getText("devicesList_searchClientName"));
	$smarty->assign("cartridgeSearchLabel",$loc->getText("devicesList_searchBarcode"));
	$smarty->assign("submitButtonLabel",$loc->getText("deviceEdit"));
	$smarty->display("devices/index.tpl","devices");
