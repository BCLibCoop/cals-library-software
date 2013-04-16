<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "admin";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "materialNew";
  $restrictInDemo = true;
  	require_once(__ROOT__."admin/header_admin.php");

	$fields = array('descr'=>array('label'=>$loc->getText("adminDescription"),
									'field'=>array('type'=>'text',
	    											'name'=>'descr',
	    											'options'=>array('size'=>'40','maxlength'=>'40')),
	    							'validate'=>array('v_descEmpty'=>$loc->getText("adminValidateDescriptionNotEmpty"))),
	    			'img'=>array('label'=>$loc->getText("adminMaterial_editImagefile"),
									'field'=>array('type'=>'text',
	    											'name'=>'imgnm',
	    											'value'=>'shim.gif',
	    											'options'=>array('size'=>'40','maxlength'=>'40')),
	    							'validate'=>array('v_imgNmEmpty'=>$loc->getText("adminMaterial_validateImageNameNotEmpty"))),
					'deflt'=>array('label'=>$loc->getText("adminDefaultPrefix").$loc->getText("adminMaterial_materialSuffix"),
									'field'=>array('type'=>'checkbox',
	    											'name'=>'deflt',
	    											'value'=>'1',
	    											'options'=>array('id'=>'deflt'))),
	    			'recom'=>array('label'=>$loc->getText("adminMaterial_editRecommend"),
									'field'=>array('type'=>'checkbox',
	    											'name'=>'recom',
	    											'value'=>'1',
	    											'options'=>array('id'=>'recom'))));

  	$smarty->assign('contentHeader',$loc->getText("adminMaterial_newHeader"));

  	$smarty->assign('submitButtonLabel',$loc->getText("adminAdd"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("adminCancel"));

	if (empty($_POST))
  	{
  		// new form, we (re)set the session data
  		SmartyValidate::connect($smarty, true);
        // register our validators
        SmartyValidate::register_validator('v_descEmpty', 'descr', 'notEmpty', false, false, 'trim');
        SmartyValidate::register_validator('v_imgNmEmpty', 'imgnm', 'notEmpty', false, false, 'trim');

        $smarty->assign('fields',$fields);
       	$smarty->display('admin/material_new.tpl','admin');

  	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
       		// no errors
           	SmartyValidate::disconnect();

       	  	require_once(__ROOT__."classes/Dm.php");
  			require_once(__ROOT__."classes/DmQuery.php");

           	$dmQ = new DmQuery();
			$aMat = new Dm();
			$aMat->setDescription($_POST['descr']);
			$aMat->setImageFile($_POST['imgnm']);
			$aMat->setDefaultFlg(isset($_POST['deflt']));
			$aMat->setShouldRecommend(isset($_POST['recom']));
			if ($dmQ->insert('material_type_dm',$aMat) !== NULL)
				$msg = $aMat->getDescription().$loc->getText("adminMaterial_newSuccess");
			else
			    $msg = "Error Adding Material, ".$aMat->getDescription();

			header("Location: ../admin/materials_list.php?msg=".HURL($msg));

       	} else {
        	// error, redraw the form
           	$smarty->assign($_POST);
            $fields['descr']['field']['value'] = $_POST['descr'];
            $fields['img']['field']['value'] = $_POST['imgnm'];
        	$fields['deflt']['field']['checked'] = isset($_POST['deflt']);
        	$fields['recom']['field']['checked'] = isset($_POST['recom']);
        	$smarty->assign('fields',$fields);
           	$smarty->display('admin/material_new.tpl','admin');
       	}
  	}
exit;
