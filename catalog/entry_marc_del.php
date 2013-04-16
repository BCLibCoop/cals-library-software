<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	
  	if(!(checkPassedIn(array('fid'),$_GET)))
	{
		header("Location: catalog_search.php");
		exit;
	}

	require_once(__ROOT__."classes/BiblioField.php");
  	require_once(__ROOT__."classes/BiblioFieldQuery.php");
	
	$fieldQ = new BiblioFieldQuery();
	$fld = $fieldQ->getField($_GET["fid"]);
	$fieldQ->delete($fld);
	header("Location: entry_view.php?bid=".$fld->getBibid());
	exit;

