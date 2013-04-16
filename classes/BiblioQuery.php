<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */


 	require_once(str_replace('//','/',dirname(__FILE__).'/').'../classes/ezQuery.php');
 	require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/marcFuncs.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/stringFuncs.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Biblio.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioField.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioFieldQuery.php");

/******************************************************************************
 * BiblioQuery data access component for library bibliographies
 *
 * @author Kieren Eaton <circledev@gmail.com>
 * Based on BiblioQuery by David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */

class BiblioQuery extends ezQuery {
  	protected $_fieldsInBiblio;

	function __construct()
	{
		parent::__construct();
    	$this->_fieldsInBiblio = array(
    	  '100a' => 'author',
    	  '245a' => 'title',
    	  '245b' => 'title_remainder',
    	  '245c' => 'responsibility_stmt',
    	  '650a' => 'topic1',
    	  '650a-1' => 'topic2',
    	  '650a-2' => 'topic3',
    	  '650a-3' => 'topic4',
    	  '650a-4' => 'topic5',
    	);
	}

	function catalogEntriesWithCriteria($type=null,$content=null,$userid=null,$showAll=false)
	{
		if(!isset($type) || !isset($content)) return false;

		$includeNarr=false;
		if(is_array($type))
		{
			// extract any options passed for the type
			$includeNarr = ((isset($type['options']['n'])) && ($type['options']['n']==1));
		}
		$type=$type[0];

		//sd($type,$content);

/*
select SQL_NO_CACHE b.`bibid`, b.`title` AS `title`, b.`author`, fd.`field_data` snum
FROM biblio b
join (select si.bibid from `search_index` si join `wordlist` wl on si.`wordid`=wl.`wordid` and (wl.word like 'alic%') where si.`searchid`=1) si0 on si0.bibid=b.bibid
join (select si.bibid from `search_index` si join `wordlist` wl on si.`wordid`=wl.`wordid` and (wl.word like 'town%') where si.`searchid`=1) si1 on si1.bibid=b.bibid
join (select bfd.`field_data`,bf.bibid from `biblio_field` bf join `biblio_field_data` bfd on bf.`fieldid`=bfd.`fieldid` and bf.tag=35 and bf.`subfield_cd`='a') fd on b.`bibid`=fd.bibid
#where b.`opac_flg`=1
order by b.title;
*/

		$sqlBasePt1 = "SELECT SQL_NO_CACHE b.`bibid`, b.`title` AS `title`, b.`author`, fd.`field_data` snum FROM ";

		$sqlBasePt2General = "`biblio` b ";
		$sqlBasePt2User = "`biblio_copy` bc JOIN `biblio` b on bc.`bibid`=b.`bibid` AND bc.`formatid`=1 ";

		$sqlBasePt2 = "JOIN (SELECT bfd.`field_data`,bf.`bibid` FROM `biblio_field` bf JOIN `biblio_field_data` bfd ON bf.`fieldid`=bfd.`fieldid` AND bf.`tag`=35 AND bf.`subfield_cd`='a') fd on b.`bibid`=fd.bibid ";
		//$sqlBasePt2 ="JOIN `biblio_field` bf ON b.`bibid`=bf.`bibid` AND bf.`tag`=35 ";
		//$sqlBasePt2 .= "JOIN `biblio_field_data` bfd on bf.`fieldid`=bfd.`fieldid` ";
		//$sqlBasePt2 .= "WHERE si.`bibid`=b.`bibid` ";


		$sqlCrit = "JOIN (SELECT si.`bibid` FROM `search_index` si JOIN `wordlist` wl on si.`wordid`=wl.`wordid` AND wl.`word` LIKE '%q%%' WHERE si.`searchid`=%N) si%N ON si%N.`bibid`=b.`bibid` ";
		//$sqlCritPrefix = "(SELECT si0.`bibid` FROM `search_index` si0 ";
		//$sqlCritJoin = "JOIN `search_index` si%N ON si0.`bibid`=si%N.`bibid` ";

		//$sqlCritContent = 	"AND si%N.wordid in (select wordid from wordlist where `word` LIKE '%q%%') ";
		//$sqlCritSuffix = " ) si ";
		$sqlUserCrit = "AND (b.`bibid` NOT IN (SELECT `bibid` FROM `download_hist` WHERE `userid`=%N)) ";
		$sqlUserCrit .= "AND (b.`bibid` NOT IN (SELECT `bibid` FROM `user_requests` WHERE `userid`=%N)) ";
		$sqlUserCrit .= "AND (b.`material_cd` IN (SELECT `code` FROM `material_type_dm` WHERE `recommend_flg`=1)) ";
		$sqlSuffix = "ORDER by b.`title` ";

		$words = null;
		$searchId = 0;
		switch ($type)
		{
			case 't': // title
				$searchId = 1;
				$words = explodeStr($content,false,false);
			break;
			case 'a': // Author
				$searchId=2;
				$words = explodeStr($content,false,false,null,2); //explode(" ",$content);
			break;
			case 'g': // subject/Genre
				$searchId=3;
				$words = explodeStr($content,true,true);
			break;
			case 's': // System Number
				$searchId=5;
				$sqlSuffix = "GROUP BY b.`bibid` ORDER by `snum` ";
				$words = explode(" ",$content);
			break;
		}

		if (empty($words))
			return false;
		$first = true;
		$crit =''; //$this->mkSQL('where si0.`searchid`=%N ',$searchId);
		$join = '';

		//sd($words,$searchId);
		while (list($idx,$aWord) = each($words))
		{
			//s($idx,$aWord,$searchId);
			//$join .= ($idx>0)?$this->mkSQL($sqlCritJoin,$idx,$idx):'';
			$crit .= $this->mkSQL($sqlCrit,$aWord,$searchId,$idx,$idx);
			//$first = false;
		}

		$sql = $sqlBasePt1;
		$sql .= (isset($userid))?$sqlBasePt2User:$sqlBasePt2General;
		$sql .= $crit.$sqlBasePt2;

		if((isset($userid)) && (!$showAll))
		{
			$sql .= $this->mkSQL($sqlUserCrit,$userid,$userid);
		}

		$sql .= $sqlSuffix;

		//echo $sql;exit;
		$res = $this->get_results($sql);
		return (count($res))?$res:false;

	}

