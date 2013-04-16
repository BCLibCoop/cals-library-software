<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	if ((empty($_GET)) && empty($_POST)) {
    	header("Location: ../users/index.php");
    	exit();
  	}

	if ((!isset($_GET['uid'])) &&  (!isset($_POST['uid']))) {
    	header("Location: ../users/index.php");
    	exit();
  	}

	$tab = "users";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	session_cache_limiter(null);

  	$nav = "request";
  	$helpPage = "users";

  	require_once(__ROOT__."admin/header_admin.php");

	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

  	$userid = (isset($_GET['uid']))?$_GET['uid']:$_POST['uid'];


	$searchBar = array('title'=>array('label'=>$loc->getText("userRequest_searchBarHeaderTitle")),
						'author'=>array('label'=>$loc->getText("userRequest_searchBarHeaderAuthor")),
						'subject'=>array('label'=>$loc->getText("userRequest_searchBarHeaderSubject")),
						'snum'=>array('label'=>$loc->getText("userRequest_searchBarHeaderSysNumber"))
	);

	$smarty->assign("contentHeader",$loc->getText("userRequest_searchContentHeader"));
	$smarty->assign("searchBar",$searchBar);
	$smarty->assign("uid",$userid);
	$smarty->assign("submitButtonLabel",$loc->getText("AddRequestButtonLabel"));
	$smarty->assign("cancelButtonLabel",$loc->getText("userCancel"));
	$smarty->assign("showAllLabel",$loc->getText("userRequest_searchShowAllLabel"));
	$smarty->display("users/user_request_search.tpl","users");

exit;

