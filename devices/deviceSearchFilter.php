<?php

	if((!isset($_POST)) || (!isset($_POST['n']) && !isset($_POST['b'])))
		exit;

	$tab='devices';
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(__ROOT__."classes/DeviceQuery.php");

	$devQuery = new DeviceQuery();
	$someDevs = $devQuery->findDevices(((isset($_POST['n']))?$_POST['n']:null),((isset($_POST['b']))?$_POST['b']:null));

	$smarty->assign("labels",array("notAssigned"=>$loc->getText("devicesList_notAssigned")));
	$smarty->assign('devsInfo',$someDevs);
	echo $smarty->fetch('devices/devices_list_body.tpl','devices');

