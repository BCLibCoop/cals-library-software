<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
    $tab = "catalog";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	session_cache_limiter(null);

 	if(!checkPassedIn(array('cid'),$_GET))
	{
		header("Location: catalog_search.php");
		exit;
 	}

  	$nav = "entrycopydelete";
  	$helpPage = "biblioCopyDelete";
  	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/BiblioCopy.php");
  	require_once(__ROOT__."classes/BiblioCopyQuery.php");

    #****************************************************************************
    #*  Read copy information
    #****************************************************************************
    $copyid = $_GET["cid"];
    $copyQ = new BiblioCopyQuery();
   	$copy = $copyQ->getCopy($copyid);
   	$bibid = $copy->getBiblioid();
   	unset($copy);

    $res = $copyQ->delete($copyid);
	if($res !== false)
  	 	$msg = $loc->getText('catalogEntry_copyDeleteSuccess');
  	else
  		$msg = $loc->getText('catalogEntry_copyDeleteError');

	header("Location: entry_view.php?bid=".$bibid."&msg=".$msg);
	exit;
