<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/formatFuncs.php");

/******************************************************************************
 * UserAddress represents a single address attached to a library user.  
 *
 * @author Kieren Eaton <circledev@gmail.com>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class UserProfile
{
  	protected $_profileid;
  	protected $_typeid;
  	protected $_userid;
  	protected $_content;
	protected $_language;
	protected $_preferred;
	protected $_allocation;

	function __construct() 
	{
		$this->_profileid = 0;
  		$this->_typeid = 0;
  		$this->_userid = 0;
  		$this->_content = '';
		$this->_language = 'eng';
		$this->_preferred = true;
		$this->_allocation = 1;


	}
	
	function profileFromPostVars($vars)
	{
		$this->setProfileId((isset($vars['profid']))?$vars['profid']:$this->getProfileId());
		$this->setTypeId((isset($vars['ptypeid']))?$vars['ptypeid']:$this->getTypeId());
		$this->setUserId((isset($vars['userid']))?$vars['userid']:$this->getUserId());
		$this->setContent((isset($vars['pcont']))?$vars['pcont']:$this->getContent());
		$this->setLanguage((isset($vars['plang']))?$vars['plang']:$this->getLanguage());
		$this->setPreferred((isset($vars['ppref']))?$vars['ppref']:$this->getPreferred());
		$this->setAllocation((isset($vars['palloc']))?$vars['palloc']:$this->getAllocation());
	
		return $this;
	}


   	/****************************************************************************
   	* Getter methods for all fields
   	* @return mixed
   	* @access public
   	****************************************************************************
   	*/
   	function getProfileId() {
		return $this->_profileid;
	}
   	function getTypeId() {
		return $this->_typeid;
	}
	function getUserId() {
		return $this->_userid;
	}
	function getContent() {
		return $this->_content;
	}
	function getLanguage(){
		return $this->_language;
	}
	function getPreferred() {
		return $this->_preferred;
	}
	function getAllocation() {
		return $this->_allocation;
	}
	
  	/****************************************************************************
   	* Setter methods for all fields
   	* @param string $value new value to set
   	* @return void
   	* @access public
   	****************************************************************************
   	*/
   	function setProfileId($value) {
    	if($value!=null) // User Id cannot be null
			{$this->_profileid = (int)$value;}
	}
   	function setTypeId($value) {
    	if($value!=null) // User Id cannot be null
			{$this->_typeid = (int)$value;}
	}
	function setUserId($value) {
    	if($value!=null) // User Id cannot be null
			{$this->_userid = (int)$value;}
	}
	function setContent($value) {
    	$this->_content=trim($value);
	}
	function setLanguage($value) {
		$this->_language=trim($value);
	}
	function setPreferred($value) {
    	$this->_preferred=$value;
	}
	function setAllocation($value) {
    	$this->_allocation=$value;
	}
}

