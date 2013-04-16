<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "devices";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  if(!(checkPassedIn(array('did'),$_GET,$_POST)))
 	{
		header("Location: index.php");
		exit;
	}

  $nav = "edit";
  $restrictInDemo = true;

	$devid = (isset($_GET['did']))?$_GET['did']:$_POST['did'];

  	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/Device.php");
	require_once(__ROOT__."classes/DeviceQuery.php");
	require_once(__ROOT__."classes/User.php");
	require_once(__ROOT__."classes/UserQuery.php");

	$aDev = null;
	$devQ = new DeviceQuery();
	$userQ = new UserQuery();

	$fields = array('name'=>array('label'=>$loc->getText("deviceEdit_usersFullName")),
	    			'username'=>array('label'=>$loc->getText("deviceEdit_username")),
					'barcd'=>array('label'=>$loc->getText("deviceEdit_enclosureBarcode"),
									'field'=>array('options'=>array('size'=>'20',
	    																'maxlength'=>'20',
	    																'onBlur'=>'setUpdateButton();',
	    																"id"=>"bcd")),
	    							'validate'=>array('v_bcNE'=>$loc->getText("deviceValidate_barcodeNotEmpty"),
	    												'v_bcValid'=>'Barcode already on file')));

		// check if we are coming to this page from the connected devices page
	if (isset($_POST['cvend']) && isset($_POST['cprod']) && isset($_POST['cserial'])){
		unset($_POST);
    }

  	$smarty->assign('did',$devid);
  	$smarty->assign('contentHeader',$loc->getText("deviceEdit_contentHeader"));

  	$smarty->assign('submitButtonLabel',$loc->getText("deviceUpdate"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("deviceCancel"));

	if (empty($_POST))
  	{
  		$aDev = $devQ->getDevice($devid);
		$fields['name']['value'] = $aDev->getUserFullname();
  		if($aDev->getUserId()!=0)
		{
			$user = $userQ->getUser($aDev->getUserId());
			$fields['username']['value'] = $user->getUsername();
		}

  		$bc = $aDev->getEnclosureId();
  		// only validate if the enclosure barcode is not already set
  		if((!isset($bc)) || ($bc==''))
  		{
  			// register the object
  			SmartyValidate::register_object('devQry',$devQ);
  			// reset the session data
  			SmartyValidate::connect($smarty, true);
        	// register our validators
        	SmartyValidate::register_criteria('isBarcodeUnique',"devQry->validateBarcode");
        	SmartyValidate::register_validator('v_bcNE', 'bcd', 'notEmpty', false, false, 'trim');
            SmartyValidate::register_validator('v_bcValid', 'bcd:did', 'isBarcodeUnique', false, false, 'trim');

  		}
  		else
        	$fields['barcd']['field']['value'] = $aDev->getEnclosureId();

		$smarty->assign('uid',$aDev->getUserId());
        $smarty->assign('fields',$fields);
       	$smarty->display('devices/device_edit.tpl','devices');

  	}
	else
	{
	    // validate after a POST
		//
		// if the validation criteria is not set just update the table row
		if((SmartyValidate::is_registered_object('devQry'))==false)
		{
			$aDev = new Device();
			$aDev->setUserId($_POST['uid']);
			$aDev->setEnclosureId($_POST['bcd']);
			$aDev->setDeviceId($_POST['did']);

			if ($devQ->update($aDev) !== NULL)
				$msg = $loc->getText("deviceEdit_editSuccess",array('barcode'=>$_POST['bcd']));
			else
			    $msg = "Error Updating Device  ";

			header("Location: ../devices/devices_list.php?msg=".HURL($msg));
			exit;
		}

		SmartyValidate::connect($smarty);
  		if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();
			$aDev = new Device();
			$aDev->setUserId($_POST['uid']);
			$aDev->setEnclosureId($_POST['bcd']);
			$aDev->setDeviceId($_POST['did']);

			if ($devQ->update($aDev) !== NULL)
				$msg = $loc->getText("deviceEdit_editSuccess",array('barcode'=>$_POST['bcd']));
			else
			    $msg = "Error Updating Device  ";

			header("Location: ../devices/devices_list.php?msg=".HURL($msg));
			exit;

       	} else {

        	// error, redraw the form
           	$smarty->assign($_POST);
           	$smarty->assign('error_barcode',true);
           	$fields['name']['value'] = (isset($_POST['fnm']))?$_POST['fnm']:'';
           	$fields['barcd']['field']['value'] = strtoupper($_POST['bcd']);
            $fields['username']['value'] = (isset($_POST['unm']))?$_POST['unm']:'';
 			$smarty->assign('uid',(isset($_POST['uid']))?$_POST['uid']:'');
        	$smarty->assign('fields',$fields);

           	$smarty->display('devices/device_edit.tpl','devices');
       	}
  	}

