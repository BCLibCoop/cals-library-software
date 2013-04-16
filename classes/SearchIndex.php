<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/stringFuncs.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/sqlFuncs.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/arrayFuncs.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/ezQuery.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Dm.php");

class SearchIndex extends ezQuery
{

	protected $_statusFilename = null;

	function __destruct()
	{
		// remove the running script indicator if the script terminates prematurely
		if ((isset($this->_statusFilename)) && (file_exists($this->_statusFilename)))
			unlink($this->_statusFilename);
	}

	function regenerateAllIndexes($bibid=null,$show=false)
	{
		if(!isset($bibid)) // check if we are doing everything
		{
			// remove the index and the wordlist
			$this->query("TRUNCATE `search_index` ");
			$this->query("TRUNCATE `wordlist` ");
		}
		$dmQ = new DmQuery();
		$sTypes = $dmQ->getAssoc("search_types_dm");
		ksort($sTypes);
		foreach ($sTypes as $idx=>$desc)
		{
			echo ($show)?"Indexing $desc&nbsp;":'';
			$this->updateIndex($bibid,$idx,$show);
			echo ($show)?"&nbsp;&nbsp;- Done.<br/>":'';

			//exit;
		}

	}

	/*
	*
	*	Updates the different types of indexing being used
	*
	*/
	function updateIndex($bibid=null,$searchType,$showOutput=false)
	{
		if((isset($bibid)) && ($bibid!=0))
		{
			if(!$this->_shouldIndex($bibid)){ goto BAIL;}
		}

		$this->_statusFilename = sys_get_temp_dir().'DLISindexer';

		if (file_exists($this->_statusFilename))
		{
			echo ($showOutput)?"<br/><br/>The Indexes are currently being updated.<br/>":'';
			return;
		}
		touch($this->_statusFilename);

		set_time_limit(300); // make sure we allow enough time for all indexes (if required)
							// to be processed

		// if a bibid is specified remove all its unique entries from the index
		if ((isset($bibid)) && ($bibid!=0))
		{
			$this->delete($bibid);
		}

		// first create a temp table in memory and make sure
		// that it will be large enough to hold the data required
		$dropSql = $this->mkSQL('DROP TABLE IF EXISTS `words_temp` ');
		$this->query($dropSql);
		$this->query('SET max_heap_table_size = (1024*1024*256)'); // 256Mb
		$createSql = $this->mkSQL('CREATE TEMPORARY TABLE `words_temp` (`bibid` INT(11) UNSIGNED NOT NULL,`word` CHAR(100) NOT NULL) ENGINE=MEMORY DEFAULT CHARSET=utf8 ');
		$res = $this->query($createSql);
		if($res === false)
		{
			echo "Error creating temporary table. Please notify your system administrator.";
			goto BAIL;
		}

		$this->_updateWordlistSingle($bibid,$searchType,$showOutput);
		$this->_updateWordlistTags($bibid,$searchType,$showOutput);

		// finished with the temp table so drop it
		$this->query($dropSql);

		BAIL:
		if ((isset($this->_statusFilename)) && (file_exists($this->_statusFilename)))
			unlink($this->_statusFilename); // remove the file used for tracking running status

		return;
	}

	// Delete all entry specific words, leaves words that are used in other references
	function delete($bibid)
	{
		$findSql = $this->mkSQL("SELECT si.`wordid` FROM `search_index` si WHERE si.bibid=%N AND NOT EXISTS (SELECT 1 FROM `search_index` WHERE si.`wordid`=`wordid` AND si.`bibid`<>`bibid`) ORDER BY si.`wordid` ",$bibid);
		if($this->query($findSql) === false)
			Fatal::internalError("Error Selecting search indexes for bibid $bibid");

		if ($this->num_rows == 0) return; // no entry specific words to remove

		$findRes = $this->last_result;
		$delSql = $this->mkSQL('DELETE si.*, wl.* FROM `search_index` si, `wordlist` wl WHERE `bibid`=%N AND si.`wordid`=wl.`wordid` and wl.`wordid` IN (',$bibid);

		$first = true;
		foreach ($findRes as $wid)
		{
			$delSql .= (!$first)?", ":"";
			$delSql .= $wid->wordid;
			$first=false;
		}
		$delSql .= ") ";

		// divide the affected rows by how many tables we affected (ie 2)
		if(($this->query($delSql) === false) || (($this->rows_affected/2) != count($findRes)) )
		{
			print_r($res)."<br/>";
			print_r($findRes);
			Fatal::internalError("Error removing search indexes for bibid $bibid");
		}

	}

