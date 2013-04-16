<?php

$navLoc = new Localize(OBIB_LOCALE,'navbars');

// setup the navigation items per tab
$items = $loginOutButton = array();
if (isset($_SESSION['_admin']['staffid']))
	$loginOutButton = array('label'=>$navLoc->getText('logout'),'ref'=>'../admin/adminLogout.php');
else
{
	$loginOutButton = array('label'=>$navLoc->getText('login'),'ref'=>"../admin/adminLogin.php?RET=../$tab/index.php");
}
$smarty->assign('loginOutButton',$loginOutButton);

switch ($tab)
{
case 'home':
	$items[] = array('label'=>$navLoc->getText('homeSummary'),'ref'=>'../home/index.php','selected'=>($nav=='summary')?'selected':'');
	$items[] = array('label'=>$navLoc->getText('homeLicense'),'ref'=>'../home/license.php','selected'=>($nav=='license')?'selected':'');
	break;
case 'users':
	$items[] = array('label'=>$navLoc->getText('usersSearch'),'ref'=>'../users/user_search.php','selected'=>($nav=='search')?'selected':'');
	$items[] = array('label'=>$navLoc->getText('usersNew'),'ref'=>'../users/user_new.php','selected'=>($nav=='new')?'selected':'');
	break;
case 'catalog':
	$items[] = array('label'=>$navLoc->getText('catalogSearch'),'ref'=>'../catalog/catalog_search.php','selected'=>($nav=='search')?true:false);
	$items[] = array('label'=>$navLoc->getText('catalogNew'),'ref'=>'../catalog/entry_new.php','selected'=>($nav=='new')?'selected':'');
	$items[] = array('label'=>$navLoc->getText('catalogUploadMarc'),'ref'=>'../catalog/upload_marc.php','selected'=>($nav=='uploadMarc')?'selected':'');
	$items[] = array('label'=>$navLoc->getText('catalogExternalSearch'),'ref'=>'../catalog/external_search.php','selected'=>($nav=='externalSearch')?'selected':'');
	break;
case 'admin':
	$items[] = array('label'=>$navLoc->getText('adminSummary'),'ref'=>'../admin/index.php','selected'=>($nav=='summary')?true:false);
	$items[] = array('label'=>$navLoc->getText('adminMaterialTypes'),'ref'=>'../admin/materials_list.php','selected'=>($nav=='materials')?true:false);
	$items[] = array('label'=>$navLoc->getText('adminCollections'),'ref'=>'../admin/collections_list.php','selected'=>($nav=='collections')?true:false);
	$items[] = array('label'=>$navLoc->getText('adminSettings'),'ref'=>'../admin/settings_edit.php','selected'=>($nav=='settings')?true:false);
	$items[] = array('label'=>$navLoc->getText('adminStaff'),'ref'=>'../admin/staff_list.php','selected'=>($nav=='staff')?true:false);
	$items[] = array('label'=>$navLoc->getText('adminTasks'),'ref'=>'../admin/tasks.php','selected'=>($nav=='tasks')?true:false);
	break;
case 'devices':
	$items[] = array('label'=>$navLoc->getText('devicesSearch'),'ref'=>'../devices/devices_list.php','selected'=>($nav=='list')?true:false);
	$items[] = array('label'=>$navLoc->getText('devicesConnected'),'ref'=>'../devices/devices_connected.php','selected'=>($nav=='connected')?true:false);

	break;
case 'reports':
	$items[] = array('label'=>$navLoc->getText('reportsSummary'),'ref'=>'../reports/index.php','selected'=>($nav=='list')?true:false);
	break;

}

// setup the tabs and which one is selected
$tabslist = array();
$tabslist[] = array('label'=>$headerLoc->getText('tabNameHome'),'ref'=>'../home/index.php','items'=>($tab=='home')?$items:null);
$tabslist[] = array('label'=>$headerLoc->getText('tabNameUsers'),'ref'=>'../users/index.php','items'=>($tab=='users')?$items:null);
$tabslist[] = array('label'=>$headerLoc->getText('tabNameCatalog'),'ref'=>'../catalog/index.php','items'=>($tab=='catalog')?$items:null);
$tabslist[] = array('label'=>$headerLoc->getText('tabNameDevices'),'ref'=>'../devices/devices_list.php','items'=>($tab=='devices')?$items:null);
$tabslist[] = array('label'=>$headerLoc->getText('tabNameAdmin'),'ref'=>'../admin/index.php','items'=>($tab=='admin')?$items:null);
$tabslist[] = array('label'=>$headerLoc->getText('tabNameReports'),'ref'=>'../reports/index.php','items'=>($tab=='reports')?$items:null);
$smarty->assign('tabList',$tabslist);

require_once(__ROOT__."admin/adminLoginCheck.php");
