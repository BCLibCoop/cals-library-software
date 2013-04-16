<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
require_once(__ROOT__.'classes/ezQuery.php');

/******************************************************************************
 * StaffQuery data access component for library staff members
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class StaffQuery extends ezQuery {

	function __construct()
	{
		parent::__construct();
		require_once(__ROOT__.'classes/Staff.php');
	}


  /****************************************************************************
   * Executes a query
   * @param string $userid (optional) userid of staff member to select
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function getStaffMember($staffid=null) {
  	// check if the last query gave us a valid staffid for signon 
  	if ((!isset($staffid)) && (isset($this->last_result[0]->staffid))) $staffid = $this->last_result[0]->staffid;
  
    $sql = "SELECT * FROM `staff` ";
    $sql .= (isset($staffid))?$this->mkSQL("WHERE `staffid`=%N ", $staffid):"ORDER BY `last_name`, `first_name`";
   
    $res = $this->get_results($sql);
    
    return (isset($res))?$this->makeStaff($res[0]):false;
  }
  
  function getAllStaff()
  {
   	$sql = "SELECT * FROM `staff` ORDER BY `last_name`, `first_name`";
    $res = $this->get_results($sql);
    if(!isset($res)) return false;
    
    $allstaff = array();
    foreach ($res as $aMember)
    {
    	$allStaff[] = $this->makeStaff($aMember);
    }
    
    return $allStaff;
  }
  /****************************************************************************
   * Executes a query to verify a signon username and password
   * @param string $username username of staff member to select
   * @param string $pwd password of staff member to select
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
	function verifySignon($username, $pwd) {
    	$sql = $this->mkSQL("SELECT `staffid` FROM `staff` WHERE `username`=LOWER(%Q) AND `pwd`=MD5(LOWER(%Q)) ",$username, $pwd);
    	$rows = $this->query($sql);
    	return (($rows !== false) && ($rows !== 0));
	}

  /****************************************************************************
   * Updates a staff member and sets the suspended flag to yes.
   * @param string $username username of staff member to suspend
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function suspendStaff($username)
  {
    $sql = $this->mkSQL("UPDATE `staff` SET `suspended_flg`=1 WHERE `username`=LOWER(%Q)", $username);
    $res=$this->query($sql);
    return (($res !== false));
  }

  /****************************************************************************
   * Fetches a row from the query result and populates the Staff object.
   * @return Staff returns staff member or false if no more staff members to fetch
   * @access public
   ****************************************************************************
   */
   private function makeStaff($result) {
    
    if ($result == null) return false;

    $staff = new Staff();
    $staff->setStaffid($result->staffid);
    $staff->setSurname($result->last_name);
    $staff->setFirstName($result->first_name);
    $staff->setUsername($result->username);
    $staff->setUsersAuth($result->users_flg);       
    $staff->setDevicesAuth($result->devices_flg);
    $staff->setCatalogAuth($result->catalog_flg);
    $staff->setAdminAuth($result->admin_flg);
    $staff->setReportsAuth($result->reports_flg); 
    $staff->setSuspended($result->suspended_flg); 
    return $staff;
  }

  /****************************************************************************
   * Returns true if username already exists
   * @param string $username staff member username
   * @param string $userid staff member userid
   * @return boolean returns true if username already exists
   * @access private
   ****************************************************************************
   */
  function usernameAvailable($username,$staffid=null) {
    $sql = $this->mkSQL("SELECT COUNT(*) FROM `staff` WHERE `username`=%Q ", $username);
    $sql .= (isset($staffid))?$this->mkSQL("AND `staffid`<>%N ",$staffid):'';
    $count = $this->get_var($sql);
    return ((isset($count)) && ($count == 0));    
  }

  /****************************************************************************
   * Inserts a new staff member into the staff table.
   * @param Staff $staff staff member to insert
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function insert($staff) {
    $sql = $this->mkSQL("INSERT INTO `staff` VALUES (NULL, SYSDATE(), NULL, %N, %Q, MD5(LOWER(%Q)), %Q, ",
                        $staff->getLastChangeStaffid(), $staff->getUsername(),
                        $staff->getPwd(), $staff->getSurname());
    $sql .=($staff->getFirstName() == "")?"NULL, ":$this->mkSQL("%Q, ", $staff->getFirstName());
    
    // set 0 for suspended as new users are never suspended
    $sql .= $this->mkSQL(" 0, %N, %N, %N, %N, %N) ",
                         $staff->hasAdminAuth(),
                         $staff->hasUsersAuth(),
                         $staff->hasDevicesAuth(),
                         $staff->hasCatalogAuth(),
                         $staff->hasReportsAuth());
    $res=$this->query($sql);
    return (($res !== false) && ($res == 1));
  }

  /****************************************************************************
   * Update a staff member in the staff table.
   * @param Staff $staff staff member to update
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function update($staff) {
	
	// username is already validated via SmartyValidate    
    $sql = $this->mkSQL("UPDATE `staff` SET `last_change_staffid`=%N, `username`=%Q, `last_name`=%Q, ",
                        $staff->getLastChangeStaffid(), $staff->getUsername(),
                        $staff->getSurname());
    $sql .= ($staff->getFirstName() == "")?"`first_name`=NULL, ":$this->mkSQL("`first_name`=%Q, ", $staff->getFirstName());
    
    $sql .= $this->mkSQL("`suspended_flg`=%N, `admin_flg`=%N, `users_flg`=%N, "
                         . "`devices_flg`=%N, `catalog_flg`=%N, `reports_flg`=%N "
                         . "WHERE `staffid`=%N ",
                         $staff->isSuspended(),
                         $staff->hasAdminAuth(),
                         $staff->hasUsersAuth(),
                         $staff->hasDevicesAuth(),
                         $staff->hasCatalogAuth(),
                         $staff->hasReportsAuth(),
                         $staff->getStaffid());
   	$res=$this->query($sql);
    return ($res !== false);
  }

  /****************************************************************************
   * Resets a staff member password in the staff table.
   * @param Staff $staff staff member to update
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function resetPwd($staff) {
    $sql = $this->mkSQL("UPDATE `staff` SET `pwd`=MD5(LOWER(%Q)), `last_change_staffid`=%N "
                        . "WHERE `staffid`=%N ",
                        $staff->getPwd(), $staff->getLastChangeStaffid(),$staff->getStaffid());
    $res=$this->query($sql);
    return ($res !== false);
  }

  /****************************************************************************
   * Deletes a staff member from the staff table.
   * @param string $userid userid of staff member to delete
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function delete($staffid) {
    $sql = $this->mkSQL("DELETE FROM `staff` WHERE `staffid`=%N ", $staffid);
    $count = $this->query($sql);
    return (($count !== false ) && $count==1);
  }

  /****************************************************************************
   * SmartyValidate Methods
   * 
   * 
   ****************************************************************************
   */
	function validateUsername($value, $empty, &$params, &$formvars) { 
		if(isset($params['field2']))            
        	return $this->usernameAvailable($value,$formvars[$params['field2']]); 
    	
    	return $this->usernameAvailable($value);    	
    }  
    
    function validateLogin($value, $empty, &$params, &$formvars)
    {
    	if((!isset($formvars[$params['field']])) || (!isset($formvars[$params['field2']]))) return false;
    	return $this->verifySignon($formvars[$params['field']],$formvars[$params['field2']]);
    }

}
