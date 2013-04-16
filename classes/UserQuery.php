<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once(str_replace('//','/',dirname(__FILE__).'/').'../classes/ezQuery.php');
require_once(str_replace('//','/',dirname(__FILE__).'/').'../functions/stringFuncs.php');

 /******************************************************************************
 * UserQuery data access component for library users
 *
 * @author Kieren Eaton <circledev@gmail.com>
 * @version 1.0
 * @access public
 ******************************************************************************
 */

// !---------  UserQuery ---------
class UserQuery extends ezQuery
{

	function __construct()
	{
		parent::__construct();
		require_once(str_replace('//','/',dirname(__FILE__).'/').'User.php');
	}

  /****************************************************************************
   * Executes a query
   * @param string $userid Member id of library member to select
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */

  	function getUser($userid=null)
	{
		if(!isset($userid)) return false;
	   	$sql = 'SELECT u.`userid`, u.`username`, u.`jadeid`, u.`surname`,u.`firstname`, u.`titleid`, (SELECT `title` FROM `user_titles_dm` WHERE `titleid`=u.`titleid`) `title`, u.`phone_mobile`, u.`email`, ';
    	$sql .= "u.`reading_levelid`, u.`classid`, DATE_FORMAT(`birth_date`, '%%d/%%m/%%Y') `birth_date`, u.`changed_by_id`, u.`auto_recommend`, u.`statusid`, ";
    	$sql .= 'u.`comments` FROM `users` u WHERE u.`userid`=%N ';
    	$sql = $this->mkSQL($sql,$userid);

    	//echo $sql;exit;
    	$rows = $this->get_results($sql);
    	if (!isset($rows))
    		return false;

    	return $this->_mkUser($rows[0]);
  	}

  	function getUserWithUsername($usernm=null)
  	{
  		if(!isset($usernm)) return false;
    	//$sql = $this->mkSQL('select * from users where username=%Q ', $usernm);
    	$sql = 'SELECT u.`userid`, u.`username`, u.`jadeid`, u.`surname`,u.`firstname`, u.`titleid`, (SELECT `title` FROM `user_titles_dm` where `titleid`=u.`titleid`) `title`, u.`phone_mobile`, u.`email`, ';
    	$sql .= "u.`reading_levelid`, u.`classid`, DATE_FORMAT(`birth_date`, '%%d/%%m/%%Y') `birth_date`, u.`changed_by_id`, u.`auto_recommend`, u.`statusid`, ";
    	$sql .= 'u.`comments` FROM `users` u WHERE u.`username`=%Q ';

    	$sql = $this->mkSQL($sql,$usernm);

    	$rows = $this->get_results($sql);
    	if (!isset($rows)) {
      		Fatal::internalError("User \'{$userid}\' not found!");
    	}
    	return $this->_mkUser($rows[0]);
  	}

  	function fetchAllUserNames($partial=null)
  	{
  		$sql = "SELECT u.`userid` userid,u.`username` , CONCAT(u.`firstname`,' ',u.`surname`) fullname FROM `users` u WHERE u.`classid`<>5 AND u.`statusid`=1 "; // not an institution and active

  		$partial = trim($partial);
  		$names = explodeStr($partial,false,false,null,2);
		if (count($names) == 1)
		    $sql .=  $this->mkSQL("AND CONCAT(u.`firstname`,' ',u.`surname`) LIKE '%%%q%%' ",$partial);
		else
		{
		    $first = true;
		    foreach ($names as $partName)
		    {
		    	$sql .= (!$first)?" AND ":"AND (";
		    	$sql .= $this->mkSql("(u.`firstname` LIKE '%%%q%%' OR u.`surname` LIKE '%%%q%%')",$partName,$partName);
		    	$first = false;
		    }
		    $sql .= ")";
		}
  		$sql .= "ORDER BY u.`surname` ";
		return $this->get_results($sql);
  	}

