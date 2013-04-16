<?php

	if((!isset($_GET)) || (!isset($_GET['aid'])))
		exit;

	$tab="users";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(__ROOT__."classes/UserQuery.php");

	$addrQ = new UserAddressQuery();

	$address = $addrQ->getAddress($_GET['aid']);

	// NOTE: when changing the following setup for fields the
	// 			userAddressFilter.php MUST be changed as well in order to keep POST vars
	//			and labels updating correctly via AJAX
	if(!isset($_GET['e']))
	{
		$addrFields = array('addr'=>array('label'=>$loc->getText('userAddrAddress'),
	  	    							'value'=>$address->getAddress()),
	  	    			'city'=>array('label'=>$loc->getText('userAddrCity'),
	  	    							'value'=>$address->getCity()),
	  	    			'state'=>array('label'=>$loc->getText('userAddrState'),
	  	    							'value'=>$address->getState()),
	  	    			'pcode'=>array('label'=>$loc->getText('userAddrPostCode'),
	  	    							'value'=>$address->getPostCode()),
	  	    			'count'=>array('label'=>$loc->getText('userAddrCountry'),
	  	    							'value'=>$address->getCountry()),
	  	    			'phone'=>array('label'=>$loc->getText('userAddrPhone'),
	  	    							'value'=>$address->getPhone()),
	  	    			'contact'=>array('label'=>$loc->getText('userAddrContactName'),
	  	    							'value'=>$address->getContactName()),
	  	    			'contactPhn'=>array('label'=>$loc->getText('userAddrContactPhone'),
	  	    							'value'=>$address->getContactAltPhone()),
	  	    			'comments'=>array('label'=>$loc->getText('userAddrComments'),
	  	    							'value'=>$address->getComments()));
	}
	else
	{

		$addrFields = array('addr'=>array('label'=>$loc->getText('userAddrAddress'),
		    						'field'=>array('type'=>'text',
	        										'name'=>'addr',
	        										'value'=>$address->getAddress(),
	        										'options'=>array('id'=>'addr','size'=>'60','maxlength'=>'128'))),
  		    		'city'=>array('label'=>$loc->getText('userAddrCity'),
  		    						'field'=>array('type'=>'text',
	        										'name'=>'addrcity',
	        										'value'=>$address->getCity(),
	        										'options'=>array('size'=>'60','maxlength'=>'128'))),

  		    		'state'=>array('label'=>$loc->getText('userAddrState'),
 		 		    				'field'=>array('type'=>'text',
 		        									'name'=>'addrstate',
 		        									'value'=>$address->getState(),
 		        									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    		'pcode'=>array('label'=>$loc->getText('userAddrPostCode'),
  		    	    				'field'=>array('type'=>'text',
  		        									'name'=>'addrpcode',
  		        									'value'=>$address->getPostCode(),
  		        									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    		'cntry'=>array('label'=>$loc->getText('userAddrCountry'),
 		 		    				'field'=>array('type'=>'text',
 		        									'name'=>'addrcntry',
 		        									'value'=>$address->getCountry(),
 		        									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    		'phone'=>array('label'=>$loc->getText('userAddrPhone'),
		  		    				'field'=>array('type'=>'text',
		        									'name'=>'addrphn',
		        									'value'=>$address->getPhone(),
		        									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    		'contact'=>array('label'=>$loc->getText('userAddrContactName'),
		  		    				'field'=>array('type'=>'text',
		        									'name'=>'addrcont',
		        									'value'=>$address->getContactName(),
		        									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    		'contactPhn'=>array('label'=>$loc->getText('userAddrContactPhone'),
 		     		    				'field'=>array('type'=>'text',
 		    	    									'name'=>'addrcontphn',
 		    	    									'value'=>$address->getContactAltPhone(),
 		    	    									'options'=>array('size'=>'60','maxlength'=>'128'))),
  		    		'comments'=>array('label'=>$loc->getText('userAddrComments'),
  		    							'field'=>array('type'=>'text',
	        											'name'=>'addrcomm',
	        											'value'=>$address->getComments(),
	        											'options'=>array('size'=>'60','maxlength'=>'128'))));
	}

	$smarty->assign('addrFields',$addrFields);
	header("Cache-Control: no-cache, must-revalidate");     // Must do cache-control headers
   	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	//header( 'Content-type: application/xml; charset="utf-8"');
	echo $smarty->fetch('users/user_address_body.tpl','users');