	function getQuickBookList($userid=NULL,$format=1,$content=1) {
    # setting query that will return all the data

   	$queryStr = 'SELECT title,author,concat(topic1,topic2,topic3,topic4,topic5) AS subject, field_data AS snumber, ';
	$queryStr .= 'b.bibid AS catid FROM biblio b, biblio_copy bc, biblio_field bf, biblio_field_data bfd WHERE (b.bibid=bc.bibid) AND ';
	$queryStr .= '(bc.bibid=bf.bibid) AND (tag=35 AND subfield_cd=\'a\') AND (bf.fieldid=bfd.fieldid) AND (formatid='.$format.' AND contentid='.$content.')  ';
	if($userid != NULL)
	{
		$queryStr .= 'AND (b.bibid NOT IN (SELECT bibid FROM download_hist WHERE userid=\''.$userid.'\')) ';
	}
	$queryStr .= ' group by b.bibid ORDER BY title ';

	//echo $queryStr;exit;

	$rows = $this->exec($queryStr);
    if (count($rows) == 0) {
      		Fatal::internalError("No books found!");
    }

	return $rows;

  }

  	function getNextSysNumber()
  	{
  		$prefix = 'S'; // !TODO: change this prefix to a library setting
  		$maxQry = "SELECT CONCAT(%Q,MAX(SUBSTRING(bfd.`field_data`,2,LENGTH(bfd.`field_data`)-1))+1) `next` FROM `biblio_field` bf, `biblio_field_data` bfd ";
  		$maxQry .= "WHERE (bf.`tag`=35 AND bf.`subfield_cd`='a' AND bf.`fieldid`=bfd.`fieldid`) ";
  		$maxQry .= "AND (UPPER(SUBSTRING(bfd.`field_data`,1,1))=%Q) AND (SUBSTRING(bfd.`field_data`,2,1)>0) ";
  		$maxQry = $this->mkSQL($maxQry,$prefix,$prefix);
  		return $this->get_var($maxQry);
  	}

