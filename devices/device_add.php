<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "devices";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "add";
  $restrictInDemo = true;

  	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/Device.php");
	require_once(__ROOT__."classes/DeviceQuery.php");

	$fields = array('name'=>array('label'=>$loc->getText("deviceEdit_usersFullName")),
	    			'username'=>array('label'=>$loc->getText("deviceEdit_username")),
					'barcd'=>array('label'=>$loc->getText("deviceEdit_enclosureBarcode"),
									'field'=>array('type'=>'text',
	    											'name'=>'bcode',
	    											'options'=>array('size'=>'30',
	    																'maxlength'=>'30',
	    																"onkeyup"=>"delayFunction(setUpdateButton,100);",
	    																'id'=>'bcode')),
	    							'validate'=>array('v_bcNE'=>$loc->getText("deviceValidate_barcodeNotEmpty"),
	    												'v_bcValid'=>$loc->getText("deviceValidate_barcodeOnFile"))));

	// check if we are coming to this page from the connected devices page
	if (isset($_POST['cvend']) && isset($_POST['cprod']) && isset($_POST['cserial'])){
		$fields['vend']['value'] = $_POST['cvend'];
		$fields['prod']['value'] = $_POST['cprod'];
		$fields['serial']['value'] = $_POST['cserial'];
		unset($_POST);
    }

  	$smarty->assign('contentHeader',$loc->getText("deviceAdd_contentHeader"));
  	$smarty->assign('submitButtonLabel',$loc->getText("deviceAdd"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("deviceCancel"));

	$devQ = new DeviceQuery();
	SmartyValidate::register_object('devQry',$devQ);

	if (empty($_POST))
  	{
  		SmartyValidate::connect($smarty,true);

  		// register our validators
        SmartyValidate::register_criteria('isBarcodeUnique','devQry->validateBarcode');
        SmartyValidate::register_validator('v_bcNE', 'bcode', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_bcValid', 'bcode', 'isBarcodeUnique', false, false, 'trim');

        $smarty->assign('fields',$fields);
       	$smarty->display('devices/device_add.tpl','devices');

  	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
       		$aDev = null;

        	// no errors
           	SmartyValidate::disconnect();
			$aDev = new Device();
			$aDev->setUserId($_POST['usrid']);
			$aDev->setEnclosureId($_POST['bcode']);
			$aDev->setVendorCode($_POST['ven']);
			$aDev->setProductCode($_POST['pro']);
			$aDev->setSerialNumber($_POST['ser']);

			if ($devQ->insert($aDev) !== NULL)
				$msg = $loc->getText("deviceAdd_addSuccess",array('barcode'=>$_POST['bcode']));
			else
			    $msg = "Error Adding Device  ";

			header("Location: ../devices/devices_list.php?msg=".HURL($msg));
			exit;

       	} else {

        	// error, redraw the form
           	$smarty->assign($_POST);

           	$fields['name']['value'] = (isset($_POST['fullnm']))?$_POST['fullnm']:'';
           	$fields['barcd']['field']['value'] = (isset($_POST['bcode']))?strtoupper($_POST['bcode']):'';
            $fields['username']['value'] = (isset($_POST['usrnm']))?$_POST['usrnm']:'';
 			$fields['vend']['value'] = $_POST['ven'];
			$fields['prod']['value'] = $_POST['pro'];
			$fields['serial']['value'] = $_POST['ser'];

 			$smarty->assign('uid',(isset($_POST['usrid']))?$_POST['usrid']:'');
        	$smarty->assign('fields',$fields);

           	$smarty->display('devices/device_add.tpl','devices');
       	}
  	}
exit;
