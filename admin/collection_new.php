<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  	$tab = "admin";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  	$nav = "collectionsNew";
  	$restrictInDemo = true;

  	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/Dm.php");
  	require_once(__ROOT__."classes/DmQuery.php");

	$fields = array('descr'=>array('label'=>$loc->getText("adminDescription"),
									'field'=>array('type'=>'text',
	    											'name'=>'descr',
	    											'options'=>array('size'=>'40','maxlength'=>'40')),
	    							'validate'=>array('msg'=>$loc->getText("adminValidateDescriptionNotEmpty"))),
					'deflt'=>array('label'=>$loc->getText("adminDefaultPrefix").$loc->getText("adminCollection_collectionSuffix"),
									'field'=>array('type'=>'checkbox',
	    											'name'=>'deflt',
	    											'value'=>'Y')));

  	$smarty->assign('contentHeader',$loc->getText("adminCollection_newHeader"));

  	$smarty->assign('submitButtonLabel',$loc->getText("adminAdd"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("adminCancel"));

	if (empty($_POST))
  	{
  		// new form, we (re)set the session data
  		SmartyValidate::connect($smarty, true);

        // register our validators
        SmartyValidate::register_validator('v_descEmpty', 'descr', 'notEmpty', false, false, 'trim');
        $smarty->assign('fields',$fields);
       	$smarty->display('admin/collection_new.tpl','admin');

  	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();
			$aColl = new Dm();
			$aColl->setDescription($_POST['descr']);
			$aColl->setDefaultFlg($_POST['deflt']);
			$dmQ = new DmQuery();
			if ($dmQ->insert('collection_dm',$aColl))
				$msg = $aColl->getDescription().$loc->getText("adminCollection_newSuccess");
			else
			    $msg = "Error Updating Collection, ".$aColl->getDescription();

			header("Location: ../admin/collections_list.php?msg=".H($msg));

       	} else {
        	// error, redraw the form
           	$smarty->assign($_POST);
            $fields['descr']['field']['value'] = $_POST['descr'];
        	$fields['deflt']['field']['checked'] = isset($_POST['deflt']);
        	$smarty->assign('fields',$fields);
           	$smarty->display('admin/collection_new.tpl','admin');
       	}
  	}
exit;