  	function usersWithCriteria($type=null,$srchStr=null)
	{
		if((!isset($srchStr) || !isset($type)) || ($srchStr=="" || $type=="")) return null;

		$sqlBase = "SELECT DISTINCT u.`userid`, u.username, CONCAT(u.`firstname`,' ',u.`surname`) fullname, u.`jadeid` ,a.`phone`, ";
		$sqlBase .= "a.`address` FROM `users` u, (SELECT ua.`phone`, ua.`userid`, CONCAT(ua.`address`,', ',ua.`city`) address ";
		$sqlBase .= "FROM `user_address` ua WHERE ua.`typeid` IN (1,2)) a WHERE a.`userid`=u.`userid` ";
		$sqlSuffix = "ORDER BY u.surname ";
		$sql = "";

		switch ($type)
		{
			case "n": // name
				$names = explodeStr($srchStr,false,false,null,2);
				if (count($names) == 1)
					$sql =  $this->mkSQL($sqlBase."AND CONCAT(u.`firstname`,' ',u.`surname`) LIKE '%%%q%%' ".$sqlSuffix,$srchStr);
				else
				{
					$sql = $sqlBase;
					$first = true;
					foreach ($names as $partName)
					{
						$sql .= (!$first)?" AND ":"AND (";
						$sql .= $this->mkSQL("(u.`firstname` LIKE '%%%q%%' OR u.`surname` LIKE '%%%q%%')",$partName,$partName);
						$first = false;
					}
					$sql .= ")".$sqlSuffix;
				}
			break;
			case "u": // username
				$sql = $this->mkSQL($sqlBase."AND u.`username` LIKE '%%%q%%' ".$sqlSuffix,$srchStr);
			break;
			case "a": // address
				$sql = $this->mkSQL($sqlBase."AND a.`address` LIKE '%%%q%%' ".$sqlSuffix,$srchStr);
			break;
			case "p": // phone
				$sql = $this->mkSQL($sqlBase."AND (a.`phone` LIKE '%%%q%%' OR u.`phone_mobile` LIKE '%%%q%%') ".$sqlSuffix,$srchStr,$srchStr);
			break;
			case "j": // jade id
				$sql = $this->mkSQL($sqlBase."AND u.`jadeid` LIKE '%%%q%%' ".$sqlSuffix,$srchStr);
			break;

		}

		return $this->get_results($sql);

	}

	function fetchAllUsersQuickInfo($peopleOnly=true)
	{

		$queryStr = "SELECT u.userid `id`, u.username `username`, concat(firstname, ' ',surname) `fullname`, u.jadeid `jadeid`, ";
		$queryStr .= "IF(ua.address <> ',',ua.address,'') `address`, u.comments `comments` FROM users u, ";
		$queryStr .= "(SELECT concat(address,', ',city,' ',postcode) AS address,userid FROM user_address) ua ";
		$queryStr .= "WHERE u.userid=ua.userid ";//AND u.classid<>5 ";

		if ($peopleOnly==true)
			$queryStr .= 'AND u.`classid`<>5 ';
		$queryStr .= 'GROUP BY `id` order by u.`surname` ';
  		$sql = $this->mkSQL($queryStr);

  		//echo $sql;exit;
    	$rows = $this->get_results($sql);

    	if (!isset($rows))
      		return false;


  		return $rows;
  	}

	private function _mkUser($userRow)
	{
		$user = new User();
		$user->setUserId($userRow->userid);
   		$user->setUsername($userRow->username);
   		$user->setBirthDate($userRow->birth_date);
   		$user->setJadeId($userRow->jadeid);
 		$user->setSurname($userRow->surname);
    	$user->setFirstname($userRow->firstname);
   		$user->setTitleId($userRow->titleid);
		$user->setTitle($userRow->title);
		$user->setMobilePhone($userRow->phone_mobile);
    	$user->setEmail($userRow->email);
		$user->setClassification($userRow->classid);
		$user->setCreateDate((isset($userRow->create_date))?$userRow->create_date:$user->getCreateDate());
 		$user->setLastChangeDate((isset($userRow->last_change_date))?$userRow->last_change_date:$user->getLastChangeDate());
    	$user->setChangedByStaffId($userRow->changed_by_id);
    	$user->setAutoRecommend($userRow->auto_recommend);
    	$user->setReadingLevelId($userRow->reading_levelid);
    	$user->setStatusId($userRow->statusid);
    	$user->setComments($userRow->comments);

		return $user;
	}

	/****************************************************************************
   	* Returns true if User Id already exists
   	* @param string $userid Library member id
   	* @return boolean returns true if User Id already exists
   	* @access private
   	****************************************************************************
   	*/
  	function userExists($username=null)
  	{
  		if((!isset($username)) || ($username == '')) return false;
    	$sql = $this->mkSQL('select count(*) from users where username=lower(%Q)', $username);
    	$count = $this->get_var($sql);
    	if ($count === null) {
      		Fatal::internalError('Bad number of rows for user exisis query');
    	}

    	return ($count > 0)?true:false;
  	}

