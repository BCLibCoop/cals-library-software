<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
require_once(__ROOT__."classes/ezQuery.php");

/******************************************************************************
 * SessionQuery data access component for signon sessions
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class SessionQuery extends ezQuery {
  /****************************************************************************
   * Executes a query to validate the token
   * @param string $userid userid of staff member to validate
   * @param string $token signon token of staff member to validate
   * @return boolean returns true if token is valid, false if token is not.
   * @access public
   ****************************************************************************
   */
	function validToken($userid=null, $token=null, $public=true) 
  	{
		if ((!isset($userid)) || (!isset($token))) return false;
		
    	$sql = $this->mkSQL("SELECT `last_updated_dt`, `token` FROM `session` WHERE `userid`=MD5(%Q) AND `token`=%Q "
            	            . "AND `last_updated_dt` >= SUBDATE(CURRENT_TIMESTAMP, ",
                	        $userid, $token);
		if($public)
			$sql .= $this->mkSQL('INTERVAL %N MINUTE) ',OBIB_PUBLIC_SESSION_TIMEOUT);
        else
           	$sql .= $this->mkSQL('INTERVAL %N MINUTE) ',OBIB_ADMIN_SESSION_TIMEOUT);     
         
        $rows = $this->query($sql);               
    	if (($rows === false)) return false;
    
    	$this->_updateToken($token);
          
      	return true;
    
  }
  /****************************************************************************
   * Inserts or updates the session table and returns a new valid signon token
   * @param string $userid userid of staff member to validate
   * @return string returns token or false, if error occurs
   * @access public
   ****************************************************************************
   */
  function getToken($userid, $public=true) {
    /**************************************************************************
     * Only purpose of the delete is to clean up old session rows so that the
     * session table doesn't get too full.
     **************************************************************************/
    $sql = $this->mkSQL("DELETE FROM `session` WHERE `userid`=MD5(%Q) AND `last_updated_dt` < SUBDATE(CURRENT_TIMESTAMP, ",$userid);
    
    if($public)
			$sql .= $this->mkSQL('INTERVAL %N MINUTE) ',OBIB_PUBLIC_SESSION_TIMEOUT);
        else
           	$sql .= $this->mkSQL('INTERVAL %N MINUTE) ',OBIB_ADMIN_SESSION_TIMEOUT);                    
              
    $res = $this->query($sql);                    
    if (($res === false)) 
    	Fatal::internalError('Error Deleting Session Details');
    
    $token = $this->_sessionToken($userid);
    $sql = $this->mkSQL("INSERT INTO `session` VALUES (MD5(%Q), %Q, NULL) ON DUPLICATE KEY UPDATE `last_updated_dt`=CURRENT_TIMESTAMP ",
                        $userid, $token);
    $res = $this->query($sql);
    if (($res === false))
    	Fatal::internalError('Error Inserting Session Details');
    
    return $token;
  }
  
  private function _sessionToken($userid)
  {
      $hash  = md5(DLS_HASH_PREFIX.$userid); 
      $ip = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : getenv('REMOTE_ADDR');
      $token = $hash.':'.md5($ip);

      return($token);
   }

  
  /****************************************************************************
   * Updates last updated date in session table so that the session will not
   * time out.
   * @param string $token token of session to update
   * @return boolean returns true if successful, false if error occurs.
   * @access private
   ****************************************************************************
   */
  private function _updateToken($token) {
    $sql = $this->mkSQL("UPDATE `session` SET `last_updated_dt`=CURRENT_TIMESTAMP WHERE `token`=%Q ", $token);
    
    $res = $this->query($sql);                    
    if (($res === false)) 
    	Fatal::internalError('Error updating session timeout');
    
    return true;
  }
}

