<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
/******************************************************************************
 * Dm represents a domain table row.
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class Dm {
  protected $_code;
  protected $_description;
  protected $_defaultFlg;
  protected $_imageFile;
  protected $_shouldRecommend;
  protected $_count;

	function __construct()
	{
		$this->_code = "";
		$this->_description = "";
		$this->_descriptionError = "";
		$this->_defaultFlg = false;
		$this->_imageFile = "";
		$this->_shouldRecommend = false;
		$this->_count = 0;
	}

  /****************************************************************************
   * Getter methods for all fields
   * @return string
   * @access public
   ****************************************************************************
   */
  function getCode() {
    return $this->_code;
  }
  function getDescription() {
    return $this->_description;
  }

  function getDefaultFlg() {
    return (bool)$this->_defaultFlg;
  }
  function getImageFile() {
    return $this->_imageFile;
  }
  function getShouldRecommend() {
    return $this->_shouldRecommend;
  }
  function getCount() {
    return $this->_count;
  }

  /****************************************************************************
   * Generic setter method for numeric fields. Ensures the value set is trimmed,
   * and defaulting to 0 if an empty field is passed.
   *
   * @param string $valueToSet New value to set
   * @param string $destinationField The destination field
   *
   * @return void
   * @access private
   ****************************************************************************
   */
  function _setNumeric(&$valueToSet, &$destinationField) {
    if (trim($valueToSet) == "") {
      $destinationField = "0";
    } else {
      $destinationField = trim($valueToSet);
    }
  }

  /****************************************************************************
   * Setter methods for all fields
   * @param string $value new value to set
   * @return void
   * @access public
   ****************************************************************************
   */
  function setCode($value) {
    $this->_code = $value;
  }
  function setDescription($value) {
    $this->_description = trim($value);
  }
  function setDescriptionError($value) {
    $this->_descriptionError = trim($value);
  }
  function setDefaultFlg($value) {
    $this->_defaultFlg = (bool)$value;
  }
  function setImageFile($value) {
    $temp = trim($value);
    $fileloc = "../images/$temp";
    if (($temp == "") or (!file_exists($fileloc))) {
      $this->_imageFile = "shim.gif";
    } else {
      $this->_imageFile = $temp;
    }
  }
  function setShouldRecommend($value) 
  {
    $this->_shouldRecommend = (bool)$value;
  }
  function setCount($value) {
    $this->_setNumeric($value, $this->_count);
  }
}