  	/****************************************************************************
   	* Inserts a new User into the users table.
   	* @param User $user User to insert
   	* @return integer the id number of the newly inserted member
   	* @access public
   	****************************************************************************
   	*/
	function addUser($user=null)
	{
		if($user==null) return false;

		//print_r($user);exit;
		$sql = $this->mkSQL('insert into users '
        	. '(username, jadeid, password, surname, firstname, '
            . 'titleid, phone_mobile, email, reading_levelid, '
            . 'classid, create_date, last_change_date, birth_date, changed_by_id, '
            . 'auto_recommend, statusid, comments) '
            . 'values (%Q, %Q, %Q, %Q, %Q, '
            . '%N, %Q, %Q, %N, '
			. '%N, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, %Q, %N, '
			. '%N, %N, %Q) ',
        $user->getUsername(), $user->getJadeId(), $user->getPassword(), $user->getSurname(), $user->getFirstname(),
		$user->getTitleId(), $user->getMobilePhone(), $user->getEmail(), $user->getReadingLevelId(),
		$user->getClassification(), ($user->getBirthDate()!='')?dateConvert($user->getBirthDate()):'NULL', $user->getChangedByStaffId(),
		$user->getAutoRecommend(), $user->getStatusId(), $user->getComments());

    	$this->query($sql);
   		$insId = $this->insert_id;
   		if (($insId == 0) || ($insId === false))
   			goto BAIL;

   		return $insId;

   		BAIL:
   		return false;
	}

	/****************************************************************************
   	* Update a library member in the member table.
   	* @param Member $user library member to update
   	* @access public
   	****************************************************************************
   	*/
	function updateUser($user=null)
	{
		if($user==null) return false;
		$sql = $this->mkSQL('update users set '
			. 'username=%Q, jadeid=%Q, surname=%Q, firstname=%Q, titleid=%N, '
			. 'phone_mobile=%Q, email=%Q, reading_levelid=%N, classid=%N, '
			. 'changed_by_id=%N, statusid=%N, comments=%Q, birth_date=%Q, '
			. 'auto_recommend=%N '
            . 'where userid=%Q ',
            $user->getUsername(),$user->getJadeId(),$user->getSurname(),$user->getFirstname(),$user->getTitleId(),
			$user->getMobilePhone(),$user->getEmail(),$user->getReadingLevelId(),$user->getClassification(),
			$user->getChangedByStaffId(),$user->getStatusId(),$user->getComments(), dateConvert($user->getBirthDate()),
			$user->getAutoRecommend(),
			$user->getUserId());

		return $this->query($sql);

	}

	function updatePassword($user)
	{
		// we do not encrypt the password here because it is already encrypted in the user data
		$sql = $this->mkSQL('UPDATE `users` SET `password`=%Q, `changed_by_id`=%N, `last_change_date`=NULL WHERE `userid`=%N ',
            $user->getPassword(),$user->getChangedByStaffId(),$user->getUserId());

		return $this->query($sql);
	}

	function verifySignon($username=null , $pwd=null)
	{
		if((!isset($username)) || ($username == '')) return false;
    	if((!isset($pwd)) || ($pwd=='')) return false;

    	$sql = $this->mkSQL('select count(*) from `users` where `username`=lower(%Q) and `password`=MD5(MD5(%Q)) ', $username, $pwd);
		$count = $this->get_var($sql);
    	if ($count === null) {
      		Fatal::internalError('Bad number of rows for signon query');
    	}

    	return ($count > 0)?true:false;
  	}

	function suspendUser($username)
  	{
    	$sql = $this->mkSQL('update users set statusid=6 where username=lower(%Q)', $username);
    	$affRows = $this->query($sql);

    	if ($affRows === null) {
      		Fatal::internalError('Bad number of rows');
    	}

    	return ($affRows > 0)?true:false;

    	//return $this->query($sql, 'Error suspending staff member.');
  	}



  /****************************************************************************
   * Deletes a library user from the users table.
   * @param string $userid  User id of library member to delete
   * @access public
   ****************************************************************************
   */
  function deleteUser($userid) {
    $sql = $this->mkSQL('DELETE u, up, ur, upr, ua FROM `users` u LEFT JOIN `user_prefs` up ON u.`userid`=up.`userid` '
			. 'LEFT JOIN `user_requests` ur ON u.`userid`=ur.`userid` LEFT JOIN `user_address` ua ON u.`userid`=ua.`userid` '
			. 'LEFT JOIN  `user_profile` upr ON u.`userid`=upr.`userid` WHERE u.`userid`=%N ', $userid);

  	return $this->query($sql);
  }

