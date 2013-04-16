<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

 	$tab = "users";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	session_cache_limiter(null);

  	$nav = "search";
  	$helpPage = "users";

  	require_once(__ROOT__."admin/header_admin.php");

	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

	$searchBar = array('name'=>array('label'=>$loc->getText("usersSearch_barHeaderClientName")),
						'username'=>array('label'=>$loc->getText("usersSearch_barHeaderUsername")),
						'phone'=>array('label'=>$loc->getText("usersSearch_barHeaderPhone")),
						'jade'=>array('label'=>$loc->getText("usersSearch_barHeaderJade")),
						'address'=>array('label'=>$loc->getText("usersSearch_barHeaderAddress"))


	);

	$smarty->assign("contentHeader",$loc->getText("usersSearch_contentHeader"));
	$smarty->assign("searchBar",$searchBar);
	$smarty->assign("submitButtonLabel",$loc->getText("userView"));
	$smarty->display("users/user_search.tpl","users");

exit;

