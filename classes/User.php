<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  	require_once(str_replace('//','/',dirname(__FILE__).'/').'../functions/formatFuncs.php');
	require_once (str_replace('//','/',dirname(__FILE__).'/').'../classes/UserPrefs.php');
/******************************************************************************
 * User represents a library user.  Contains business rules for
 * user data validation.
 * - Based on the Member class by Dave Stevens from OpenBiblio 0.6
 * 
 * @author Kieren Eaton <circledev@gmail.com>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class User 
{
  	protected $_userId;
  	protected $_username;
  	protected $_jadeId;
  	protected $_birthDate;
	protected $_passwd;
	protected $_firstname;
	protected $_surname;
   	protected $_titleId;
   	protected $_title;
	protected $_phoneMobile;
	protected $_email;
	protected $_classification; 
	protected $_autoRecommend;
	protected $_createDate;
	protected $_lastChangeDate; 
  	protected $_changedByStaffId;
  	protected $_readingLevel;
	protected $_statusId;
	protected $_comments;
	
	function __construct() 
	{
		$this->_userId = '';
		$this->_username = '';
		$this->_jadeId = '';
		$this->_birthDate = '';
		$this->_passwd = '';
		$this->_firstname = '';
		$this->_surname = '';
		$this->_titleId = 0; // Default = Unknown
		$this->_title = '';
		$this->_phoneMobile = '';
		$this->_email = '';
		$this->_classification = 1; // 1 from the user_classify_dm table
		$this->_autoRecommend = false;
		$this->_createDate = null; // timestamp used for reference purposes only
		$this->_lastChangeDate = time(); // timestamp used for reference purposes only
		$this->_changedByStaffId = 0; // default
		$this->_readingLevel = 1; // default == Adult from the audience_dm table
		$this->_statusId = 1; // 1 == Active from the user_status_type_dm table
		$this->_comments = '';
	}
	
	function validatePasswords($newPasswd1=null,$newPasswd2=null)
	{
		$isValid = false;
		if(($newPasswd1 == null ) || ($newPasswd2 == null)) {
			$this->_passwdError='One or both of the passwords is empty';
			goto BAIL;
		}
			
		if(md5($newPasswd1) != md5($newPasswd2)){
			$this->_passwdError = 'Passwords do not match';
			goto BAIL;
		}
		
		$isValid = true;

	BAIL:
		return $isValid;
	}

  
   	/****************************************************************************
   	* Getter methods for all fields
   	* @return string
   	* @access public
   	****************************************************************************
   	*/
	function getUserId() {
		return $this->_userId;
	}
	function getUsername() {
		return $this->_username;
	}
	function getBirthDate() {
		return $this->_birthDate;
	}
	function getJadeId(){
		return $this->_jadeId;
	}
	function getPassword() {
		return $this->_passwd;
	}
	function getSurname() {
    	return $this->_surname;
	}
	function getFirstname() {
    	return $this->_firstname;
	}
	function getFirstSurname() {
    	return $this->_firstname.' '.$this->_surname;
	}
	function getSurnameFirstname() {
    	return $this->_surname.','.$this->_firstname;
	}
	function getFullName() {
		$name = $this->getFirstSurname();
		if($this->getTitle()!='')
			{$name = $this->getTitle().' '.$name;}
		return $name;
	}
	function getTitleId() {
		return $this->_titleId;
	}
	function getTitle() {
		return $this->_title;
	}
	function getMobilePhone() {
		return $this->_phoneMobile;
	}
	function getEmail() {
    	return $this->_email;
	}
	function getClassification() {
    	return $this->_classification;
	}
	function getCreateDate() {
    	return $this->_createDate;
	}
	function getLastChangeDate() {
    	return $this->_lastChangeDate;
	}
	function getChangedByStaffId() {
    	return $this->_changedByStaffId;
	}
	function getReadingLevelId() {
    	return $this->_readingLevel;
	}
	function getStatusId() {
		return $this->_statusId;
	}
	function getAutoRecommend() {
    	return $this->_autoRecommend;
	}

	function getComments() {
    	return $this->_comments;
	}
	
  	
  	/****************************************************************************
   	* Setter methods for all fields
   	* @param string $value new value to set
   	* @return void
   	* @access public
   	****************************************************************************
   	*/
	function setUserId($value) {
		if($value!=null) {
			$this->_userId = (int)trim($value);
			//$this->getPrefs()->setUserId($this->getUserId());
			
		}
	}
	function setUsername($value) {
		if($value!=null) {
			$this->_username = trim($value);		
		}
	}
	function setBirthDate($value) {
			$this->_birthDate = $value;
	}
	function setJadeId($value) {
    	$this->_jadeId = trim($value);
	}
	function setPassword($value){
		if($value!=null)
    		{$this->_passwd = md5(md5(trim($value)));}
	}
	function setSurname($value) {
    	if($value!=null)
    		{$this->_surname = trim($value);}
	}
	function setFirstname($value) {
    	if($value!=null)
    		{$this->_firstname = trim($value);}
	}
	function setTitleId($value){
		$this->_titleId = (int)$value;
	}
	function setTitle($value){
		$this->_title = trim($value);
	}

  	function setMobilePhone($value) {
    	$this->_phoneMobile = trim($value);
  	}
  	function setEmail($value) {
    		$this->_email = trim($value);
  	}
  	function setClassification($value) {
    	if(($value!=null) && ($value != 0) ) // there is no row 0 for the user_classify_dm 
    		{$this->_classification = (int)$value;}
  	}
  	function setCreateDate($value) {
    	if(($value!=null)&&($value!=0) )
    		{$this->_createDate = trim($value);}
  	}

  	function setLastChangeDate($value) {
    	if(($value!=null)&&($value!=0))
    		{$this->_lastChangeDate = trim($value);}
  	}
  	function setChangedByStaffId($value) {
    	if(($value!=null)&&($value!=0))
    		{$this->_changedByStaffId = (int)$value;}
  	}
  	function setStatusId($value) {
    	$this->_statusId = $value;	
	}
	function setAutoRecommend($value) {
    		$this->_autoRecommend = $value;
  	}
  	function setComments($value) {
    	$this->_comments = trim($value);
  	}
	function setReadingLevelId($value) {
    		$this->_readingLevel = (int)$value;
  	}
}

