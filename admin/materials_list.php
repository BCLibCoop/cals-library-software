<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "admin";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "materials";

	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

	require_once(__ROOT__."admin/header_admin.php");
  require_once(__ROOT__."classes/Dm.php");
  require_once(__ROOT__."classes/DmQuery.php");
  require_once(__ROOT__."functions/errorFuncs.php");
  require_once(__ROOT__."functions/formatFuncs.php");
  $dmQ = new DmQuery();
  $dms = $dmQ->getWithStats("material_type_dm");

	$newCollButton = array('label'=>$loc->getText("adminMaterials_listAddMaterialType"),
							'ref'=>"material_new.php");

	$columnHeaders = array('funcs'=>$loc->getText("adminMaterials_listFunction"),
							'descr'=>$loc->getText("adminDescription"),
							'recom'=>$loc->getText("adminMaterials_listRecommend"),
							'bibcnt'=>$loc->getText("adminMaterials_listBibCount"),
							'deflt'=>$loc->getText("adminMaterials_listDefault"),
							'img'=>$loc->getText("adminMaterials_listImageFile"));
	$collNote = array('label'=>$loc->getText("adminMaterials_ListNote"),
						'text'=>$loc->getText("adminMaterials_ListNoteText"));

	$funcs = array('marc'=>array('label'=>$loc->getText("adminMaterials_listMarcFields"),
									'ref'=>"marc_list.php?cd="),
					'edit'=>array('label'=>$loc->getText("adminEdit"),
									'ref'=>"edit.php?cd="),
					'del'=>array('label'=>$loc->getText("adminDel"),
									'ref'=>"del.php?cd="),

					'baseRef'=>'material_');
	$labels = array('yes'=>array('label'=>$loc->getText("adminYes"),
									'image'=>'apply.png'),
					'no'=>array('label'=>$loc->getText("adminNo")));

	$smarty->assign('labels',$labels);
	$smarty->assign('newMaterialButton',$newCollButton);
	$smarty->assign('contentHeader',$loc->getText("adminMaterials_listMaterialTypes"));
	$smarty->assign('columnHeaders',$columnHeaders);
	$smarty->assign('materials',$dms);
	$smarty->assign('funcs',$funcs);
	$smarty->assign('collNote',$collNote);
	$smarty->display('admin/materials_list.tpl','admin');