  /****************************************************************************
   * SmartyValidate Methods
   *
   *
   ****************************************************************************
   */
	function validateUsername($value, $empty, &$params, &$formvars) {
		if(isset($params['field2']))
        	return $this->_usernameAvailable($value,$formvars[$params['field2']]);

    	return $this->_usernameAvailable($value);
    }

    function validateLogin($value, $empty, &$params, &$formvars)
    {
    	if((!isset($formvars[$params['field']])) || (!isset($formvars[$params['field2']]))) return false;
    	return $this->verifySignon($formvars[$params['field']],$formvars[$params['field2']]);
    }


	// !------------- Private User functions
	private function _usernameAvailable($username,$userid=null) {
    $sql = $this->mkSQL("SELECT COUNT(*) FROM `users` WHERE `username`=%Q ", $username);
    $sql .= (isset($userid))?$this->mkSQL("AND `userid`<>%N ",$userid):'';

    $count = $this->get_var($sql);
    if (!isset($count)) return false;

    return ($count == 0);

  }


}
// !---------  UserPrefsQuery ---------
class UserPrefsQuery extends ezQuery
{

	function __construct()
	{
		parent::__construct();
		require_once(str_replace('//','/',dirname(__FILE__).'/').'UserPrefs.php');
	}


	function getPrefs($userid)
  	{
    	$sql = $this->mkSQL('SELECT * FROM `user_prefs` WHERE `userid`=%N ', $userid);
    	$rows = $this->get_results($sql);
    	if (!isset($rows)) {
      		Fatal::internalError("Prefs for User id \'{$userid}\' not found!");
    	}
    	return $this->_mkUserPrefs($rows[0]);
  	}

	function addPrefs($prefs=null)
	{
		if($prefs==null) return false;
		$sql = $this->mkSQL('INSERT INTO `user_prefs` '
        	. '(`userid`, `content_sex`, `content_violence`, `content_lang`, '
			. '`narrator_male`, `narrator_female`, `narrator_synth`, '
			. '`books_short`, `books_long`, `braille`, `books_per_device`, `max_queued_reqs`) '
            . 'values (%N, %N, %N, %N, '
            . '%N, %N, %N, '
            . '%N, %N, %N, '
            . '%N, %N) ',
           	$prefs->getUserId(), $prefs->getContentSex(), $prefs->getContentViolence(), $prefs->getContentLanguage(),
 			$prefs->getNarratorMale(), $prefs->getNarratorFemale(), $prefs->getNarratorSynth(),
 			$prefs->getBooksShort(), $prefs->getBooksLong(), $prefs->getBraille(),
 			$prefs->getBooksPerDevice(),$prefs->getMaxQueuedReqs());

		$this->query($sql);

    	return;
	}

	function updatePrefs($prefs=null)
	{
		if($prefs==null) return false;
		$sql = $this->mkSQL('UPDATE `user_prefs` SET '
			. '`content_sex`=%N, `content_violence`=%N, `content_lang`=%N, '
			. '`narrator_male`=%N, `narrator_female`=%N, `narrator_synth`=%N, '
			. '`books_short`=%N, `books_long`=%N, `braille`=%N, '
			. '`books_per_device`=%N, `max_queued_reqs`=%N '
            . 'WHERE `userid`=%N ',
            $prefs->getContentSex(),$prefs->getContentViolence(),$prefs->getContentLanguage(),
			$prefs->getNarratorMale(),$prefs->getNarratorFemale(),$prefs->getNarratorSynth(),
			$prefs->getBooksShort(),$prefs->getBooksLong(),
			$prefs->getBraille(), $prefs->getBooksPerDevice(),
			$prefs->getMaxQueuedReqs(),$prefs->getUserId());

    $affectedRows = $this->query($sql);

	}

