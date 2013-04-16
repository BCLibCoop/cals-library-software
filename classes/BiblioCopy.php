<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/formatFuncs.php");

/******************************************************************************
 * BiblioCopy represents a library bibliography copy record.  Contains business rules for
 * bibliography data validation.
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class BiblioCopy {
  protected $_biblioId;
  protected $_copyId;
  protected $_formatId;
  protected $_contentId;
  protected $_createDt;
  protected $_description;
  protected $_filePath;

	function __construct()
	{
  		$_biblioId = 0;
  		$_copyId = 0;
  		$_formatId = 1;
  		$_contentId = 1;
  		$_createDt = "";
  		$_description = "";
  		$_filePath = "";

	}

  /****************************************************************************
   * Getter methods for all fields
   * @return string
   * @access public
   ****************************************************************************
   */
  function getBiblioId() {
    return $this->_biblioId;
  }
  function getCopyId() {
    return $this->_copyId;
   }
 	function getFormatId(){
 		return $this->_formatId;
 	}
 	function getContentId(){
 		return $this->_contentId;
 	}
 
  function getCreateDt() {
    return $this->_createDt;
  }
  function getDescription() {
    return $this->_description;
  }
  function getFilePath() {
    return $this->_filePath;
  }


  /****************************************************************************
   * Setter methods for all fields
   * @param string $value new value to set
   * @return void
   * @access public
   ****************************************************************************
   */
  function setBiblioId($value) {
    $this->_biblioId = trim($value);
  }
  function setCopyId($value) {
    $this->_copyId = trim($value);
  }
  function setFormatId($value) {
    $this->_formatId = (int)trim($value);
  }
  function setContentId($value) {
    $this->_contentId = (int)trim($value);
  }
  function setCreateDt($value) {
    $this->_createDt = trim($value);
  }
  function setDescription($value) {
    $this->_description = trim($value);
  }
  function setFilePath($value) {
  $this->_filePath = (trim($value));  
  }
  
}
