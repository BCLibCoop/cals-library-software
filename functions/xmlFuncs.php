<?php 

require_once(str_replace('//','/',dirname(__FILE__).'/') ."../classes/Device.php");

function stripXmlTags($inputStr)
{
    $inputStr = trim($inputStr);
	$strStart = strpos($inputStr,">")+1;
	$strEnd = strpos($inputStr,"<",$strStart);
	return substr($inputStr,$strStart,($strEnd-$strStart));
}

function parseProfilerXmlOutput($xmlInput)
{
	// flags
	$foundVols = false;
	
	// placeholder ivars
	unset($prod_id);
	unset($vend_id);
	unset($serial);
	unset($path);
	
	$devices = array();
	
	// check if we have been passed a string
	if(is_string($xmlInput))
	{ $xmlArray = explode("\n",$xmlInput);}
	else
	{ $xmlArray = $xmlInput;}
	
	for ($i = 0; $i < count($xmlArray); $i++)
	{
		$line = $xmlArray[$i];
		if(substr_count($line,"<key>")>0) // check for a key tag 
		{
			$line = stripXmlTags($line);
			if(($line == "_name") && ($foundVols == false))
			{
				// new device found so reset the ivars
				unset($prod_id);
				unset($vend_id);
				unset($serial);
				unset($path);
				continue;
			}
			if ($line == "volumes")
			{
				$foundVols = true;
				continue;
			}
			
			switch ($line)
			{
				case "b_vendor_id";
					$vend_id = stripXmlTags($xmlArray[$i+1]);
					$vend_id = substr($vend_id,0,6);
					break;
				case "a_product_id";
					$prod_id = stripXmlTags($xmlArray[$i+1]);
					$prod_id = substr($prod_id,0,6);
					break;
				case "d_serial_num";
					$serial = stripXmlTags($xmlArray[$i+1]);
					break;	
				case "mount_point";
					$path = stripXmlTags($xmlArray[$i+1]);
					$path = ($path!='')?$path:null;
					break;	
				default ;
					continue;
			}
			
			// check if all the needed ivars are set
			if(isset($vend_id)&&isset($prod_id)&&isset($serial)&&isset($path))
			{
				$aDev = new Device();
				$aDev->setVendorCode($vend_id);
				$aDev->setProductCode($prod_id);
				$aDev->setSerialNumber($serial);
				$aDev->setMountPoint($path);
				$devices[] = $aDev;
				
				// reset the ivars after adding to the array						
				unset($prod_id);
				unset($vend_id);
				unset($serial);
				unset($path);	
				$foundVols = false;								
			}
		}	
	}
	return($devices);
}

?>