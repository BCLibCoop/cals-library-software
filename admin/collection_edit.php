<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  	$tab = "admin";
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  	$nav = "collectionsEdit";
  	$restrictInDemo = true;

	if (!isset($_GET["cd"]) && (empty($_POST))){
    	header("Location: ../admin/collections_list.php");
    	exit();
    }

  	require_once(__ROOT__."admin/header_admin.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Dm.php");
  	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");

	$UID = $staff = null;
	$UID=(isset($_GET["cd"]))?$_GET["cd"]:$_POST['cid'];

	$dmQ = new DmQuery();
	$aColl = new Dm();
	$aColl = $dmQ->get1('collection_dm',$UID);

	$fields = array('descr'=>array('label'=>$loc->getText("adminDescription"),
									'field'=>array('type'=>'text',
	    											'name'=>'descr',
	    											'options'=>array('size'=>'40','maxlength'=>'40')),
	    							'validate'=>array('msg'=>$loc->getText("adminValidateDescriptionNotEmpty"))),
					'deflt'=>array('label'=>$loc->getText("adminDefaultPrefix").$loc->getText("adminCollection_editCollectionSuffix"),
									'field'=>array('type'=>'checkbox',
	    											'name'=>'deflt',
	    											'value'=>'Y')));

  	$smarty->assign('cid',$UID);
  	$smarty->assign('contentHeader',$loc->getText("adminCollection_editHeader"));

  	$smarty->assign('submitButtonLabel',$loc->getText("Update"));
  	$smarty->assign('cancelButtonLabel',$loc->getText("Cancel"));

	if (empty($_POST))
  	{
  		// new form, we (re)set the session data
  		SmartyValidate::connect($smarty, true);

        // register our validators
        SmartyValidate::register_validator('v_descEmpty', 'descr', 'notEmpty', false, false, 'trim');

        $fields['descr']['field']['value'] = $aColl->getDescription();
        $fields['deflt']['field']['checked'] = ($aColl->getDefaultFlg());
        $smarty->assign('fields',$fields);

       	$smarty->display('admin/collection_edit.tpl','admin');

  	}
	else
	{
	    // validate after a POST
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();
			$aColl->setDescription($_POST['descr']);
			$aColl->setDefaultFlg($_POST['deflt']);
			if ($dmQ->update('collection_dm',$aColl) !== NULL)
				$msg = $aColl->getDescription().$loc->getText("adminCollection_editSuccess");
			else
			    $msg = "Error Updating Collection, ".$aColl->getDescription();

			header("Location: ../admin/collections_list.php?msg=".HURL($msg));

       	} else {
        	// error, redraw the form
           	$smarty->assign($_POST);
            $fields['descr']['field']['value'] = $_POST['descr'];
        	$fields['deflt']['field']['checked'] = isset($_POST['deflt']);
        	$smarty->assign('fields',$fields);
           	$smarty->display('admin/collection_edit.tpl','admin');
       	}
  	}
exit;

  #****************************************************************************
  #*  Validate data
  #****************************************************************************
  $dm = new Dm();
  $dm->setCode($_POST["code"]);
  $_POST["code"] = $dm->getCode();
  $dm->setDescription($_POST["description"]);


  #**************************************************************************
  #*  Update domain table row
  #**************************************************************************
  $dmQ = new DmQuery();
  $dmQ->update("collection_dm",$dm);

  #**************************************************************************
  #*  Destroy form values and errors
  #**************************************************************************
  unset($_SESSION['postVars']);
  unset($_SESSION['pageErrors']);
/*
      <?php echo $loc->getText("adminCollection_edit_formEditcollection"); ?>
    </th>
  </tr>
  <tr>
    <td nowrap="true" class="primary">
      <?php echo ; ?>
    </td>
    <td valign="top" class="primary">
      <?php printInputText("description",40,40,$postVars,$pageErrors); ?>
    </td>
  </tr>
  <tr>
    <td nowrap="true" class="primary">
      <font class="small">*</font><?php echo $loc->getText("adminCollection_edit_formDaysdueback"); ?>
    </td>
    <td valign="top" class="primary">
      <?php printInputText("daysDueBack",3,3,$postVars,$pageErrors); ?>
    </td>
  </tr>
  <tr>
    <td nowrap="true" class="primary"><?php echo $loc->getText("adminCollection_edit_formDailyLateFee"); ?>
      <font class="small">*</font>
    </td>
    <td valign="top" class="primary">
      <?php printInputText("dailyLateFee",7,7,$postVars,$pageErrors); ?>
    </td>
  </tr>
  <tr>
    <td align="center" colspan="2" class="primary">
      <input type="submit" value="  <?php echo $loc->getText("adminSubmit"); ?>  " class="button">
      <input type="button" onClick="self.location='../admin/collections_list.php'" value="  <?php echo $loc->getText("adminCancel"); ?>  " class="button">
    </td>
  </tr>

</table>
      </form>
<table><tr><td valign="top"><font class="small"><?php echo $loc->getText("adminCollection_edit_formNote"); ?></font></td>
<td><font class="small"><?php echo $loc->getText("adminCollection_edit_formNoteText"); ?><br></font>
*/