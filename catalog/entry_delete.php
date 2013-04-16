<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
	$tab = "catalog";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  	if(!(checkPassedIn(array('bid'),$_GET)))
	{
		header("Location: catalog_search.php");
		exit;
	}

  	$nav = "entryDelete";
  	$helpPage = "catalog";
  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/BiblioQuery.php");
  	require_once(__ROOT__."classes/BiblioCopyQuery.php");

  	#****************************************************************************
  	#*  Retrieving get var
  	#****************************************************************************
  	$bibid = $_GET["bid"];

  	// !--- Get the copies Info ---
  	$copyQ = new BiblioCopyQuery();
  	if (!$copyQ) {
  	  // display error message
  	}
  	$copies = $copyQ->getAllCopies($bibid);

  	if ($copies !== false)
  	{
		if(!empty($copies))
		{
			header("Location: entry_view.php?bid=".HURL($bibid)."&msg=".$loc->getText('catalogEntry_viewDeleteCopiesStillAvailable'));
			exit;
		}

  	}

  	$biblioQ = new BiblioQuery();
  	$flds = $biblioQ->getEntry($bibid,false)->getBiblioFields();
  	$title = $flds['245a']->getFieldData();
  	unset($biblio);
  	unset($flds);
  	$res = $biblioQ->delete($bibid);
  	if ($res !== false)
  	{
  		// remove the entry from the search index
		require_once(__ROOT__."classes/SearchIndex.php");
		$si = new SearchIndex();
  		$si->delete($bibid);
  		unset($si);
  	 	$msg = $loc->getText('catalogEntry_deleteSuccess',array("title"=>$title));

  	}
  	else
  		$msg = $loc->getText('catalogEntry_deleteError',array("bibid"=>$bibid,"title"=>$title));

	header("Location: catalog_search.php?msg=".$msg);
	exit;