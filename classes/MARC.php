<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
require_once(str_replace('//','/',dirname(__FILE__).'/').'../functions/marcFuncs.php');

 /******************************************************************************
 * MARC component for exracting records and entries from raw MARC (.mrc) data 
 *
 * @author Kieren Eaton <circledev@gmail.com>
 * @version 1.0
 * @access public
 ******************************************************************************
 */
 
class MARC 
{

	// returns an array of tags containing the  
	static public function recordsFromRawData(&$inputData)
	{
		$recOffset = 0;
		$allRecs = array();
	
		$fileLen = strlen($inputData);
		while(($recOffset+5) < $fileLen) 
		{	
			$tags = array();
			$recLen = (int)substr($inputData,$recOffset,5);
			$record = substr($inputData,$recOffset,$recLen);
			$tags = self::_tagsFromRecordData($record);
			if (!empty($tags)) {$allRecs[] = $tags;}
			$recOffset += $recLen;
		}
		return $allRecs;
	}
	
	static public function entriesFromMarcRecords(&$records=null,$excludedIds=null)
	{
		if ((!isset($records)) || (empty($records))) return array();
		
		require_once(str_replace('//','/',dirname(__FILE__).'/').'Biblio.php');
		require_once(str_replace('//','/',dirname(__FILE__).'/').'BiblioField.php');
		
		$entries = array();
		while(list(,$aRec) = each($records)) 
		{	
			$bib = new Biblio();			
			while(list($tag,$fields) = each($aRec))
			{	
				foreach($fields as $aField)
				{	
					$fld = new BiblioField();
					$fld->setTag($tag);			
					$fld->setInd1Cd(((isset($aField["indicator1"]))?$aField["indicator1"]:""));
					$fld->setInd2Cd(((isset($aField["indicator2"]))?$aField["indicator2"]:""));
					$fld->setSubfieldCd(((isset($aField["subfield"]))?$aField["subfield"]:""));
					$fld->setFieldData($aField["data"]);								
					$bib->addField($fld);
				}
			}
			$entries[] = $bib;	
		}
		return $entries;
	} 

	
	// !-- Private functions
	private static function _tagsFromRecordData(&$recData)
	{
		$dataStart = (int)substr($recData,12,5); // get the offset where the actual data starts
		$leader = substr($recData,0,$dataStart); // the leader is everything before the actual data
		// extract the tags from the leader
		$tagOffset = 24; // tags dir starts at the 24th pos of the leader
		$tagList = $allTags = array();
		while(($tagOffset+12) < $dataStart)
		{
			$tagList[] = array(
				"tag"=>substr($leader,$tagOffset,3), // tag
				"len"=>(int)substr($leader,$tagOffset+3,4), // total length of all fields 
				"off"=>(int)substr($leader,$tagOffset+7,5), // start poition within the record excluding the leader length
				);
			$tagOffset += 12;		
		}
		
		// process the fields of each tag
		while (list(,$aTag) = each($tagList))
		{
			$tag = $aTag["tag"];
			$len= $aTag["len"];
			$off = $aTag["off"];
			if ((((int)$tag) >= 900)  ) continue; // ignore tags reserved for local use 
			$fieldsData	= substr($recData, $dataStart+$off, $len);
			$fields = self::_fieldsFromData($tag, $fieldsData);
			if (empty($fields)) continue;
			 
			$allTags[$tag] = $fields;
				
		}
		
		return $allTags;
	}
	
	private static function _fieldsFromData($aTag, &$dataSeg)
	{
		$fields = $fld = array();
		$fieldsData = explode("\37",$dataSeg); // split the fields for this tag
		foreach ($fieldsData as $idx=>$fldData)
		{
			if ($idx == 0) // first index is the field identifier (control or regular)
			{
				$fld = array(); // init the array holding the field data
			    if(((int)$aTag) > 9) // check for control field
			    {
			    	// set the indicators if specified
			    	$ind1 = substr($fldData,0,1);
			    	$ind2 = substr($fldData,1,1);
			    	$fld["indicator1"] = (($ind1 != " ")?$ind1:"");
			    	$fld["indicator2"] = (($ind2 != " ")?$ind2:"");
			    }
			    else 
			    {
			    	// control fields have no Indicator or Subfield codes 
			        $fld["data"] = (($aTag == "008")?str_replace(" ","|",$fldData):$fldData);
	            	$fields[] = $fld;
			    }
			    continue;
			} // 
			
			$subId = substr($fldData,0,1);
			$fld["subfield"] = $subId;
	        $fld["data"] = trim(substr($fldData,1));
	        $fields[] = $fld;    
		}
		
		return $fields;
	}
		

}	
