<?php
	
	if((!isset($_POST) || empty($_POST))) return;

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	$loc = new Localize(OBIB_LOCALE,'catalog');
	
	$servers = array();
	$qry = null;
	foreach($_POST as $key=>$val)
	{
		if($key == "s")
			$servers = $val;
					
		if($key=="q")
			$qry = $val;
	}	
	
	if ((empty($servers)) || (!isset($qry))) return;
	
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Z3950.php");
	//require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Biblio.php");
	//require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioField.php");
	
	// results are an array servers each one containing it individual entries
	
	$results = Z3950::searchServers($servers,$qry); 
	$serverErrors = null;
	if (isset($results["errors"]))
	{
		$serverErrors = $results["errors"];
		unset($results["errors"]);
	}
	
	// !TODO -- localize the labels
	$labels = array("useThis"=>$loc->getText("catalogExternalSearch_useThisEntry"),
					"title"=>$loc->getText("catalogSearch_barHeaderTitle"),
					"author"=>$loc->getText("catalogSearch_barHeaderAuthor"),
					"isbn"=>$loc->getText("catalogExternalSearch_isbn"),
					"pubPlace"=>$loc->getText("catalogExternalSearch_publisherLocation"),
					"publisher"=>$loc->getText("catalogExternalSearch_publisher"),
					"pubDate"=>$loc->getText("catalogExternalSearch_publishedDate")
					);
	
	$smarty->assign('results',$results);
	$smarty->assign('errors',$serverErrors);
	$smarty->assign('labels',$labels);
	echo $smarty->fetch('catalog/external_search_body.tpl','catalog');
	

