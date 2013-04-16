<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab="opac";
 	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  require_once(__ROOT__."classes/User.php");
  require_once(__ROOT__."classes/UserQuery.php");
  require_once(__ROOT__."classes/SessionQuery.php");

  #****************************************************************************
  #*  Checking for post vars.  Go back to form if none found.
  #****************************************************************************
  $pageErrors = "";

  	$labels = array();
  	$labels['header']=$loc->getText("opac_login_header");
  	$labels['username']=$loc->getText("opac_login_username");
	$labels['password']=$loc->getText("opac_login_password");
	$labels['button']=$loc->getText("opac_login_loginButton");
	$labels['invalidLogin']=$loc->getText("opac_login_invalidLogin");

  	$smarty->assign('labels',$labels);
  	$userQ = new UserQuery();
  	SmartyValidate::register_object('userQry',$userQ);

	if(empty($_POST))
	{
		$ret='index.php';
		if((isset($_GET['ret'])) && ($_GET['ret'] != ''))
		{
			$page = $_GET['ret'];
			switch ($page)
			{
				case 'view' :
					if((isset($_GET['b'])) && ($_GET['b'] !=''))
						$ret='view.php?b='.$_GET['b'];
				break;
			}
		}
		$_SESSION['_user']['returnPage'] = (isset($_SESSION['_user']['returnPage']))?$_SESSION['_user']['returnPage'] :$ret;

		// new form, we (re)set the session data
		SmartyValidate::connect($smarty, true);

        // register our validators
        SmartyValidate::register_criteria('isValidLogin','userQry->validateLogin');
        SmartyValidate::register_validator('v_login', 'uname:pwd', 'isValidLogin', false, false, 'trim');

		$smarty->display('opac/login.tpl','opac');
	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();

  			$user = $userQ->getUserwithUsername($_POST['uname']);
  			if (!isset($user)) header("Location: index.php");

  			#****************************************************************************
			#*  Redirect to suspended message if suspended
			#****************************************************************************
/*
			if ($user->isSuspended()) {
			  header('Location: suspended.php');
			  exit();
			}
*/

			#**************************************************************************
			#*  Insert new session row with random token
			#**************************************************************************

			$sessionQ = new SessionQuery();
			$token = $sessionQ->getToken('User'.$user->getUserId(),false);
			if ($token === false) {
			  // failed to get token
			  header("Location: index.php");
			}
			unset($sessionQ);

  			$_SESSION['_user']['username'] = $user->getUsername();
			$_SESSION['_user']['id'] = $user->getUserid();
			$_SESSION['_user']['token'] = $token;
			unset($_SESSION['_user']['loginAttempts']);

  			#**************************************************************************
			#*  Redirect to return page
			#**************************************************************************

			header('Location: '.$_SESSION['_user']['returnPage']);

       	} else {
        	// error, redraw the form
           	$smarty->assign($_POST);
           	$smarty->display('opac/login.tpl','admin');
       	}
    }

exit;





/*

  if (count($_POST) == 0) {


    $smarty->display("opac/login.tpl");
    exit();
  }

	$error_found = false;
  #****************************************************************************
  #*  Username edits
  #****************************************************************************
  $username = $_POST['username'];
	if ($username == '')
	{
    	$error_found = true;
    	$pageErrors["username"] = "Username is required.";
  		goto BAIL;
  	}

  #****************************************************************************
  #*  Password edits
  #****************************************************************************

  	$pwd = $_POST["pwd"];
	if ($pwd == '')
	{
    	$error_found = true;
    	$pageErrors["pwd"] = "Password is required.";
 		goto BAIL;
  	}

    $pwd = md5(md5($pwd));
    $userQ = new UserQuery();

    $validUser = $userQ->userExists($username);
    if(!$validUser)
    {
    	# invalid username.
      	$error_found = true;
      	$pageErrors['username'] = 'Invalid username.';
    	goto BAIL;
    }

    $verified = $userQ->verifySignon($username, $pwd);
    if (!$verified)
    {
      # invalid password.  Add one to login attempts.
      $error_found = true;
      $pageErrors['pwd'] = 'Invalid signon.';
      if (!isset($_SESSION['_user']['loginAttempts']) || ($_SESSION['_user']['loginAttempts'] == '')) {
        $sess_login_attempts = 1;
      } else {
        $sess_login_attempts = $_SESSION['_user']['loginAttempts'] + 1;
      }
      # Suspend userid if login attempts >= 5
      if ($sess_login_attempts >= 5) {
        $userQ->suspendUser($username);
        header('Location: suspended.php');
        exit();
      }
    }

    $user = $userQ->getUserWithUsername($username);
    unset($userQ);

  #****************************************************************************
  #*  Redirect back to form if error occured
  #****************************************************************************
BAIL:
  if ($error_found == true)
  {
    $_SESSION['postVars'] = $_POST;
    $_SESSION['pageErrors'] = $pageErrors;
    header("Location: ../shared/loginForm.php");
    exit();
  }

  #****************************************************************************
  #*  Redirect to suspended message if suspended
  #****************************************************************************
  if ($user->getStatusId() == 6) {
    header("Location: ../shared/suspended.php");
    exit();
  }


  #**************************************************************************
  #*  Insert new session row with random token
  #**************************************************************************

  $sessionQ = new SessionQuery();
  $sessionQ->connect();
  if ($sessionQ->errorOccurred()) {
    $sessionQ->close();
    displayErrorPage($sessionQ);
  }
  $token = $sessionQ->getToken('Usr'.$user->getUserId());
  if ($token == false) {
    $sessionQ->close();
    displayErrorPage($sessionQ);
  }
  $sessionQ->close();

  #**************************************************************************
  #*  Destroy form values and errors and reset signon variables
  #**************************************************************************
  unset($_SESSION['postVars']);
  unset($_SESSION['pageErrors']);

  $_SESSION['_user']['username'] = $user->getUsername();
  $_SESSION['_user']['userid'] = $user->getUserId();
  $_SESSION['_user']['token'] = $token;
  $_SESSION['_user']['loginAttempts'] = 0;
  $_SESSION['_user']['canDownload'] = ($user->getStatusId()==1)?1:0;


  #**************************************************************************
  #*  Redirect to return page
  #**************************************************************************
  header('Location: '.$_SESSION['_user']['returnPage']);
  exit();

?>
*/
