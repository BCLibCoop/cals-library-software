<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  //require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/formatFuncs.php");

/******************************************************************************
 * Device represents a digital storage device .  Contains business rules for
 * device validation.
 *
 * @author Kieren Eaton <circledev@gmail.com>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class Device
{
	protected $_deviceId;
  	protected $_userId;
  	protected $_userFullname;
  	protected $_vendorCode;
	protected $_productCode;
	protected $_enclosureId;
	protected $_serialNumber;
	protected $_mountPoint;
	protected $_validated;


	function __construct() 
	{
		$this->_deviceId= 0;
  		$this->_userId = 0;
  	 	$this->_userFullname = '';
  	 	$this->_vendorCode = '';
	 	$this->_productCode = '';
	 	$this->_enclosureId = '';
	 	$this->_serialNumber = '';
	 	$this->_mountPoint = '';
	 	$this->_validated = false;
	}
   	/****************************************************************************
   	* Getter methods for all fields
   	* @return string
   	* @access public
   	****************************************************************************
   	*/
   	function getDeviceId() {
		return $this->_deviceId;
	}
	function getUserId() {
		return $this->_userId;
	}
	function getUserFullname() {
		return $this->_userFullname;
	}
	function getVendorCode() {
		return $this->_vendorCode;
	}
	function getProductCode(){
		return $this->_productCode;
	}
	function getEnclosureId(){
		return $this->_enclosureId;
	}
	function getSerialNumber() {
		return $this->_serialNumber;
	}
	function getMountPoint() {
		return $this->_mountPoint;
	}
	
	function getValidated() {
		return $this->_validated;
	}
	
	/****************************************************************************
   	* Setter methods for all fields
   	* @param string $value new value to set
   	* @return void
   	* @access public
   	*****************************************************************************/
	
	function setDeviceId($value) {
    	$this->_deviceId = (int)trim($value);
	}
	function setUserId($value) {
    	$this->_userId = $value;
	}
	function setUserFullname($value) {
    	$this->_userFullname = trim($value);
	}
	function setVendorCode($value) {
		if($value!=null) // Vendor Id cannot be null
			{$this->_vendorCode = trim($value);}
	}
	function setProductCode($value) {
    	if($value!=null) // Product Id cannot be null
			{$this->_productCode = trim($value);}
	}
	function setEnclosureId($value) {
    	$this->_enclosureId = trim($value);
	}
	function setSerialNumber($value) {
    	if($value!=null) // Serial Number cannot be null
			{$this->_serialNumber = $value;}
	}
	function setMountPoint($value) {
    	if($value!=null) // Mount Point cannot be null
			{$this->_mountPoint = $value;}
	}
	
	function setValidated($isValid) {
		$this->_validated = (BOOL)$isValid;
	}
}
