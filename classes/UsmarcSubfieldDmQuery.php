<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once(__ROOT__."classes/ezQuery.php");
require_once(__ROOT__."classes/UsmarcSubfieldDm.php");

/******************************************************************************
 * UsmarcSubfieldDmQuery data access component for usmarc_subfield_dm table
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class UsmarcSubfieldDmQuery extends ezQuery {

	function __construct()
	{
		parent::__construct();
		$this->cache_timeout = (24*31); // set the cache timeout to approximately 1 month
	}

  /****************************************************************************
   * Executes a query
   * @param int $code (optional) code of row to fetch
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function getSubfieldsForTag($tag=null,$makeAssoc=false) {
    $sql = "SELECT * FROM `usmarc_subfield_dm` ";
    $sql .= (isset($tag))?$this->mkSQL("WHERE `tag`=%N ", $tag):'';

    $sql .= "ORDER BY `tag`, `subfield_cd` ";
    $res=$this->get_results($sql);
    $flds=array();
    if(($res === null) || ($res === false))
    {
    	$flds[""] = "";

    }
    else
    {
    	foreach($res as $aFld)
    	{
    		$flds[$aFld->subfield_cd] = (!$makeAssoc)?$this->_mkSubfield($aFld):($aFld->subfield_cd." - ".$aFld->description);
    	}
    }
    return $flds;
  }

  /****************************************************************************
   * Formats a subfield object from the selected row result
   * @param int $result fetched row
   * @return UsmarcSubfieldDm returns UsMarcSubfieldDm object
   * @access private
   ****************************************************************************
   */
  private function _mkSubfield($result) {
    $dm = new UsmarcSubfieldDm();
    $dm->setTag($result->tag);
    $dm->setSubfieldCd($result->subfield_cd);
    $dm->setDescription($result->description);
    $dm->setRepeatableFlg($result->repeatable_flg);
    return $dm;
  }

  /****************************************************************************
   * Executes a query
   * @param int $subfld subfield code of row to fetch
   * @return SubfieldDm returns SubfieldDm object or false if error occurs
   * @access public
   ****************************************************************************
   */
  function getSubfield($tag, $subfld) {
    $sql = $this->mkSQL("SELECT * FROM `usmarc_subfield_dm` WHERE `tag`=%N AND `subfield_cd`=%Q ",$tag, $subfld);

    $res = $this->get_results($sql);
    if (!isset($res) || empty($res))
      return false;

    return $this->_mkSubfield($res[0]);
  }


  /****************************************************************************
   * Fetches all rows from the query result.
   * @return assocArray returns associative array indexed by tag containing UsmarcsubfieldDm objects.
   * @access public
   ****************************************************************************
   */
  function getAllSubfields()
  {
  	$sql = $this->mkSQL("SELECT sf.* FROM `usmarc_subfield_dm` sf");

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
	  $aTag = $this->_mkSubfield($aRow);
      $index = makeCompositeTag($aRow->tag,$aRow->subfield_cd);
      $assoc[$index] = $aTag;
    }
    return (!empty($assoc))?$assoc:false;
  }

}

?>
