<?php

	function cacheQuery(&$qryObj, $qry, $forceUpdate=false)
	{
		if (!isset($qryObj)) return false;
		
		if (($forceUpdate == false) && ($qryObj->get_cache($qry) != false)) return; // valid cache found 
		
		//echo '<br/>Caching<br/> '.$qry.'<br/>';
		
		// cache not found so cache this query
		// store the current caching and timeout values
		$cachingState = $qryObj->cache_queries;
		$currentTimeout = $qryObj->cache_timeout;
		
		// set the states to make sure the cache will be regenerated
		$qryObj->cache_queries = true; 
		$qryObj->cache_timeout = 0; 
		
		$qryObj->query($qry);
		
		// set the states back to their original values
		$qryObj->cache_queries = $cachingState;  
		$qryObj->cache_timeout = $currentTimeout;
		 
		//echo '<br/>Completed Caching<br/> '.$qry.'<br/>';

	}



	function searchTypes(&$db,$type=1,$forceAll=false)
	{
		$sql = 'select `searchid`, `descr`, `tags` from search_types ';
		if ($forceAll==false)
			$sql .= ($type!=1)?' where searchid=\''.$type.'\' ':' where searchid <> \'1\' ';	
		$res = $db->get_results($sql);
		return (isset($res))?$res:array();
	}
	
	
	function makeCriteria($cols,$values,$useOr=true)
	{
		if (is_array($cols))
			if (count($cols) != count($values)) return false;
		elseif (!is_string($cols)) return false;
		
		$crit = '';
		$first = true;
		while (list($idx,$word) = each($values))
		{
			$crit .= (!$first)?($useOr)?' OR ':' AND ':'';
			$crit .= (is_string($cols))?$cols.'=\''.$word.'\'':$cols[$idx].'=\''.$word.'\'';
			
			$first = ($first == true)?false:$first;
		}
		
		return $crit;
	}
	
	function dateConvert($date,$toSql=true) 
	{
		$pieces = $sep = null;
		if ($toSql == true)
		{ // conversion from PHP to mySQL yyyy/mm/dd for insert
			preg_match('`(\d{1,2})[/\.-](\d{1,2})[/\.-](\d{4,4})`', $date, $pieces); 
			$sep='-';
		}
		else
		{ //convert from mySQL select to PHP dd/mm/yyyy 
			preg_match('`(\d{4,4})-(\d{2,2})-(\d{2,2})`', $date, $pieces); 
			$sep='/'; 	
		}
		
		$date = $pieces[3].$sep.$pieces[2].$sep.$pieces[1];
		return $date; 
	} 

?>