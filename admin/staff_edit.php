<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "admin";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

	$nav = "staffedit";
	$restrictInDemo = true;

	if (!isset($_GET["u"]) && (empty($_POST))){
    	header("Location: ../admin/staff_list.php");
    	exit();
    }

  	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/Staff.php");
	require_once(__ROOT__."classes/StaffQuery.php");

  	$UID = $staff = null;
	$UID=(isset($_GET["u"]))?$_GET["u"]:$_POST['uid'];

	$staffQ = new StaffQuery();
	$staff= new Staff();
	$staff = $staffQ->getStaffMember($UID);

	$tabs = $info = array();
  	$tabs['users'] = array('label'=>$loc->getText("adminStaff_editAuthUsers"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'authUsers',
	    								'value'=>'1'));
  	$tabs['catalog'] = array('label'=>$loc->getText("adminStaff_editAuthCatalog"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'authCat',
	    								'value'=>'1'));
  	$tabs['devices'] = array('label'=>$loc->getText("adminStaff_editAuthDevices"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'authDevs',
	    								'value'=>'1'));
  	$tabs['admin'] = array('label'=>$loc->getText("adminStaff_editAuthAdmin"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'authAdmin',
	    								'value'=>'1'));
  	$tabs['reports'] = array('label'=>$loc->getText("adminStaff_editAuthReports"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'authReps',
	    								'value'=>'1'));

  	$info['first'] = array('label'=>$loc->getText("adminStaff_editFirstname"),
  	    					'field'=>array('type'=>'text',
	    								'name'=>'fname',
	    								'options'=>array('size'=>'30','maxlength'=>'30')));

  	$info['last'] = array('label'=>$loc->getText("adminStaff_editSurname"),
  	    					'field'=>array('type'=>'text',
	    								'name'=>'sname',
	    								'options'=>array('size'=>'30','maxlength'=>'30')));
  	$info['uname'] = array('label'=>$loc->getText("adminStaff_editUsername"),
  	    					'field'=>array('type'=>'text',
	    								'name'=>'uname',
	    								'options'=>array('size'=>'20','maxlength'=>'20')),
	    					'validate'=>array('v_unmEmpty'=>'Username Cannot Be Empty.',
	    										'v_unmInvalid'=>'Username is already in use.'));
   	$info['auth'] = array('label'=>$loc->getText("adminStaff_editAuths"),
   	    					'tabs'=>$tabs);
  	$info['susp'] = array('label'=>$loc->getText("adminStaff_editSuspended"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'susp',
	    								'value'=>'1'));

  	$smarty->assign('staffid',$UID);
  	$smarty->assign('contentHeader',$loc->getText("adminStaff_editHeader"));
  	$smarty->assign('formHeaderLabel',$loc->getText("adminStaff_editFormHeader"));
  	$smarty->assign('submitButtonLabel',$loc->getText("Update"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("Cancel"));

	SmartyValidate::register_object('staffQry',$staffQ);


	if(empty($_POST))
	{
		// new form, we (re)set the session data
        SmartyValidate::connect($smarty, true);

        // register our validators
       	SmartyValidate::register_criteria('isValidUsername','staffQry->validateUsername');
        SmartyValidate::register_validator('v_unmEmpty', 'uname', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_unmInvalid', 'uname:uid', 'isValidUsername', false, false, 'trim');

		$info['first']['field']['value'] = $staff->getFirstname();
		$info['last']['field']['value'] = $staff->getSurname();
		$info['uname']['field']['value'] = $staff->getUsername();
		$info['susp']['field']['checked'] = ($staff->isSuspended())?'checked':null;
		$info['auth']['tabs']['users']['field']['checked'] = ($staff->hasUsersAuth())?'checked':null;
		$info['auth']['tabs']['devices']['field']['checked'] = ($staff->hasDevicesAuth())?'checked':null;
		$info['auth']['tabs']['catalog']['field']['checked'] = ($staff->hasCatalogAuth())?'checked':null;
		$info['auth']['tabs']['admin']['field']['checked'] = ($staff->hasAdminAuth())?'checked':null;
		$info['auth']['tabs']['reports']['field']['checked'] = ($staff->hasReportsAuth())?'checked':null;

  		$smarty->assign('info',$info);
		$smarty->display('admin/staff_edit.tpl','admin');
	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();
           	$staff->setFirstName($_POST['fname']);
			$staff->setSurname($_POST['sname']);
			$staff->setUsername($_POST['uname']);
			$staff->setUsersAuth(isset($_POST['authUsers']));
			$staff->setCatalogAuth(isset($_POST['authDevs']));
			$staff->setDevicesAuth(isset($_POST['authCat']));
			$staff->setAdminAuth(isset($_POST['authAdmin']));
			$staff->setReportsAuth(isset($_POST['authReps']));
			$staff->setSuspended(isset($_POST['susp']));
			$staff->setLastChangeStaffid($_SESSION['_admin']['staffid']);

			if ($staffQ->update($staff))
				$msg = $staff->getFirstName().' '.$staff->getSurname().$loc->getText("adminStaff_editSuccess");
			else
			    $msg = $loc->getText("adminStaff_editError").$staff->getFirstName().' '.$staff->getSurname();

			header("Location: ../admin/staff_list.php?msg=".H($msg));

       	} else {
        	// error, redraw the form
           	$smarty->assign($_POST);
           	$info['first']['field']['value'] = $_POST['fname'];
			$info['last']['field']['value'] = $_POST['sname'];
			$info['uname']['field']['value'] = $_POST['uname'];
			$info['susp']['field']['checked'] = isset($_POST['susp']);
			$info['auth']['tabs']['users']['field']['checked'] = isset($_POST['authUsers']);
			$info['auth']['tabs']['devices']['field']['checked'] = isset($_POST['authDevs']);
			$info['auth']['tabs']['catalog']['field']['checked'] = isset($_POST['authCat']);
			$info['auth']['tabs']['admin']['field']['checked'] = isset($_POST['authAdmin']);
			$info['auth']['tabs']['reports']['field']['checked'] = isset($_POST['authReps']);

           	$smarty->assign('info',$info);
           	$smarty->display('admin/staff_edit.tpl','admin');
       	}
  	}
