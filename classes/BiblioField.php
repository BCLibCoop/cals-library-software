<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");

/******************************************************************************
 * UsmarcField represents a library bibliography subfield.  Contains business rules for
 * subfield data validation.
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class BiblioField {
   protected $_bibid;
   protected $_fieldid;
   protected $_tag;
   protected $_ind1Cd;
   protected $_ind2Cd;
   protected $_subfieldCd;
   protected $_fieldData;
   protected $_isRequired;
   protected $_isRepeatable;


	function __construct()
	{
		$this->_bibid = 0;
  		$this->_fieldid = 0;
  		$this->_tag = "";
  		$this->_ind1Cd = "";
  		$this->_ind2Cd = "";
  		$this->_subfieldCd = "";
  		$this->_fieldData = "";
  		$this->_isRequired = false;
  		$this->_isRepeatable = false;
	}

  /****************************************************************************
   * Getter methods for all fields
   * @return string
   * @access public
   ****************************************************************************
   */
  function getBibid() {
    return $this->_bibid;
  }
  function getFieldid() {
    return $this->_fieldid;
  }
  function getTag() {
    return $this->_tag;
  }
  function getInd1Cd() {
    return $this->_ind1Cd;
  }
  function getInd2Cd() {
    return $this->_ind2Cd;
  }
  function getSubfieldCd() {
    return $this->_subfieldCd;
  }
  function getFieldData() {
    return $this->_fieldData;
  }
  function getIsRequired() {
     return $this->_isRequired;
  }
  function getIsRepeatable() {
    return $this->_isRepeatable;
  }

  /****************************************************************************
   * Setter methods for all fields
   * @param string $value new value to set
   * @return void
   * @access public
   ****************************************************************************
   */
  function setBibid($value) {
    $this->_bibid = trim($value);
  }
  function setFieldid($value) {
    $this->_fieldid = trim($value);
  }
  function setTag($value) {
    $this->_tag = trim($value);
  }
  function setInd1Cd($value) {
    $this->_ind1Cd = $value;
  }
  function setInd2Cd($value) {
    $this->_ind2Cd = $value;
  }
  function setSubfieldCd($value) {
    $this->_subfieldCd = $value;
  }
  function setFieldData($value) {
    $this->_fieldData = trim($value);
  }
  function setIsRequired($value) {
   	$this->_isRequired = $value;
  }
  function setIsRepeatable($value) {
    $this->_isRepeatable = $value;
  }
  
}

