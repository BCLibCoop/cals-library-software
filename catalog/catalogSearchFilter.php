<?php

	$validKeys=array('t'=>'','a'=>'','g'=>'','s'=>'');
	if((!isset($_POST) || empty($_POST)) || (!array_keys_exist($validKeys,$_POST,true)))
		exit;

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(__ROOT__."classes/BiblioQuery.php");
	$bibQ = new BiblioQuery();

	$options=array_diff_key($_POST,$validKeys);
	if(count($options))
	{
		foreach($options as $k=>$v)
		{
			// remove the options from the original keys
			unset($_POST[$k]);

		}
		$keys=array_keys($_POST);
		$keys['options']=$options;
	}
	else
	{
		$keys = array_keys($_POST);
	}

	$vals = array_values($_POST);
	$someEntries = array();
	$vals = trim($vals[0]);
	if (!strlen($vals))
	{
		echo "";
		return;
	}

	$someEntries = $bibQ->catalogEntriesWithCriteria($keys,$vals);

	header("Expires: Sun, 19 Nov 1978 05:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	if($someEntries === false)
	{
		echo "No entries found";
		exit;
	}
	$smarty->assign('entries',$someEntries);
	echo $smarty->fetch('catalog/catalog_search_body.tpl','catalog');

    function array_keys_exist($keys,$array,$partial=false) {
    	if ($partial)
    		return (count(array_diff_key($keys,array_keys($array))) >0);

    	return (count(array_diff_key($keys,array_keys($array))) == count($keys));
    }
