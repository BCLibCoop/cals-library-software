<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "admin";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "materialEdit";
  $restrictInDemo = true;

	if (!isset($_GET["cd"]) && (empty($_POST))){
    	header("Location: ../admin/materials_list.php");
    	exit();
    }

  	require_once(__ROOT__."admin/header_admin.php");
 	require_once(__ROOT__."classes/Dm.php");
  	require_once(__ROOT__."classes/DmQuery.php");

	$UID = $staff = null;
	$UID=(isset($_GET["cd"]))?$_GET["cd"]:$_POST['mid'];

	$dmQ = new DmQuery();
	$aMat = new Dm();

	$fields = array('descr'=>array('label'=>$loc->getText("adminDescription"),
									'field'=>array('type'=>'text',
	    											'name'=>'descr',
	    											'options'=>array('size'=>'40','maxlength'=>'40')),
	    							'validate'=>array('v_descEmpty'=>$loc->getText("adminValidateDescriptionNotEmpty"))),
	    			'img'=>array('label'=>$loc->getText("adminMaterial_editImagefile"),
									'field'=>array('type'=>'text',
	    											'name'=>'imgnm',
	    											'options'=>array('size'=>'40','maxlength'=>'40')),
	    							'validate'=>array('v_imgNmEmpty'=>$loc->getText("adminMaterial_validateImageNameNotEmpty"))),
					'deflt'=>array('label'=>$loc->getText("adminDefaultPrefix").$loc->getText("adminMaterial_materialSuffix"),
									'field'=>array('type'=>'checkbox',
	    											'name'=>'deflt',
	    											'value'=>'1')),
	    			'recom'=>array('label'=>$loc->getText("adminMaterial_editRecommend"),
									'field'=>array('type'=>'checkbox',
	    											'name'=>'recom',
	    											'value'=>'1')));

  	$smarty->assign('mid',$UID);
  	$smarty->assign('contentHeader',$loc->getText("adminMaterial_editDescription"));

  	$smarty->assign('submitButtonLabel',$loc->getText("adminUpdate"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("adminCancel"));

	if (empty($_POST))
  	{
  		$aMat = $dmQ->get1('material_type_dm',$UID);
  		// new form, we (re)set the session data
  		SmartyValidate::connect($smarty, true);

        // register our validators
        SmartyValidate::register_validator('v_descEmpty', 'descr', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_imgNmEmpty', 'imgnm', 'notEmpty', false, false, 'trim');

        $fields['descr']['field']['value'] = $aMat->getDescription();
        $fields['deflt']['field']['checked'] = ($aMat->getDefaultFlg());
        $fields['recom']['field']['checked'] = ($aMat->getShouldRecommend());
        $fields['img']['field']['value'] = $aMat->getImageFile();
        $smarty->assign('fields',$fields);

       	$smarty->display('admin/material_edit.tpl','admin');

  	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();

           	$aMat = $dmQ->get1('material_type_dm',$UID);
			$aMat->setDescription($_POST['descr']);
			$aMat->setImageFile($_POST['imgnm']);
			$aMat->setDefaultFlg(isset($_POST['deflt']));
			$aMat->setShouldRecommend(isset($_POST['recom']));
			if ($dmQ->update('material_type_dm',$aMat) !== NULL)
				$msg = $aMat->getDescription().$loc->getText("adminMaterial_editSuccess");
			else
			    $msg = "Error Updating Material, ".$aMat->getDescription();

			header("Location: ../admin/materials_list.php?msg=".HURL($msg));

       	} else {
        	// error, redraw the form
           	$smarty->assign($_POST);
            $fields['descr']['field']['value'] = $_POST['descr'];
            $fields['img']['field']['value'] = $_POST['imgnm'];
        	$fields['deflt']['field']['checked'] = isset($_POST['deflt']);
        	$fields['recom']['field']['checked'] = isset($_POST['recom']);
        	$smarty->assign('fields',$fields);
           	$smarty->display('admin/material_edit.tpl','admin');
       	}
  	}
exit;
