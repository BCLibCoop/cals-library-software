<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "home";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "summary";
  require_once(__ROOT__."admin/header_admin.php");

  $smarty->assign('contentHeader', $loc->getText("indexHeading"));
  $smarty->assign('contentDesc',$loc->getText("indexIntro"));

  $smarty->assign('indexTab', $loc->getText("indexTab"));
  $smarty->assign('indexDesc',$loc->getText("indexDesc"));

  $tabs = array();
  $tabs['users'] = array('label'=>$loc->getText("indexUsers"),
  								'image'=>"admin.png",
  								'descHeader'=>$loc->getText("indexUsersDesc1"));
  $tabs['catalog'] = array('label'=>$loc->getText("indexCat"),
  								'image'=>"catalog.png",
  								'descHeader'=>$loc->getText("indexCatDesc1"),
  								'descriptions'=>array($loc->getText("indexCatDesc2"),
  														$loc->getText("indexCatDesc3")));
  $tabs['devices'] = array('label'=>$loc->getText("indexDevices"),
  								'image'=>"reports.png",
  								'descHeader'=>$loc->getText("indexDevicesDesc1"));
  $tabs['admin'] = array('label'=>$loc->getText("indexAdmin"),
  								'image'=>"admin.png",
  								'descHeader'=>$loc->getText("indexAdminDesc1"),
  								'descriptions'=>array($loc->getText("indexAdminDesc2"),
  														$loc->getText("indexAdminDesc3"),
  														$loc->getText("indexAdminDesc4"),
  														$loc->getText("indexAdminDesc5"),
  														$loc->getText("indexAdminDesc6")));
  $tabs['reports'] = array('label'=>$loc->getText("indexReports"),
  								'image'=>"reports.png",
  								'descHeader'=>$loc->getText("indexReportsDesc1"),
  								'descriptions'=>array($loc->getText("indexReportsDesc2"),
  														$loc->getText("indexReportsDesc3")));


  $smarty->assign('tabsDesc',$tabs);
  $smarty->display('home/index.tpl','home');
