<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

/******************************************************************************
 * UserAddress represents a single address attached to a library user.  
 *
 * @author Kieren Eaton <circledev@gmail.com>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
 
class UserAddress 
{
	protected $_addressid;
	protected $_typeid;
	protected $_userid;
	protected $_address;
	protected $_city;
	protected $_state;
	protected $_postcode;
	protected $_country;
	protected $_phone;
	protected $_contactName;
	protected $_contactAltPhone;
	protected $_comments;
	protected $_lastUpdated;

	function __construct() 
	{
		$this->_addressid = 0;
  		$this->_typeid = 0;
  		$this->_userid = 0;
  		$this->_address = '';
		$this->_city = '';
		$this->_state = '';
		$this->_postcode = '';
		$this->_country = '';
		$this->_phone = '';
		$this->_contactName = '';
		$this->_contactAltPhone = '';
		$this->_comments = '';
		$this->_lastUpdated = time();

	}

   	/****************************************************************************
   	* Getter methods for all fields
   	* @return mixed
   	* @access public
   	****************************************************************************
   	*/
   	function getAddressId() {
		return $this->_addressid;
	}
   	function getTypeId() {
		return $this->_typeid;
	}
	function getUserId() {
		return $this->_userid;
	}
	function getAddress() {
		return $this->_address;
	}
	function getCity(){
		return $this->_city;
	}
	function getState() {
		return $this->_state;
	}
	function getPostCode() {
		return $this->_postcode;
	}
	function getCountry() {
    	return $this->_country;
	}
	function getPhone() {
    	return $this->_phone;
	}
	function getContactName() {
    	return $this->_contactName;
	}
	function getContactAltPhone() {
    	return $this->_contactAltPhone;
	}
	function getComments() {
    	return $this->_comments;
	}
	function getLastUpdated() {
    	return $this->_lastUpdated;
	}
	
	
  	/****************************************************************************
   	* Setter methods for all fields
   	* @param string $value new value to set
   	* @return void
   	* @access public
   	****************************************************************************
   	*/
   	function setAddressId($value) {
    	if($value!=null) // User Id cannot be null
			{$this->_addressid = (int)$value;}
	}
   	function setTypeId($value) {
    	if($value!=null) // User Id cannot be null
			{$this->_typeid = (int)$value;}
	}
	function setUserId($value) {
    	if($value!=null) // User Id cannot be null
			{$this->_userid = (int)$value;}
	}
	function setAddress($value) {
    	$this->_address=$value;
	}
	function setCity($value) {
		$this->_city=$value;
	}
	function setState($value) {
    	$this->_state=$value;
	}
	function setPostCode($value) {
    	$this->_postcode=$value;
	}
	function setCountry($value) {
    	$this->_country=$value;
	}
	function setPhone($value) {
    	$this->_phone=$value;
	}
	function setContactName($value) {
    	$this->_contactName=$value;
	}
	function setContactAltPhone($value) {
    	$this->_contactAltPhone=$value;
	}
	function setComments($value) {
    	$this->_comments=$value;
	}
	function setLastUpdated($value) {
    	$this->_lastUpdated=($value);
	}
	
}

?>
