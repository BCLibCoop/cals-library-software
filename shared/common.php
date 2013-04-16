<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  # Forcibly disable register_globals
  if (ini_get('register_globals')) {
    foreach ($_REQUEST as $k=>$v) {
      unset(${$k});
    }
    foreach ($_ENV as $k=>$v) {
      unset(${$k});
    }
    foreach ($_SERVER as $k=>$v) {
      unset(${$k});
    }
  }

  ini_set("default_charset", 'utf-8');

  /****************************************************************************
   * Cover up for the magic_quotes disaster.
   * Modified from ryan@wonko.com.
   ****************************************************************************
   */
   // --- updated for php 5.3+ removed call to depreciated function
  //set_magic_quotes_runtime(0);
  ini_set('magic_quotes_runtime', 0);

  if (get_magic_quotes_gpc()) {
    function magicSlashes($element) {
      if (is_array($element))
        return array_map("magicSlashes", $element);
      else
        return stripslashes($element);
    }

    // Remove slashes from all incoming GET/POST/COOKIE data.
    $_GET    = array_map("magicSlashes", $_GET);
    $_POST   = array_map("magicSlashes", $_POST);
    $_COOKIE = array_map("magicSlashes", $_COOKIE);
    $_REQUEST = array_map("magicSlashes", $_REQUEST);
  }

  # FIXME - Until I get around to fixing all the notices...
  error_reporting(E_ALL ^ E_NOTICE);

  # Escaping shorthands
  function H($s) {
    return htmlspecialchars($s, ENT_QUOTES);
  }
  function HURL($s) {
    return H(urlencode($s));
  }
  function U($s) {
    return urlencode($s);
  }

  # Compatibility
  $phpver = explode('.', PHP_VERSION);
  if (!function_exists('mysql_real_escape_string')) {		# PHP < 4.3.0
    function mysql_real_escape_string($s, $link) {
      return mysql_escape_string($s);
    }
  }
  if ($phpver[0]>=5 || ($phpver[0]==4 && $phpver[1]>=3)) {
    function obib_setlocale() {
      $a = func_get_args();
      call_user_func_array('setlocale', $a);
    }
  } else {
    function obib_setlocale() {
      $a = func_get_args();
      setlocale($a[0], $a[1]);
    }
  }
  	// define the root of the app
	defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)).'/');
	require_once(__ROOT__.'database_constants.php');
	require_once(__ROOT__.'shared/global_constants.php');
	require_once(__ROOT__.'classes/Error.php');
	require_once(__ROOT__.'classes/Iter.php');
	require_once(__ROOT__.'classes/Nav.php');
	require_once(__ROOT__.'classes/Localize.php');

	if (!isset($doing_install) or !$doing_install) {
	  require_once(__ROOT__."shared/read_settings.php");

	  /* Making session user info available on all pages. */
	  session_start();
	  # Forcibly disable register_globals
	  if (ini_get('register_globals')) {
	    foreach ($_SESSION as $k=>$v) {
	      unset(${$k});
	    }
	  }
	}

	ini_set('display_errors',1);
	//ini_set('display_errors',0);

	if(ini_get('display_errors')==1)
	{
		error_reporting(E_ALL);
		require_once(__ROOT__.'classes/kint/Kint.class.php');
	}

	// Add Smarty template system
	require_once(__ROOT__.'classes/Smarty_DLS.php');
	$smarty = new Smarty_DLS();

	// Add Sanitize Class for checking and sanitizing GET and POST vars
	require_once(__ROOT__.'functions/sanitizeFuncs.php');

	if(!isset($tab)) $tab='';
	if (preg_match('/[^a-zA-Z0-9_]/', $tab)) {
		 Fatal::internalError("Possible security violation: bad tab name");
		 exit(); # just in case
	}
 	$headerLoc = new Localize(OBIB_LOCALE,'shared');
 	$loc=null;
 	if($tab!='')
	 	$loc = new Localize(OBIB_LOCALE,$tab);
	// Header Info
	$smarty->assign('labelTodaysDate',$headerLoc->getText('headerTodaysDate'));
	$smarty->assign('labelLibraryPhone',$headerLoc->getText('headerLibraryPhone'));
	$smarty->assign('labelLibraryHours',$headerLoc->getText('headerLibraryHours'));


