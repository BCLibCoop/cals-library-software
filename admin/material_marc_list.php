<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "admin";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  session_cache_limiter(null);


	$nav = "materials";
	$helpPage = "customMARC";



	if (!checkPassedIn(array("cd"),$_GET))
	{
    	header("Location: ../admin/materials_list.php");
    	exit();
    }

   	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/MaterialFieldQuery.php");
	require_once(__ROOT__."classes/DmQuery.php");
	require_once(__ROOT__."classes/Dm.php");

	$mid = null;
	$mid=(isset($_GET["cd"]))?$_GET["cd"]:$_POST['mid'];


	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

	$newMarcButton = array('label'=>$loc->getText("adminMaterial_marcListAddMarc"),
							'ref'=>"material_marc_new.php?cd=$mid");

	$columnHeaders = array('funcs'=>$loc->getText("adminMaterials_listFunction"),
							'tag'=>$loc->getText("adminMaterial_marcListTag"),
							'subfield'=>$loc->getText("adminMaterial_marcListSubfield"),
							'descr'=>$loc->getText("adminDescription"),
							'fld'=>$loc->getText("adminMaterial_marcListFieldType"),
							'fldVals'=>$loc->getText("adminMaterial_marcListFieldValues"),
							'req'=>$loc->getText("adminMaterial_marcListRequired"),
							'show'=>$loc->getText("adminMaterial_marcListShowInOpac"));

	$funcs = array('edit'=>array('label'=>$loc->getText("adminEdit"),
									'ref'=>"edit.php?cd="),
					'del'=>array('label'=>$loc->getText("adminDel"),
									'ref'=>"del.php?cd="),
					'baseRef'=>'material_marc_');
	$labels = array('yes'=>array('label'=>$loc->getText("adminYes"),
									'image'=>'apply.png'),
					'no'=>array('label'=>$loc->getText("adminNo")));

	$ctrlTypes = array($loc->getText("adminMaterial_marcEditTextField"),
						$loc->getText("adminMaterial_marcEditTextArea"),
						$loc->getText("adminMaterial_marcEditCheckbox"),
						$loc->getText("adminMaterial_marcEditSelectList"));

	$dmQ = new DmQuery();
	$aMat = new Dm();
	$aMat = $dmQ->get1('material_type_dm',$mid);
	$smarty->assign('contentHeader',$loc->getText("adminMaterial_marcListHeader"));
	$smarty->assign('contentDesc',$aMat->getDescription());
	unset($dmQ);
	unset($aMat);

	$fldQ = new MaterialFieldQuery();
	$fields = $fldQ->getMaterialWithCode($mid);

	$smarty->assign('labels',$labels);
	$smarty->assign('newMarcButton',$newMarcButton);
	$smarty->assign('columnHeaders',$columnHeaders);
	$smarty->assign('fields',$fields);
	$smarty->assign('funcs',$funcs);
	$smarty->assign('ctrlTypes',$ctrlTypes);

	$smarty->display('admin/material_marc_list.tpl','admin');
