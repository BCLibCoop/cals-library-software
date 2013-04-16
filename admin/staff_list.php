<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "admin";
 	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "staff";

	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

  	require_once(__ROOT__."admin/header_admin.php");
 	require_once(__ROOT__."classes/Staff.php");
  	require_once(__ROOT__."classes/StaffQuery.php");

	$staffQ = new StaffQuery();
	$allStaff = array();
	$allStaff = $staffQ->getAllStaff();
	if ($allStaff === false)
	{
		header("Location: ../admin/staff_list.php?msg=".H("An Error Occurred while getting the Staff List."));
		exit;
	}

	$columnHeaders = array('function'=>$loc->getText("adminStaff_listFunctionLabel"),
			'lastname'=>$loc->getText("adminStaff_editSurname"),
			'firstname'=>$loc->getText("adminStaff_editFirstname"),
			'username'=>$loc->getText("adminStaff_editUsername"),
			'auth'=>$loc->getText("adminStaff_editAuths"),
			'susp'=>$loc->getText("adminStaff_editSuspended"));
	$tabNames = array($loc->getText("adminStaff_editAuthUsers"),
			$loc->getText("adminStaff_editAuthDevices"),
			$loc->getText("adminStaff_editAuthCatalog"),
			$loc->getText("adminStaff_editAuthAdmin"),
			$loc->getText("adminStaff_editAuthReports"));
	$funcs = array('edit'=>array('label'=>$loc->getText("adminEdit"),'ref'=>"edit.php?u="),
					'pwd'=>array('label'=>$loc->getText("adminStaff_listPwdLabel"),'ref'=>"pwd.php?u="),
					'del'=>array('label'=>$loc->getText("adminDel"),'ref'=>"del.php?u="),
					'baseRef'=>'staff_');

	foreach ($allStaff as $staff) {
		$staffInfo[] = array('id'=>HURL($staff->getStaffid()),
				'surname'=>H($staff->getSurname()),
				'firstname'=>H($staff->getFirstName()),
				'username'=>H($staff->getUsername()),
				'admin'=>$staff->hasAdminAuth(),
				'users'=>$staff->hasUsersAuth(),
				'devices'=>$staff->hasDevicesAuth(),
				'catalog'=>$staff->hasCatalogAuth(),
				'reports'=>$staff->hasReportsAuth(),
				'suspended'=>$staff->isSuspended());
	}
	$addNewButton = array('label'=>$loc->getText('adminStaff_listAddNewLabel'),
							'ref'=>'staff_new.php');
	$labels = array('yes'=>array('label'=>$loc->getText("adminYes"),
									'image'=>'apply.png'),
					'no'=>array('label'=>$loc->getText("adminNo")));

	$smarty->assign('labels',$labels);
	$smarty->assign('contentHeader',$loc->getText('adminStaff_listHeader'));
	$smarty->assign('addNewStaffButton',$addNewButton);
	$smarty->assign('adminStaffListTabNames',$tabNames);
	$smarty->assign('adminStaffListColumnHeaders',$columnHeaders);
	$smarty->assign('funcs',$funcs);
	$smarty->assign('staffList',$staffInfo);

BUILD:

	$smarty->display('admin/staff_list.tpl','admin');
