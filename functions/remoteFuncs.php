<?php

	require_once(__ROOT__."libs/phpseclib/Net/SSH2.php");
	require_once(__ROOT__."functions/xmlFuncs.php");


function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    { $ip=$_SERVER['HTTP_CLIENT_IP'];}
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    { $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];}
    else
    { $ip=$_SERVER['REMOTE_ADDR'];}

	// fix for local host not resolving to an ip address
	if($ip == "::1") $ip = "127.0.0.1";

    return $ip;
}


function getConnectedDevices($showLog=false)
{
	$remIp = getRealIpAddr();

	$ssh = new Net_SSH2($remIp);

	if($showLog == true) { define('NET_SSH2_LOGGING',NET_SSH2_LOG_COMPLEX);}

	if (!$ssh->login(OBIB_REMOTE_USER,OBIB_REMOTE_USER_PWD)) {
		echo 'Remote Login Failed<br/>User : '.OBIB_REMOTE_USER.'<br/>Host Address : '.$remIp;
		echo '<br/><br/>Please report this issue to your administrator. <br/>';
		if($showLog == true) { echo $ssh->getLog();	}

		return false;
	}

	$devs = array();
	$output =  $ssh->exec('system_profiler -xml SPUSBDataType');

	if($showLog == true) {
		echo $ssh->getLog()."<br/><br/>";
		print_r($output);
	}

	$ssh->disconnect();

	$devs = parseProfilerXmlOutput($output);

	return $devs;
}

?>




