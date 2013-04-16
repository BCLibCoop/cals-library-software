<?php

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

	require_once(__ROOT__."functions/remoteFuncs.php");
	require_once(__ROOT__."classes/Device.php");
	require_once(__ROOT__."classes/DeviceQuery.php");

	$loc = new Localize(OBIB_LOCALE,'devices');

$devQry = new DeviceQuery();
$connectedDevs = getConnectedDevices();
	
if(($connectedDevs !== false) && (count($connectedDevs) > 0)) 
{ 
	$connectedDevs = $devQry->getFurtherInfo($connectedDevs);
	$funcs = array('add'=>array('field'=>array('type'=>'button',
												'value'=>$loc->getText("deviceAddThis"),
												'options'=>array('onclick'=>"doSubmit('device_add.php')")),
								'value'=>$loc->getText("devicesConnected_notFound")),
					'assign'=>array('field'=>array('type'=>'button',
												'value'=>$loc->getText("deviceAssign"),
												'options'=>array('onclick'=>"doSubmit('device_edit.php')")),
								'value'=>$loc->getText("devicesConnected_assignable")),
					'edit'=>array('field'=>array('type'=>'button',
												'value'=>$loc->getText("deviceEdit"),
												'options'=>array('onclick'=>"doSubmit('device_edit.php')"))));

}
else
{
	$connectedDevs = $funcs = null;
}	

	
$smarty->assign('funcs',$funcs);
$smarty->assign('devsInfo',$connectedDevs);
echo $smarty->fetch("devices/devices_connected_body.tpl","devices");

