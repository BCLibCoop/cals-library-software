<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

 	$tab = "devices";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	session_cache_limiter(null);

  	$nav = "connected";
  	$helpPage = "devices";

  	require_once(__ROOT__."admin/header_admin.php");
	$smarty->assign('tableHeader1',$loc->getText("devicesConnected_assignedTo"));
	$smarty->display("devices/devices_connected.tpl","devices");

exit;