	// update the wordlist and index with single field entries
	private function _updateWordlistSingle($bibid=null,$srchType=null,$showOutput=false)
	{
		// get x bibid's at a time for processing
		$booksPerChunk = 5000;

		if (!isset($srchType)) goto BAIL;

		$sqlPrefix = '';
		$sqlSuffix = '';
		if ($srchType == 1) // title
		{
		    $sqlPrefix = 'SELECT b.`bibid`, CONCAT(`title`,\' \',`title_remainder`) content ';
		    $sqlSuffix = "FROM biblio b WHERE b.`bibid` NOT IN (SELECT `bibid` FROM `biblio` b, `material_type_dm` mt  WHERE b.`material_cd`= mt.`code` AND mt.`index_flg`=0) ";
		}
		elseif ($srchType == 2) // author
		{
		    $sqlPrefix = 'SELECT b.`bibid`, b.`author` content ';
		    $sqlSuffix = "FROM `biblio` b WHERE b.`bibid` NOT IN (SELECT b.`bibid` FROM `biblio` b, `material_type_dm` mt  WHERE b.`material_cd`= mt.`code` AND mt.`index_flg`=0) ";
		}
		elseif ($srchType == 3) // subject/genre info
		{
		    $sqlPrefix = "SELECT bt.`bibid` bibid, bt.`topics` content ";
		    $sqlSuffix = "FROM biblio b, (SELECT bi.`bibid`, CONCAT(IF(bi.`topic1` NOT LIKE '',bi.`topic1`,''), ";
		    $sqlSuffix .= "IF(bi.`topic2` NOT LIKE '',concat(';',bi.`topic2`),''), ";
		    $sqlSuffix .= "IF(bi.`topic3` NOT LIKE '',concat(';',bi.`topic3`),''), ";
		    $sqlSuffix .= "IF(bi.`topic4` NOT LIKE '',concat(';',bi.`topic4`),''), ";
		    $sqlSuffix .= "IF(bi.`topic5` NOT LIKE '',concat(';',bi.`topic5`),'')) topics FROM biblio bi) bt ";
		    $sqlSuffix .= "WHERE bt.`bibid`=b.`bibid` AND bt.`topics` NOT LIKE '' ";
		    $sqlSuffix .= " AND bt.`bibid` NOT IN (SELECT `bibid` FROM `biblio` b, `material_type_dm` mt  WHERE b.`material_cd`= mt.`code` AND mt.`index_flg`=0) ";
		}
		else // ignore other types at this stage
		    goto BAIL;

		$sqlSuffix .= (isset($bibid))?$this->mkSQL('AND b.`bibid`=%N',$bibid):' ';
		$countSql = 'SELECT COUNT(*) '.$sqlSuffix;

		$totalBooks = $this->get_var($countSql);

		if ($totalBooks == 0) return; // make sure we have something to process

		$maxChunks = ($totalBooks>$booksPerChunk)?($totalBooks/$booksPerChunk):1;
		for($chunkCnt=0;$chunkCnt<=$maxChunks;$chunkCnt++)
		{
		    if (($chunkCnt==$maxChunks)&&($totalBooks<$booksPerChunk)) {continue;}

		    echo ($showOutput)?'.':'';

		    $sql = $sqlPrefix.$sqlSuffix;
		    $sql .= ($totalBooks != 1)?' LIMIT '.$chunkCnt*$booksPerChunk.','.$booksPerChunk.' ':' ';
		    $res = $this->get_results($sql);
		    //echo"<br/>";print_r($res);
		    if (!isset($res)) {continue;}

		    $stops = in_array($srchType, array(3)); // strip stops from Subject (idx 3)
		    $stem = in_array($srchType, array(3)); // stem the subject (idx 3)
		    $len = (in_array($srchType, array(2,6)))?2:3; // min word length to keep

		    $this->_processResults($res,$stops,$stem,null,$len);

		} // end for chunkCnt

		$this->_insertResults($srchType);
		BAIL:

		return;
	}

