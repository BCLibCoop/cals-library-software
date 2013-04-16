<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/ezQuery.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/marcFuncs.php");

/******************************************************************************
 * BiblioFieldQuery data access component for library bibliography fields
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class BiblioFieldQuery extends ezQuery {
  var $_rowCount = 0;
  var $_loc;

	function __construct()
	{
		parent::__construct();
		require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioField.php");
	}

  /****************************************************************************
   * Executes a query to select ONLY ONE SUBFIELD
   * @param string $bibid bibid of bibliography copy to select
   * @param string $fieldid copyid of bibliography copy to select
   * @return BiblioField returns subfield or false, if error occurs
   * @access public
   ****************************************************************************
   */
  function getField($fieldid) {
    # setting query that will return all the data in biblio
    $sql = $this->mkSQL("select bf.*, bfd.`field_data` from `biblio_field` bf, `biblio_field_data` bfd where bf.`fieldid`=%N and bfd.`fieldid`=bf.`fieldid` ", $fieldid);
	$res = $this->get_results($sql);
    if (($res == null) || (empty($res)) )
      return false;

    return $this->_mkField($res[0]);
  }

  /****************************************************************************
   * Executes a query
   * @param string $bibid bibid of bibliography fields to select
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */

 function getAllFields($bibid, $requiredFields=array()) {
    # setting query that will return all the field data for a biblio id
    /*
$sql = $this->mkSQL("select bf.*, `field_data` "
                        . "from `biblio_field` bf, `biblio_field_data` bfd "
                        . "where bf.`bibid`=%N and bfd.`fieldid`=bf.`fieldid` "
                        . "order by `tag`, `subfield_cd` ",
                        $bibid);
*/

    $sql=$this->mkSQL('select bf.*, bfd.`field_data` from `biblio_field` bf '
    	. 'join `biblio_field_data` bfd on bfd.`fieldid`=bf.`fieldid` '
    	. 'where bf.`bibid`=%N '
    	. 'order by bf.`tag`, bf.`subfield_cd` ',$bibid);
    $res = $this->get_results($sql);
    if (($res == null) || (empty($res)) )
      return false;

    $fields = array();
	while(list(,$aField) = each($res))
	{
     	$thisField = $this->_mkField($aField);
     	$tag = makeCompositeTag($thisField->getTag(),$thisField->getSubfieldCd(),$fields);
     	$thisField->setIsRequired(isset($requiredFields[$tag]));
   		$fields[$tag]=$thisField;
    }

    return $fields;
  }
  /****************************************************************************
   * Creates a BiblioField object from a row passed in.
   * @return BiblioField
   * @access public
   ****************************************************************************
   */
  private function _mkField($aField) {
    $fld = new BiblioField();
    $fld->setBibid($aField->bibid);
    $fld->setFieldid($aField->fieldid);
    $fld->setTag($aField->tag);
    $fld->setInd1Cd($aField->ind1_cd);
    $fld->setInd2Cd($aField->ind2_cd);
    $fld->setSubfieldCd($aField->subfield_cd);
    $fld->setFieldData($aField->field_data);

    return $fld;
  }



  /****************************************************************************
   * Inserts new bibliography field into the biblio_field table.
   * @param BiblioField $field bibliography field to insert
   * @return boolean returns true if insert was successful or false, if error occurs
   * @access public
   ****************************************************************************
   */

	function insert($field) {
		# inserting biblio field row
		// add the reference data
    	$sql = $this->mkSQL("INSERT INTO `biblio_field` VALUES (NULL, %N, %N, %Q, %Q, %Q) ",
    						$field->getBibid(),
            	            $field->getTag(),
            	            $field->getInd1Cd(),
            	            $field->getInd2Cd(),
                	        $field->getSubfieldCd());

		$rowsAffected=$this->query($sql);
		if (($rowsAffected === false) || ($this->insert_id == 0))
			Fatal::internalError('Error Inserting field reference.');

		$fieldid = $this->insert_id;

		// add the actual data and reference it correctly
		$sql = $this->mkSQL("INSERT INTO `biblio_field_data` VALUES (%N, %Q) ",
							$fieldid,
							$field->getFieldData());
		$rowsAffected=$this->query($sql);
		if (($rowsAffected === false))
		{
			echo "fieldid-> ".$fieldid." data query-> ".$sql."<br/>";
			// failed to insert the data item so remove the reference to it
			$sql = $this->mkSQL("DELETE FROM `biblio_field` WHERE `fieldid`=%N",$fieldid);
			$this->query($sql);
			Fatal::internalError('Error Inserting field data.');

		}

    	return true;
    }

	function insertBulk($fields)
	{
		if((!isset($fields)) || (empty($fields))) return false;

		foreach($fields as $aFld)
		{
			$this->insert($aFld);
		}

		return true;
	}


  /****************************************************************************
   * Updates a bibliography field in the biblio_field table.
   * @param BiblioField $field bibliography field to insert
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  	function update($field) {
    	# updating biblio_field table
    	$sql = $this->mkSQL("UPDATE `biblio_field` bf, `biblio_field_data` bfd  SET bf.`tag`=%N, bf.`ind1_cd`=%Q, bf.`ind2_cd`=%Q, bf.`subfield_cd`=%Q, bfd.`field_data`=%Q WHERE bf.`fieldid`=bfd.`fieldid` AND bf.`fieldid`=%N ",
   							$field->getTag(), $field->getInd1Cd(),
                        	$field->getInd2Cd(), $field->getSubfieldCd(),
                        	$field->getFieldData(),$field->getFieldid());
        if($this->query($sql) === false)
        	 Fatal::internalError('Error updating field reference.');

    	return ($this->rows_affected);
  }

  function updateBulk($fields)
  {
  		if((!isset($fields)) || (empty($fields))) return false;

		foreach($fields as $aFld)
		{
			$this->update($aFld);
		}
  }

  /****************************************************************************
   * Deletes a bibliography field from the biblio_field table.
   * @param string $bibid bibliography id of bibliography field to delete
   * @param string $fieldid field id of bibliography field to delete
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
	function delete($field) {
    	$sql = $this->mkSQL("DELETE bf, bfd FROM `biblio_field` bf, `biblio_field_data` bfd WHERE bf.`fieldid`=%N AND bfd.`fieldid`=bf.`fieldid` ", $field->getFieldid());

	if($this->query($sql) === false )
        	 Fatal::internalError('Error deleting field.');

    return ($this->rows_affected);
  }

  	// delete an array of fields
  	function deleteBulk($fields)
  	{
    	if((!isset($fields)) || (empty($fields))) return false;

    	$sql = $this->mkSQL("DELETE bf, bfd FROM `biblio_field` bf, `biblio_field_data` bfd WHERE  bfd.`fieldid`=bf.`fieldid` AND  bf.`fieldid` IN ( ");

		$first = true;
		foreach($fields as $aFld)
		{
			$sql .= (!$first)?",":"";
			$sql .= $aFld->getFieldid();
			$first = false;
		}
		$sql .= ") ";

		if(($this->query($sql)) === false )
        	 Fatal::internalError('Error deleting fields.');

    	return $this->rows_affected;
  }

  /****************************************************************************
   * SmartyValidate Methods
   *
   *
   ****************************************************************************
   */
	function isUnique($value, $empty, &$params, &$formvars)
	{
		$sql = $this->mkSQL("SELECT count(*) FROM `biblio_field` bf, `biblio_field_data` bfd WHERE bf.`fieldid`=bfd.`fieldid` AND LOWER(bfd.`field_data`)=LOWER(%Q) AND bf.`tag`=%N AND bf.`subfield_cd`=%Q ",$value,$params["field2"],$params["field3"]);
		if (isset($params["field4"])) // optional bibid exclusion check
			$sql .= $this->mkSQL("AND bf.`bibid`<>%N ",$params["field4"]);
		$count = $this->get_var($sql);
		return (($count !== false) && ($count == 0 ))?true:false;
    }

}

