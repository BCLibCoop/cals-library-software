<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "admin";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "staffNew";
  $restrictInDemo = true;

  	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/Staff.php");
	require_once(__ROOT__."classes/StaffQuery.php");

  	$staff = null;
	$staffQ = new StaffQuery();

	$tabs = $info = array();
  	$tabs['users'] = array('label'=>$loc->getText("adminStaff_edit_authUsers"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'authUsers',
	    								'value'=>'1'));
  	$tabs['catalog'] = array('label'=>$loc->getText("adminStaff_edit_authCatalog"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'authCat',
	    								'value'=>'1'));
  	$tabs['devices'] = array('label'=>$loc->getText("adminStaff_edit_authDevices"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'authDevs',
	    								'value'=>'1'));
  	$tabs['admin'] = array('label'=>$loc->getText("adminStaff_edit_authAdmin"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'authAdmin',
	    								'value'=>'1'));
  	$tabs['reports'] = array('label'=>$loc->getText("adminStaff_edit_authReports"),
  	    					'field'=>array('type'=>'checkbox',
	    								'name'=>'authReps',
	    								'value'=>'1'));

  	$info['first'] = array('label'=>$loc->getText("adminStaff_edit_firstname"),

  	    					'field'=>array('type'=>'text',
	    								'name'=>'fname',
	    								'options'=>array('size'=>'30','maxlength'=>'30')));

  	$info['last'] = array('label'=>$loc->getText("adminStaff_edit_surname"),
  							'validate'=>array('v_snmEmpty'=>'Surname cannot be empty.'),
  	    					'field'=>array('type'=>'text',
	    								'name'=>'sname',
	    								'options'=>array('size'=>'30','maxlength'=>'30')));
  	$info['uname'] = array('label'=>$loc->getText("adminStaff_edit_login"),
  	    					'field'=>array('type'=>'text',
	    								'name'=>'uname',
	    								'options'=>array('size'=>'20','maxlength'=>'20')),
	    					'validate'=>array('v_unmEmpty'=>'Username cannot be empty.',
	    										'v_unmInvalid'=>'Username is already in use.'));
	$info['pass'] = array('label'=>$loc->getText("adminStaff_new_form_Password"),
							'field'=>array('type'=>'password',
	    								'name'=>'pass',
	    								'options'=>array('size'=>'30','maxlength'=>'30')),
  							'validate'=>array('v_passEmpty'=>$loc->getText("adminStaff_pwd_reset_PasswordNotEmpty")));
   	$info['pass2'] = array('label'=>$loc->getText("adminStaff_new_form_Reenterpassword"),
   							'field'=>array('type'=>'password',
	    								'name'=>'pass2',
	    								'options'=>array('size'=>'30','maxlength'=>'30')),
  							'validate'=>array('v_pass2Empty'=>$loc->getText("adminStaff_pwd_reset_PasswordNotEmpty"),
  												'v_passNE'=>$loc->getText("adminStaff_pwd_reset_PasswordNotEqual")));

   	$info['auth'] = array('label'=>$loc->getText("adminStaff_edit_auth"),
   	    					'tabs'=>$tabs);

	$smarty->assign('contentHeader',$loc->getText("adminStaff_new_form_Header"));
  	$smarty->assign('submitButtonLabel',$loc->getText("Add"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("Cancel"));

	SmartyValidate::register_object('staffQry',$staffQ);

	if(empty($_POST))
	{
		// new form, we (re)set the session data
        SmartyValidate::connect($smarty, true);

        // register our validators
       	SmartyValidate::register_criteria('isValidUsername','staffQry->validateUsername');
       	SmartyValidate::register_validator('v_snmEmpty', 'sname', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_unmEmpty', 'uname', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_unmInvalid', 'uname', 'isValidUsername', false, false, 'trim');
        SmartyValidate::register_validator('v_passEmpty', 'pass', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_pass2Empty', 'pass2', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_passNE', 'pass:pass2', 'isEqual', false, false, 'trim');

  		$smarty->assign('info',$info);
		$smarty->display('admin/staff_new.tpl','admin');
	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();
           	$staff= new Staff();
           	$staff->setFirstName($_POST['fname']);
			$staff->setSurname($_POST['sname']);
			$staff->setUsername($_POST['uname']);
			$staff->setPwd($_POST['pass']);
			$staff->setUsersAuth(isset($_POST['authUsers']));
			$staff->setCatalogAuth(isset($_POST['authDevs']));
			$staff->setDevicesAuth(isset($_POST['authCat']));
			$staff->setAdminAuth(isset($_POST['authAdmin']));
			$staff->setReportsAuth(isset($_POST['authReps']));
			$staff->setLastChangeStaffid($_SESSION['_admin']['staffid']);

			if ($staffQ->insert($staff))
				$msg = $staff->getFirstName().' '.$staff->getSurname().$loc->getText("adminStaff_new_Added");
			else
			    $msg = "Error Adding Staff member, ".$staff->getFirstName().' '.$staff->getSurname();

			header("Location: ../admin/staff_list.php?msg=".H($msg));

       	} else {
        	// error, redraw the form
           	$smarty->assign($_POST);
           	$info['first']['field']['value'] = $_POST['fname'];
			$info['last']['field']['value'] = $_POST['sname'];
			$info['uname']['field']['value'] = $_POST['uname'];
			$info['pass']['field']['value'] = $_POST['pass'];
			$info['pass2']['field']['value'] = $_POST['pass2'];
			$info['auth']['tabs']['users']['field']['checked'] = isset($_POST['authUsers']);
			$info['auth']['tabs']['devices']['field']['checked'] = isset($_POST['authDevs']);
			$info['auth']['tabs']['catalog']['field']['checked'] = isset($_POST['authCat']);
			$info['auth']['tabs']['admin']['field']['checked'] = isset($_POST['authAdmin']);
			$info['auth']['tabs']['reports']['field']['checked'] = isset($_POST['authReps']);

           	$smarty->assign('info',$info);
           	$smarty->display('admin/staff_new.tpl','admin');
       	}
  	}
