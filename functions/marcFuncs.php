<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 

/*********************************************************************************
 * Draws input html tag of type text.
 * @param string $tag input field tag
 * @param int $occur input field occurance if field is being entered as repeatable
 * @return void
 * @access public
 *********************************************************************************
 */
function marcTagDesc($fullTag,&$marcTags,&$marcSubflds,$excludedTags=null,$showTagDesc=false)
{
	// make sure the tag does not contain an index Suffix 
	$idx = substr($fullTag,0,4);
	$tag = substr($idx,0,3);

 	// check if we just want the full tag description
  	if (($showTagDesc) && (isset($marcTags[$tag])) && (isset($marcSubflds[$idx])))
  	{
    	return H($marcTags[$tag]->getDescription()).' ('.H($marcSubflds[$idx]->getDescription()).')';
  	} 
  
  	// get the specific tag description
  	if (isset($marcSubflds[$idx]))
    	return H($marcSubflds[$idx]->getDescription());
 
	return false;
}

function makeCompositeTag($tag=null,$subfld=null,&$checkArr=null)
{
	if((!isset($tag)) || (!isset($subfld))) return false; // sanity check but should never happen 
	
	# make a composite index so repeated fields are stored correctly.
    # format is ttts[i] where 
    #    t=tag
    #    s=subfield code
    #	 i=subfield index if > 0
    # examples: 020a 650a 650a-1 650a-2
    
    $compTag = sprintf("%03d%s",$tag,$subfld);
    
    if (!isset($checkArr)) return $compTag;
    
    $index ='';  	
    while(isset($checkArr[$compTag]))
    {
    	$index++;
    	$compTag = sprintf("%03d%s-%s",$tag,$subfld,$index);
    }
    reset($checkArr);
    
    return $compTag;
}

// custom sort function for tags (by tag then subfield within tag)
function tagCmp($tag1,$tag2)
{	
	$sub1 = substr($tag1,3,1); 
	$sub2 = substr($tag2,3,1);
	$tag1 = substr($tag1,0,3);
	$tag2 = substr($tag2,0,3);

	if ($tag1==$tag2)
		return (strcmp($sub1,$sub2));
		
	return ($tag1<$tag2)?-1:1;
}