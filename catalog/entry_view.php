<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  	$tab = "catalog";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once '../s3.php';

  	if(!(checkPassedIn(array('bid'),$_GET)))
	{
		header("Location: catalog_search.php");
		exit;
	}

  	$nav = "entryView";
  	$helpPage = "catalog";

	if((isset($_GET['msg'])) && ($_GET['msg']!=''))
		$smarty->assign('contentStatusMsg',$_GET['msg']);

 	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/Biblio.php");
  	require_once(__ROOT__."classes/BiblioQuery.php");
  	require_once(__ROOT__."classes/BiblioCopy.php");
  	require_once(__ROOT__."classes/BiblioCopyQuery.php");
  	require_once(__ROOT__."classes/DmQuery.php");
  	require_once(__ROOT__."classes/UsmarcTagDm.php");
  	require_once(__ROOT__."classes/UsmarcTagDmQuery.php");
  	require_once(__ROOT__."classes/UsmarcSubfieldDm.php");
  	require_once(__ROOT__."classes/UsmarcSubfieldDmQuery.php");
  	require_once(__ROOT__."classes/MaterialFieldQuery.php");
  	require_once(__ROOT__."functions/marcFuncs.php");
  	require_once(__ROOT__."functions/arrayFuncs.php");

  	#****************************************************************************
  	#*  Retrieving get var
  	#****************************************************************************
  	$bibid = $_GET["bid"];

  	#****************************************************************************
  	#*  Loading a few domain tables into associative arrays
  	#****************************************************************************
  	$dmQ = new DmQuery();
	$cols = $dmQ->getAssoc("collection_dm");
	$mats = $dmQ->getAssoc("material_type_dm");
	$auds = $dmQ->getAssoc("audience_dm");
	unset($dmQ);

  	$marcTagDmQ = new UsmarcTagDmQuery();
  	$marcTags = $marcTagDmQ->getAllTags();
  	unset($marcTagDmQ);

  	$marcSubfldDmQ = new UsmarcSubfieldDmQuery();
  	$marcSubflds = $marcSubfldDmQ->getAllSubfields();
  	unset($marcSubfldDmQ);

	// !--- Get entry Info ---

	$biblioQ = new BiblioQuery();
  	$biblio = $biblioQ->getEntry($bibid);
  	if (!$biblio) {
  	  echo "error";
  	  exit;
  	}
  	// mark the specific tags for display in the general section
  	// Note: we set the array this way for easier display of additional info
  	//			without duplicating the general info tags
  	$generalFields = array('245a'=>'245a', // title
  							'245b'=>'245b', // title_remainder
    	  					'100a'=>'100a', // author
    	  					'245c'=>'245c', // responsibility_stmt
    	  					'655a'=>'655a', // primary genre
    	  					'650a'=>'650a' // topic 1
    	  				   );

  	$entryFields = $biblio->getBiblioFields();
  	$smarty->assign("entry",$biblio);
	uksort($entryFields,"tagCmp");

	$smarty->assign("generalFields", $generalFields);


  	// get the descriptors for the custom Material fields this entry uses
	$matFldQ = new MaterialFieldQuery();
  	$customMaterialFields = $matFldQ->getMaterialWithCode($biblio->getMaterialCd());
	unset($matFldQ);

	// add the custom fields (if any) to the main subfields
    foreach($customMaterialFields as $row)
  	{
  		$idx = makeCompositeTag($row->tag, $row->subfieldCd);
  		if(!isset($entryFields[$idx])) continue;

  		$subfld = new UsmarcSubfieldDm();
  		$subfld->setTag($row->tag);
  		$subfld->setSubfieldCd($row->subfieldCd);
  		$subfld->setDescription($row->descr);
  		$marcSubflds[$idx]=$subfld;

 		if($row->ctrltype == 3) // check if the custom field is a select/list box
  		{
  			$fldVals = makeAssocFromString($row->ctrlvalues,",",true);
  			$entryFields[$idx]->setFieldData($fldVals[$entryFields[$idx]->getFieldData()]);
  		}
  	}
  	unset($customMaterialFields);

  	$smarty->assign("material",$mats[$biblio->getMaterialCd()]);
  	$smarty->assign("collection",$cols[$biblio->getCollectionCd()]);
  	$smarty->assign("audience",$auds[$biblio->getAudienceCd()]);

  	// !----- Set Tag Descriptions -----
	// extract just the descriptions we need
	// and remove any fields that contain no data (only general fields will be like this)
	$tagDescs = array();
  	while(list($tagIdx,$field) = each($entryFields))
  	{
  		if(($field->getFieldData())=="")
  		{
  			unset($entryFields[$tagIdx]);
  			continue;
  		}
  		$desc = marcTagDesc($tagIdx,$marcTags, $marcSubflds);
  		$tagDescs[$tagIdx] = ($desc !== false)?$desc:$loc->getText("catalogEntry_viewTagDescriptionNotFound",array('tag'=>$tagIdx));
  	}
  	$smarty->assign("tagDescs",$tagDescs);
  	$smarty->assign("entryFields",$entryFields);
  	unset($tagDescs);
  	unset($marcTags);
  	unset($marcSubflds);

  	// !--- Get the copies Info ---
  	$copyQ = new BiblioCopyQuery();
  	if (!$copyQ) {
  	  // display error message
  	}
  	$copies = $copyQ->getAllCopies($bibid);

  	if ($copies !== false)
  	{
  		$copiesExtraInfo = array();
  		while(list(,$aCopy) = each($copies))
  		{
			$filepath = ROOT_ARCHIVES_PATH.$aCopy->getFilePath();
  			if(!file_exists($filepath))
  			{
   				$size = 0;
  				$playtime = '';
  				$errorMsg = $loc->getText("catalogEntry_viewCopyNotFoundError");
  				goto SET_ATTRIBS;
  			}
  			$errorMsg = null;
  			// file size calculator
			$size = round(((filesize($filepath) / 1024) / 1024), 2)." Mb";
			$playtime = "";
			// file time calculator


	 	    $pt = $entryFields["306a"]->getFieldData();
        	if ((isset($pt)) && (strlen($pt) >= 6))
			{
			    $hours = substr($pt, 0 , 2);
			    $minutes = 	substr($pt, 2 , 2);
			    if ($minutes == '00')
			    { $playtime = "$hours hours"; }
			    else
			    { $playtime = "$hours hours $minutes minutes"; }
			}
			SET_ATTRIBS:
			$copiesExtraInfo[] = array('fileSize'=>$size,'playTime'=>$playtime,'errMsg'=>$errorMsg);

  		}

  		$smarty->assign("copies",$copies);
  		$smarty->assign("copiesExtraInfo",$copiesExtraInfo);

  	}

	// assorted labels
	$labels = array("newCopyButtonLabel"=>$loc->getText("catalogEntry_viewAddCopyLabel"),
					"material"=>$loc->getText("catalogEntry_viewMaterialType"),
					"collection"=>$loc->getText("catalogEntry_viewCollectionType"),
					"audience"=>$loc->getText("catalogEntry_viewAudienceType"),
					"noCopiesFoundMsg"=>$loc->getText("catalogEntry_viewNoCopiesFound"),
					"editCopyButtonLabel"=>$loc->getText("catalogEntry_viewEditCopyButtonLabel"),
					"delCopyButtonLabel"=>$loc->getText("catalogEntry_viewDeleteCopyButtonLabel"),
					"copyTypeLabel"=>$loc->getText("catalogEntry_viewCopyType"),
					"copySizeLabel"=>$loc->getText("catalogEntry_viewCopySize"),
					"copyReadingTimeLabel"=>$loc->getText("catalogEntry_viewCopyReadingTime"),
					"restrictedWarning"=>$loc->getText("catalogEntry_viewRestrictedAdminWarning"),
					"generalInfoLabel"=>$loc->getText("catalogEntry_viewGeneralInfo"),
					"editBasicButtonLabel"=>$loc->getText("catalogEntry_viewEditBasicButtonLabel"),
					"viewMarcButtonLabel"=>$loc->getText("catalogEntry_viewViewMarcButtonLabel"),
					"newLikeButtonLabel"=>$loc->getText("catalogEntry_viewNewLikeButtonLabel"),
					"deleteButtonLabel"=>$loc->getText("catalogEntry_viewDeleteButtonLabel"),
					"callNumberLabel"=>$loc->getText("catalogEntry_viewCallNumber"),
					"restrictedLabel"=>$loc->getText("catalogEntry_viewRestricted"),
					"showInOpacLabel"=>$loc->getText("catalogEntry_viewShowInOpac"),
					"saleableLabel"=>$loc->getText("catalogEntry_viewSaleable"),
					"deleteConfirmLabel"=>$loc->getText("catalogEntry_viewEntryDeleteConfirm"),
					"deleteConfirmCopyLabel"=>$loc->getText("catalogEntry_viewEntryDeleteCopyConfirm"),
					"yesLabel"=>$loc->getText("AnswerYes"),
					"noLabel"=>$loc->getText("AnswerNo"),
					"additionalInfoLabel"=>$loc->getText("catalogEntry_viewAdditionalInfo")

					);

	// !----- Misc Smarty Assignments -----
  	$smarty->assign("bibid",$bibid);
	$smarty->assign("labels",$labels);

	$smarty->display("catalog/entry_admin_view.tpl","catalog");

	exit;
