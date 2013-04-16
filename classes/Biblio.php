<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."BiblioField.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/marcFuncs.php");


/******************************************************************************
 * Biblio represents a library bibliography record.  Contains business rules for
 * bibliography data validation.
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class Biblio {
  protected $_bibid;
  protected $_createDt;
  protected $_lastChangeDt;
  protected $_lastChangeUserid;
  protected $_lastChangeUsername;
  protected $_materialCd;
  protected $_collectionCd;
  protected $_callNmbr1;
  protected $_callNmbr2;
  protected $_callNmbr3;
  protected $_biblioFields;
  protected $_opacFlg;
  protected $_restrictedFlg;
  protected $_saleableFlg;
  protected $_audienceCd;

	function __construct()
	{
		$this->_bibid = 0;
   		$this->_createDt = '';
   		$this->_lastChangeDt = '';
   		$this->_lastChangeUserid = '';
   		$this->_lastChangeUsername = '';
   		$this->_materialCd = 0;
   		$this->_collectionCd = 0;
		$this->_callNmbr1 = '';
   		$this->_callNmbr2 = '';
   		$this->_callNmbr3 = '';
   		$this->_biblioFields = array();
   		$this->_opacFlg = true;
   		$this->_restrictedFlg = true; // default entry state
   		$this->_saleableFlg = false; // add for checking ability to onsell created books 
		$this->_audienceCd = 1; // default intended audience/reading level is adult
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
  function getCreateDt() {
    return $this->_createDt;
  }
  function getLastChangeDt() {
    return $this->_lastChangeDt;
  }
  function getLastChangeUserid() {
    return $this->_lastChangeUserid;
  }
  function getLastChangeUsername() {
    return $this->_lastChangeUsername;
  }
  function getMaterialCd() {
    return $this->_materialCd;
  }
  function getCollectionCd() {
    return $this->_collectionCd;
  }
  function getCallNmbr1() {
    return $this->_callNmbr1;
  }
  function getCallNmbr2() {
    return $this->_callNmbr2;
  }
  function getCallNmbr3() {
    return $this->_callNmbr3;
  }
  function getBiblioFields() {
    return $this->_biblioFields;
  }
  function showInOpac() {
    return $this->_opacFlg;
  }
   function getIsRestricted() {
    return $this->_restrictedFlg;
  }
   function getIsSaleable() {
    return $this->_saleableFlg;
  }
   function getAudienceCd() {
    return $this->_audienceCd;
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
  function setCreateDt($value) {
    $this->_createDt = trim($value);
  }
  function setLastChangeDt($value) {
    $this->_lastChangeDt = trim($value);
  }
  function setLastChangeUserid($value) {
    $this->_lastChangeUserid = trim($value);
  }
  function setLastChangeUsername($value) {
    $this->_lastChangeUsername = trim($value);
  }
  function setMaterialCd($value) {
    $this->_materialCd = trim($value);
  }
  function setCollectionCd($value) {
    $this->_collectionCd = trim($value);
  }
  function setCallNmbr1($value) {
    $this->_callNmbr1 = trim($value);
  }
  function setCallNmbr2($value) {
    $this->_callNmbr2 = trim($value);
  }
  function setCallNmbr3($value) {
    $this->_callNmbr3 = trim($value);
  }
  function setOpacFlg($flag) {
  	$this->_opacFlg = (bool)$flag;
  }
  
  	function setIsRestricted($value) {
    	$this->_restrictedFlg = (BOOL)$value;
  	}
  	function setIsSaleable($value) {
    	$this->_saleableFlg = (BOOL)$value;
  	}
  	function setAudienceCd($value) {
    	$this->_audienceCd = trim($value);
  	}
	
	function addField($field,$tagIdx=null){
  		if(!isset($field)){return;}
  		
  		if(isset($tagIdx)) // check if the tag has been generated already
  			goto DO_ADD;
  		  		
  		$tagIdx = makeCompositeTag($field->getTag(),$field->getSubfieldCd(),$this->_biblioFields);
  		   	
     	DO_ADD:
      	$this->_biblioFields[$tagIdx] = $field;
  	}
  	function updateField($field,$tagIdx=null){
  		if(!isset($field)) return;
  		if((!isset($tagIdx)) && ($field->getTag() == "") && ($field->getSubfieldCd() == "")) return;
  		if(!isset($tagIdx))
  			$tagIdx = makeCompositeTag($field->getTag(),$field->getSubfieldCd(),$this->_biblioFields);
  		
  		$this->addField($field,$tagIdx);
  	}

}
