<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  /******************************************************************************
 * CatalogIntegrity -- Archive and filesystem validation
 *
 * @author Kieren Eaton <circledev@gmail.com>
 * @version 1.0
 * @access public
 ******************************************************************************
 */

 
require_once(str_replace('//','/',dirname(__FILE__).'/').'../classes/ezQuery.php');

class CatalogIntegrity extends ezQuery
{

	protected $_statusFilename = null; 
	
	function __destruct()
	{
		if ((isset($this->_statusFilename)) && (file_exists($this->_statusFilename)))
			unlink($this->_statusFilename);
	}
	
	function checkCatalog($bibid=null, $showOutput=false)
	{
		$this->_statusFilename = sys_get_temp_dir().'DLISCatalogIntegrity';

		if (file_exists($this->_statusFilename)) 
		{
			echo ($showOutput)?"<br/><br/>The Catalog is currently being checked.<br/>Please Wait":''; 
			return;
		}
		touch($this->_statusFilename);
		set_time_limit(600); // 600 seconds = 10 minutes 
		
		echo ($showOutput)?'Checking Catalog Integrity …<br/><br/>':'';
		
		$missingFiles = array();
		$faultyArchives = array();
		
		$copySelect = $this->mkSQL('SELECT bc.`bibid`,b.`title`,bc.`file_path` AS `path` FROM biblio b, `biblio_copy` bc WHERE b.`bibid`=bc.`bibid` ');
		$copySelect .= (isset($bibid))?$this->mkSQL('AND bc.`bibid`=%N ',$bibid):'ORDER BY bc.`bibid` ';
		$copies = $this->get_results($copySelect);
		if ((!isset($copies)) || (!count($copies))) goto BAIL;
		while(list(,$copyRow) = each($copies))
		{
			$path = ROOT_ARCHIVES_PATH.$copyRow->path;
			if(!file_exists($path))
			{
				$missingFiles[] = $copyRow;
				continue;
			}
			if ()
		}
		
		echo ($showOutput)?'<br/><br/>Integrity Check Complete.':'';
		BAIL:
		unlink($this->_statusFilename); // remove the file used for tracking running status
		return;
	}

}