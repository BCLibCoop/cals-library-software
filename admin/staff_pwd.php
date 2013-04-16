<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "admin";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "staffchgpass";
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
    $staff=$staffQ->getStaffMember($UID);

    $info['first'] = array('label'=>$loc->getText("adminStaff_editFirstname"),
  	    					'value'=>$staff->getFirstname());
  	$info['last'] = array('label'=>$loc->getText("adminStaff_editSurname"),
  	    					'value'=>$staff->getSurname());
  	$info['pass'] = array('label'=>$loc->getText("adminStaff_newPassword"),
  							'validate'=>array('passEmpty'=>$loc->getText("adminStaff_passwordNotEmpty")));
   	$info['pass2'] = array('label'=>$loc->getText("adminStaff_newReenterPassword"),
  							'validate'=>array('pass2Empty'=>$loc->getText("adminStaff_passwordNotEmpty"),
  												'passNE'=>$loc->getText("adminStaff_passwordNotEqual")));

    $smarty->assign('staffid',$UID);
    $smarty->assign('contentHeader',$loc->getText('adminStaff_passwordHeader').$staff->getFirstName().' '.$staff->getSurname());
  	$smarty->assign('formHeaderLabel',$loc->getText("adminStaff_passwordFormHeader"));
  	$smarty->assign('submitButtonLabel',$loc->getText("Update"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("Cancel"));

  	if(empty($_POST))
	{
		// new form, we (re)set the session data
        SmartyValidate::connect($smarty, true);
        // register our validators
        SmartyValidate::register_validator('passEmpty', 'pass', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('pass2Empty', 'pass2', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('passNE', 'pass:pass2', 'isEqual', false, false, 'trim');

  		$smarty->assign('info',$info);
		$smarty->display('admin/staff_pwd.tpl','admin');
	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();

			$staff->setPwd($_POST['pass']);
			$staff->setStaffid($_POST['uid']);
			$staff->setLastChangeStaffid($_SESSION['_admin']['staffid']);

			if ($staffQ->resetPwd($staff))
				$msg = $loc->getText("adminStaff_pwd_reset_PasswordSuccess").$staff->getFirstName().' '.$staff->getSurname();
			else
			    $msg = "Error Updating Staff member, ".$staff->getFirstName().' '.$staff->getSurname();

			unset($_POST);


			header("Location: ../admin/staff_list.php?msg=".H($msg));
       	} else {
        	// error, redraw the form

           	$smarty->assign($_POST);
           	$info['pass']['value'] = $_POST['pass'];
           	$info['pass2']['value'] = $_POST['pass2'];
           	$smarty->assign('info',$info);
           	$smarty->display('admin/staff_pwd.tpl','admin');
       	}
  	}
