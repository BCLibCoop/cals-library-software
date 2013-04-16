<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "admin";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "materialMarcEdit";
  $restrictInDemo = true;

	if (!isset($_GET["cd"]) && (empty($_POST))){
    	header("Location: ../admin/materials_list.php");
    	exit();
    }

    $fid = $mid = $msg = null;
	$fid=(isset($_GET["cd"]))?$_GET["cd"]:$_POST['cd'];

	if (!isset($fid) || ($fid == '')){
    	header("Location: ../admin/materials_list.php");
    	exit();
	}

  	require_once(__ROOT__."admin/header_admin.php");
 	require_once(__ROOT__."classes/Dm.php");
  	require_once(__ROOT__."classes/DmQuery.php");
  	require_once(__ROOT__."classes/MaterialFieldQuery.php");

	$fieldQ = new MaterialFieldQuery();
	$dmQ = new DmQuery();
	$aMat = new Dm();
	$res = null;

	$res = $fieldQ->getMaterialWithId($fid);
	$aMat = $dmQ->get1('material_type_dm',$res->materialCd);

	if (empty($_POST))
  	{
       	$smarty->assign('fieldId',$fid);
       	$smarty->assign('matId',$res->materialCd);
	  	$smarty->assign('deleteConfirmMsg',$loc->getText("adminMaterial_marcDeleteConfirm").$res->tag.$res->subfieldCd.' from '.$aMat->getDescription());

  		$smarty->assign('submitButtonLabel',$loc->getText("adminDelete"));
  		$smarty->assign('cancelButtonLabel',$loc->getText("adminCancel"));
       	$smarty->display('admin/material_marc_del.tpl','admin');
  	}
	else
	{
		if ($fieldQ->delete($fid))
			$msg = $loc->getText("adminMaterial_marcDeleteSuccess").$res['tag'].$res['subfieldCd'];
		else
		    $msg = "Error Deleting Custom Marc Field";

		header("Location: ../admin/material_marc_list.php?cd=".H($res['materialCd'])."&msg=".HURL($msg));
  	}

  	unset($res);
  	unset($fieldQ);
   	unset($aMat);
	unset($dmQ);
	exit;
