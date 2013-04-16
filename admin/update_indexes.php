<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/SearchIndex.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");
	$si = new SearchIndex();

	//print_r($_GET);exit;

	$updIdx = (isset($_GET['typ']))?$_GET['typ']:0;
	$showOutput = (isset($_GET['so']))?true:false;
	$bibid = (isset($_GET['bib']))?$_GET['bib']:null;

	if ($showOutput)
	{
		@ini_set('implicit_flush', 1);
    	for ($i = 0; $i < ob_get_level(); $i++) { ob_end_flush(); }
    	ob_implicit_flush(1);
		print str_pad('',1024)."\n"; // add 4K of padding (especially for Safari) so we can get realtime
									// feedback on the calling page

		echo "Updating Indexes…  Please Wait.<br/><br/>";
	}

	$dmQ = new DmQuery();
	$sTypes = $dmQ->getAssoc("search_types_dm");
	ksort($sTypes);

	if($updIdx == 0)
	{
		$si->regenerateAllIndexes($bibid,$showOutput);
	}
	else
	{
		echo ($showOutput)?'Indexing '.$indexTypes[$updIdx].' ':'';
		$si->updateIndex($bibid,$updIdx,$showOutput);
		echo ($showOutput)?"  - Done.<br/>":'';
	}


	if ($showOutput)
	{
   		echo "<br/><br/>Indexing Complete.";
   		for ($i = 0; $i < ob_get_level(); $i++) { ob_end_flush(); }
   		ob_implicit_flush(0);
   		@ini_set('implicit_flush', 0);

   	}

