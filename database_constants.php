<?php
$f = __FILE__;
$lf = preg_replace('/.php$/', '.local.php', $f);
if(file_exists($lf)) {
 include($lf);
}
/*********************************************************************************
 *
 *                           A T T E N T I O N !
 *
 *  ||  Please modify the following database connection variables to match  ||
 *  \/  the MySQL database and user that you have created for OpenBiblio.   \/
 *********************************************************************************
 */
defined("OBIB_HOST") || define("OBIB_HOST",     "localhost");
defined("OBIB_DATABASE") || define("OBIB_DATABASE", "DB_library");
defined("OBIB_USERNAME") || define("OBIB_USERNAME", "ob_user");
defined("OBIB_PWD") || define("OBIB_PWD",      "abwa!");
defined("OBIB_REMOTE_USER") || define("OBIB_REMOTE_USER", "circulation");
defined("OBIB_REMOTE_USER_PWD") || define("OBIB_REMOTE_USER_PWD", "postalABWA");
defined("ROOT_ARCHIVES_PATH") || define("ROOT_ARCHIVES_PATH", "/mnt/usb/books/");

/*********************************************************************************
 *  /\                                                                      /\
 *  ||                                                                      ||
 *********************************************************************************
 */

# New stuff
global $_CONFIG;
if(!isset($_CONFIG)) {
$_CONFIG = array(
	'aws_s3' => array(
		'key' => 'CENSORED',
		'secret' => 'CENSORED',
		'base_url' => 'CENSORED',
		# Custom
		'bucket' => 'nnels',
		'prefix' => 'Books',
	),
);
}
?>
