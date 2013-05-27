<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "catalog";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	require_once(__ROOT__."classes/Z3950.php");

  	$nav = "externalSearch";
  	$helpPage = "catalog";
  	require_once(__ROOT__."admin/header_admin.php");

  	// set the server names and addresses and also the default selected servers.
  	$servers = array("servers"=>array(
				"z3950.loc.gov:7090/voyager"=>"Library of Congress",
  				"catalogue.nla.gov.au:7090/voyager"=>"National Library of Australia",
  				"janus.rnib.org.uk:210/MAIN*BIBMAST"=>"RNIB",
  				"203.28.85.72:210/Aurora"=>"Vision Australia"
				),
  			"selected"=>array("z3950.loc.gov:7090/voyager","catalogue.nla.gov.au:7090/voyager")
  			);
  	$labels = array("results"=>$loc->getText("catalogExternalSearch_results"));

  	$smarty->assign("labels",$labels);
  	$smarty->assign("serverList",$servers);
  	$smarty->assign("contentHeader","Search external servers");
  	$smarty->display("catalog/external_search.tpl","catalog");

  	exit;
