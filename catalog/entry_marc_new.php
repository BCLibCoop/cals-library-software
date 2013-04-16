<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "catalog";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  	if(!(checkPassedIn(array('bid'),$_GET,$_POST)))
	{
		header("Location: catalog_search.php");
		exit;
	}

  	$nav = "entryEditMarcNew";
  	$helpPage = "catalog";
  	require_once(__ROOT__."admin/header_admin.php");

    $labels = array("deleteLabel"=>$loc->getText("catalogDelete"),
					"deleteConfirmLabel"=>$loc->getText("catalogEntry_editEditMarcDeleteConfirm"),
					"fieldInfoLabel"=>$loc->getText("catalogEntry_editEditMarcFieldInfo"),
					"fieldDataLabel"=>$loc->getText("catalogEntry_editEditMarcFieldData"),
					"submitButtonLabel"=>$loc->getText("catalogAdd"),
					"cancelButtonLabel"=>$loc->getText("catalogCancel"),
					);
	$bibid = (isset($_GET["bid"]))?$_GET["bid"]:$_POST["bid"];
	$smarty->assign("newField",true);

	if(empty($_POST))
	{
		$block = "0";
		$field = "dummy"; // dummy value to stop the ajax section being shown
		require("entry_marc_change.php");
	}
	else // $_POST sent when updating field
	{
	  	require_once(__ROOT__."classes/BiblioField.php");
  		require_once(__ROOT__."classes/BiblioFieldQuery.php");

		$fld = new BiblioField();
		$fld->setBibid($bibid);
		$fld->setTag($_POST["t"]);
		$fld->setInd1Cd($_POST["i1"]);
		$fld->setInd2Cd($_POST["i2"]);
		$fld->setSubfieldCd($_POST["s"]);
		$fld->setFieldData($_POST["cont"]);
		$fieldQ = new BiblioFieldQuery();
		//dd($fld);
		$fieldQ->insert($fld);
		header("Location: entry_view.php?bid=".$bibid);
		exit;
	}

	$smarty->assign("bibid",$bibid);
	$smarty->assign("blocks",$blocks);
	$smarty->assign("ind1",$ind1);
	$smarty->assign("ind2",$ind2);
	$smarty->assign("subFlds",$subFlds);
	$smarty->assign("tags",$tags);

	$smarty->assign("tagContent",$smarty->fetch("catalog/entry_marc_body.tpl","catalog"));

	$smarty->assign("contentHeader",$loc->getText("catalogEntry_editNewMarcTagHeader"));
	$smarty->display("catalog/entry_marc_edit.tpl","catalog");

	exit;
