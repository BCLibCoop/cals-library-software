<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 

require_once(__ROOT__."classes/ezQuery.php");

/******************************************************************************
 * UsmarcBlockDmQuery data access component for usmarc_block_dm table
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class UsmarcBlockDmQuery extends ezQuery {
  
	function __construct()
	{
		parent::__construct();
		$this->cache_timeout = (24*31);
	}


  /****************************************************************************
   * Executes a query
   * @param string $table table name of domain table to query
   * @param int $code (optional) code of row to fetch
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function getBlocks($assoc=false) {
    $sql = "SELECT * FROM `usmarc_block_dm` ORDER BY `block_nmbr` ";

    if($this->get_cache($sql) !== false)
    {
    	$res = $this->get_results($sql);
    } 
    else
    {
    	$this->cache_queries = true;
    	$this->cache_timeout = 0.001;
    	$res = $this->get_results($sql);
    	$this->cache_queries = false;
    	$this->cache_timeout = (24*31); // set the cache timeout to approximately 1 month
    }

    if($res==null) return false;
    $blocks = array();
    foreach($res as $aRow)
    {
    	$blocks[$aRow->block_nmbr] = (!$assoc)?$this->_mkBlock($aRow):($aRow->block_nmbr." - ".$aRow->description);
    }
    
    return $blocks; 
  }

  /****************************************************************************
   * Fetches a row from the query result and populates the Dm object.
   * @return Dm returns domain object or false if no more domain rows to fetch
   * @access public
   ****************************************************************************
   */
  private function _mkBlock($aRow) {

    $block = new UsmarcBlockDm();
    $block->setBlockNmbr($aRow->block_nmbr);
    $block->setDescription($aRow->description);
    return $block;
  }

} 