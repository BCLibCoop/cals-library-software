<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  	$tab = "catalog";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
 	session_cache_limiter(null);

  	if(!(checkPassedIn(array('f'),$_GET,$_POST)))
	{
		header("Location: catalog_search.php");
		exit;
	}

  	$nav = "entryEditMarcEdit";
  	$helpPage = "catalog";
  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/BiblioField.php");
  	require_once(__ROOT__."classes/BiblioFieldQuery.php");

 	$fieldid = (isset($_GET["f"]))?$_GET["f"]:$_POST["f"];
	$tag = (isset($_GET["t"]))?$_GET["t"]:((isset($_POST["t"]))?$_POST["t"]:null); // GET used to specify a change in tag
	$subfld = (isset($_GET["s"]))?$_GET["s"]:((isset($_POST["s"]))?$_POST["s"]:null); // GET used to specify a change in subfield code

    #****************************************************************************
    #*  Reading database for subfield values
    #****************************************************************************

    $fieldQ = new BiblioFieldQuery();
    $field = $fieldQ->getField($fieldid);

    if ($field===false)
    {	// field not found!
    	header("Location: catalog_search.php");
		exit;
    }

    $labels = array("deleteLabel"=>$loc->getText("catalogDelete"),
					"deleteConfirmLabel"=>$loc->getText("catalogEntry_editEditMarcDeleteConfirm"),
					"fieldInfoLabel"=>$loc->getText("catalogEntry_editEditMarcFieldInfo"),
					"fieldDataLabel"=>$loc->getText("catalogEntry_editEditMarcFieldData"),
					"submitButtonLabel"=>$loc->getText("catalogUpdate"),
					"cancelButtonLabel"=>$loc->getText("catalogCancel"),
					);

	$tag = $field->getTag();
	$block = substr($tag,0,1);
	$fldContent = $field->getFieldData();
	$smarty->assign("newField",false);

	if(empty($_POST))
	{
		include_once("entry_marc_change.php");
		// set the selected values for the indicators and subfield option lists
		$ind1["selected"] = $field->getInd1Cd();
		$ind2["selected"] = $field->getInd2Cd();
		$subFlds["selected"] = $field->getSubfieldCd();
	}
	else // $_POST sent when updating field
	{
		$fld = new BiblioField();
		$fld->setFieldid($_POST["f"]);
		$fld->setTag($_POST["t"]);
		$fld->setInd1Cd($_POST["i1"]);
		$fld->setInd2Cd($_POST["i2"]);
		$fld->setSubfieldCd($_POST["s"]);
		$fld->setFieldData($_POST["cont"]);
		$fieldQ->update($fld);
		header("Location: entry_view.php?bid=".$field->getBibid());
		exit;
	}

	$smarty->assign("bibid",$field->getBibid());
	$smarty->assign("blocks",$blocks);
	$smarty->assign("ind1",$ind1);
	$smarty->assign("ind2",$ind2);
	$smarty->assign("subFlds",$subFlds);
	$smarty->assign("tags",$tags);
	$smarty->assign("fldContent",$field->getFieldData());
	$smarty->assign("fieldid",$field->getFieldid());

	$smarty->assign("tagContent",$smarty->fetch("catalog/entry_marc_body.tpl","catalog"));

	$smarty->assign("contentHeader",$loc->getText("catalogEntry_editEditMarcTagHeader"));
	$smarty->display("catalog/entry_marc_edit.tpl","catalog");

	exit;
