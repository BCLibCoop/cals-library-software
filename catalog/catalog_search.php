<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

 	$tab = "catalog";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	session_cache_limiter(null);

  	$nav = "search";
  	$helpPage = "catalog";
  	require_once(__ROOT__."admin/header_admin.php");

	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

	$searchBar = array('title'=>array('label'=>$loc->getText("catalogSearch_barHeaderTitle")),
						'author'=>array('label'=>$loc->getText("catalogSearch_barHeaderAuthor")),
						'subject'=>array('label'=>$loc->getText("catalogSearch_barHeaderSubject")),
						'snum'=>array('label'=>$loc->getText("catalogSearch_barHeaderSysNumber"))
	);

	$smarty->assign("contentHeader",$loc->getText("catalogSearch_contentHeader"));
	$smarty->assign("searchBar",$searchBar);
	$smarty->assign("submitButtonLabel",$loc->getText("catalogSearch_viewEntryDetails"));
	$smarty->display("catalog/catalog_search.tpl","catalog");

exit;

