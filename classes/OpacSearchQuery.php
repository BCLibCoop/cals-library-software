<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

 	require_once(str_replace('//','/',dirname(__FILE__).'/').'../classes/ezQuery.php');

//require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/global_constants.php");
//require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Query.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioField.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");

/******************************************************************************
 * BiblioQuery data access component for library bibliographies
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class OpacSearchQuery extends ezQuery {
  var $_itemsPerPage = 1;
  var $_rowNmbr = 0;
  var $_currentRowNmbr = 0;
  var $_currentPageNmbr = 0;
  var $_rowCount = 0;
  var $_pageCount = 0;
  var $_loc;

  public function __contruct()
  {
    //$this->Query();
    $this->_loc = new Localize(OBIB_LOCALE,"classes");
  }
  function setItemsPerPage($value) {
    $this->_itemsPerPage = $value;
  }
  function getLineNmbr() {
    return $this->_rowNmbr;
  }
  function getCurrentRowNmbr() {
    return $this->_currentRowNmbr;
  }
  function getRowCount() {
    return $this->_rowCount;
  }
  function getPageCount() {
    return $this->_pageCount;
  }

  /****************************************************************************
* Executes a query
* @param string $type one of the global constants
*
*               OBIB_SEARCH_TITLE,
*               OBIB_SEARCH_AUTHOR,
*               OBIB_SEARCH_SUBJECT,
*
				// added additional search methods
				// 30/11/10 - Kieren Eaton
				OBIB_SEARCH_ISBN,
*				OBIB_SEARCH_SYS_NUMBER,
*				OBIB_SEARCH_ALL

* 	@param string @$words pointer to an array containing words to search for
 	@param integer $page What page should be returned if results are more than one page
 	@param string $sortBy column name to sort by.  Can be title or author
* @return boolean returns false, if error occurs
* @access public
   ****************************************************************************
    */
    function search($type, $words, $page, $sortBy, $opacFlg=true, $searchProd=true)
    {

    # reset stats
    $this->_currentPageNmbr = $page;
    $this->_pageCount = 0;


    $sqlPrefix = "SELECT b.`bibid`, CONCAT(b.`title`,' ',b.`title_remainder`) AS `title`, b.`author`, b.`restricted_flg`, c.`description` `coll`,fd.`field_data` `snum`, bc.`copy_type` FROM `biblio` b ";
    $sqlSuffix = "JOIN (SELECT bfd.`field_data`,bf.bibid FROM `biblio_field` bf JOIN `biblio_field_data` bfd ON bf.`fieldid`=bfd.`fieldid` AND bf.tag=35 AND bf.`subfield_cd`='a') fd ON b.`bibid`=fd.bibid ";
    $sqlSuffix .= "JOIN `collection_dm` c on b.`collection_cd`=c.`code` ";
    $sqlSuffix .= 'LEFT JOIN (SELECT ct.`description` `copy_type`, bc.`bibid`, bc.`copyid` FROM `biblio_copy` bc ,`content_type_dm` ct WHERE bc.`contentid`=ct.`code` ) bc ON b.`bibid`=bc.`bibid` ';
    $sqlSuffix .= ($opacFlg||$searchProd)?"WHERE ":'';

    $sqlSuffix .= ($opacFlg)?"b.`opac_flg`=1 ":'';
    $sqlSuffix .= ($opacFlg&&$searchProd)?"AND ":'';
    $sqlSuffix .= ($searchProd)?"`copy_type` IS NOT NULL ":'';
    $orderBy = ($sortBy=='t')?"ORDER BY b.`title` ":"ORDER BY b.`author` ";

    $criteria = '';
    $where = '';
    if($type != 0) {
      $where = $this->mkSQL("WHERE si.`searchid`=%N", $atype);
    }
    foreach($words as $idx=>$aWord) {
            $criteria .= $this->mkSQL("JOIN (SELECT si.`bibid` FROM `search_index` si JOIN `wordlist` wl ON si.`wordid`=wl.`wordid` AND (wl.`word` like '%q%%') $where) si%N on  si%N.bibid =b.bibid ", $aWord, $idx, $idx);
    }

    $sql=$sqlPrefix.$criteria.$sqlSuffix.$orderBy;

    $res = $this->get_results($sql);
    if(!$res) return array();

    // build the entries list from the results set
    $entries = array();
    foreach($res as $row)
    {
	    if(!isset($entries[$row->bibid]))
	    {
	    	$entries[$row->bibid]['bibid'] = $row->bibid;
	    	$entries[$row->bibid]['title'] = $row->title;
	    	$entries[$row->bibid]['author'] = $row->author;
	    	$entries[$row->bibid]['collection'] = $row->coll;
	    	$entries[$row->bibid]['snum'] = $row->snum;
	    	$entries[$row->bibid]['restricted'] = $row->restricted_flg;
	    }
	    if(isset($row->copy_type))
		{
			$types = (isset($entries[$row->bibid]['copyTypes']))?explode(',',$entries[$row->bibid]['copyTypes']):array();
			$types = array_flip($types);
			$words = explode(' ',$row->copy_type,3);
			if(is_array($words) && count($words)>2)
			    array_pop($words);
			$words = implode(' ', (array)$words);
			$types[$words]='';
			$types = implode(', ', array_keys($types));
			$entries[$row->bibid]['copyTypes'] = $types;
		}
    }

    return $entries;

/*
 select b.* from biblio b
join (select si.bibid from `search_index` si join `wordlist` wl on si.`wordid`=wl.`wordid` and (wl.word like 'cook') where si.`searchid`=1) si on  si.bibid =b.bibid
#join (select si.bibid from `search_index` si join `wordlist` wl on si.`wordid`=wl.`wordid` and (wl.word like 'tow%') where si.`searchid`=1) si2 on  si2.bibid =b.bibid
join `biblio_copy` bc on bc.bibid=b.bibid
where b.`opac_flg`=1

*/




/*
    // setting sql join clause
    $join = "biblio b left join biblio_copy bc on b.bibid=bc.bibid ";

    # setting sql where clause
    $criteria = "";
    if ((sizeof($words) == 0) || ($words[0] == ""))
	{
      if ($opacFlg) $criteria = "where opac_flg=1 ";
    }
	else
	{
		switch ($type)
		{
			case OBIB_SEARCH_AUTHOR :
				//$join = "from ".$join;
				$criteria = $this->_getCriteria(array("b.author","b.responsibility_stmt"),$words);
				break;
			case OBIB_SEARCH_SUBJECT :
				$join = "biblio_field_data bfd, ".$join;
				$join .= "left join biblio_field bf on bf.bibid=b.bibid and (bf.tag in ('650','655')) ";
				$criteria = $this->_getCriteria(array("b.topic1","b.topic2","b.topic3","b.topic4","b.topic5","bfd.field_data"),$words,'where bfd.fieldid=bf.fieldid and ');
				break;
			case OBIB_SEARCH_ISBN : // MARC tag 20 subfield a
				$join = "biblio_field_data bfd, ".$join;
				$join .= "left join biblio_field bf on bf.bibid=b.bibid "
                	. "and (bf.tag='20' and bf.subfield_cd='a') ";
          		$criteria = $this->_getCriteria(array("bfd.field_data"),$words,'where bfd.fieldid=bf.fieldid and ');
				break;
			case OBIB_SEARCH_SYS_NUMBER : // MARC tag 32 subfield a
				$join = "biblio_field_data bfd, ".$join;
				$join .= "left join biblio_field bf on bf.bibid=b.bibid and (bf.tag='35' and bf.subfield_cd='a') ";
          		$criteria = $this->_getCriteria(array("bfd.field_data"),$words,'where bfd.fieldid=bf.fieldid and ');
				break;
			case OBIB_SEARCH_ALL : // search all of the above

//				$join .= "left join biblio_field on biblio_field.bibid=biblio.bibid "
//                	. "and ((biblio_field.tag='700' or biblio_field.tag='20' or biblio_field.tag='35' "
//					. "or biblio_field.tag='852') "
//					. "and (biblio_field.subfield_cd='a' or biblio_field.subfield_cd='b')) ";

				$join = "biblio_field_data bfd, ".$join;
				$join .= "left join biblio_field bf on bf.bibid=b.bibid "
                	. "and (bf.tag in ('700','20','35','852') and (bf.subfield_cd in ('a','b'))) ";
				$criteria = $this->_getCriteria(array("b.title","b.author","b.responsibility_stmt","bfd.field_data","b.topic1","b.topic2","b.topic3","b.topic4","b.topic5"),$words,'where bfd.fieldid=bf.fieldid and ');
				break;

			default : // search by title as the default
				//$join = "from ".$join;
				$criteria = $this->_getCriteria(array("b.title", "b.title_remainder"),$words);


		}
		if($searchProd)	{$criteria .= "and bc.file_path is not null ";}

      	if ($opacFlg) $criteria .= "and opac_flg=1 ";
    }

    # setting count query
    $sqlcount = "select count(*) as rowcount from ";
    $sqlcount = $sqlcount.$join;
    $sqlcount = $sqlcount.$criteria;

    # setting query that will return all the data
    $sql = "select SQL_NO_CACHE b.* ";
    $sql .= ",bc.copyid ";
    $sql .= ",bc.file_path from ";
    $sql .= $join;
    $sql .= $criteria;
    $sql .= $this->mkSQL(" GROUP BY b.bibid order by %C ", $sortBy);

    # setting limit so we can page through the results
    $offset = ($page - 1) * $this->_itemsPerPage;
    $limit = $this->_itemsPerPage;
    $sql .= $this->mkSQL(" limit %N, %N", $offset, $limit);

    //echo "sqlcount=[".$sqlcount."]<br>\n";
    //exit("sql=[".$sql."]<br>\n");

    dd($sql);
    # Running row count sql statement
    if (!$this->_query($sqlcount, $this->_loc->getText("biblioSearchQueryErr1"))) {
      return false;
    }

    # Calculate stats based on row count
    $array = $this->_conn->fetchRow();
    $this->_rowCount = $array["rowcount"];
    $this->_pageCount = ceil($this->_rowCount / $this->_itemsPerPage);

    # Running search sql statement
    return $this->_query($sql, $this->_loc->getText("biblioSearchQueryErr2"));
*/
  }


  /****************************************************************************
   * Utility function to get the selection criteria for a given column and set of values
   * @param string $col bibid of bibliography to select
   * @param array reference &$words array of words to search for
   * @return string returns SQL criteria syntax for the given column and set of values
   * @access private
   ****************************************************************************
   */
  function _getCriteria($cols,&$words,$prefix='where ') {
    # setting selection criteria sql
    $criteria = "";
    for ($i = 0; $i < count($words); $i++) {
      $criteria .= $prefix.$this->_getLike($cols,$words[$i]);
      $prefix = " and ";
    }
    return $criteria;
  }

  function _getLike(&$cols,$word) {
    $prefix = "";
    $suffix = "";
    if (count($cols) > 1) {
      $prefix = "(";
      $suffix = ")";
    }
    $like = "";
    for ($i = 0; $i < count($cols); $i++) {
      $like .= $prefix;
      $like .= $this->mkSQL("%C like %Q ", $cols[$i], "%".$word."%");
      $prefix = " or ";
    }
    $like .= $suffix;
    return $like;
  }

  /****************************************************************************
   * Executes a query to select ONLY ONE SUBFIELD
   * @param string $bibid bibid of bibliography copy to select
   * @param string $fieldid copyid of bibliography copy to select
   * @return BiblioField returns subfield or false, if error occurs
   * @access public
   ****************************************************************************
   */
  function doQuery($statusCd,$mbrid="") {

    $sql = "select biblio.* ";
    $sql .= ",biblio_copy.copyid ";
    $sql .= ",biblio_copy.file_path ";
    $sql .= "from biblio, biblio_copy ";
    $sql .= "where biblio.bibid = biblio_copy.bibid ";

    if (!$this->_query($sql, $this->_loc->getText("biblioSearchQueryErr3"))) {
      return false;
    }
    $this->_rowCount = $this->_conn->numRows();
    return true;
  }

  /****************************************************************************
   * Fetches a row from the query result and populates the BiblioSearch object.
   * @return BiblioSearch returns bibliography search record or false if no more bibliographies to fetch
   * @access public
   ****************************************************************************
   */
  function fetchRow() {
    $array = $this->_conn->fetchRow();
    if ($array == false) {
      return false;
    }

    # increment rowNmbr
    $this->_rowNmbr = $this->_rowNmbr + 1;
    $this->_currentRowNmbr = $this->_rowNmbr + (($this->_currentPageNmbr - 1) * $this->_itemsPerPage);

    $bib = new BiblioSearch();
    $bib->setBibid($array["bibid"]);
    $bib->setCopyid($array["copyid"]);
    $bib->setCreateDt($array["create_dt"]);
    $bib->setLastChangeDt($array["last_change_dt"]);
    $bib->setLastChangeUserid($array["last_change_staffid"]);
    $bib->setMaterialCd($array["material_cd"]);
    $bib->setCollectionCd($array["collection_cd"]);
    $bib->setCallNmbr1($array["call_nmbr1"]);
    $bib->setCallNmbr2($array["call_nmbr2"]);
    $bib->setCallNmbr3($array["call_nmbr3"]);
    $bib->setTitle($array["title"]);
    $bib->setTitleRemainder($array["title_remainder"]);
    $bib->setResponsibilityStmt($array["responsibility_stmt"]);
    $bib->setAuthor($array["author"]);
    $bib->setTopic1($array["topic1"]);
    $bib->setTopic2($array["topic2"]);
    $bib->setTopic3($array["topic3"]);
    $bib->setTopic4($array["topic4"]);
    $bib->setTopic5($array["topic5"]);
    if (isset($array["file_path"])) {
      $bib->setFilePath($array["file_path"]);
    }
    if (isset($array["status_cd"])) {
      $bib->setStatusCd($array["status_cd"]);
    }
    if (isset($array["status_begin_dt"])) {
      $bib->setStatusBeginDt($array["status_begin_dt"]);
    }
    if (isset($array["status_mbrid"])) {
      $bib->setStatusMbrid($array["status_mbrid"]);
    }
    if (isset($array["due_back_dt"])) {
      $bib->setDueBackDt($array["due_back_dt"]);
    }
    if (isset($array["days_late"])) {
      $bib->setDaysLate($array["days_late"]);
    }
    if (isset($array["renewal_count"])) {
      $bib->setRenewalCount($array["renewal_count"]);
    }

    return $bib;
  }

	function getGenresList(){
		$sql ='SELECT `genre` FROM genre_list ORDER BY `genre` ASC ';
		return $this->exec($sql);
	}

}



?>
