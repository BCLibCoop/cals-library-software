<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  	$tab = "catalog";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
 	session_cache_limiter(null);

  	if(!(checkPassedIn(array('bid'),$_GET,$_POST)))
	{
		header("Location: catalog_search.php");
		exit;
	}

  	$nav = "entryNewLike";
  	$helpPage = "catalog";
  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/Biblio.php");
  	require_once(__ROOT__."classes/BiblioField.php");
  	require_once(__ROOT__."classes/BiblioQuery.php");
	require_once(__ROOT__."classes/BiblioFieldQuery.php");
  	require_once(__ROOT__."classes/DmQuery.php");
  	require_once(__ROOT__."classes/UsmarcTagDm.php");
  	require_once(__ROOT__."classes/UsmarcTagDmQuery.php");
  	require_once(__ROOT__."classes/UsmarcSubfieldDm.php");
  	require_once(__ROOT__."classes/UsmarcSubfieldDmQuery.php");
  	require_once(__ROOT__."classes/MaterialFieldQuery.php");
  	require_once(__ROOT__."functions/marcFuncs.php");
  	require_once(__ROOT__."functions/arrayFuncs.php");

  	$bibid = (isset($_GET["bid"]))?$_GET["bid"]:$_POST["bid"];

  	// !--- Setup the field section specifics
  	$generalFields = array('245a'=>'245a', // title
  							'245b'=>'245b', // title_remainder
    	  					'100a'=>'100a', // author
    	  					'245c'=>'245c', // responsibility_stmt
    	  					'655a'=>'655a', // primary genre
    	  					'650a'=>'650a', // topic 1
    	  				   	'650a-1'=>'650a-1', // topic 2
    	  				   	'650a-2'=>'650a-2', // topic 3
    	  				   	'650a-3'=>'650a-3', // topic 4
    	  				   	'650a-4'=>'650a-4' // topic 5
    	  				   );
    // !--- Set the fields required for validation
	// material Specific fields are added later
	$reqFlds = array('100a'=>'','245a'=>'','035a'=>'');
    $defaultTextfieldOptions = array("size"=>"60","maxlength"=>"1000");
	$inputTypes = array("textfield","textarea","checkbox","select");

  	// !--- first add the general fields
	// no easy way to set this universally so here we are
	$customFieldOptions = array('520a'=>array('type'=>'textarea','options'=>array('cols'=>"50",'rows'=>'5')), // summary
  								'035a'=>array('type'=>'textfield','options'=>array('size'=>"20",'maxlength'=>'20')), // sys num
  								'306a'=>array('type'=>'textfield','options'=>array('size'=>"10",'maxlength'=>'10'))
  								);

   	$dmQ = new DmQuery();
	$cols = array("types"=>$dmQ->getAssoc("collection_dm"));
	$mats = array("types"=>$dmQ->getAssoc("material_type_dm"));

  	$biblio = new Biblio();
  	$bibFldQ = new BiblioFieldQuery();

  	if ($bibid == 0) // Posted changes back to this page for validation or getting values from a z39.50 search
  	{
  		if (!isset($_POST["flds"]) || empty($_POST["flds"]))
  		{
  			header("Location: catalog_search.php");
			exit;
  		}
  		$entryFields = array();
  		foreach($_POST["flds"] as $tag=>$data)
  		{
  			$fld = new biblioField();
  			$fld->setTag(substr($tag,0,3));
  			$fld->setSubfieldCd(((strlen($tag)>3)?substr($tag,3,1):""));
  			$fld->setFieldData($data);
  			$entryFields[$tag]=$fld;
  		}

  		// check if the post is coming from an external server search
  		if (!isset($_POST["matid"]))
  		{
  			$defMat = $dmQ->getDefault("material_type_dm");
			$defColl = $dmQ->getDefault("collection_dm");
			$mats["selected"] = $defMat->getCode();
	  		$cols["selected"] = $defColl->getCode();
  			$_POST = array();
  			//dd($_POST);
  		}
  		else // posting back from the new like page
  		{
  			$mats['selected'] = $_POST["matid"];
	  		$cols['selected'] = $_POST["colid"];
  		}
  	}
  	else // get the entry that the new entry will be like
  	{
  		// !--- Get entry Info ---
		$biblioQ = new BiblioQuery();
	  	$biblio = $biblioQ->getEntry($bibid,false,$reqFlds);
	  	if (!$biblio) {
	  	  echo "error";
	  	  exit;
	  	}
	  	// get the bulk of the fields separately to reduce memory consumption
	  	// due to the biblio object containing a duplicate set of fields

	  	$entryFields = $bibFldQ->getAllFields($bibid,$reqFlds);
	  	$entryFields = $entryFields + $biblio->getBiblioFields();
  		$mats["selected"] = $biblio->getMaterialCd();
  		$cols["selected"] = $biblio->getCollectionCd();
  		$_POST = array();
  		unset($biblioQ);
  	}

  	unset($dmQ);

  	reset($entryFields);
  	$bibid = 0; // reset the bibid for later use

  	#****************************************************************************
  	#*  Loading a few domain tables into associative arrays
  	#****************************************************************************

  	$marcTagDmQ = new UsmarcTagDmQuery();
  	$marcTags = $marcTagDmQ->getAllTags();
  	unset($marcTagDmQ);

  	$marcSubfldDmQ = new UsmarcSubfieldDmQuery();
  	$marcSubflds = $marcSubfldDmQ->getAllSubfields();
  	unset($marcSubfldDmQ);

  	$fields = $validators = $tempGeneral = array();

  	$matFldQ = new MaterialFieldQuery();
  	$matFields = $matFldQ->getMaterialWithCode($mats['selected']);
	unset($matFldQ);

	// build the different sections for display
	// !----- Separate the fields into sections -----
  	while(list($tagIdx,$field) = each($entryFields))
  	{
  		$field->setBibid(0);
  		$field->setFieldid(0);

  		if(isset($generalFields[$tagIdx]))
  		{
  			$tempGeneral[$tagIdx]["field"] = $field;
  			$desc = marcTagDesc($tagIdx, $marcTags, $marcSubflds);
  			$tempGeneral[$tagIdx]["desc"] = ($desc !== false)?$desc:$loc->getText("catalogEntry_viewTagDescriptionNotFound",array('tag'=>$tagIdx));

  			$tempGeneral[$tagIdx]["options"] = (!isset($customFieldOptions[$tagIdx]))?$defaultTextfieldOptions:$customFieldOptions[$tagIdx]["options"];
  			$tempGeneral[$tagIdx]["type"] = (!isset($customFieldOptions[$tagIdx]))?"textfield":$customFieldOptions[$tagIdx]["type"];

  			// add the validator if required
  			if($field->getIsRequired())
  			{
  				$validators[$tagIdx]["v_".$tagIdx."_NE"] = array("field"=>"flds[$tagIdx]",
  															"crit"=>"notEmpty",
  															"msg"=>$loc->getText("catalogValidate_isRequired",array('tag'=>$tagIdx)));
			}
  			continue;
  		}

  		if(isset($matFields[$tagIdx]))
  		{
  			$fields["material"][$tagIdx]["field"] = $field;
  			$fields["material"][$tagIdx]["desc"] = $matFields[$tagIdx]->descr;
  			$fields["material"][$tagIdx]["type"] = $inputTypes[$matFields[$tagIdx]->ctrltype];
  			$fields["material"][$tagIdx]["ctrltype"] = $matFields[$tagIdx]->ctrltype;

  			// set the specifics of values depending on the control type
  			switch ($matFields[$tagIdx]->ctrltype)
  			{
  				case 0: // textfield
  					$fields["material"][$tagIdx]['options'] = (isset($customFieldOptions[$tagIdx]))?$customFieldOptions[$tagIdx]['options']:$defaultTextfieldOptions;
  					break;
  				case 1: // textarea
  					$fields["material"][$tagIdx]['options'] = (isset($customFieldOptions[$tagIdx]))?$customFieldOptions[$tagIdx]['options']:array('options'=>array("cols"=>"50","rows"=>"5"));
  					break;
  				case 2: // checkbox
  					$fields["material"][$tagIdx]['value'] = $matFields[$tagIdx]->ctrlvalues;
  					break;
  				case 3: // select box
  					$opts = makeAssocFromString($matFields[$tagIdx]->ctrlvalues,",",true,false);
					$fields["material"][$tagIdx]['selected'] = key($opts);
					asort($opts);
  					$fields["material"][$tagIdx]['options'] = $opts;
  					break;
  			}

  			// add the validator if required
  			if($matFields[$tagIdx]->required)
  			{
  				$fields["material"][$tagIdx]["required"] = true;
  				$validators[$tagIdx]["v_".$tagIdx."_NE"] = array("field"=>"flds[$tagIdx]",
  															"crit"=>"notEmpty",
  															"msg"=>$loc->getText("catalogValidate_isRequired",array('tag'=>$tagIdx)));
  			}
  			continue;
  		}

  		// add all other fields not in the General or custom material sections
  		$fields["other"][$tagIdx]["field"] = $field;
  		$desc = marcTagDesc($tagIdx,$marcTags, $marcSubflds);
  		$fields["other"][$tagIdx]["desc"] = ($desc !== false)?$desc:$loc->getText("catalogEntry_viewTagDescriptionNotFound",array('tag'=>$tagIdx));
  		$fields["other"][$tagIdx]["options"] = (!isset($customFieldOptions[$tagIdx]))?$defaultTextfieldOptions:$customFieldOptions[$tagIdx]["options"];
  		$fields["other"][$tagIdx]["type"] = (!isset($customFieldOptions[$tagIdx]))?"textfield":$customFieldOptions[$tagIdx]["type"];
  		// add the validator if required
  		if($field->getIsRequired())
  		{
  			$validators[$tagIdx]["v_".$tagIdx."_NE"] = array("field"=>"flds[$tagIdx]",
  														"crit"=>"notEmpty",
  														"msg"=>$loc->getText("catalogValidate_isRequired",array('tag'=>$tagIdx)));
		}

  	}
  	// !--- Add any required fields if they are not already there
  	foreach ($reqFlds as $tagIdx=>$dummy)
  	{
  		if((!isset($fields["other"][$tagIdx])) && (!isset($fields["material"][$tagIdx])) && (!isset($tempGeneral[$tagIdx])))
  		{
  			$fields["other"][$tagIdx]["required"] = true;
  			$fields["other"][$tagIdx]["field"] = new BiblioField();
  			$desc = marcTagDesc($tagIdx,$marcTags, $marcSubflds);
  			$fields["other"][$tagIdx]["desc"] = ($desc !== false)?$desc:$loc->getText("catalogEntry_viewTagDescriptionNotFound",array('tag'=>$tagIdx));
  			$fields["other"][$tagIdx]["options"] = (!isset($customFieldOptions[$tagIdx]))?$defaultTextfieldOptions:$customFieldOptions[$tagIdx]["options"];
  			$fields["other"][$tagIdx]["type"] = (!isset($customFieldOptions[$tagIdx]))?"textfield":$customFieldOptions[$tagIdx]["type"];
  			// add the validator
  			$validators[$tagIdx]["v_".$tagIdx."_NE"] = array("field"=>"flds[$tagIdx]",
  															"crit"=>"notEmpty",
  															"msg"=>$loc->getText("catalogValidate_isRequired",array('tag'=>$tagIdx)));

  		}
  	}

  	// !--- reSort the general fields into a more aesthetically pleasing order
  	foreach ($generalFields as $tagIdx=>$dummy)
  	{
  		if(isset($tempGeneral[$tagIdx]))
  			$fields["general"][$tagIdx] = $tempGeneral[$tagIdx];
  	}
  	unset($tempGeneral);

  	if (empty($matFields)) goto DISPLAY;

  	// !--- add any material specific fields that did not have values in the entry
  	foreach($matFields as $tagIdx=>$fld)
  	{
  		if(!isset($fields["material"][$tagIdx]))
  		{
  		 	$fields["material"][$tagIdx]["desc"] = $matFields[$tagIdx]->descr;
  			$fields["material"][$tagIdx]["type"] = $inputTypes[$matFields[$tagIdx]->ctrltype];
  			$fields["material"][$tagIdx]["ctrltype"] = $matFields[$tagIdx]->ctrltype;

  			// set the specifics of values depending on the control type
  			switch ($matFields[$tagIdx]->ctrltype)
  			{
  				case 0: // textfield
  					$fields["material"][$tagIdx]['options'] = (isset($customFieldOptions[$tagIdx]))?$customFieldOptions[$tagIdx]['options']:$defaultTextfieldOptions;
  					break;
  				case 1: // textarea
  					$fields["material"][$tagIdx]['options'] = (isset($customFieldOptions[$tagIdx]))?$customFieldOptions[$tagIdx]['options']:array('options'=>array("cols"=>"50","rows"=>"5"));
  					break;
  				case 2: // checkbox
  					$fields["material"][$tagIdx]['value'] = $matFields[$tagIdx]->ctrlvalues;
  					break;
  				case 3: // select box
  					$opts = makeAssocFromString($matFields[$tagIdx]->ctrlvalues,",",true,false);
					$fields["material"][$tagIdx]['selected'] = key($opts); // set the default selected item
					asort($opts);
  					$fields["material"][$tagIdx]['options'] = $opts;
  					break;
  			}

  			// add the validator if required
  			if($matFields[$tagIdx]->required)
  			{
  				$fields["material"][$tagIdx]["required"] = true;
  				$validators[$tagIdx]["v_".$tagIdx."_NE"] = array("field"=>"flds[$tagIdx]",
  															"crit"=>"notEmpty",
  															"msg"=>$loc->getText("catalogValidate_isRequired",array('tag'=>$tagIdx)));
  			}

  		}
  	}

  	DISPLAY:

  	$mats['label'] = $loc->getText("catalogEntry_viewMaterialType");
  	$cols['label'] = $loc->getText("catalogEntry_viewCollectionType");

  	unset($marcTags);
  	unset($marcSubflds);
  	if(isset($fields["material"]))
	  	uksort($fields["material"],"tagCmp");
  	uksort($fields["other"],"tagCmp");

  	// --- Setup the custom field validators
  	$validators["035a"]["v_035a_IU"] = array("field"=>"flds[035a]:35:a",
  											"crit"=>"isUnique",
  											"msg"=>$loc->getText("catalogValidate_notUnique",array("tag"=>"035a")));
  	SmartyValidate::register_object('fieldQry',$bibFldQ);

	reset($entryFields);
  	// ! ----- Check for $_POST
  	if (empty($_POST))
  	{
  		SmartyValidate::connect($smarty,true);
		SmartyValidate::register_criteria('isUnique','fieldQry->isUnique');
		// register validators
		while(list(,$aVal) = each($validators))
		{
			foreach($aVal as $id=>$part)
			{
				SmartyValidate::register_validator($id, $part["field"], $part["crit"], false, false, 'trim');
			}
		}

  		if(!empty($fields["material"]))
  		{
  		 	// get the initial values from the db
  			foreach($fields["material"] as $idx=>$part)
  			{
  				// set the specifics of values depending on the control type
  				switch ($part['ctrltype'])
  				{
  				    case 2: // checkbox
  				    	$fields["material"][$idx]['checked'] = (isset($part["field"]))?$part["field"]->getFieldData():'';
  				    	break;
  				    case 3: // select box
  				    	$fields["material"][$idx]['selected'] = (isset($part["field"]))?$part["field"]->getFieldData():$fields["material"][$idx]['selected'];
  				    	break;
  				    default:
  				    	$fields["material"][$idx]['value'] = (isset($part["field"]))?$part["field"]->getFieldData():'';
  				}
			}
  		}
  	}
  	else // $_POST vars sent
  	{
		SmartyValidate::connect($smarty);
       	if($_POST["chmid"] != '') goto MATERIAL_CHANGED; // check for a material change
       	if(SmartyValidate::is_valid($_POST))
       	{
       		// no errors
       		SmartyValidate::disconnect();
			$biblio = new Biblio();
  			$biblio->setMaterialCd($_POST["matid"]);
  			$biblio->setCollectionCd($_POST["colid"]);
  			$biblio->setCallNmbr1(isset($_POST["callno1"])?$_POST["callno1"]:'');
  			$biblio->setCallNmbr2(isset($_POST["callno2"])?$_POST["callno2"]:'');
  			$biblio->setCallNmbr3(isset($_POST["callno3"])?$_POST["callno3"]:'');
  			$biblio->setLastChangeUserid($_SESSION['_admin']['staffid']);
  			$biblio->setOpacFlg(isset($_POST["showinopac"]));
  			$biblio->setIsRestricted(isset($_POST["restr"]));
  			$biblio->setIsSaleable(isset($_POST["saleable"]));

  			while(list($tagIdx,$aField) = each($entryFields))
  			{
  				if(isset($_POST["flds"][$tagIdx]))
  				{
	  				$aField->setFieldData($_POST["flds"][$tagIdx]);
	  				unset($_POST["flds"][$tagIdx]);
  				}
  				else
  				{
  					// field not found in the POST so set the data portion
  					// to empty which will remove it during the update
  					$aField->setFieldData("");
  				}
 				$biblio->updateField($aField,$tagIdx);
  			}

  			// check for remaining fields in the POST which need to be added
  			while(list($tagIdx,$data) = each($_POST["flds"]))
  			{
  				$fld = new BiblioField();
				$fld->setTag(substr($tagIdx,0,3));
				$fld->setSubfieldCd(substr($tagIdx,3,1));
				$fld->setFieldData($data);
				// check if it was listed in the custom material fields
				$fld->setIsRequired(isset($fields["material"][$tagIdx]["required"]));
  				$biblio->addField($fld,$tagIdx);
  			}
 			$biblioQ = new BiblioQuery();
 			$newBibid = $biblioQ->insert($biblio);
  			if($newBibid !== false)
	  		{

	  			// update the search index
				require_once(__ROOT__."classes/SearchIndex.php");
				$si = new SearchIndex();
  				$si->regenerateAllIndexes($newBibid);
  				unset($si);

	  			header("Location: entry_view.php?bid=".HURL($newBibid)."&msg=".HURL($loc->getText('catalogEntry_newLikeSuccess')));

	  		}
			else
				header("Location: catalog_search.php?msg=".HURL($loc->getText('catalogEntry_newLikeError',array('title'=>$fields["general"]['245a']["field"]->getFieldData()))));

			exit;

		}
  		else // failed validation or changed Material type
  		{
  			$smarty->assign("contentStatusMsg",$loc->getText('catalogEntry_editValidationError'));

  			MATERIAL_CHANGED:
  			// repopulate the fields with the contents of the $_POST
  			$smarty->assign($_POST);
			//dd($_POST);
  			while(list($tagIdx,) = each($_POST["flds"]))
  			{
  				// check if its a custom material field
  				if(isset($fields["material"][$tagIdx]))
  				{
  					// set the specifics of values depending on the control type
  					switch ($fields["material"][$tagIdx]['ctrltype'])
  					{
  						case 2: // checkbox
  							$fields["material"][$tagIdx]['checked'] = isset($_POST["flds"][$tagIdx]);
  							break;
  						case 3: // select box
  							$fields["material"][$tagIdx]['selected'] = (isset($_POST["flds"][$tagIdx]))?$_POST["flds"][$tagIdx]:$fields["material"][$tagIdx]['selected'];
  							break;
  						default:
  							$fields["material"][$tagIdx]['value'] = (isset($_POST["flds"][$tagIdx]))?$_POST["flds"][$tagIdx]:'';
  					}
  					continue;
  				}

  				if(isset($fields["general"][$tagIdx]))
  				{
  					$fields["general"][$tagIdx]["field"]->setFieldData($_POST["flds"][$tagIdx]);
  					continue;
  				}

  				if(isset($fields["other"][$tagIdx]))
  				{
  					$fields["other"][$tagIdx]["field"]->setFieldData($_POST["flds"][$tagIdx]);
  					continue;
  				}

  			}

  			// update the misc fields
  			$biblio->setCallNmbr1((isset($_POST["callno1"]))?$_POST["callno1"]:"");
  			$biblio->setCallNmbr2((isset($_POST["callno2"]))?$_POST["callno2"]:"");
  			$biblio->setCallNmbr3((isset($_POST["callno3"]))?$_POST["callno3"]:"");
  			$biblio->setIsRestricted(isset($_POST["restr"]));
  			$biblio->setOpacFlg(isset($_POST["showinopac"]));
  			$biblio->setIsSaleable(isset($_POST["saleable"]));

  		}
  	}

  	// !----- Build the input field requirements  -----
	$smarty->assign("fields",$fields);
	$smarty->assign("contentHeader",$loc->getText("catalogEntry_newLikeHeader",array('title'=>$fields["general"]['245a']["field"]->getFieldData())));
	unset($fields);

  	$smarty->assign("validators",$validators);
  	$smarty->assign("materials",$mats);
  	$smarty->assign("collections",$cols);
  	unset($mats);
  	unset($cols);

  	$smarty->assign("entry",$biblio);
	$smarty->assign("generalButtons",array('655a'=>'dummy'));

	// !----- Misc Smarty Assignments -----
	// assorted labels
	$labels = array("restrictedWarning"=>$loc->getText("catalogEntry_viewRestrictedAdminWarning"),
					"generalInfoLabel"=>$loc->getText("catalogEntry_viewGeneralInfo"),
					"tagLabel"=>$loc->getText("catalogEntry_editEditMarcTag"),
					"submitButtonLabel"=>$loc->getText("catalogAdd"),
					"cancelButtonLabel"=>$loc->getText("catalogBack"),
					"materialFieldsLabel"=>$loc->getText("catalogEntry_editMaterialFields"),
					"additionalInfoLabel"=>$loc->getText("catalogEntry_viewAdditionalInfo"),
					"callNumberLabel"=>$loc->getText("catalogEntry_viewCallNumber"),
					"restrictedLabel"=>$loc->getText("catalogEntry_viewRestricted"),
					"showInOpacLabel"=>$loc->getText("catalogEntry_viewShowInOpac"),
					"saleableLabel"=>$loc->getText("catalogEntry_viewSaleable"),
					"nextSysNumLabel"=>$loc->getText("catalogEntry_editGetNextSysNum"),
					"noMaterialsLabel"=>$loc->getText("catalogEntry_editNoMaterials"),
					"requiredWarning"=>$loc->getText("catalogFootnote",array("symbol"=>"*"))
					);

	$smarty->assign("labels",$labels);
  	$smarty->assign("bibid",$bibid);

	$smarty->display("catalog/entry_new_like.tpl","catalog");

	exit;
