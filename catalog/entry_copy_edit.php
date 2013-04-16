<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "catalog";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	session_cache_limiter(null);

 	if(!checkPassedIn(array('cid'),$_GET,$_POST))
	{
		header("Location: catalog_search.php");
		exit;
 	}

  	$nav = "entrycopyedit";
  	$helpPage = "biblioCopyEdit";
  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/Biblio.php");
  	require_once(__ROOT__."classes/BiblioQuery.php");
  	require_once(__ROOT__."classes/BiblioCopy.php");
  	require_once(__ROOT__."classes/BiblioCopyQuery.php");
	require_once(__ROOT__."classes/DmQuery.php");

    #****************************************************************************
    #*  Read copy information
    #****************************************************************************
    $copyid = (isset($_GET["cid"]))?$_GET["cid"]:$_POST["cid"];
    $copyQ = new BiblioCopyQuery();
    $copy = $copyQ->getCopy($copyid);

    $bibid = $copy->getBiblioId();
    $bibQ = new BiblioQuery();
	$entry = $bibQ->getEntry($bibid,false);
	$entryFlds = $entry->getBiblioFields();
	$smarty->assign("contentHeader",$loc->getText("catalogEntry_copyEditHeader",array('title'=>$entryFlds["245a"]->getFieldData())));
	unset($bibQ);

	#**************************************************************************
    #*  fill the types arrays
    #**************************************************************************
	$dmQ = new DmQuery();
	$formatTypes = $dmQ->getAssoc('format_type_dm');
	$contentTypes = $dmQ->getAssoc('content_type_dm');

	$miscLabels = array('form'=>$loc->getText("catalogEntry_copyEditFormLabel"),
						'submitButton'=>$loc->getText("catalogUpdate"),
						'cancelButton'=>$loc->getText("catalogCancel"));

	$fields = array("path"=>array("label"=>$loc->getText("catalogEntry_copyEditFilePathLabel"),
									"field"=>array("type"=>"textfield",
													"name"=>"fpath",
													"options"=>array("size"=>"80","maxlen"=>"300")),
									"validate"=>array("msg"=>$loc->getText("catalogValidate_notEmpty"))),
					"format"=>array("label"=>$loc->getText("catalogEntry_copyEditFormatType"),
									"field"=>array("type"=>"select",
													"name"=>"fmtid",
													"options"=>$formatTypes)),
					"content"=>array("label"=>$loc->getText("catalogEntry_copyEditContentType"),
									"field"=>array("type"=>"select",
													"name"=>"cntid",
													"options"=>$contentTypes)));



	if(empty($_POST))
	{
		SmartyValidate::connect($smarty,true);

		SmartyValidate::register_validator('v_pathEmpty', 'fpath', 'NotEmpty', false, false, 'trim');
		$fields["path"]["field"]["value"] = $copy->getFilePath();
		$fields["format"]["field"]["selected"] = $copy->getFormatId();
		$fields["content"]["field"]["selected"] = $copy->getContentId();

	}
	else
	{
		// validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
       		// no errors found
       		SmartyValidate::disconnect();

       		$copy->setFormatId($_POST["fmtid"]);
       		$copy->setContentId($_POST["cntid"]);
       		$copy->setFilePath($_POST["fpath"]);
       		if($copyQ->update($copy))
       			$msg = $loc->getText("catalogEntry_copyUpdateSuccess");
       		else
       			$msg = $loc->getText("catalogEntry_copyUpdateError");

       		header("Location: entry_view.php?bid=".$bibid."&msg=".H($msg));
       		exit;
       	}
		else
		{
			// errors found so redisplay the form
			$smarty->assign($_POST);

			$fields["path"]["field"]["value"] = $_POST["fpath"];
			$fields["format"]["field"]["selected"] = $_POST["fmtid"];
			$fields["content"]["field"]["selected"] = $_POST["cntid"];

		}

	}

	$smarty->assign("fields",$fields);
	$smarty->assign("labels",$miscLabels);
	$smarty->assign("copyid",$copyid);
	$smarty->assign("bibid",$bibid);
	$smarty->display("catalog/entry_copy_edit.tpl","catalog");
