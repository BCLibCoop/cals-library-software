<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "admin";
 	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

 	$nav = "collectionsDelete";
 	$restrictInDemo = true;

	#****************************************************************************
	#*  Checking for query string.  Go back to staff list if none found.
	#****************************************************************************

	if (!isset($_GET["cd"]) && (empty($_POST))){
    	header("Location: ../admin/collections_list.php");
    	exit();
	}

  	$CID = $dm = null;

  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/Dm.php");
	require_once(__ROOT__."classes/DmQuery.php");

	$dmQ = new DmQuery();
	$dm= new Dm();

  if (empty($_POST))
  {
  	$CID = $_GET['cd'];
  	$dm = $dmQ->get1('collection_dm',$CID);
  	// display the confirm page
  	$msg = $loc->getText("adminCollection_delConfirmText").$dm->getDescription();
  	$smarty->assign('submitButtonLabel',$loc->getText("adminDelete"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("adminCancel"));
  	$smarty->assign('deleteConfirmMsg',$msg);
  	$smarty->assign('collId',$CID);
  	$smarty->display('admin/collection_del.tpl','admin');
  }
  else
  {
  	$id=$_POST['cd'];
  	$dm = $dmQ->get1('collection_dm',$id);
  	if (!$dmQ->delete('collection_dm',$id))
    	$msg = "Error Deleting Collection";
  	else
  		$msg = $dm->getDescription().$loc->getText("adminCollection_delSuccess");

  	header("Location: ../admin/collections_list.php?msg=".HURL($msg));
  }

  unset($dm);
  unset($dmQ);
  exit;
