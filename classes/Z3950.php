<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
require_once(str_replace('//','/',dirname(__FILE__).'/').'../shared/common.php');
require_once(__ROOT__.'classes/MARC.php');

 /******************************************************************************
 * Z39.50 component for searching Z39.50 servers
 *
 * @author Kieren Eaton <circledev@gmail.com>
 * @version 1.0
 * @access public
 ******************************************************************************
 */
 
class Z3950
{

	// returns entries (if any) from a search of the selected servers
	static public function searchServers($servers, $searchTerms=null, $returnEntries=true, $maxResults=25)
	{ 	
		if ((!is_array($servers) && !is_string($servers)) || (!isset($searchTerms) || ($searchTerms==""))) return array();
		
		if (is_string($servers)) $servers = array($servers);
	
		$excludes = null;
		// Mapping CCL keywords to Bib-1-Attributes (allows convenient query formulation)
		$cclFields = array("ti"=>"1=4",
  							"au"=>"1=1",
  							"isbn"=>"1=7"
  							);
		
		// setup the connections
		$conns = $results = array();
		foreach($servers as $idx=>$host)
		{
			$ref = yaz_connect($host);
			if ($ref == false) continue;
			$conns[$idx] = $ref;
        	yaz_syntax($conns[$idx], "usmarc");
        	yaz_ccl_conf($conns[$idx], $cclFields);
        	yaz_range($conns[$idx], 1, $maxResults);
        	// build the CCL query
        	$cclQry = "";
        	$first = true;
        	foreach($cclFields as $key=>$dummy)
        	{
        		$cclQry .= (!$first)?" or ":"";
        		$cclQry .= "($key=$searchTerms)";
        		$first = false;
        	}
        	if (!yaz_ccl_parse($conns[$idx], $cclQry, &$rpnQuery)){continue;}
        	yaz_search($conns[$idx], "rpn", $rpnQuery["rpn"]);
		}
		yaz_wait(); // connect to the servers

    	foreach ($conns as $idx=>$ref) 
    	{
        	$error = yaz_error($ref);
	        if (!empty($error))
	        {
	        	$results["errors"][]=array("msg"=>$error,
	        								"server"=>$idx
	        								);
	       		continue;
	        }
	          
        	$results[$idx] = array();
    	    for ($p = 1; $p <= $maxResults; $p++)  // 
    	    {
            	$marcData = yaz_record($ref, $p, "raw");
            	s($marcData);
            	if (!$marcData) break;
            	// process the data recieved
            	$aRec = MARC::recordsFromRawData($marcData);
            	if (!empty($aRec) )
            	{
            		$entries = ($returnEntries==true)?MARC::entriesFromMarcRecords($aRec,$excludes):$aRec;
            		$results[$idx][] = (count($entries)==1)?$entries[0]:$entries;
            	}	
        	}
        	
        }
        return $results;
    }
		 
}
