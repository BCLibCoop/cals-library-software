<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 		
 	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(__ROOT__."classes/Recommender.php");
	$rec = new Recommender();

	$userid = (isset($_GET['u']))?$_GET['u']:null;
	$showOutput = (isset($_GET['so']))?true:false;
	
	if ($showOutput)
	{	
		@ini_set('implicit_flush', 1);
    	for ($i = 0; $i < ob_get_level(); $i++) { ob_end_flush(); }
    	ob_implicit_flush(1);
		print str_pad('',2048)."\n"; // add 4K of padding (especially for Safari) so we can get realtime 
									// feedback on the calling page
	}
	
	$rec->refillRequests($userid,$showOutput); // refill specified user or all if null
	
	if ($showOutput)
	{ 		
   		for ($i = 0; $i < ob_get_level(); $i++) { ob_end_flush(); }
   		ob_implicit_flush(0);
   		@ini_set('implicit_flush', 0);
   	}	