	// update the search index with the list of tags (if any) associated with the search type
	private function _updateWordlistTags($bibid=null,$srchType=null,$showOutput=false)
	{
		$booksPerChunk = 5000; // get x bibid's at a time for processing

		if (!isset($srchType)) goto BAIL;

		$dmQ = new DmQuery();

		$sTypes = $dmQ->getAssoc('search_types_dm',"tags");
		$tagList = $sTypes[$srchType];
		unset($dmQ);

		// only process types that have tag fields listed
		if (strlen($tagList)==0) goto BAIL;

		$sqlPrefix = 'SELECT bf.`bibid` bibid, lower(convert(bfd.`field_data` using utf8)) content ';
		$sqlSuffix = 'FROM biblio_field bf, biblio_field_data bfd where bf.`fieldid`=bfd.`fieldid` ';
		$sqlSuffix .= 'and bf.`tag`=%N and bf.`subfield_cd`=%Q ';
		$sqlSuffix .= " AND bf.`bibid` NOT IN (SELECT `bibid` FROM `biblio` b, `material_type_dm` mt  WHERE b.`material_cd`= mt.`code` AND mt.`index_flg`=0) ";

		$tags = explode(' ',$tagList);
		foreach ($tags as $fulltag)
		{
		    $tagLen = strlen($fulltag)-1;
		    $tag = ((int)substr($fulltag,0,$tagLen));
		    $subfield = substr($fulltag,$tagLen,1);

		    $sql = $this->mkSQL($sqlPrefix.$sqlSuffix,$tag,$subfield);

		   	$sql .= (isset($bibid) )?$this->mkSQL('AND bf.`bibid`=%N ',$bibid):"";

		    $countSql = $this->mkSQL('SELECT COUNT(*) '.$sqlSuffix,$tag,$subfield);

		    $totalBooks = $this->get_var($countSql);
		    if ($totalBooks == 0) continue; // make sure we have something to process

		    $maxChunks = ($totalBooks>$booksPerChunk)?($totalBooks/$booksPerChunk):1;
		    for($chunkCnt=0;$chunkCnt<=$maxChunks;$chunkCnt++)
		    {
		    	$res=null;
		    	if (($chunkCnt == $maxChunks) && ($totalBooks<$booksPerChunk)) continue;

		    	echo ($showOutput)?'.':'';
		    	$qrySql = ($totalBooks != 1)?$this->mkSQL($sql.' LIMIT %N,%N',($chunkCnt*$booksPerChunk),$booksPerChunk):$sql;
		    	$res = $this->get_results($qrySql);
		    	if (!isset($res)) {continue;}

		    	if ($srchType!=4) // check that the search is not ISBN
		    	{
		    	    $stops = in_array($srchType, array(1,3)); // strip stops from title (idx 1) , Subject (idx 3)
		    	    $stem = in_array($srchType, array(1,3)); // stem the title (idx 1)
		    	    $len = (in_array($srchType, array(2,6)))?2:3; // min word length to keep
		    	    $this->_processResults($res,$stops,$stem,null,$len);
		    	}
		    	else
		    	{
		    	    // tag 020a (ISBN) may have - or spaces between the numbers
		    	    // remove all letters except 'x' and all punctuation
		    	    $excepts = array('/[^xX[:digit:]]/'=>' ','/\-/'=>'','/\s/'=>'');
		    	    $this->_processResults($res,false,false,$excepts,7);
		    	}
		    }
		}
		// insert the processed results into the index
		$this->_insertResults($srchType);

		BAIL:
		return;
	}

	private function _processResults(&$results,$stripStops=true,$doStem=true,$exceptions=NULL,$minLen=3)
	{
		$insWords = array();
		$wlStr = '';
		$tempList=null;

		while (list(,$row) = each($results)) // iterate through each row in the results
		{
		    $tempList=explodeStr($row->content, $stripStops,$doStem, $exceptions,$minLen);
		   	if (empty($tempList)) {
		   		//echo "<br/> nothing for ";
		   		//print_r($row);
		   		continue;
		   	}
	    	reset($tempList); // reset the position pointer for the array
	    	// load up the inserts list
	    	while ((list(,$word) = each($tempList)))
	    	{
	    		$hash = hash('sha256',($row->bibid.'|'.$word));

	    		if (isset($insWords[$hash])) continue;
	    		$insWords[$hash]="(".$row->bibid.",'".$word."')"; // add brackets and quote the word ready for insert
	    	}
	    	// insert ~2000 rows at a time
	    	if (count($insWords) > 2000)
	    	{
	    		$wlStr = implode(',', $insWords);
				if (strlen($wlStr) > 0)
				{
					// insert values into temp table
					$insql = 'INSERT IGNORE INTO `words_temp` (`bibid`,`word`) VALUES '.$wlStr.' ';
					$result = $this->query($insql);
				}
				$insWords= array();
				$wlStr = '';
	    	}

		}
		// insert the left over rows
		if (!empty($insWords))
		{
			$wlStr = implode(',', $insWords);
			if (strlen($wlStr) > 0)
			{
				// insert leftover values into temp table
				$insql = 'INSERT IGNORE INTO `words_temp` (`bibid`,`word`) VALUES '.$wlStr.' ';
				$this->query($insql);
			}
		}
	}

	private function _insertResults($srchid)
	{
		$countSql = $this->mkSQL('SELECT COUNT(*) FROM `words_temp` ');
		$count = $this->get_var($countSql);
		if ($count > 0)
		{
			// add new words into the wordlist if are unique
			$insertSql = $this->mkSQL('INSERT IGNORE INTO `wordlist` (word) SELECT `word` FROM `words_temp` ');
			$this->query($insertSql);
			// add the biblio references for the words list to the search index
			//exit;
			$insertSql = $this->mkSQL('INSERT IGNORE INTO `search_index` (`bibid`,`searchid`,`wordid`) SELECT `bibid`,%N,`wordid` FROM `words_temp` wt,`wordlist` wl WHERE wt.`word`=wl.`word` ',$srchid);
			$res = $this->query($insertSql);
			if($res===false)
			{
				echo "<br/>".$this->show_errors()."<br/>";
			}
			// delete the contents of the temp table ready for the next chunk
			$delsql = 'TRUNCATE `words_temp` ';
			$this->query($delsql);
		}
	}

	private function _shouldIndex($bibid=null)
	{
		if((!isset($bibid)) || ($bibid==0)) return false;

		$sql = $this->mkSQL("SELECT bibid FROM `biblio` WHERE bibid NOT IN (SELECT `bibid` FROM `biblio` b, `material_type_dm` mt  WHERE b.`material_cd`= mt.`code` AND mt.`index_flg`=0) AND `bibid`=%N ",$bibid);

		$this->query($sql);
		return ($this->num_rows > 0);
	}
}

