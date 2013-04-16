<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

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
		
		
		 
		$usrQryPrefix = "SELECT %i DISTINCT bc.`bibid`, bc.`copyid` FROM  `biblio_copy` bc, `biblio` b ";
 		// initial part of the query limiting the search scope by material types which should be recommended
 		// and to books not already in the users queue or they have already read
 		// along with ones that are only at their reading level 
 		$usrQrySuffix = "WHERE b.`bibid`=bc.`bibid` AND bc.`formatid`=1 AND bc.`contentid`=1 ";
 		$usrQrySuffix .= "AND b.`audience_cd`= (SELECT `reading_levelid` FROM `users` WHERE `userid`=%N) ";
 		$usrQrySuffix .= "AND b.`material_cd` IN (SELECT `code` FROM `material_type_dm` WHERE `recommend_flg`=1) ";
		$usrQrySuffix .= "AND bc.bibid NOT IN (SELECT DISTINCT `bibid` FROM `download_hist` dh WHERE dh.`userid`=%N UNION SELECT DISTINCT `bibid` FROM `user_requests` ur WHERE ur.`userid`=%N) ";
		
 		//$usrQryEnd = 'ORDER BY ';
 		
 		$insertPrefix = $insertStr = 'INSERT IGNORE INTO `user_requests` (`userid`,`bibid`,`copyid`,`order_dt`) VALUES ';
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
				
				$thisPrefix = $thisSuffix = null;
				
				// limit the search to specific types 
				//$thisPart .= $this->mkSQL($usrQryPrefix);
				// add exclusions for disliked words per type 

				$dislikesFilter = $this->_buildWordsQuery($dislikesWords,$stype,$ptype);
				if (isset($dislikesFilter))
				{
					$thisPrefix .= ",(".$dislikesFilter.") dlf #dislikes Filter \r";
					$thisSuffix .= "AND bc.`bibid` NOT IN (dlf.`bibid`) ";
				
					//$thisPart .= (isset($dislikesFilter))?'AND NOT EXISTS (SELECT 1 FROM ('.$dislikesFilter.') dlf WHERE dlf.`bibid`=si.`bibid` )':' ';
				}
				
				$likesFilter = $this->_buildWordsQuery($likesWords,$stype,$ptype);
				if (isset($likesFilter))
				{
					$thisPrefix .= ",(".$likesFilter.") lf #likes Filter \r";
					$thisSuffix .= "AND bc.`bibid` IN (lf.`bibid`) ";

					
					//$thisPart .= (isset($likesFilter))?'AND EXISTS (SELECT 1 FROM ('.$likesFilter.') lf WHERE lf.`bibid`=si.`bibid` )':' ';
				}
				
				if ((!isset($thisPrefix)) && (!isset($thisPrefix))) continue;
				
				// add the excludes per preferences (if any) (covers all types) 
				$thisSuffix .= (isset($prefsExcludes))?$prefsExcludes:' ';
				
				
				$usrQryStr .= (!$firstLoop)?' UNION ':'';
				$usrQryStr .= $this->mkSQL($usrQryPrefix.$thisPrefix.$usrQrySuffix.$thisSuffix,(($firstLoop)?"SQL_NO_CACHE":""),$thisUser->userid,$thisUser->userid,$thisUser->userid);
				
				$firstLoop = false;
					
			}
			// ORDER BY RAND() is VERY expensive but as we are limiting the rows 
			// to at most the users max amount for queueing (~20-100)
			// it is very fast	
			if (!isset($usrQryStr))
				$usrQryStr .= $this->mkSQL($usrQryPrefix.$usrQrySuffix,$thisUser->userid,$thisUser->userid,$thisUser->userid);
							
			$displayIdx++;
			echo (($showOutput)&&(($displayIdx%$displayOutputAt) == 0))?'.':'';
			
			
			$sql = $this->mkSQL($usrQryStr."ORDER BY RAND() LIMIT %N ",$thisUser->num_req);
// ---
			s($sql); continue;