	private function _mkUserPrefs($array)
	{
		$prefs = new UserPrefs();
		$prefs->setUserId($array->userid);
   		$prefs->setContentSex($array->content_sex);
		$prefs->setContentViolence($array->content_violence);
 		$prefs->setContentLanguage($array->content_lang);
    	$prefs->setNarratorMale($array->narrator_male);
   		$prefs->setNarratorFemale($array->narrator_female);
 		$prefs->setNarratorSynth($array->narrator_synth);
    	$prefs->setBooksShort($array->books_short);
    	$prefs->setBooksLong($array->books_long);
		$prefs->setBraille($array->braille);
		$prefs->setBooksPerDevice($array->books_per_device);
		$prefs->setMaxQueuedReqs($array->max_queued_reqs);
		return $prefs;
	}

	 /****************************************************************************
   * Deletes a library user from the users table.
   * @param string $userid  User id of library member to delete
   * @access public
   ****************************************************************************
   */
  function deleteUserPrefs($userid) {
    $sql = $this->mkSQL('DELETE up FROM `user_prefs` up WHERE u.`userid`=%N ', $userid);
    $affectedRows = $this->query($sql);
    return $affectedRows;
  }

}
// !---------  UserAddressQuery ---------
class UserAddressQuery extends ezQuery
{

	function __construct()
	{
		parent::__construct();
		require_once(str_replace('//','/',dirname(__FILE__).'/').'UserAddress.php');
	}

	function getAddresses($userid)
  	{
    	$sql = $this->mkSQL('SELECT * FROM `user_address` WHERE `userid`=%N ORDER BY `typeid` ', $userid);
    	$retRows = $this->get_results($sql);

    	if (!isset($retRows)) return null;

    	$addresses = null;
    	while (list (,$addRow) = each($retRows))
    	{
    	    $addresses[] = $this->_mkAddress($addRow);
    	}

    	return $addresses;

    }

  	function getAddress($addrid)
  	{
    	$sql = $this->mkSQL('SELECT * FROM `user_address` WHERE `addressid`=%N ', $addrid);
    	$retRows = $this->get_results($sql);

    	if (!isset($retRows)) return null;

    	return $this->_mkAddress($retRows[0]);

  	}


  	function updateAddress($addrs=null)
	{
		if($addrs==null) return false;
		$sql = $this->mkSQL('UPDATE `user_address` SET '
			. '`typeid`=%N, `address`=%Q, `city`=%Q, `state`=%Q, `postcode`=%Q, '
			. '`country`=%Q, `phone`=%Q, `contact_name`=%Q, '
			. '`contact_alt_phone`=%Q, `comments`=%Q '
            . 'WHERE `addressid`=%N ',
            $addrs->getTypeId(),$addrs->getAddress(),$addrs->getCity(),$addrs->getState(),$addrs->getPostCode(),
			$addrs->getCountry(),$addrs->getPhone(),$addrs->getContactName(),
			$addrs->getContactAltPhone(),$addrs->getComments(),$addrs->getAddressId());

    	return $this->query($sql);

	}

  	function addAddress($addrs)
  	{
  		if($addrs==null) return false;
		$sql = $this->mkSQL('INSERT INTO `user_address` (`typeid`,`userid`,`address`,`city`, '
			. '`state`,`postcode`,`country`,`phone`, '
			. '`contact_name`,`contact_alt_phone`,`comments`) '
			. 'values (%N,%N,%Q,%Q,%Q,%Q,%Q,%Q,%Q,%Q,%Q) ',
            $addrs->getTypeId(),$addrs->getUserId(),$addrs->getAddress(),$addrs->getCity(),
            $addrs->getState(),$addrs->getPostCode(),$addrs->getCountry(),$addrs->getPhone(),
            $addrs->getContactName(),$addrs->getContactAltPhone(),$addrs->getComments());

    	$this->query($sql);
   		if (($this->insert_id == 0) || ($this->insert_id === false))
   			goto BAIL;

   		return $this->insert_id;

   		BAIL:
   		return false;

  	}

  	function deleteAddress($addrId)
  	{
  		if ((!isset($addrId)) || ($addrId == 0)) return false;
  		$sql = $this->mkSQL('DELETE FROM `user_address` WHERE `addressid`=%N ',$addrId);

    	return $this->query($sql);

  	}

  	private function _mkAddress($aRow)
	{
		$address = new UserAddress();
		$address->setAddressId($aRow->addressid);
		$address->setTypeId($aRow->typeid);
		$address->setUserId($aRow->userid);
		$address->setAddress($aRow->address);
		$address->setCity($aRow->city);
		$address->setState($aRow->state);
		$address->setPostCode($aRow->postcode);
		$address->setCountry($aRow->country);
		$address->setPhone($aRow->phone);
		$address->setContactName($aRow->contact_name);
		$address->setContactAltPhone($aRow->contact_alt_phone);
		$address->setComments($aRow->comments);
		$address->setLastUpdated($aRow->last_updated);
		return $address;
	}

}

