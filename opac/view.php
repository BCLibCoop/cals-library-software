<?php
	/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
	 * See the file COPYRIGHT.html for more details.
	 */
	$tab='opac';
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  	require_once('loginCheck.php');
	require_once '../s3.php';

 	#****************************************************************************
 	#*  Checking for get vars.  Go back to form if none found.
 	#****************************************************************************
 	if ((count($_GET) == 0) || (!isset($_GET['b']))) {
 	  header("Location: index.php");
 	  exit();
 	}

 	require_once(__ROOT__."classes/Biblio.php");
 	require_once(__ROOT__."classes/BiblioQuery.php");
 	require_once(__ROOT__."classes/BiblioCopy.php");
 	require_once(__ROOT__."classes/BiblioCopyQuery.php");
 	require_once(__ROOT__."classes/DmQuery.php");
 	require_once(__ROOT__."classes/UsmarcSubfieldDmQuery.php");
 	require_once(__ROOT__."classes/MaterialFieldQuery.php");
 	require_once(__ROOT__."functions/sessionFuncs.php");
 	require_once(__ROOT__."libs/phpqrcode/qrlib.php");

 	$dmQ = new DmQuery();
  	$contentTypes = $dmQ->getAssoc("content_type_dm");

 	$dmQ = new UsmarcSubfieldDmQuery();
 	$tagDescs = $dmQ->getAllSubfields();

 	unset($dmQ);

 	$bibid = (int)$_GET['b'];
 	$bibQ = new BiblioQuery();
 	$entry = $bibQ->getEntry($bibid);
 	if($entry === false)
 	{
	 	header("Location: index.php");
	 	exit;
 	}

 	//$_SESSION['_user']['returnPage'] = 'view.php?b='.$bibid;

 	$matQ = new MaterialFieldQuery();

 	$materialTagDescs = $matQ->getMaterialWithCode($entry->getMaterialCd());
 	$fieldData = $entry->getBiblioFields();

 	//! ----- copies ------
 	$copyQ = new BiblioCopyQuery();
 	$copyRes = $copyQ->getAllCopies($bibid);
 	$copies = array();
 	if(($copyRes === false) || empty($copyRes)) goto FIELDS;
  	// check online status of all copies
  	foreach($copyRes as $copyData)
  	{
  		$copy = array();
		$filepath = ROOT_ARCHIVES_PATH.$copyData->getFilePath();
		if(file_exists($filepath))
 		{
 			// file size calculator

 			$copy['content']=$contentTypes[$copyData->getContentId()];
			$filesize = filesize($filepath);
			$size = (($filesize / 1024) / 1024);
			$precision = 2;
			$copy['size'] = round($size, $precision)." Mb";

			// file time calculator
			$pt = '';
			if (isset($fieldData["306a"])) { $pt = $fieldData["306a"]->getFieldData();}
			if (strlen($pt) >= 6)
			{
				$hours = substr($pt, 0 , 2);
				$minutes = 	substr($pt, 2 , 2);
				$copy['playTime'] = ($minutes == '00')?"$hours hours":"$hours hours $minutes minutes";
			}
	 		$copy['id']=$copyData->getCopyId();
	 		$copy['downloadButtonUrl']=($isGuest)?"login.php?ret=view&b=".$bibid:"download.php?c=".$copyData->getCopyId();
	 		$copy['downloadButtonText']=($isGuest)?$loc->getText("opac_view_copyLogin"):$loc->getText("opac_view_copyDownload").' '.$copy['content'];
	 	} else {
 			$copy['error']=$loc->getText("opac_view_copyNotFound");
 		}

 		$copies[]=$copy;
  	}

FIELDS:
  	//! ----- fields -----
  	$opacFields = array();
  	$opacFields['general'] = array_flip(array('035a','245a','245b','245c','100a','520a','650a','655a'));
  	$opacFields['extra'] = array_flip(array('700a','599s','599l','599v'));

  	$fields=array();
  	foreach($fieldData as $idx=>$aField)
  	{
	  	$tag = substr($idx, 0,4);
	  	if((!isset($opacFields['general'][$tag])) && (!isset($opacFields['extra'][$tag])))
	  		continue;
	  	if($aField->getFieldData() == '')
	  		continue;

	  	$aFld = array();
	  	$aFld['tag']=$tag;

	  	if(isset($materialTagDescs[$tag])) {
			$aFld['descr'] = $materialTagDescs[$tag]->descr;
		}
	  	elseif(isset($tagDescs[$tag])) {
		  	$aFld['descr'] = $tagDescs[$tag]->getDescription();
		}
		else {
			$aFld['descr'] = 'No Description';
		}

	  	$aFld['data']=$aField->getFieldData();
	  	if(isset($opacFields['general'][$tag]))
	  		$fields['general'][$idx]=$aFld;
	  	else
	  		$fields['extra'][$idx]=$aFld;
  	}

	$labels = array();
  	$labels['restrictedWarning'] = $loc->getText("opac_restrictedMsg");
  	$labels['restrictedMessage'] = $loc->getText("opac_restrictedFullMsg");
  	$labels['noCopies'] = $loc->getText("opac_view_noCopies");

   	$labels['copySize'] = $loc->getText("opac_view_copySize");
   	$labels['copyFormat'] = $loc->getText("opac_view_copyFormat");
 	$labels['copyPlayTime'] = $loc->getText("opac_view_copyPlayingTime");
 	$labels['entryInfoGeneral'] = $loc->getText("opac_view_entryInfo");
	$labels['entryInfoExtra'] = $loc->getText("opac_view_entryInfoExtra");

	# FIXME
	$url = "http://cals.libraries.coop".$_SERVER['REQUEST_URI'];
    $code = QRcode::pngData($url, "L", 4, 2);
    if($code!==false)
    	$smarty->assign('qrcode',base64_encode($code));
    //dd($url,$code);
    //$code = base64_encode();



 	$smarty->assign('entry',$entry);
 	$smarty->assign('fields',$fields);
 	$smarty->assign('labels',$labels);
 	$smarty->assign('copies',$copies);
  	$smarty->assign('restricted',$entry->getIsRestricted());
  	$smarty->display('opac/view.tpl');
  	exit;