  function setItemsPerPage($value) {
    $this->_itemsPerPage = $value;
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
   * @param string $bibid bibid of bibliography to select
   * @return Biblio a bibliography object or false if error occurs
   * @access public
   ****************************************************************************
   */

  function getEntry($bibid,$getAllFields=true,$requiredFields=array()) {

    /***********************************************************
     *  Reading biblio data
     ***********************************************************/
    # setting query that will return all the data in biblio
    $sql = $this->mkSQL("SELECT b.*, s.`username` FROM `biblio` b, `staff` s WHERE b.`last_change_staffid`=s.`staffid` AND b.`bibid` =%N", $bibid);

    $res = $this->get_results($sql);
	if (!isset($res))
    	return false;
    $res=$res[0];

    $bib = new Biblio();
    $bib->setBibid($res->bibid);
    $bib->setCreateDt($res->create_dt);
    $bib->setLastChangeDt($res->last_change_dt);
    $bib->setLastChangeUserid($res->last_change_staffid);
    $bib->setLastChangeUsername(isset($res->username)?$res->username:'');
    $bib->setMaterialCd($res->material_cd);
    $bib->setCollectionCd($res->collection_cd);
    $bib->setAudienceCd($res->audience_cd);
    $bib->setCallNmbr1($res->call_nmbr1);
    $bib->setCallNmbr2($res->call_nmbr2);
    $bib->setCallNmbr3($res->call_nmbr3);
    $bib->setOpacFlg($res->opac_flg);
    $bib->setIsRestricted($res->restricted_flg);
	$bib->setisSaleable($res->saleable_flg);

	/***********************************************************
     *  Adding fields from biblio to Biblio object
     ***********************************************************/
	// first add the rows from the biblio record

	$field = new BiblioField();
	$field->setTag('245');
	$field->setSubfieldCd('a');
	$field->setFieldData($res->title);
	$field->setIsRequired(isset($requiredFields['245a']));
	$bib->addField($field);
	$field = new BiblioField();
	$field->setTag('245');
	$field->setSubfieldCd('b');
	$field->setFieldData($res->title_remainder);
	$field->setIsRequired(isset($requiredFields['245b']));
	$bib->addField($field);
	$field = new BiblioField();
	$field->setTag('245');
	$field->setSubfieldCd('c');
	$field->setFieldData($res->responsibility_stmt);
	$field->setIsRequired(isset($requiredFields['245c']));
	$bib->addField($field);
	$field = new BiblioField();
	$field->setTag('100');
	$field->setSubfieldCd('a');
	$field->setFieldData($res->author);
	$field->setIsRequired(isset($requiredFields['100a']));
	$bib->addField($field);
	$field = new BiblioField();
	$field->setTag('650');
	$field->setSubfieldCd('a');
	$field->setFieldData($res->topic1);
	$field->setIsRequired(isset($requiredFields['650a']));
	$bib->addField($field);
	$field = new BiblioField();
	$field->setTag('650');
	$field->setSubfieldCd('a');
	$field->setFieldData($res->topic2);
	$field->setIsRequired(isset($requiredFields['650a']));
	$bib->addField($field);
	$field = new BiblioField();
	$field->setTag('650');
	$field->setSubfieldCd('a');
	$field->setFieldData($res->topic3);
	$field->setIsRequired(isset($requiredFields['650a']));
	$bib->addField($field);
	$field = new BiblioField();
	$field->setTag('650');
	$field->setSubfieldCd('a');
	$field->setFieldData($res->topic4);
	$field->setIsRequired(isset($requiredFields['650a']));
	$bib->addField($field);
	$field = new BiblioField();
	$field->setTag('650');
	$field->setSubfieldCd('a');
	$field->setFieldData($res->topic5);
	$field->setIsRequired(isset($requiredFields['650a']));
	$bib->addField($field);


	if($getAllFields)
	{
		require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioFieldQuery.php");
		// add the tag data rows
		$fldQry = new BiblioFieldQuery();
		$fields = $fldQry->getAllFields($bibid,$requiredFields);
		unset($fldQry);
		while(list($tagIdx,$aField) = each($fields))
		{
			$bib->addField($aField,$tagIdx);
		}
		unset($fields);
	}

    return $bib;
  }


  /****************************************************************************
   * Inserts new bibliography info into the biblio and biblio_field tables.
   * @param Biblio $biblio bibliography to insert
   * @return int returns bibid or false, if error occurs
   * @access public
   ****************************************************************************
   */
  /*###########################
    # WORKS WITH NEW FORMAT   #
    ###########################*/
  function insert($biblio) {
    // inserting biblio entry
    $biblioFlds = $biblio->getBiblioFields();
    $bibfields = array();	// remove the fields in biblio table from the fields array
    foreach ($this->_fieldsInBiblio as $key => $name)
    {
      if (isset($biblioFlds[$key])) {
        $bibfields[$name] = $biblioFlds[$key]->getFieldData();
        unset($biblioFlds[$key]);
      } else {
        $bibfields[$name] = '';
      }
    }

    $sql = $this->mkSQL("insert into biblio values(null, CURRENT_TIMESTAMP, null, "
                        . "%N, %N, %N, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, "
                        . "%Q, %Q, %Q, %Q, %Q, %N, %N, %N) ",
                        $biblio->getLastChangeUserid(),
                        $biblio->getMaterialCd(),
                        $biblio->getCollectionCd(),
                        $biblio->getCallNmbr1(),
                        $biblio->getCallNmbr2(),
                        $biblio->getCallNmbr3(),
                        $bibfields['title'],
                        $bibfields['title_remainder'],
                        $bibfields['responsibility_stmt'],
                        $bibfields['author'],
                        $bibfields['topic1'],
                        $bibfields['topic2'],
                        $bibfields['topic3'],
                        $bibfields['topic4'],
                        $bibfields['topic5'],
                        $biblio->showInOpac() ? "Y" : "N",
                        $biblio->getIsRestricted(),
                        $biblio->getIsSaleable(),
                        $biblio->getAudienceCd());

    if (($this->query($sql) === false)) {
      return false;
    }
	$bibid = $this->insert_id;
    # inserting biblio_field rows
    if (!($this->setFields($biblioFlds, $bibid))) {
      return false;
    }

    return $bibid;
  }

  /****************************************************************************
   * Updates a bibliography in the biblio table.
   * @param Biblio $biblio bibliography to update
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  /*###########################
    # WORKS WITH NEW FORMAT   #
    ###########################*/
  function update($biblio) {

    // updating biblio table
    $sql = $this->mkSQL("UPDATE `biblio` SET `last_change_staffid`=%N, "
					    . "`material_cd`=%N, `collection_cd`=%N, "
                        . "`call_nmbr1`=%Q, `call_nmbr2`=%Q, `call_nmbr3`=%Q, `restricted_flg`=%N, "
                        . "`saleable_flg`=%N, `audience_cd`=%N, "
                        . "`opac_flg`=%N, ",
                        $biblio->getLastChangeUserid(),
                        $biblio->getMaterialCd(), $biblio->getCollectionCd(),
                        $biblio->getCallNmbr1(), $biblio->getCallNmbr2(),
                        $biblio->getCallNmbr3(),
                        $biblio->getIsRestricted(),
                        $biblio->getIsSaleable(),
                        $biblio->getAudienceCd(),
                        $biblio->showInOpac());

    $biblioFlds = $biblio->getBiblioFields();
    $first = true;
    foreach ($this->_fieldsInBiblio as $key => $name)
    {
    	$sql .= (!$first)?", ":"";
      if (array_key_exists($key, $biblioFlds) and $biblioFlds[$key]->getFieldid() == '') {
        $sql .= $this->mkSQL("%I=%Q", $name, $biblioFlds[$key]->getFieldData());
        unset($biblioFlds[$key]);
      } else {
        $sql .= $this->mkSQL("%I=''", $name);
      }
      $first = false;
    }
    $sql .= $this->mkSQL(" WHERE `bibid`=%N ",$biblio->getBibid());

    if ($this->query($sql) === false) {
      return false;
    }

    // inserting (or updating) biblio_field rows from update Biblio object.
    if (!($this->setFields($biblioFlds, $biblio->getBibid()))) {
      return false;
    }

    return true;
  }

  /****************************************************************************
   * Inserts biblio_field rows
   * @param array reference $biblioFlds an array of BiblioField objects
   * @param int bibid id of bibliography to insert fields into
   * @return boolean returns false if error occurs
   * @access private
   ****************************************************************************
   */
  private function setFields(&$biblioFlds, $bibid) {

    $insFields = array();
    $updFields = array();
    $delFields = array();

    foreach ($biblioFlds as $tag => $field) {
    	// check the type of change the field should have
    	// ie insert/update/delete

    	$field->setBibid($bibid);
    	// insert -- has data but no fieldid or fieldid of 0 denoting a new field
    	if(($field->getFieldData()!='') && (($field->getFieldid()=='') || ($field->getFieldid()==0))) {
    		$insFields[]=$field;
    		continue;
    	}

    	// update -- has data and fieldid (thats not 0 which it might be if its a "New Like Entry")
    	if(($field->getFieldData()!='') && (($field->getFieldid()!='') && ($field->getFieldid()!=0))) {
    		$updFields[]=$field;
    		continue;
    	}

       	// delete -- has fieldid (and its not 0 which it might be if its a "New Like Entry") but no data
    	if(($field->getFieldData()=='') && (($field->getFieldid()!='') && ($field->getFieldid()!=0))) {
    		$delFields[]=$field;
    		continue;
    	}
    }

    $fieldsQry = new BiblioFieldQuery();

    $fieldsQry->insertBulk($insFields);
	$fieldsQry->updateBulk($updFields);
   	$fieldsQry->deleteBulk($delFields);

    return true;

  }

  /****************************************************************************
   * Deletes a bibliography from the biblio table.
   * @param string $bibid bibliography id of bibliography to delete
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function delete($bibid)
  {
  	// copies are not deleted here as they are deleted separately
    $sql = $this->mkSQL("DELETE b.*, bf.*, bfd.* FROM `biblio` b JOIN `biblio_field` bf ON b.`bibid`=bf.`bibid` JOIN `biblio_field_data` bfd ON bf.`fieldid`=bfd.`fieldid` WHERE b.`bibid`=%N ", $bibid);

    if ($this->query($sql) === null) {
      return false;
    }

    return true;
  }

}