// !---------  UserProfileQuery ---------
class UserProfileQuery extends ezQuery
{
	function __construct()
	{
		parent::__construct();
		require_once(str_replace('//','/',dirname(__FILE__).'/').'UserProfile.php');
	}

	function getProfiles($userid)
  	{
    	$sql = $this->mkSQL('SELECT * FROM `user_profile` WHERE `userid`=%N ORDER BY `typeid`,`content` ', $userid);
    	$retRows = $this->get_results($sql);

  		if (isset($retRows))
    	{
    		$profiles = null;
    		while (list(,$addRow) = each($retRows))
    		{
    			$profiles[] = $this->_mkProfile($addRow);
    		}

    		return $profiles;
    	}
    	return null;
    }

	private function _mkProfile($aRow)
	{
		$profile = new UserProfile();
		$profile->setProfileId($aRow->profileid);
		$profile->setTypeId($aRow->typeid);
		$profile->setUserId($aRow->userid);
		$profile->setContent($aRow->content);
		$profile->setLanguage($aRow->lang);
		$profile->setPreferred($aRow->prefers);
		$profile->setAllocation($aRow->alloc);

		return $profile;
	}



	function updateProfiles($profs)
	{
		if(!isset($profs) || $profs==null) return false;
		if(!is_array($profs)) return false;

		$sqlPrefix = $this->mkSQL('INSERT INTO `user_profile` (`profileid`,`typeid`,`userid`,`content`,`lang`,`prefers`,`alloc`) VALUES ');
		$sqlSuffix = ' ON DUPLICATE KEY UPDATE `typeid`=VALUES(`typeid`), `content`=VALUES(`content`), `lang`=VALUES(`lang`), ';
		$sqlSuffix .= '`prefers`=VALUES(`prefers`), `alloc`=VALUES(`alloc`) ';

		$sql = '';
		$firstItem = true;
		while (list(,$aProf) = each($profs))
		{
			$sql .=(!$firstItem)?', ':'';
			$sql .=$this->mkSQL('(%N,%N,%N,%Q,%Q,%N,%N)',
								$aProf->getProfileId(),
								$aProf->getTypeId(),
								$aProf->getUserId(),
								$aProf->getContent(),
								$aProf->getLanguage(),
								$aProf->getPreferred(),
								$aProf->getAllocation());
			$firstItem = false;
		}
		$sql = $sqlPrefix.$sql.$sqlSuffix;

    	return $this->query($sql);
	}

	function addProfile($prof)
	{
		if($prof==null) return false;
			$sql = $this->mkSQL('INSERT IGNORE INTO `user_profile` (`typeid`,`userid`,`content`,`lang`,`prefers`,`alloc`) '
				. 'VALUES (%N,%N,%Q,%Q,%N,%N) ',
    	        $prof->getTypeId(),$prof->getUserId(),$prof->getContent(),
    	        $prof->getLanguage(),$prof->getPreferred(),$prof->getAllocation());

    		return $this->query($sql);
	}

	function deleteProfile($profid=null)
	{

		if ((!isset($profid)) || ($profid == 0)) return false;
  		$sql = $this->mkSQL('DELETE FROM `user_profile` WHERE `profileid`=%N ',$profid);
  		return $this->query($sql);



	}
}
// !---------  UserRequestQuery ---------
class UserRequestsQuery extends ezQuery
{
	function addRequest($userid,$catalogid,$format=1,$content=1){
		// we set the default book format and content type  to daisy 2.02 Audio Only
		// which are specified in the format_type_dm and content_type_dm tables

		// first get the correct biblio_copyid for the book with the specified
		// format and content types
		$sql = $this->mkSQL("SELECT `copyid` FROM `biblio_copy` WHERE (`formatid`=%N) AND (`contentid`=%N) AND (`bibid`=%N) ",$format,$content,$catalogid);
		$copyid = $this->get_var($sql);
		if ($copyid == null) {
      		Fatal::internalError('A Book with that format and content type cannot be found');
    	}
    	// found the reference copyid so add a row to the requests table
		$sql = $this->mkSQL("INSERT INTO `user_requests` (`userid`,`bibid`,`copyid`,`order_dt`) VALUES (%N,%N,%N,CURRENT_TIMESTAMP) ",$userid,$catalogid,$copyid);
	    $rows = $this->query($sql);
    	if ($rows != 1) {
      		Fatal::internalError('Error Inserting row into user_requests');
    	}

    	return true;
    }

