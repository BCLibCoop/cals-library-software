<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "admin";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

	$nav = "materialDelete";
	$restrictInDemo = true;
  	require_once(__ROOT__."admin/header_admin.php");


	if (!isset($_GET["cd"]) && (empty($_POST))){
    	header("Location: ../admin/materials_list.php");
    	exit();
    }

    $mid = $msg = null;
	$mid=(isset($_GET["cd"]))?$_GET["cd"]:$_POST['cd'];

	if (!isset($mid) || ($mid == '')){
    	header("Location: ../admin/materials_list.php");
    	exit();
	}

    require_once(__ROOT__."classes/Dm.php");
  	require_once(__ROOT__."classes/DmQuery.php");

	$dmQ = new DmQuery();
	$aMat = new Dm();
    $aMat = $dmQ->get1('material_type_dm',$mid);

	if (empty($_POST))
  	{
  		$smarty->assign('matId',$mid);
  		$smarty->assign('submitButtonLabel',$loc->getText("adminDelete"));
  		$smarty->assign('cancelButtonLabel',$loc->getText("adminCancel"));
  		$smarty->assign('deleteConfirmMsg',$loc->getText("adminMaterial_delConfirm").$aMat->getDescription());
  		$smarty->assign('matId',$mid);
  		$smarty->display('admin/material_del.tpl','admin');
  	}
	else
	{
  		if ($dmQ->delete('material_type_dm',$mid))
    		$msg = $aMat->getDescription().$loc->getText("adminMaterial_delSuccess");
  		else
  			$msg = "Error Deleting Material";

  		header("Location: ../admin/materials_list.php?msg=".HURL($msg));
  	}

  	unset($dmQ);
  	unset($aMat);
	exit;
