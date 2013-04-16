<?php

function objectsMatchingKeyValue(&$array, $key, $value)
{
	// returns an array of objects that match the $value of the $key
	$found=array();
	while(list(,$object) = each($array))
	{
		if (is_object($object))
		{	
			if (method_exists($object,$key))
			{
				if ($object->$key() == $value)
					$found[]=$object;
			}
			else
			{	
				if ($object->$key == $value)
					$found[]=$object;	
			}
			
		}
		else if (is_array($object))
		{
			if ($object[$key] == $value)
				$found[]=$object;
		}
	}
	
	reset($array);
	return $found;
}

function identifierOfRowForObjectWithKeyValue(&$array, $key, $value)
{
	// returns the first identifier of the row in the array
	// that match the $value of the $key
	// or false if not found
	$obj = false;
	while (list($k,$object) = each($array))
	{
		if (is_object($object))
		{
			if (method_exists($object,$key))
			{
				if ($object->$key() == $value)
				{
					$obj = $k;
					break;
				}
			}
			else
			{
				if ($object->$key == $value)
				{
					$obj = $k;
					break;
				}
			}
		}
		else if (is_array($object))
		{
			if ($object[$key] == $value)
			{
				$obj = $k;
				break;
			}	
		}
	}
	
	reset($array);
	return $obj;
}

function objectsWithKey(&$array,$key)
{
	// returns an array of objects that match the $key
	$found=array();
	while(list(,$row) = each($array))
	{
		$found[]=$row[$key];
	}
	reset($array);
	return $found;
}

function objectToArray($d)
{
	if (is_object($d))
	{
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars($d);
	}

	if (is_array($d))
	{
		/*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
		return array_map(__FUNCTION__, $d);
	}
	else
	{
		// Return array
		return $d;
	}
}


function makeAssocFromString($inputStr, $kvSep=",",$flip=false,$sort=true)
{
	if ((!isset($inputStr)) || ($inputStr=="")) return false;
	$matches = $output = array();
	// check for (Key,Value) pairs first
	preg_match_all("/\((.+?),(.+?)\)/", $inputStr, $matches, PREG_SET_ORDER);
	if(!empty($matches)) // no matches so just explode the string 
	{
		foreach($matches as $k=>$arr)
		{
			$output[$arr[1]]=$arr[2];
		}
		if($flip)
		{
			$output = array_flip($output);
			if($sort) 
				asort($output);
		}
	}
	else
	{
		
		$output = array_combine(explode($kvSep, $inputStr), explode($kvSep, $inputStr));

	}		
	return $output;
	
}