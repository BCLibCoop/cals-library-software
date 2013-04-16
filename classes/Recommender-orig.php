<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */


require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/stringFuncs.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/sqlFuncs.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/arrayFuncs.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Dm.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");

require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/ezQuery.php");

class Recommender extends ezQuery
{
	protected $_statusFilename = null; 
	
	function __destruct()
	{
		if ((isset($this->_statusFilename)) && (file_exists($this->_statusFilename)))
			unlink($this->_statusFilename);
	}
	
	function refillRequests($userid=null, $showOutput=false)
	{
		$this->_statusFilename = sys_get_temp_dir().'DLISrecommender';

		if (file_exists($this->_statusFilename)) 
		{
			echo ($showOutput)?"<br/><br/>The list is currently being updated.<br/>":''; 
			return;
		}
					
		touch($this->_statusFilename);
		
		set_time_limit(600); // 600 seconds = 10 minutes 
		
		// $searchLinks defines the same types of search data between the 
		// search_types (key) and profile_types (value) tables
		$searchLinks = array(2=>1,3=>2);
		
		// get the material types (if any) that should be used for recommendations
		$dmQ = new DmQuery();
		$allMatTypes = $dmQ->get('material_type_dm');
		unset($dmQ);
		$matTypes = array();
		foreach ($allMatTypes as $idx=>$type)
		{
			if ($type->getShouldRecommend())
				$matTypes[] = $type->getCode();
		}	
		unset($allMatTypes);	
		$matTypesStr = (count($matTypes))?implode(',',$matTypes):null;
				
		$usersNeedingReqs = $this->_getNumReqsRequired($userid);
		if ((!isset($usersNeedingReqs)) || (!count($usersNeedingReqs)))
		{
			echo ($showOutput)?'<br/><br/>There are no free request slots to be filled. <br/><br/>':'';	
			goto BAIL;
		}
		echo ($showOutput)?'Generating recommendations for '.count($usersNeedingReqs).' users. <br/><br/>':'';
		
		$allUsersPrefs = $this->_getPrefs();
		echo ($showOutput)?'Got preferences... <br/>':'';
		
		$userLikesProfiles = $this->_getProfiles();
		echo ($showOutput)?'Got users likes... <br/>':'';
		
		$userDislikesProfiles = $this->_getProfiles(false);
		echo ($showOutput)?'Got users dislikes... <br/><br/>':'';
		
		echo ($showOutput)?'Processing .':'';
		
		
		// initial part of the query limiting (if neccesary) the search scope by material types  
		$usrQryPrefix = 'SELECT si.bibid bibid, bco.copyid copyid, count(si.bibid) score FROM `search_index` si, ';
		$usrQryPrefix .= '(SELECT bc.`bibid`, bc.`copyid` FROM `biblio_copy` bc ';
		$usrQryPrefix .= (isset($matTypesStr))?', `biblio` b WHERE b.`bibid`=bc.`bibid` and b.`material_cd` IN ('.$matTypesStr.')   AND ':'WHERE ';
		$usrQryPrefix .= 'bc.`formatid`=1 AND bc.`contentid`=1) bco WHERE si.`bibid`=bco.`bibid` AND si.`searchid`';
 		// further limiting the scope to books not already in the users queue and ones they have already read
 		$usrQrySuffixPt1 = 'AND NOT EXISTS (SELECT 1 FROM `user_requests` ur WHERE bco.`copyid`=ur.`copyid` AND ur.`userid`=%N) ';
 		$usrQrySuffixPt2 = 'AND NOT EXISTS (SELECT 1 FROM `download_hist` dh WHERE bco.`copyid`=dh.`copyid` AND dh.`userid`=%N) GROUP BY si.`bibid` ';
 		$usrQryEnd = 'ORDER BY ';
 		
 		$insertPrefix = $insertStr = 'INSERT ignore into user_requests (userid,bibid,copyid,req_date) values ';
 		$totalInserts = 0;
 		$displayOutputAt = 1;
 		$displayOutputAt = count($usersNeedingReqs)*(($displayOutputAt<100)?0.10:0.05);
 		$displayOutputAt = ceil($displayOutputAt); 
 		$displayIdx = 0;
 		
		while (list(,$thisUser) = each($usersNeedingReqs))
		{	
			$id = identifierOfRowForObjectWithKeyValue($allUsersPrefs,'userid',$thisUser->userid);
			$thisUserPrefs = $allUsersPrefs[$id];

			if (empty($thisUserPrefs)) 
			{
				echo 'Failed to find prefs for userid '.$thisUser->userid.'<br/>';
				goto BAIL;
			}
			
			// build a query that will get all the bibid's that 
			// are excluded by the users prefs
			$prefsExcludes = $this->_makePrefsExcludes($thisUser->userid,$thisUserPrefs);			
			
			// get the list of words that this user dislikes
			$thisUserDislikes = objectsMatchingKeyValue($userDislikesProfiles,'userid',$thisUser->userid); 
			$dislikesWords = $this->_getWordsList($thisUserDislikes);
			
			// get the list of words that this user likes
			$thisUserLikes = objectsMatchingKeyValue($userLikesProfiles,'userid',$thisUser->userid); 
			$likesWords = $this->_getWordsList($thisUserLikes);
			
			$usrQryStr = null;
			$firstLoop = true;
			// find the books on a per type basis
			foreach ($searchLinks as $stype=>$ptype)
			{
				$thisPart = (!$firstLoop)?' UNION ':'';
				// limit the search to specific types 
				$thisPart .= $this->mkSQL($usrQryPrefix.'=%N ',$stype);
				// add exclusions for disliked words per type 
				
				$dislikesFilter = $this->_buildWordsQuery($dislikesWords,$stype,$ptype);
				$likesFilter = $this->_buildWordsQuery($likesWords,$stype,$ptype);
				
				$thisPart .= (isset($dislikesFilter))?'AND NOT EXISTS (SELECT 1 FROM ('.$dislikesFilter.') dlf WHERE dlf.`bibid`=si.`bibid` )':' ';
				$thisPart .= (isset($likesFilter))?'AND EXISTS (SELECT 1 FROM ('.$likesFilter.') lf WHERE lf.`bibid`=si.`bibid` )':' ';
				
				// add the excludes per preferences (covers all types)
				$thisPart .= (isset($prefsExcludes))?$prefsExcludes:' ';
				$thisPart .= $usrQrySuffixPt1.$usrQrySuffixPt2;
				
				if ((isset($usrQryStr)) || (isset($likesFilter)) || (isset($dislikesFilter)) || (isset($prefsExcludes))) 
				{
					$usrQryStr .= $this->mkSQL($thisPart,$thisUser->userid,$thisUser->userid);
					$firstLoop = false;
				}	
			}
			// check if we did not add any user specific filtering
			if (isset($usrQryStr))
			{
				$usrQryStr .= $usrQryEnd.'score DESC LIMIT %N ';
				
			}	
			else
			{	
				// generate a random selection from the entire catalog
				$sTypes = array_keys($searchLinks);
				$sTypes = implode(',',$sTypes);
				$usrQryStr = $this->mkSQL($usrQryPrefix.'IN ('.$sTypes.') '.$usrQrySuffixPt1.$usrQrySuffixPt2,$thisUser->userid,$thisUser->userid);
				$usrQryStr .= $usrQryEnd.' RAND() LIMIT %N '; 
			}
			
			$displayIdx++;
			echo (($showOutput)&&(($displayIdx%$displayOutputAt) == 0))?'.':'';
			
			$sql = $this->mkSQL($usrQryStr,$thisUser->num_reqs);
			s($sql);
			$reqs = null;
			$reqs = $this->get_results($sql);
			// check if there were no results 
			if (($reqs == null) || (empty($reqs))) continue; //echo "<br/>$sql<br/>"; 
			
			$insVals = array();
			foreach ($reqs as $k=>$row)
			{
				$insVals[] = '('.$thisUser->userid.','.$row->bibid.','.$row->copyid.",'".$thisUser->insert_dt."')";
			}
		
			$insertStr .= ($totalInserts!=0)?',':'';
			$insertStr .= implode(',',$insVals);			
			$totalInserts += count($insVals);
			// insert 500 rows at a time to reduce load on the server
			if ($totalInserts>500)
			{	
				// validate the string before doing the insert;
				$insertStr = $this->mkSQL($insertStr);
				$this->query($insertStr);
				// reset the counter and insert string
				$insertStr = $insertPrefix;
				$totalInserts = 0;
				continue;
			}			
				
		} // end while $usersNeedingReqs
		
		// insert any leftover requests
		if ($totalInserts>0)
		{	
	    	// validate the string before doing the insert;
	    	$insertStr = $this->mkSQL($insertStr);
	    	$this->query($insertStr);
	    	echo ($showOutput)?'.':'';
	    	unset($insertStr);
	    }
		
		echo ($showOutput)?'<br/><br/>Generation Complete.':'';
		
		BAIL:
		unlink($this->_statusFilename); // remove the file used for tracking running status
		return;
	}

