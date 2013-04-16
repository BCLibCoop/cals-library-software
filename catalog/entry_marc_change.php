<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	
  	require_once(__ROOT__."classes/UsmarcBlockDmQuery.php");
  	require_once(__ROOT__."classes/UsmarcTagDmQuery.php");
  	require_once(__ROOT__."classes/UsmarcSubfieldDmQuery.php");
  	
  	// at a minimum we need a block id
  	if((!empty($_POST)) && (!(checkPassedIn(array('b'),$_POST)))) 
	{
		exit;
	}
	// locale required local for ajax support 
	$loc = (isset($loc))?$loc:(new Localize(OBIB_LOCALE,"catalog"));
	
  	$labels["blockLabel"] = $loc->getText("catalogEntry_editEditMarcBlock");
	$labels["tagLabel"]= $loc->getText("catalogEntry_editEditMarcTag");
	$labels["subfieldLabel"]= $loc->getText("catalogEntry_editEditMarcSubfield");
	$labels["ind1Label"]= $loc->getText("catalogEntry_editEditMarcInd1");
	$labels["ind2Label"]= $loc->getText("catalogEntry_editEditMarcInd2");
					
  	$block = (isset($_POST["b"]))?$_POST["b"]:((isset($block))?$block:null); 
  	$tag = (isset($_POST["t"]))?$_POST["t"]:((isset($tag))?$tag:null);
	$blocks=$tags=$ind1=$ind2=$subFlds=array();  	
    $bq = new UsmarcBlockDmQuery();
    $blockList = $bq->getBlocks(true); 
    unset($bq);
        
    if($blockList !== false) {$blocks = array("options"=>$blockList,"selected"=>$block);}
	
	$tq = new UsmarcTagDmQuery();
	$tagsList = $tq->getTagsForBlock($block,true);
	reset($tagsList);
	$tag= (isset($tag))?$tag:key($tagsList);
	$tags =	array("options"=>$tagsList,"selected"=>$tag);	
	$inds = $tq->getIndicatorsForTag($tag);	
	// set the values for the indicators select boxes 
	$ind1 = array("options"=>$inds[1],"selected"=>""); 
	$ind2 = array("options"=>$inds[2],"selected"=>""); 
	
	$subQ = new UsmarcSubfieldDmQuery();
	$subsList = $subQ->getSubfieldsForTag($tag,true);
	$subFlds = array("options"=>$subsList);
	$smarty->assign("labels",$labels);
	
	// ajax call does not supply $field 
	if (!isset($field))
	{
		$blocks["selected"] = $block;
		$ind1["selected"]="";
		$ind2["selected"]="";
		reset($subsList);
		$subFlds["selected"]=key($subsList);
		$smarty->assign("blocks",$blocks);
		$smarty->assign("ind1",$ind1);
		$smarty->assign("ind2",$ind2);
		$smarty->assign("subFlds",$subFlds);
		$smarty->assign("tags",$tags);
		echo $smarty->fetch("catalog/entry_marc_body.tpl","catalog");
	
	}
		
		
		