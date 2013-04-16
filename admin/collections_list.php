<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
	$tab = "admin";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

	$nav = "collections";

	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Dm.php");
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/errorFuncs.php");
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/formatFuncs.php");

  	$dmQ = new DmQuery();
  	$dms = $dmQ->getWithStats("collection_dm");
	$newCollButton = array('label'=>$loc->getText("adminCollections_listAddNewCollection"),
							'ref'=>"collection_new.php");

	$columnHeaders = array('funcs'=>$loc->getText("adminCollections_listFunction"),
							'desc'=>$loc->getText("adminCollections_listDescription"),
							'count'=>$loc->getText("adminCollections_listBibliographycount"),
							'deflt'=>$loc->getText("adminCollections_listDefault"));
	$collNote = array('label'=>$loc->getText("adminCollections_ListNote"),
						'text'=>$loc->getText("adminCollections_ListNoteText"));

	$funcs = array('edit'=>array('label'=>$loc->getText("adminEdit"),
									'ref'=>"edit.php?cd="),
					'del'=>array('label'=>$loc->getText("adminDel"),
									'ref'=>"del.php?cd="),
					'baseRef'=>'collection_');
	$labels = array('yes'=>array('label'=>$loc->getText("adminYes"),
									'image'=>'apply.png'),
					'no'=>array('label'=>$loc->getText("adminNo")));
	$smarty->assign('newCollectionButton',$newCollButton);
	$smarty->assign('contentHeader',$loc->getText("adminCollections_listCollections"));
	$smarty->assign('columnHeaders',$columnHeaders);
	$smarty->assign('collections',$dms);
	$smarty->assign('funcs',$funcs);

	$smarty->assign('labels',$labels);
	$smarty->assign('collNote',$collNote);
	$smarty->display('admin/collections_list.tpl','admin');