	function getRequests($userid)
	{
	   $sql = $this->mkSQL("SELECT b.`title`, ur.`req_dt` `date`, ur.`reqid` FROM `biblio` b, `user_requests` ur WHERE (b.`bibid`=ur.`bibid`) AND (ur.`userid`=%N) ORDER BY `order_dt` DESC ", $userid);

    	$rows = $this->get_results($sql);

    	return $rows;

	}

	function deleteRequest($requestId=null)
	{
		if($requestId == NULL) return false;

		$sql = $this->mkSQL("DELETE FROM `user_requests` WHERE (`reqid`=%N) ",$requestId);

		$rows = $this->query($sql);
		if ($rows == null) {
      		Fatal::internalError('Error deleting request.');
    	}

    	return true;
    }


}

// !---------  UserHistoryQuery ---------
class UserHistoryQuery extends ezQuery
{

	function getReadingHistory($userid,$showAll=false)
	{
	   //$sql = $this->mkSQL("SELECT `title`,DATE_FORMAT(`dl_date`,'%%d-%%b-%%Y %%r') AS `date`, `deviceid` FROM `biblio` b, `download_hist` dh WHERE (b.`bibid`=dh.`bibid`) AND (dh.`userid`=%N) ORDER BY `dl_date` DESC ", $userid);

	   $sql = $this->mkSQL("SELECT `title`,DATE_FORMAT(`dl_date`,'%%d-%%b-%%Y %%r') AS `date`, rn.idx FROM `biblio` b, `download_hist` dh, (SELECT @rnum:=0) r, (SELECT deviceid, @rnum := @rnum + 1 `idx` FROM devices WHERE userid=%N) rn  WHERE (b.`bibid`=dh.`bibid`) AND (dh.`userid`=%N) AND rn.`deviceid`=dh.`deviceid` ORDER BY `dl_date` DESC ",$userid,$userid);
	   $sql .= (!$showAll)?$this->mkSQL("LIMIT 40 "):'';
    	$rows = $this->get_results($sql);
    	return $rows;
	}

}

class UserNoteQuery extends ezQuery
{
	function notesWithContent($userid=null,$srchCrit=null)
	{
		if(!isset($userid) || !isset($srchCrit)) return null;

		$sql = $this->mkSQL("SELECT `content`,DATE_FORMAT(`note_dt`,'%%d-%%b-%%Y %%r') AS `date` FROM `user_notes` WHERE `userid`=%N ", $userid);

		$words = null;
		$words = explode(" ",trim($srchCrit));

		if (empty($words))
			return null;

		while (list(,$aWord) = each($words))
		{

			$sql .= $this->mkSQL("AND `content` LIKE '%%%q%%' ",$aWord);

		}
		$sql .= " ORDER BY `note_dt` DESC ";

		return $this->get_results($sql);


	}

	function getNotes($userid,$showAll=false)
	{
	   $sql = $this->mkSQL("SELECT `content`,DATE_FORMAT(`note_dt`,'%%d-%%b-%%Y %%r') AS `date` FROM `user_notes` WHERE `userid`=%N ORDER BY `note_dt` DESC ", $userid);
	   $sql .= (!$showAll)?"LIMIT 20 ":'';

    	$rows = $this->get_results($sql);

    	return $rows;

	}

	function addNote($userid,$content)
	{
		$sql = $this->mkSQL("INSERT INTO `user_notes` (`userid`,`content`) VALUES (%N,%Q) ",$userid,$content);
	    $rows = $this->query($sql);
    	if ($rows != 1) {
      		Fatal::internalError('Error Inserting row into user_notes');
    	}

    	return true;
	}

	function deleteNote($noteId)
	{
		if($noteId == NULL || $noteId == '') return false;

		$sql = $this->mkSQL("DELETE FROM `user_notes` WHERE `noteid`=%N ",$noteId);

		$rows = $this->query($sql);
		if ($rows == null) {
      		Fatal::internalError('Error deleting note '.$noteId);
    	}

    	return true;
	}
}