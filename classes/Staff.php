<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
/******************************************************************************
 * Staff represents a library staff member.  Contains business rules for
 * staff member data validation.
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class Staff {
  protected $_staffid;
  protected $_lastChangeDt;
  protected $_lastChangeStaffid;
  protected $_lastChangeStaffName;
  protected $_pwd;
  protected $_lastName;
  protected $_firstName;
  protected $_username;
  protected $_usersAuth;
  protected $_devicesAuth;
  protected $_catalogAuth;
  protected $_adminAuth;
  protected $_reportsAuth;
  protected $_suspended;

	function __construct()
	{
		$this->_staffid = "";
		$this->_lastChangeDt = "";
		$this->_lastChangeStaffid = "";
		$this->_lastChangeStaffName = "";
		$this->_pwd = "";
		$this->_lastName = "";
		$this->_firstName = "";
		$this->_username = "";
		$this->_usersAuth = false;
		$this->_devicesAuth = false;
		$this->_catalogAuth = false;
		$this->_adminAuth = false;
		$this->_reportsAuth = false;
		$this->_suspended = false;
	
	}

  /****************************************************************************
   * @return string Staff userid
   * @access public
   ****************************************************************************
   */
  function getStaffid() {
    return $this->_staffid;
  }
  /****************************************************************************
   * @param string $userid userid of staff member
   * @return void
   * @access public
   ****************************************************************************
   */
  function setStaffid($staffid) {
    $this->_staffid = trim($staffid);
  }

  /****************************************************************************
   * @param string $pwd Password of staff member
   * @return void
   * @access public
   ****************************************************************************
   */
  function setPwd($pwd) {
    $this->_pwd = trim($pwd);
  }
  function getPwd() {
    return $this->_pwd;
  }


  /****************************************************************************
   * @return string Staff last name
   * @access public
   ****************************************************************************
   */
  function getSurname() {
    return $this->_lastName;
  }

  /****************************************************************************
   * @param string $lastName last name of staff member
   * @return void
   * @access public
   ****************************************************************************
   */
  function setSurname($lastName) {
    $this->_lastName = trim($lastName);
  }
  /****************************************************************************
   * @return string first name of staff member
   * @access public
   ****************************************************************************
   */
  function getFirstName() {
    return $this->_firstName;
  }
  /****************************************************************************
   * @param string $firstName first name of staff member
   * @return void
   * @access public
   ****************************************************************************
   */
  function setFirstName($firstName) {
    $this->_firstName = trim($firstName);
  }
  /****************************************************************************
   * @return string Staff username
   * @access public
   ****************************************************************************
   */
  function getUsername() {
    return $this->_username;
  }

  /****************************************************************************
   * @param string $username username of staff member
   * @return void
   * @access public
   ****************************************************************************
   */
  function setUsername($username) {
    $this->_username = strtolower(trim($username));
  }
  /****************************************************************************
   * @return boolean true if staff member has User authorization
   * @access public
   ****************************************************************************
   */
  function hasUsersAuth() {
    return $this->_usersAuth;
  }
  /****************************************************************************
   * @param boolean $userAuth true if staff member has user authorization
   * @return void
   * @access public
   ****************************************************************************
   */
  function setUsersAuth($usersAuth) {
      $this->_usersAuth = $usersAuth;
  }
  /****************************************************************************
   * @return boolean true if staff member has Device modification authorization
   * @access public
   ****************************************************************************
   */
  function hasDevicesAuth() {
    return $this->_devicesAuth;
  }
  /****************************************************************************
   * @param boolean $deviceAuth true if staff member has device management authorization
   * @return void
   * @access public
   ****************************************************************************
   */
  function setDevicesAuth($devicesAuth) {
      $this->_devicesAuth = $devicesAuth;
  }

  /****************************************************************************
   * @return boolean true if staff member has catalog authorization
   * @access public
   ****************************************************************************
   */
  function hasCatalogAuth() {
    return $this->_catalogAuth;
  }
  /****************************************************************************
   * @param boolean $catalogAuth true if staff member has catalog authorization
   * @return void
   * @access public
   ****************************************************************************
   */
  function setCatalogAuth($catalogAuth) {
 	 $this->_catalogAuth = $catalogAuth;
  }
  /****************************************************************************
   * @return boolean true if staff member has administration authorization
   * @access public
   ****************************************************************************
   */
  function hasAdminAuth() {
    return $this->_adminAuth;
  }
  /****************************************************************************
   * @param boolean $AdminAuth true if staff member has administration authorization
   * @return void
   * @access public
   ****************************************************************************
   */
  function setAdminAuth($adminAuth) {
  	$this->_adminAuth = $adminAuth;
  }
  /****************************************************************************
   * @return boolean true if staff member has reports authorization
   * @access public
   ****************************************************************************
   */
  function hasReportsAuth() {
    return $this->_reportsAuth;
  }
  /****************************************************************************
   * @param boolean $ReportsAuth true if staff member has reports authorization
   * @return void
   * @access public
   ****************************************************************************
   */
  function setReportsAuth($reportsAuth) {
      $this->_reportsAuth = $reportsAuth;
  }
  /****************************************************************************
   * @return boolean true if staff member account has been suspended
   * @access public
   ****************************************************************************
   */
  function isSuspended() {
    return $this->_suspended;
  }
  /****************************************************************************
   * @param boolean $suspended true if staff member has been suspended
   * @return void
   * @access public
   ****************************************************************************
   */
  function setSuspended($suspended) {
      $this->_suspended = $suspended;
  }

  function getLastChangeDt() {
    return $this->_lastChangeDt;
  }
  function getLastChangeStaffid() {
    return $this->_lastChangeStaffid;
  }
  function getLastChangeStaffName() {
    return $this->_lastChangeStaffName;
  }
  function setCreateDt($value) {
    $this->_createDt = trim($value);
  }
  function setLastChangeDt($value) {
    $this->_lastChangeDt = trim($value);
  }
  function setLastChangeStaffid($value) {
    $this->_lastChangeStaffid = (int)trim($value);
  }


}

