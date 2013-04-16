<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "admin";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "materialMarcNew";
  $restrictInDemo = true;

	if (!isset($_GET["cd"]) && (empty($_POST))){
    	header("Location: ../admin/materials_list.php");
    	exit();
    }

    $mid = $msg = null;
	$mid=((isset($_GET["cd"])) && ($_GET['cd']!=''))?$_GET["cd"]:$_POST['mid'];

	if (!isset($mid))
		$msg = $loc->getText("adminMaterial_editInvalidMaterialId");
	if(isset($msg))
		header("Location: ../admin/material_marc_list.php?msg=".HURL($msg));

  	require_once(__ROOT__."admin/header_admin.php");
 	require_once(__ROOT__."classes/Dm.php");
  	require_once(__ROOT__."classes/DmQuery.php");
  	require_once(__ROOT__."classes/MaterialFieldQuery.php");

	$fields = null;
	$fields = array('descr'=>array('label'=>$loc->getText("adminDescription").' :',
									'field'=>array('type'=>'text',
	    											'name'=>'descr',
	    											'options'=>array('size'=>'40','maxlength'=>'64')),
	    							'validate'=>array('v_descNE'=>$loc->getText("adminValidateDescriptionNotEmpty"))),

	    			'tag'=>array('label'=>$loc->getText("adminMaterial_marcEditTag").' :',
									'field'=>array('type'=>'text',
	    											'name'=>'tag',
	    											'options'=>array('size'=>'3','maxlength'=>'3')),
	    							'validate'=>array('v_tagNE'=>$loc->getText("adminMaterial_marcEditTag").$loc->getText("adminMaterial_validateMarcNotEmptySuffix"),
	    												'v_tagII'=>$loc->getText("adminMaterial_validateMarcTagIsInteger"),
	    												'v_tagRa'=>$loc->getText("adminMaterial_validateMarcTagRange"))),
	    			'subfield'=>array('label'=>$loc->getText("adminMaterial_marcEditSubfield").' :',
									'field'=>array('type'=>'text',
	    											'name'=>'subfld',
	    											'options'=>array('size'=>'1','maxlength'=>'1')),
	    							'validate'=>array('v_subfieldNE'=>$loc->getText("adminMaterial_marcEditSubfield").$loc->getText("adminMaterial_validateMarcNotEmptySuffix"),
	    												'v_subfieldIA'=>$loc->getText("adminMaterial_validateMarcSubfieldIsAlphaNum"))),
					'ctrl'=>array('label'=>$loc->getText("adminMaterial_marcEditFieldType"),
									'field'=>array('type'=>'select',
	    											'name'=>'ctrltyp',
	    											'options'=>array('0'=>$loc->getText("adminMaterial_marcEditTextField"),
																		'2'=>$loc->getText("adminMaterial_marcEditCheckbox"),
																		'3'=>$loc->getText("adminMaterial_marcEditSelectList"),
																		'1'=>$loc->getText("adminMaterial_marcEditTextArea")),
	    											'onclick'=>"showHideElements(this.value);")),
	    			'ctrlvals'=>array('label'=>$loc->getText("adminDescription"),
									'field'=>array('type'=>'text',
	    											'name'=>'ctrlval',
	    											'options'=>array('size'=>'40','maxlength'=>'100'))),
					'req'=>array('label'=>$loc->getText("adminMaterial_marcEditRequired"),
									'field'=>array('type'=>'checkbox',
	    											'name'=>'req',
	    											'value'=>'1')),
	    			'show'=>array('label'=>$loc->getText("adminMaterial_marcEditShowInOpac"),
									'field'=>array('type'=>'checkbox',
	    											'name'=>'show',
	    											'value'=>'1')));

	$dmQ = new DmQuery();
	$aMat = new Dm();
	$aMat = $dmQ->get1('material_type_dm',$mid);
	$smarty->assign('contentDesc',$aMat->getDescription());
	unset($aMat);
	unset($dmQ);
  	$smarty->assign('matId',$mid);
  	$smarty->assign('fieldId',$fid);
  	$smarty->assign('contentHeader',$loc->getText("adminMaterial_marcNewHeader"));

  	$smarty->assign('submitButtonLabel',$loc->getText("adminAdd"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("adminCancel"));

	if (empty($_POST))
  	{
  		// new form, we (re)set the session data
  		SmartyValidate::connect($smarty, true);

        // register our validators
        SmartyValidate::register_validator('v_descNE', 'descr', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_tagNE', 'tag', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_tagII', 'tag', 'isInt', false, false, 'trim');
        SmartyValidate::register_validator('v_tagRa', 'tag:0:9999', 'isRange', false, false, 'trim');
        SmartyValidate::register_validator('v_subfieldNE', 'subfld', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_subfieldIA', 'subfld', 'isAlphaNum', false, false, 'trim,lower');

        $smarty->assign('fields',$fields);

       	$smarty->display('admin/material_marc_new.tpl','admin');

  	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();
			$fieldQ = new MaterialFieldQuery();
			$thisField = array();

			$thisField['material'] = $_POST['mid'];
			$thisField['xrefid'] = $_POST['cd'];
            $thisField['tag'] = $_POST['tag'];
            $thisField['subfield'] = $_POST['subfld'];
            $thisField['descr'] = $_POST['descr'];
            $thisField['required'] = isset($_POST['req']);
            $thisField['ctrltype'] = $_POST['ctrltyp'];
            $thisField['ctrlvalues'] = (isset($_POST['ctrlval']))?$_POST['ctrlval']:'';
            $thisField['inopac'] = isset($_POST['show']);

			if ($fieldQ->insert($thisField))
				$msg = $aMat->getDescription().$loc->getText("adminMaterial_marcNewSuccess");
			else
			    $msg = "Error Adding New Marc Field";

			header("Location: ../admin/material_marc_list.php?cd=".H($mid)."&msg=".HURL($msg));

       	} else {
        	// error, redraw the form
           	$smarty->assign($_POST);

           	$fields['descr']['field']['value'] = $_POST['descr'];
	        $fields['tag']['field']['value'] = $_POST['tag'];
    	    $fields['subfield']['field']['value'] = $_POST['subfld'];
        	$fields['ctrl']['field']['selected'] = $_POST['ctrltyp'];
        	$fields['ctrlvals']['field']['value'] = (isset($_POST['ctrlval']))?$_POST['ctrlval']:'';
        	$fields['req']['field']['checked'] = isset($_POST['req']);
        	$fields['show']['field']['checked'] = isset($_POST['show']);

        	$smarty->assign('fields',$fields);
           	$smarty->display('admin/material_marc_new.tpl','admin');
       	}
  	}
exit;
