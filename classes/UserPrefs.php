<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

/******************************************************************************
 * UserPrefs represents the set of preferences a library user has.  
 *
 * @author Kieren Eaton <circledev@gmail.com>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class UserPrefs
{
  	protected $_userid;
  	protected $_contentSex;
	protected $_contentViolence;
	protected $_contentLanguage;
	protected $_narratorMale;
	protected $_narratorFemale;
	protected $_narratorSynth;
	protected $_booksShort;
	protected $_booksLong;
	protected $_authorMale;
	protected $_authorFemale;
	protected $_braille;
	protected $_booksPerDevice ;
	protected $_maxQueuedReqs;

	function __construct() {
		$this->_userid = '';
  	 	$this->_contentSex = true;
	 	$this->_contentViolence = true;
	 	$this->_contentLanguage = true;
	 	$this->_narratorMale = true;
	 	$this->_narratorFemale = true;
	 	$this->_narratorSynth = true;
	 	$this->_booksShort = true;
	 	$this->_booksLong = true;
	 	$this->_braille = false;
	 	$this->_booksPerDevice = 5;
	 	$this->_maxQueuedReqs = 40;
	}

   	/****************************************************************************
   	* Getter methods for all fields
   	* @return string
   	* @access public
   	****************************************************************************
   	*/
	function getUserId() {
		return $this->_userid;
	}
	function getContentSex() {
		return $this->_contentSex;
	}
	function getContentViolence(){
		return $this->_contentViolence;
	}
	function getContentLanguage() {
		return $this->_contentLanguage;
	}
	function getNarratorMale() {
		return $this->_narratorMale;
	}
	function getNarratorFemale() {
    	return $this->_narratorFemale;
	}
	function getNarratorSynth() {
    	return $this->_narratorSynth;
	}
	function getBooksShort() {
    	return $this->_booksShort;
	}
	function getBooksLong() {
    	return $this->_booksLong;
	}
	function getBraille() {
    	return $this->_braille;
	}
	function getBooksPerDevice() {
    	return $this->_booksPerDevice;
	}
	function getMaxQueuedReqs() {
    	return $this->_maxQueuedReqs;
	}
	
  	/****************************************************************************
   	* Setter methods for all fields
   	* @param string $value new value to set
   	* @return void
   	* @access public
   	****************************************************************************
   	*/
	function setUserId($value) {
    	if($value!=null) // User Id cannot be null
			{$this->_userid = $value;}
	}
	function setContentSex($value) {
    	$this->_contentSex=$value;
	}
	function setContentViolence($value) {
		$this->_contentViolence=$value;
	}
	function setContentLanguage($value) {
    	$this->_contentLanguage=$value;
	}
	function setNarratorMale($value) {
    	$this->_narratorMale=$value;
	}
	function setNarratorFemale($value) {
    	$this->_narratorFemale=$value;
	}
	function setNarratorSynth($value) {
    	$this->_narratorSynth=$value;
	}
	function setBooksShort($value) {
    	$this->_booksShort=$value;
	}
	function setBooksLong($value) {
    	$this->_booksLong=$value;
	}
	function setBraille($value) {
    	$this->_braille=$value;
	}
	function setBooksPerDevice($value) {
    	$this->_booksPerDevice=(int)$value;
	}
	function setMaxQueuedReqs($value) {
    	$this->_maxQueuedReqs=(int)$value;
	}
}