	private function _getNumReqsRequired($userid=null)
	{
		$userFreeReqNums = null;
		// * get the number of books for each user that wants recommendations 
		// up to the max of their prefs settings
		// * subtract 30 mins from the oldest request DateTime to make sure the 
		// new additions are added to the end of the users list
		$qrySql = 'SELECT up.`userid`, (cast(up.`max_queued_reqs` AS SIGNED) - cast(ur.`queued_reqs` AS SIGNED)) num_reqs, DATE_SUB(ur.`oldest_req`, INTERVAL 30 MINUTE) insert_dt ';
		$qrySql .= 'FROM user_prefs up, users u, (SELECT uro.`userid`, count(*) queued_reqs, min(`req_date`) oldest_req FROM `user_requests` uro GROUP BY uro.`userid`) ur ';
		$qrySql .= 'WHERE up.`userid`=ur.`userid` AND up.`userid`=u.`userid` AND u.`statusid`=1 AND u.`classid`<>5 AND u.`auto_recommend`=1  AND (cast(up.max_queued_reqs AS SIGNED) - cast(ur.queued_reqs AS SIGNED))>0 ';
		if (!$userid) // most of the time we will be doing all users
		{
			// union is for users that have no requests pending
			$qrySql .= 'UNION SELECT u.`userid` , up.`max_queued_reqs`, DATE_SUB(NOW(), INTERVAL 30 MINUTE) FROM `users` u, `user_prefs` up ';
			$qrySql .= 'WHERE u.`userid`=up.`userid` AND u.`auto_recommend`=1 AND u.`statusid`=1 AND u.`classid`<>5 ';
			$qrySql .= 'AND NOT exists (SELECT 1 FROM `user_requests` urc where u.`userid`=urc.`userid`) ';
		}		 
		else
			$qrySql .= 'AND up.`userid` = '.$userid.' ';
		
		$qrySql .= ' order by `userid` '; 	
		
		$sql = $this->mkSQL($qrySql);
		$userFreeReqNums = $this->get_results($sql);
		
		return $userFreeReqNums;
	}

