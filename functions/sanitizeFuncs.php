<?php
/*
    Sanitize methods
*/


function checkPassedIn($validKeys=null,&$getVars=null,&$postVars=null,$removeUnknown=false)
{
	if((!isset($validKeys)) || (isset($validKeys) && (!isset($getVars) && !isset($postVars))))
		return false;
	
	if((empty($validKeys)) || (!empty($validKeys) && (empty($getVars) && empty($postVars))))
		return false;

	$validKeys = array_flip($validKeys);
	$foundKeys = 0;  // assume nothing is valid to being with
	if(!isset($getVars))
		goto DO_POST;
	while(list($key,$val) = each($getVars))
	{
		if((isset($validKeys[$key])) && ($val != '') )
			$foundKeys++;
		if(($removeUnknown) && (!isset($validKeys[$key])))
			unset($getVars[$key]); 
	}
	
	DO_POST:
	if(!isset($postVars))
		goto COMPLETE;
	while(list($key,$val) = each($postVars))
	{
		if((isset($validKeys[$key])) && ($val != ''))
			$foundKeys++;
		if(($removeUnknown) && (!isset($validKeys[$key])))
			unset($postVars[$key]); 
	}
	
	COMPLETE:
	return ($foundKeys == count($validKeys));

}



