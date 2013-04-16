<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "catalog";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
 	session_cache_limiter(null);

  	$nav = "new";
  	$helpPage = "catalog";
  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/Biblio.php");
  	require_once(__ROOT__."classes/BiblioField.php");
	require_once(__ROOT__."classes/BiblioFieldQuery.php");
  	require_once(__ROOT__."classes/DmQuery.php");
  	require_once(__ROOT__."classes/UsmarcTagDm.php");
  	require_once(__ROOT__."classes/UsmarcTagDmQuery.php");
  	require_once(__ROOT__."classes/UsmarcSubfieldDm.php");
  	require_once(__ROOT__."classes/UsmarcSubfieldDmQuery.php");
  	require_once(__ROOT__."classes/MaterialFieldQuery.php");
  	require_once(__ROOT__."functions/marcFuncs.php");
  	require_once(__ROOT__."functions/arrayFuncs.php");

 	#****************************************************************************
  	#*  Loading a few domain tables into associative arrays
  	#****************************************************************************
  	$dmQ = new DmQuery();
	$cols = $dmQ->getAssoc("collection_dm");
	$mats = $dmQ->getAssoc("material_type_dm");

  	$marcTagDmQ = new UsmarcTagDmQuery();
  	$marcTags = $marcTagDmQ->getAllTags();
  	unset($marcTagDmQ);

  	$marcSubfldDmQ = new UsmarcSubfieldDmQuery();
  	$marcSubflds = $marcSubfldDmQ->getAllSubfields();
  	unset($marcSubfldDmQ);

  	$fields = array();

	$generalIds = array('245a'=>'245a', // title
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

   	$otherIds = array("010a"=>"",
   							"020a"=>"",
   							"020c"=>"",
   							"035a"=>"",
   							"082a"=>"",
   							"0822"=>"",
   							"260a"=>"",
   							"260b"=>"",
   							"260c"=>"",
   							"520a"=>"",
   							"300b"=>"",
   							"300c"=>"",
   							"300e"=>""
   							);
   	// sort the fields so we dont have to work it out by hand
   	uksort($otherIds,"tagCmp");

	$inputTypes = array("textfield","textarea","checkbox","select");

	// !--- Set the fields required for validation
	// material Specific fields are added later
	$reqFlds = array('100a'=>'','245a'=>'','035a'=>'');

  	// !--- first add the general fields

	// no easy way to set this universally so here we are
	$customFieldOptions = array('520a'=>array('type'=>'textarea','options'=>array('cols'=>"50",'rows'=>'5')), // summary
  								'035a'=>array('type'=>'textfield','options'=>array('size'=>"20",'maxlength'=>'20')), // sys num
  								'306a'=>array('type'=>'textfield','options'=>array('size'=>"10",'maxlength'=>'10'))
  								);

  	$fields = $validators = $tempGeneral = array();
  	$defaultTextfieldOptions = array("size"=>"60","maxlength"=>"1000");

	// !----- Separate the fields into sections-----
	// Genaral
  	while(list($tagIdx,) = each($generalIds))
  	{
  			$desc = marcTagDesc($tagIdx, $marcTags, $marcSubflds);
  			$fields["general"][$tagIdx]["desc"] = ($desc !== false)?$desc:$loc->getText("catalogEntry_viewTagDescriptionNotFound",array('tag'=>$tagIdx));

  			$fields["general"][$tagIdx]["options"] = (!isset($customFieldOptions[$tagIdx]))?$defaultTextfieldOptions:$customFieldOptions[$tagIdx]["options"];
  			$fields["general"][$tagIdx]["type"] = (!isset($customFieldOptions[$tagIdx]))?"textfield":$customFieldOptions[$tagIdx]["type"];
  			$fields["general"][$tagIdx]["field"] = new BiblioField();

  			// add the validator if required
  			if(isset($reqFlds[$tagIdx]))
  			{
  				$fields["general"][$tagIdx]["required"] = true;
  				$validators[$tagIdx]["v_".$tagIdx."_NE"] = array("field"=>"flds[$tagIdx]",
  															"crit"=>"notEmpty",
  															"msg"=>$loc->getText("catalogValidate_isRequired",array('tag'=>$tagIdx)));
			}
  	}
  	$biblio = new Biblio();
  	$biblio->setIsRestricted(true);

	// check if we are changing material types
	$matId = isset($_POST['chmid'])?$_POST['chmid']:(isset($_POST['matid']))?$_POST['matid']:null;
	if(!isset($matId))
	{
		$row = $dmQ->getDefault("material_type_dm");
		$matId = $row->getCode();
	}


  	// get the descriptors for the custom Material fields this entry uses
	$matFldQ = new MaterialFieldQuery();
  	$matFields = $matFldQ->getMaterialWithCode($matId);

	unset($matFldQ);
	if (empty($matFields)) goto OTHER;
  	// Material Specific
   	while(list($tagIdx,$fld) = each($matFields))
  	{
  			$fields["material"][$tagIdx]["field"] = new BiblioField();
  			$fields["material"][$tagIdx]["desc"] = $fld->descr;
  			$fields["material"][$tagIdx]["type"] = $inputTypes[$fld->ctrltype];
  			$fields["material"][$tagIdx]["ctrltype"] = $fld->ctrltype;

  			// set the specifics of values depending on the control type
  			switch ($matFields[$tagIdx]->ctrltype)
  			{
  				case 0: // textfield
  					$fields["material"][$tagIdx]['options'] = (isset($customFieldOptions[$tagIdx]))?$customFieldOptions[$tagIdx]['options']:$defaultTextfieldOptions;
  					$fields["material"][$tagIdx]['value'] = $fld->ctrlvalues;
  					break;
  				case 1: // textarea
  					$fields["material"][$tagIdx]['options'] = (isset($customFieldOptions[$tagIdx]))?$customFieldOptions[$tagIdx]['options']:array('options'=>array("cols"=>"50","rows"=>"5"));
  					$fields["material"][$tagIdx]['value'] = $fld->ctrlvalues;
  					break;
  				case 2: // checkbox
  					$fields["material"][$tagIdx]['value'] = $fld->ctrlvalues;
  					break;
  				case 3: // select box
  					$fldOpts = explode('|', $fld->ctrlvalues);
  					$fields["material"][$tagIdx]['options'] = makeAssocFromString($fldOpts[0],",",true);
  					$fields["material"][$tagIdx]['selected'] = (isset($fldOpts[1]))?$fldOpts[1]:null;
  					break;
  			}

  			// add the validator if required
  			if($fld->required)
  			{
  				$fields["material"][$tagIdx]["required"] = true;
  				$validators[$tagIdx]["v_".$tagIdx."_NE"] = array("field"=>"flds[$tagIdx]",
  															"crit"=>"notEmpty",
  															"msg"=>$loc->getText("catalogValidate_isRequired",array('tag'=>$tagIdx)));
  			}


  	}

  	OTHER:
  	// Other
   	while(list($tagIdx,) = each($otherIds))
  	{
  		$fields["other"][$tagIdx]["field"] = new BiblioField();
  		$desc = marcTagDesc($tagIdx,$marcTags, $marcSubflds);
  		$fields["other"][$tagIdx]["desc"] = ($desc !== false)?$desc:$loc->getText("catalogEntry_viewTagDescriptionNotFound",array('tag'=>$tagIdx));
  		$fields["other"][$tagIdx]["options"] = (!isset($customFieldOptions[$tagIdx]))?$defaultTextfieldOptions:$customFieldOptions[$tagIdx]["options"];
  		$fields["other"][$tagIdx]["type"] = (!isset($customFieldOptions[$tagIdx]))?"textfield":$customFieldOptions[$tagIdx]["type"];
  		// add the validator if required
  		if(isset($reqFlds[$tagIdx]))
  		{
  			$fields["other"][$tagIdx]["required"] = true;
  			$validators[$tagIdx]["v_".$tagIdx."_NE"] = array("field"=>"flds[$tagIdx]",
  														"crit"=>"notEmpty",
  														"msg"=>$loc->getText("catalogValidate_isRequired",array('tag'=>$tagIdx)));
		}

  	}

  	$matType = array('label'=>$loc->getText("catalogEntry_viewMaterialType"));
  	$colType = array('label'=>$loc->getText("catalogEntry_viewCollectionType"));

  	unset($marcTags);
  	unset($marcSubflds);
  	if(isset($fields["material"]))
	  	uksort($fields["material"],"tagCmp");
  	uksort($fields["other"],"tagCmp");

  	// --- Setup the custom field validators
   	$validators["035a"]["v_035a_IU"] = array("field"=>"flds[035a]:35:a",
  											"crit"=>"isUnique",
  											"msg"=>$loc->getText("catalogValidate_notUnique",array("tag"=>"035a")));
  	$bibFldQ = new BiblioFieldQuery();
  	SmartyValidate::register_object('fieldQry',$bibFldQ);

	// ! ----- Check for POST
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

		$matType['selected'] = $matId;
		$row = $dmQ->getDefault("collection_dm");
  		$colType['selected'] = $row->getCode();

  	}
  	else // $_POST vars sent
  	{
		SmartyValidate::connect($smarty);
       	if($_POST["chmid"] != '') goto MATERIAL_CHANGED; // check for a material change
       	if(SmartyValidate::is_valid($_POST))
       	{
       		// no errors
       		SmartyValidate::disconnect();

  			$biblio->setMaterialCd($_POST["matid"]);
  			$biblio->setCollectionCd($_POST["colid"]);
  			$biblio->setCallNmbr1(isset($_POST["callno1"])?$_POST["callno1"]:'');
  			$biblio->setCallNmbr2(isset($_POST["callno2"])?$_POST["callno2"]:'');
  			$biblio->setCallNmbr3(isset($_POST["callno3"])?$_POST["callno3"]:'');
  			$biblio->setLastChangeUserid($_SESSION['_admin']['staffid']);
  			$biblio->setOpacFlg(isset($_POST["showinopac"]));
  			$biblio->setIsRestricted(isset($_POST["restr"]));
  			$biblio->setIsSaleable(isset($_POST["saleable"]));

  			while(list($tagIdx,$data) = each($_POST["flds"]))
  			{
  				$fld = new BiblioField();
				$fld->setTag(substr($tagIdx,0,3));
				$fld->setSubfieldCd(substr($tagIdx,3,1));
				$fld->setFieldData($data);
  				$biblio->addField($fld,$tagIdx);
  			}

 			require_once(__ROOT__."classes/BiblioQuery.php");
 			$biblioQ = new BiblioQuery();
 			$newBibid = $biblioQ->insert($biblio);
  			if($newBibid !== false)
	  		{
	  			// update the search index
				require_once(__ROOT__."classes/SearchIndex.php");
				$si = new SearchIndex();
  				$si->regenerateAllIndexes($newBibid);
  				unset($si);
	  			header("Location: entry_view.php?bid=".HURL($newBibid)."&msg=".HURL($loc->getText('catalogEntry_newSuccess')));
	  		}
			else
				header("Location: catalog_search.php?msg=".HURL($loc->getText('catalogEntry_newError')));
			exit;
		}
  		else // failed validation or changed Material type
  		{
  			$smarty->assign("contentStatusMsg",$loc->getText('catalogEntry_editValidationError'));

  			MATERIAL_CHANGED:
  			// repopulate the fields with the contents of the $_POST
  			$smarty->assign($_POST);
  			while(list($tagIdx,$data) = each($_POST["flds"]))
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
  							$fields["material"][$tagIdx]['selected'] = (isset($_POST["flds"][$tagIdx]))?$data:false;
  							break;
  						default:
  							$fields["material"][$tagIdx]['value'] = (isset($_POST["flds"][$tagIdx]))?$data:'';
  					}
  					continue;
  				}

  				if(isset($fields["general"][$tagIdx]))
  				{
  					$fields["general"][$tagIdx]["field"]->setFieldData($data);
  					continue;
  				}

  				if(isset($fields["other"][$tagIdx]))
  				{
  					$fields["other"][$tagIdx]["field"]->setFieldData($data);
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


  			$matType['selected'] = $_POST['matid'];
  			$colType['selected'] = $_POST['colid'];

  		}
  	}
  	unset($dmQ);

  	// !----- Build the input field requirements  -----
	$smarty->assign("fields",$fields);
	$smarty->assign("contentHeader",$loc->getText("catalogEntry_newHeader"));
	unset($fields);

  	$smarty->assign("validators",$validators);
  	$smarty->assign("materialType",$matType);
  	$smarty->assign("collectionType",$colType);
  	$smarty->assign("materials",$mats);
  	$smarty->assign("collections",$cols);
  	unset($mats);
  	unset($cols);
  	unset($matType);
  	unset($colType);

  	$smarty->assign("entry",$biblio);

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
	$smarty->display("catalog/entry_new.tpl","catalog");

	exit;