	private function _getProfiles($likes=true,$userid=null)
	{
		$sql = $this->mkSQL('SELECT up.`userid`, up.`typeid`, up.`content` FROM user_profile up WHERE `prefers`=%N ',$likes);
		$sql .= (isset($userid))?$this->mkSQL('AND `userid`=%N ',$userid):'';
		
		return $this->get_results($sql);
	}
	
	private function _getPrefs($userid=null)
	{
		$qrySql = 'SELECT up.* FROM `user_prefs` up ';
		$sql = $this->mkSQL($qrySql);
		$sql .= (isset($userid))?$this->mkSQL('where up.`userid`=%N ',$userid):'';
		
		return $this->get_results($sql); 
	}
	
	private function _getWordsList(&$userProfiles)
	{
		if (!isset($userProfiles)) return false;
		
		$typeWords = array();
		// first extract all the content strings
		while (list(,$row) = each($userProfiles))
		{
			if ((isset($typeWords[$row->typeid])) && (array_search(strtolower($row->content),$typeWords[$row->typeid]))) continue ;
			if (($row->content == '') || (strlen($row->content)<(($row->typeid==1)?2:3))) 
				continue;
			$typeWords[$row->typeid][] = $row->content;
		}
		
		// then explode and stem the words for each type
		foreach ($typeWords as $type=>$dummy)
		{
			foreach ($typeWords[$type] as $idx=>$wordStr)
			{
				$contents = explodeStr($wordStr,(($type==2)?true:false),(($type==2)?true:false),null,(($type==1)?2:3));
				if (empty($contents))
				{
					unset($typeWords[$type][$idx]);
					continue;
				}
				$typeWords[$type][$idx] = $contents;
			}
		}		
		
		reset($userProfiles);
		return (!empty($typeWords))?$typeWords:null;	
	}
				
