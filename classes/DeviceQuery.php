<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once(__ROOT__.'classes/ezQuery.php');
require_once(str_replace('//','/',dirname(__FILE__).'/') ."Device.php");
require_once(str_replace('//','/',dirname(__FILE__).'/') ."../functions/arrayFuncs.php");
require_once(str_replace('//','/',dirname(__FILE__).'/') ."../functions/stringFuncs.php");

/******************************************************************************
 * DeviceQuery data access component for Storage devices 
 *
 * @author Kieren Eaton;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class DeviceQuery extends ezQuery {

	function findDevices($name=null,$barcode=null)
	{
		if((!isset($name) || !isset($barcode)) || ($name=="" || $barcode==""))
		$sql = "SELECT d.`deviceid` devid, d.`userid`, CONCAT(u.`firstname`,' ',u.`surname`) uname, d.`enc_barcode` barcd FROM `devices` d, `users` u WHERE d.`userid`=u.`userid` ";
		
		if(isset($name))
		{
			$name = trim($name);
			$names = explodeStr($name,false,false,null,2);
			if (count($names) == 1)
			    $sql .=  $this->mkSQL("AND CONCAT(u.`firstname`,' ',u.`surname`) LIKE '%%%q%%' ",$name);
			else
			{
			    $first = true;
			    foreach ($names as $partName)
			    {
			    	$sql .= (!$first)?" AND ":"AND (";
			    	$sql .= $this->mkSQL("(u.`firstname` LIKE '%%%q%%' OR u.`surname` LIKE '%%%q%%')",$partName,$partName);
			    	$first = false;
			    }
			    $sql .= ")";
			}
		}
		else // do barcode search
		{
			$sql .= $this->mkSQL("AND d.`enc_barcode` LIKE '%%%q%%' ",$barcode);
			$sql .= $this->mkSQL("UNION SELECT d.`deviceid` devid, d.`userid`, '' uname, d.`enc_barcode` barcd FROM `devices` d WHERE d.`enc_barcode` LIKE '%%%q%%' AND d.`userid`=0 ", $barcode);

		}
		$sql .= "ORDER BY `uname` ";

		return $this->get_results($sql);
			
	}
	
  /****************************************************************************
   * Executes a query to select ONLY ONE Device 
   * @param string $serial serial number of the device to select
   * @return lioField returns subfield or false, if error occurs
   * @access public
   ****************************************************************************
   */
  function doQuery($serial,$vendor=NULL,$product=NULL) {
    # query that will return the device for a given serial number
    
    $sql = $this->mkSQL("SELECT * FROM `devices` WHERE `serial`=%Q "
                        , $serial);

	$res = $this->get_results($sql);
    if (!isset($res)) return false;
    
    //$this->_rowCount = $this->rows_affected;
    return $this->fetchDevice($res);
  }

	function getDevice($id) {
    # query that will return the device for a given row id
    
    $sql = $this->mkSQL("SELECT d.* , CONCAT(u.`firstname`,' ',u.`surname`) uname FROM `devices` d, `users` u WHERE d.`deviceid`=%N AND d.`userid`=u.`userid` ", $id);
	$sql .= $this->mkSQL("UNION SELECT d.*,'' FROM `devices` d WHERE d.`deviceid`=%N and d.`userid`=0 ", $id);
    $res = $this->get_results($sql);
    if (!isset($res)) return false;
    return $this->fetchDevice($res[0]);

  }

  /****************************************************************************
   * Executes a query to select all devices for a given userID or all devices if
   * 	no user Id is supplied.
   * @param string $userid user id of the devices to select
   * @return error occurs
   * @access public
   ****************************************************************************
   */
  function getUserDevices($userid=NULL) {
    # query that will return all devices for a given User Id
   
   	$devs = array();
    if (!isset($userid)) {goto BAIL;}
    	
    $sql = $this->mkSQL("SELECT d.* ,CONCAT(u.`firstname`,' ',u.`surname`) as uname FROM `devices` d,`users` u WHERE d.`userid`=%N AND u.`userid`=d.`userid` ",$userid);
    
    $res = $this->get_results($sql);
    if (!isset($res) || empty($res)) goto BAIL;
      	
  	foreach($res as $aDev)
  	{
  		$devs[]=$this->fetchDevice($aDev);
  	}   
  	
  	BAIL:
  	
    return $devs;
  }
  
	function fetchAllDevices() {
    # query that will return all devices 
    $qryStr = "SELECT d.* ,CONCAT(u.`firstname`,' ',u.`surname`) uname FROM `devices` d, `users` u WHERE d.`userid`=u.`userid` ";
    $qryStr .= "UNION SELECT d.*,'Not Assigned' uname FROM `devices` d WHERE d.`userid`=0 ";
    $sql = $this->mkSQL($qryStr);
    
    $res = $this->get_results($sql);
    if (!isset($res)) goto BAIL;
      	
  	foreach($res as $aDev)
  	{
  		$devs[]=$this->fetchDevice($aDev);
  	}   
  	
  	BAIL:

    return $devs;
  }

  /****************************************************************************
   * Fetches a row from the query result and populates the Device object.
   * @return 
   * @access public
   ****************************************************************************
   */
  function fetchDevice($devObj) {
    
    if ($devObj == false) {
      return false;
    }
    $dev = new Device();
    
    $dev->setDeviceId($devObj->deviceid); 
    $dev->setUserId($devObj->userid);
    $dev->setUserFullname($devObj->uname); 	
    $dev->setVendorCode($devObj->vendor_code);
    $dev->setProductCode($devObj->product_code);
    $dev->setSerialNumber($devObj->serial);
    $dev->setEnclosureId($devObj->enc_barcode);
    return $dev;
  }

  /****************************************************************************
   * Inserts a new Device record into the devices table.
   * @param Device $device to insert
   * @return boolean returns true if insert was successful or false, if error occurs
   * @access public
   ****************************************************************************
   */
  function insert($device) {
    # inserting device row
    $sql = $this->mkSQL("INSERT INTO `devices` VALUES (NULL, %N, %Q, %Q, %Q, %Q) ",
                        $device->getUserId(), $device->getVendorCode(),
                        $device->getProductCode(), $device->getSerialNumber(),
                        $device->getEnclosureId());
    $this->query($sql);
    $insId = $this->insert_id;
    return (($insId != 0) && ($insId !== false));
  }


  /****************************************************************************
   * Updates a device in the devices table.
   * @param (Device)device to insert
   * @return boolean returns NULL, if error occurs
   * @access public
   ****************************************************************************
   */
  function update($device) {
    # updating devices table
    // the vendorid, productid and serial number are not directly editable by the user 
    // so no need to update them
    $sql = $this->mkSQL("UPDATE `devices` set `userid`=%N, `enc_barcode`=%Q WHERE `deviceid`=%N ",
                        $device->getUserId(), $device->getEnclosureId(), $device->getDeviceId());
    
    $affectedRows = $this->query($sql);
    return ($affectedRows == 1);
    
  }

  /****************************************************************************
   * Deletes a  device from the devices table.
   * @param string $devid the deviceid index of the device
   * @return boolean returns null, if error occurs
   * @access public
   ****************************************************************************
   */
  function delete($devid) {
    $sql = $this->mkSQL("DELETE FROM `devices` WHERE `deviceid`=%N ", $devid);

	$count = $this->query($sql);
    return (isset($count) && $count==1);  
    }
  
  	function getfurtherInfo($someDevs)
  	{
   		if ((NULL == $someDevs) || (!is_array($someDevs)))
  			return NULL;
  		
  		$updatedDevs = array();
  		
  		// get all the devices
  		$allDevs = $this->fetchAllDevices();
  		
  		foreach($someDevs as $aDev )
  		{
  			$foundDevs = objectsMatchingKeyValue($allDevs,'getSerialNumber',$aDev->getSerialNumber());  			
  						
  			// check if the device IS NOT in the DB
  			if((count($foundDevs) == 0)){
  				$updatedDevs[] = $aDev;
  				continue;
  			}
  			
  			foreach ($foundDevs as $checkDev)
  			{ 
  				if(($checkDev->getVendorCode() == $aDev->getVendorCode())&&($checkDev->getProductCode()==$aDev->getProductCode()))
  				{
  					// set and add the device as it is valid
  					$checkDev->setValidated(true);
  					$checkDev->setMountPoint($aDev->getMountPoint());
  					$updatedDevs[] = $checkDev;
  					break; // no need to check any other devices with the same serial
  				}
  			}
    	}	
    	
  		return $updatedDevs;
  	}
  	
  	private function barcodeUnique($barcode,$deviceid=null) {
    $sql = $this->mkSQL("SELECT COUNT(*) FROM `devices` WHERE `enc_barcode`=%Q ", $barcode);
    $sql .= (isset($deviceid))?$this->mkSQL("AND `deviceid`<>%N ",$deviceid):'';
    
    $count = $this->get_var($sql);
    if (!isset($count)) return false;
    
    return ($count == 0);
    
  }
/****************************************************************************
 * Smarty Validate functions
 *
 ****************************************************************************
 */
	function validateBarcode($value, $empty, &$params, &$formvars) { 
		if(isset($params['field2']))            
        	return $this->barcodeUnique($value,$formvars[$params['field2']]); 
    	
    	return $this->barcodeUnique($value);    	
    } 
    
    function validateDevice($value, $empty, &$params, &$formvars) {
    	return true;
    }

}

