<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once(__ROOT__."classes/ezQuery.php");
require_once(__ROOT__."classes/UsmarcTagDm.php");

/******************************************************************************
 * UsmarcTagDmQuery data access component for usmarc_tag_dm table
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class UsmarcTagDmQuery extends ezQuery {

	function __construct()
	{
		parent::__construct();
		$this->cache_timeout = (24*31);
	}

  /****************************************************************************
   * Executes a query
   * @param int $code (optional) code of row to fetch
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function getTagsForBlock($blockNmbr=null,$assoc=false) {
    $sql = "SELECT * FROM `usmarc_tag_dm` ";
    $sql .= (isset($blockNmbr))?$this->mkSQL("WHERE `block_nmbr`=%N ", $blockNmbr):'';
    $sql .= "ORDER BY `tag` ";
	$res=$this->get_results($sql);
	if(($res === false) || (empty($res))) return false;
    $tags=array();
    foreach($res as $aTag)
    {
    	$tags[$aTag->tag] = (!$assoc)?$this->_mkTag($aTag):($aTag->tag." - ".$aTag->description);
    }
    return (!empty($tags))?$tags:false;
  }

  /****************************************************************************
   * Formats a tag object from the selected row result
   * @param int $result fetched row
   * @return UsmarcTagDm returns UsMarcTagDm object
   * @access private
   ****************************************************************************
   */
  private function _mkTag($result) {
    $dm = new UsmarcTagDm();
    $dm->setBlockNmbr($result->block_nmbr);
    $dm->setTag($result->tag);
    $dm->setDescription($result->description);
    $dm->setInd1Description($result->ind1_description);
    $dm->setInd2Description($result->ind2_description);
    $dm->setRepeatableFlg($result->repeatable_flg);
    return $dm;
  }

  /****************************************************************************
   * Executes a query
   * @param int $tag tag of row to fetch
   * @return UsmarcTagDm returns UsMarcTagDm object or false if error occurs
   * @access public
   ****************************************************************************
   */
  function getTag($tag) {
    $sql = $this->mkSQL("SELECT * FROM `usmarc_tag_dm` WHERE `tag`=%N ", $tag);

    $res = $this->get_results($sql);
    if (!isset($res) || empty($res))
      return false;

    return $this->_mkTag($res[0]);
  }

  /****************************************************************************
   * Executes a query
   * @param int $tag tag of indicators to fetch
   * @return Associative array of indicators and their descriptions or false if error occurs
   * @access public
   ****************************************************************************
   */
  function getIndicatorsForTag($tag) {
    $sql = $this->mkSQL("SELECT `indicator_nmbr` `ind_num`, `indicator_cd` `ind_code`, `descr`, `tag` FROM `usmarc_indicator_dm` WHERE `tag`=%N ORDER BY `indicator_nmbr`,`indicator_cd` ", $tag);

    $res = $this->get_results($sql);
    if (!isset($res) || empty($res))
      return false;

   	$inds = array();
   	while (list(,$row) = each($res))
   	{
   		$inds[$row->ind_num][$row->ind_code] = (($row->ind_code != "")?$row->ind_code:"&nbsp;")." - ".$row->descr;
   	}
   	if (!isset($inds[1])) {$inds[1] = array(""=>"&nbsp;&nbsp;- ");}
    if (!isset($inds[2])) {$inds[2] = array(""=>"&nbsp;&nbsp;- ");}

    return $inds;
  }


  /****************************************************************************
   * Fetches all rows from the query result.
   * @return assocArray returns associative array indexed by tag containing UsmarcTagDm objects.
   * @access public
   ****************************************************************************
   */
  function getAllTags()
  {
  	$sql = "SELECT * FROM `usmarc_tag_dm` ORDER BY `tag` ";

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

    if (!isset($res) || empty($res))
      return false;

    $assoc = array();
    while (list(,$aRow) = each($res))
    {
      $assoc[$aRow->tag] = $this->_mkTag($aRow);
    }

    return (!empty($assoc))?$assoc:false;
  }

}
