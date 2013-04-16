<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "admin";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "staff";
  $restrictInDemo = true;

	#****************************************************************************
	#*  Checking for query string.  Go back to staff list if none found.
	#****************************************************************************

	if (!isset($_GET["u"]) && (empty($_POST))){
    	header("Location: ../admin/staff_list.php");
    	exit();
	}

  	$UID = $staff = null;

  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/Staff.php");
	require_once(__ROOT__."classes/StaffQuery.php");

	$staffQ = new StaffQuery();
	$staff= new Staff();

  if (empty($_POST))
  {
  	$UID = $_GET['u'];
  	$staff = $staffQ->getStaffMember($UID);
  	// display the confirm page
  	$msg = $loc->getText("adminStaff_delConfirmText").$staff->getFirstName()." ".$staff->getSurname();
  	$smarty->assign('submitButtonLabel',$loc->getText("Delete"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("Cancel"));
  	$smarty->assign('deleteConfirmMsg',$msg);
  	$smarty->assign('staffId',$UID);
  	$smarty->display('admin/staff_del.tpl','admin');
  }
  else
  {
  	$id=$_POST['id'];
  	$staff = $staffQ->getStaffMember($id);
  	if (!$staffQ->delete($id))
    	$msg = "Error Deleting Staff member";
  	else
  		$msg = $staff->getFirstName().' '.$staff->getSurname().$loc->getText("adminStaff_delDeleted");

  	header("Location: ../admin/staff_list.php?msg=".H($msg));
  }

  unset($staff);
  unset($staffQ);
  exit;