// ---
			$reqs = null;
			$reqs = $this->get_results($sql);
			// check if there were no results 
			if (($reqs == null) || (empty($reqs))) continue; 
						
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
		// * subtract 15 mins from the oldest request Timestamp to make sure the 
		// new additions are added to the end of the users list
		$reqSql = "SELECT  u.`userid`, (up.`max_queued_reqs`-ur.`req_cnt`) `num_req`, DATE_SUB(ur.`oldest_req`, INTERVAL 15 MINUTE) `insert_dt` ";
		$reqSql .= "FROM (SELECT `userid`, COUNT(`reqid`) AS `req_cnt`, MIN(`order_dt`) `oldest_req` FROM `user_requests` GROUP BY `userid`) ur, "; 
		$reqSql .= "`user_prefs` up, `users` u WHERE ur.`userid`=u.`userid`  AND u.`userid`=up.`userid` AND  ur.`req_cnt`<up.`max_queued_reqs` ";
		$reqSql .= "AND  u.`statusid`=1 AND u.`classid`<>5 AND u.`auto_recommend`=1 ";
		$unSql = "UNION SELECT u.`userid`, up.`max_queued_reqs`, DATE_SUB(NOW(), INTERVAL 15 MINUTE) FROM `users` u,`user_prefs` up ";
		$unSql .= "WHERE u.`userid`=up.`userid` AND u.`statusid`=1 AND u.`classid`<>5 AND u.`auto_recommend`=1 AND ";
		$unSql .= "NOT EXISTS (SELECT 1 FROM `user_requests` ur WHERE u.`userid`=ur.`userid`) ";
		
		if (!isset($userid)) // check for specific userid 
		{
			$sql = $this->mkSQL($reqSql.$unSql."ORDER BY `userid` ");
		}
		else
		{
			$reqSql .= "AND u.`userid`=%N ";
			$unSql .= "AND u.`userid`=%N ";
			$sql = $this->mkSQL($reqSql.$unSql."ORDER BY `userid` ",$userid,$userid);
		}		 
		
		
		$userFreeReqNums = $this->get_results($sql);
		
		return $userFreeReqNums;
	}

	private function _getProfiles($likes=true,$userid=null)
	{
		$sql = $this->mkSQL('SELECT up.`userid`, up.`typeid`, up.`content` FROM `user_profile` up WHERE `prefers`=%N ',$likes);
		$sql .= (isset($userid))?$this->mkSQL('AND `userid`=%N ',$userid):'';
		
		return $this->get_results($sql);
	}
	
	private function _getPrefs($userid=null)
	{
		$qrySql = 'SELECT up.* FROM `user_prefs` up ';
		$sql = $this->mkSQL($qrySql);
		$sql .= (isset($userid))?$this->mkSQL('WHERE up.`userid`=%N ',$userid):'';
		
		
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
			if (($row->content == '') || (strlen($row->content)<(($row->typeid==1)?2:3))) continue;
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

		$prefsQry = 'AND NOT EXISTS (SELECT 1 FROM `biblio_field` bf WHERE bc.`bibid`=bf.`bibid` AND (bf.`tag`=599 AND bf.`subfield_cd` IN (';
		
		// !TODO: add logic for narrators (ie male, female, synth)
		//'narrator_male'=>'n','narrator_female'=>'n','narrator_synth'=>'n',
		
		// fields that will be used 
		$cols = array('content_sex'=>'s','content_violence'=>'v','content_lang'=>'l','books_long'=>'e','books_short'=>'b');
		
		$filters = null;
		$first = true;
		foreach ($prefs as $key=>$val)
		{
			if (!isset($cols[$key])) continue; // ignore fields that dont need processing 
			if ($val == 1) continue; // ignore values that the user prefers
			
			$filters .= (!$first)?',':'';
			$filters .= "'".$cols[$key]."'";
			$first = false;
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
		    	//$filter .= $this->mkSQL("SELECT si.`bibid` FROM `search_index` si LEFT JOIN `wordlist` wl ON si.`wordid`=wl.`wordid` WHERE si.`searchid`=%N AND wl.`word` IN (",$sType);
		    	$filter .= $this->mkSQL("SELECT si.bibid FROM `search_index` si ,`wordlist` wl  WHERE  si.`wordid`=wl.`wordid` AND  si.`searchid`=%N AND (",$sType);
		    	while (list($wordIdx,$aWord) = each($wordList))
		    	{	
		    		$filter .= ($wordIdx>0)?' OR ':'';
		    		$filter .= $this->mkSQL("wl.`word`=%Q",$aWord);							
		    	}
		    	$count = count($profiles[$pType][$profIdx]);
		    	$filter .= $this->mkSQL(') GROUP BY si.`bibid` HAVING COUNT(*)%i=%N ',(($count>1)?">":""),(($count==1)?1:2));
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
