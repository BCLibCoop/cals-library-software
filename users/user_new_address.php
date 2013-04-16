<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
	$tab = "users";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  	$nav = "newaddress";
  	$helpPage = "users";

  	if ((empty($_GET)) && empty($_POST))
  	{
    	echo "Invalid User specified.";
    	exit();
  	}

  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/DmQuery.php");

  	if ((!isset($_GET['uid'])) &&  (!isset($_POST['uid']))) {
    echo "Invalid User specified.";
    exit;
  }

	if(empty($_POST))
	{

		$dmQ = new DmQuery();
		$userAddressTypes = $dmQ->getAssoc('user_address_type_dm','type','typeid');
		unset($dmQ);

		$addrSelector = array('name'=>'addrSel','id'=>'addrid');
		$addrSelector['options'] = $userAddressTypes;

		$addrFields = array('addr'=>array('label'=>$loc->getText('userAddrAddress'),
		    								'field'=>array('type'=>'text',
	        												'name'=>'addr',
	        												'options'=>array('id'=>'addr','size'=>'60','maxlength'=>'128'))),
  		    				'city'=>array('label'=>$loc->getText('userAddrCity'),
  		    								'field'=>array('type'=>'text',
	        												'name'=>'addrcity',
	        												'options'=>array('size'=>'60','maxlength'=>'128'))),

  		    				'state'=>array('label'=>$loc->getText('userAddrState'),
 		    	 		    				'field'=>array('type'=>'text',
 		    		    									'name'=>'addrstate',
 		    		    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'pcode'=>array('label'=>$loc->getText('userAddrPostCode'),
  		    			    				'field'=>array('type'=>'text',
  		    		    									'name'=>'addrpcode',
  		    		    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'cntry'=>array('label'=>$loc->getText('userAddrCountry'),
 		    	 		    				'field'=>array('type'=>'text',
 		    		    									'name'=>'addrcntry',
 		    		    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'phone'=>array('label'=>$loc->getText('userAddrPhone'),
		    	  		    				'field'=>array('type'=>'text',
		    		    									'name'=>'addrphone',
		    		    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'contact'=>array('label'=>$loc->getText('userAddrContactName'),
		    	  		    				'field'=>array('type'=>'text',
		    		    									'name'=>'addrcont',
		    		    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'contactPhn'=>array('label'=>$loc->getText('userAddrContactPhone'),
 		    		 		    				'field'=>array('type'=>'text',
 		    			    									'name'=>'addrcontphn',
 		    			    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    				'comments'=>array('label'=>$loc->getText('userAddrComments'),
  		    									'field'=>array('type'=>'text',
	        													'name'=>'addrcomm',
	        													'options'=>array('size'=>'60','maxlength'=>'128'))));

	        $submitButton = array('label'=>$loc->getText('userAddr_addAddress'),
	        						'type'=>'submit');
	        $cancelButton = array('label'=>$loc->getText('userCancel'),
	        						'type'=>'button',
	        						'onclick'=>"window.location.reload(true);");
	        $smarty->assign('addrFields',$addrFields);
		    $smarty->assign('addrSel',$addrSelector);
		    $smarty->assign('addressBody',$smarty->fetch('users/user_address_body.tpl','users'));
  		    $smarty->assign('addrFields',null);
  		    $smarty->assign('uid',$_GET['uid']);
  		    $smarty->assign('addrSubmitButton',$submitButton);
  		    $smarty->assign('addrCancelButton',$cancelButton);
		    echo $smarty->fetch('users/user_address_content.tpl','users');
		    exit;

	} // end if empty($_POST)
	else
	{

		if(!isset($_POST['uid']))
		{
			header("Location: user_view.php?uid=".HURL($_POST['uid'])."&".HURL($loc->getText('userAddr_newAddressInvalidUser')));
			exit;
		}

		if(!isset($_POST['addrSel']))
		{
			header("Location: user_view.php?uid=".HURL($_POST['uid'])."&".HURL($loc->getText('userAddr_newAddressInvalidType')));
			exit;
		}


		// check for an empty address
		if((isset($_POST['addr']) && $_POST['addr']=='')
			&& (isset($_POST['addrcity']) && $_POST['addrcity']=='')
			&& (isset($_POST['addrstate']) && $_POST['addrstate']=='')
			&& (isset($_POST['addrpcode']) && $_POST['addrpcode']=='')
			&& (isset($_POST['addrcntry']) && $_POST['addrcntry']=='')
			&& (isset($_POST['addrphone']) && $_POST['addrphone']=='')
			&& (isset($_POST['addrcont']) && $_POST['addrcont']=='')
			&& (isset($_POST['addrcontphn']) && $_POST['addrcontphn']=='')
			&& (isset($_POST['addrcomm']) && $_POST['addrcomm']==''))
		{
			header("Location: user_view.php?uid=".HURL($_POST['uid'])."&".HURL($loc->getText('userAddr_newAddressEmptyNotAdded')));
			exit;
		}

		// adding a new address
		require_once(__ROOT__."classes/UserQuery.php");
		require_once(__ROOT__."classes/UserAddress.php");

		$address = new UserAddress();
		$address->setTypeId((isset($_POST['addrSel']))?$_POST['addrSel']:$this->getTypeId());
		$address->setUserId((isset($_POST['uid']))?$_POST['uid']:$this->getUserId());
		$address->setAddress((isset($_POST['addr']))?$_POST['addr']:$this->getAddress());
		$address->setCity((isset($_POST['addrcity']))?$_POST['addrcity']:$this->getCity());
		$address->setState((isset($_POST['addrstate']))?$_POST['addrstate']:$this->getState());
		$address->setPostCode((isset($_POST['addrpcode']))?$_POST['addrpcode']:$this->getPostCode());
		$address->setCountry((isset($_POST['addrcntry']))?$_POST['addrcntry']:$this->getCountry());
		$address->setPhone((isset($_POST['addrphone']))?$_POST['addrphone']:$this->getPhone());
		$address->setContactName((isset($_POST['addrcont']))?$_POST['addrcont']:$this->getContactName());
		$address->setContactAltPhone((isset($_POST['addrcontphn']))?$_POST['addrcontphn']:$this->getContactAltPhone());
		$address->setComments((isset($_POST['addrcomm']))?$_POST['addrcomm']:$this->getComments());
		$address->setLastUpdated(time());
		$addrQ = new UserAddressQuery();
		if (!$addrQ->addAddress($address))
		{
			header("Location: user_view.php?uid=".HURL($_POST['uid'])."&".HURL($loc->getText('userAddr_newAddressError')));
			exit;
		}
		unset($addrQ);
		unset($address);
		header("Location: user_view.php?uid=".HURL($_POST['uid'])."&".HURL($loc->getText('userAddr_newAddressSuccess')).'#2');
		exit;

	}