	private function _makePrefsExcludes($userid,$prefs)
	{
		if (!isset($prefs)) return null; // error getting prefs for user!!

		$prefsQry = 'AND NOT EXISTS (SELECT 1 FROM `biblio_field` bf WHERE si.`bibid`=bf.`bibid` AND (bf.`tag`=599 AND bf.`subfield_cd` IN (';
		
		// !TODO: add logic for narrators (ie male, female, synth)
		//'narrator_male'=>'n','narrator_female'=>'n','narrator_synth'=>'n',
		
		// fields that will be used 
		$cols = array('content_sex'=>'s','content_violence'=>'v','content_lang'=>'l','books_long'=>'e','books_short'=>'b');
		
		$filters = null;
		$idx = 0;
		foreach ($prefs as $key=>$val)
		{
			if (!isset($cols[$key])) continue; // ignore fields that dont need processing 
			if ($val == 1) continue; // ignore values that the user prefers
			
			$filters .= ($idx>0)?',':'';
			$filters .= "'".$cols[$key]."'";
	
			$idx++; 
		}
		
		return (isset($filters))?$prefsQry.$filters.'))) ':null;
	}
	
	private function _buildWordsQuery($profiles,$sType,$pType)
	{
		if (!isset($profiles)) return null;
		$filter = null;
		if (isset($profiles[$pType]))
		{	
		    while (list($profIdx,$wordList) = each($profiles[$pType]))
		    {
		    	$filter .= ($profIdx>0)?' UNION ':'';
		    	//$filter .= $this->mkSQL('SELECT si.`bibid` FROM `search_index` si, `wordlist` wl WHERE si.`searchid`=%N AND si.`wordid`=wl.`wordid` AND `word` IN (',$sType);
		    	$filter .= $this->mkSQL("SELECT si.`bibid` FROM `search_index` si LEFT JOIN `wordlist` wl ON si.`wordid`=wl.`wordid` WHERE si.`searchid`=%N AND wl.`word` IN (",$sType);
		    	while (list($wordIdx,$aWord) = each($wordList))
		    	{	
		    		$filter .= ($wordIdx>0)?',':'';
		    		$filter .= "'".$aWord."'";							
		    	}
		    	
		    	$count = count($profiles[$pType][$profIdx]);
		    	$filter .= $this->mkSQL(') GROUP BY si.`bibid` HAVING COUNT(*)>=%N ',(($count==1)?1:2));
		    						
		    	$addedFilters = true;
		    }
		}	
	
		return (isset($filter))?$filter:null;
	}
	
	private function _makeWords($wordsArray)
	{
		$outStr = '';
		$addComma = false;
		foreach ($wordsArray as $obj)
		{
			if (is_string($obj))
			{
				if (strlen($obj))
				{	
					$outStr .= ($addComma)?',':'';
					$outStr .= "'".$obj."'";
					if (strlen($outStr)) $addComma = true;
				}
			}
			else // array of strings
			{
				$subStr = '';
				$subStr = $this->_makeWords($obj);				
				if(strlen($subStr))
				{
					$outStr .= ($addComma)?',':'';
					$outStr .= $subStr;
					$addComma = true;
				}
			}
		}
		return $outStr;
	}
			
}
