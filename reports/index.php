<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
    $tab = "reports";
    require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");


  	$nav = "list";



  	require_once(__ROOT__."classes/Report.php");

  	define("REPORT_DEFS_DIR","../reports/defs");

	#****************************************************************************
	#*  Read report definitions
	#****************************************************************************
	$reports = array();
	$errors = array();

	if ($handle = opendir(REPORT_DEFS_DIR)) {
	  while (($file = readdir($handle)) !== false) {
	    if (preg_match('/^([^._][^.]*)\\.(rpt|php)$/', $file, $m)) {
	      list($rpt, $err) = Report::create_e($m[1]);
	      if (!$err) {
	        if (!isset($reports[$rpt->category()])) {
	          $reports[$rpt->category()] = array();
	        }
	        $reports[$rpt->category()][$rpt->type()] = $loc->getText($rpt->title());
	      } else {
	        $errors[] = $err;
	      }
	    }
	  }
	  closedir($handle);
	}

	ksort($reports);
	foreach (array_keys($reports) as $k) {
	  asort($reports[$k]);
	}

	$smarty->assign('reportListHeader',$loc->getText("reportListHdr"));
	$smarty->assign('reportListDesc',$loc->getText("reportListDesc"));
	$smarty->assign('reportsList',$reports);
$smarty->display('reports/index.tpl','reports');