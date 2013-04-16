<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "admin";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

	$nav = "settings";
	$restrictInDemo = true;

  	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/Settings.php");
	require_once(__ROOT__."classes/SettingsQuery.php");
    require_once(__ROOT__."functions/errorFuncs.php");

	$set = new Settings();
	$setQ = new SettingsQuery();
	$setQ->connect();
	if ($setQ->errorOccurred()) {
	  $setQ->close();
	  displayErrorPage($setQ);
	}

	$setQ->execSelect();
	if ($setQ->errorOccurred()) {
	  $setQ->close();
	  displayErrorPage($setQ);
	}

	$settings['libnm'] = array('label'=>$loc->getText("adminSettings_libName"),
	    				'field'=>array('type'=>'text',
	    								'name'=>'libName',
	    								'options'=>array('size'=>'60','maxlength'=>'128')));
	$settings['libdesc'] = array('label'=>$loc->getText("adminSettings_libDesc"),
	    				'field'=>array('type'=>'text',
	    								'name'=>'libDesc',
	    								'options'=>array('size'=>'60','maxlength'=>'128')));

	$settings['imgurl'] = array('label'=>$loc->getText("adminSettings_libImageUrl"),
	    				'field'=>array('type'=>'text',
	    								'name'=>'libImgUrl',
	    								'options'=>array('size'=>'60','maxlength'=>'100')));

	$settings['showimg'] = array('label'=>$loc->getText("adminSettings_showImageInFooter"),
	    				'field'=>array('type'=>'checkbox',
	    								'name'=>'showImg',
	    								'value'=>'1'));

	$settings['libhrs'] = array('label'=>$loc->getText("adminSettings_libHours"),
	    				'field'=>array('type'=>'text',
	    								'name'=>'libHours',
	    								'options'=>array('size'=>'60','maxlength'=>'60')));

	$settings['libphn'] = array('label'=>$loc->getText("adminSettings_libPhone"),
	    				'field'=>array('type'=>'text',
	    								'name'=>'libPhone',
	    								'options'=>array('size'=>'40','maxlength'=>'40')));

	$settings['liburl'] = array('label'=>$loc->getText("adminSettings_libUrl"),
	    				'field'=>array('type'=>'text',
	    								'name'=>'libUrl',
	    								'options'=>array('size'=>'40','maxlength'=>'128')));

	$settings['opacurl'] = array('label'=>$loc->getText("adminSettings_opacUrl"),
	    				'field'=>array('type'=>'text',
	    								'name'=>'opacUrl',
	    								'options'=>array('size'=>'40','maxlength'=>'128')));

	$settings['adtime'] = array('label'=>$loc->getText("adminSettings_adminSessionTimeout"),
	    				'postLabel'=>$loc->getText("adminSettings_minutes"),
	    				'validate'=>array('v_admSessNE'=>$loc->getText('adminSettings_validateNotEmpty'),
	    									'v_admSessRa'=>$loc->getText('adminSettings_validateAdminSessionRange')),
	    				'field'=>array('type'=>'text',
	    								'name'=>'adminSess',
	    								'options'=>array('size'=>'3','maxlength'=>'3')));

	$settings['pbtime'] = array('label'=>$loc->getText("adminSettings_publicSessionTimeout"),
	    				'postLabel'=>$loc->getText("adminSettings_minutes"),
	    				'validate'=>array('v_pubSessNE'=>$loc->getText('adminSettings_validateNotEmpty'),
	    									'v_pubSessRa'=>$loc->getText('adminSettings_validatePublicSessionRange')),
	    				'field'=>array('type'=>'text',
	    								'name'=>'publicSess',
	    								'options'=>array('size'=>'3','maxlength'=>'3')));

	$settings['perpage'] = array('label'=>$loc->getText("adminSettings_itemsPerPage"),
						'validate'=>array('v_perPageNE'=>$loc->getText('adminSettings_validateNotEmpty'),
											'v_perPageRa'=>$loc->getText('adminSettings_validateItemsPerPageRange')),
	    				'field'=>array('type'=>'text',
	    								'name'=>'perPage',
	    								'options'=>array('size'=>'2','maxlength'=>'2')));

	$settings['purge'] = array('label'=>$loc->getText("adminSettings_purgeBibHistory"),
	    				'postLabel'=>$loc->getText("adminSettings_months"),
	    				'field'=>array('type'=>'text',
	    								'name'=>'purgeMonths',
	    								'options'=>array('size'=>'2','maxlength'=>'2')));

	$settings['locale'] = array('label'=>$loc->getText("adminSettings_locale"),
	    				'field'=>array('type'=>'select',
	    								'name'=>'locale',
	    								'options'=>$set->getLocales()));

	$settings['htmlchar'] = array('label'=>$loc->getText("adminSettings_htmlChar"),
	    				'field'=>array('type'=>'text',
	    								'name'=>'charset',
	    								'options'=>array('size'=>'20','maxlength'=>'20')));

	$settings['langatt'] = array('label'=>$loc->getText("adminSettings_htmlTagLangAttr"),
	    				'field'=>array('type'=>'text',
	    								'name'=>'lang',
	    								'options'=>array('size'=>'8','maxlength'=>'8')));

	$smarty->assign('contentHeader',$loc->getText("adminSettings_editHeader"));
	$smarty->assign('submitButtonLabel',$loc->getText("adminUpdate"));


	if (empty($_POST) )
	{
		SmartyValidate::connect($smarty, true);
		SmartyValidate::register_validator('v_pubSessNE','publicSess','notEmpty',false,false,'trim');
        SmartyValidate::register_validator('v_pubSessRa','publicSess:10:900','isRange',false,false,'trim');
        SmartyValidate::register_validator('v_admSessNE','adminSess','notEmpty',false,false,'trim');
        SmartyValidate::register_validator('v_admSessRa','adminSess:10:900','isRange',false,false,'trim');
        SmartyValidate::register_validator('v_perPageNE','perPage','notEmpty',false,false,'trim');
        SmartyValidate::register_validator('v_perPageRa','perPage:1:100','isRange',false,false,'trim');

        $set = $setQ->fetchRow();

        $settings['libnm']['field']['value'] = $set->getLibraryName();
        $settings['libdesc']['field']['value'] = $set->getLibraryDesc();
        $settings['imgurl']['field']['value'] = $set->getLibraryImageUrl();
        $settings['showimg']['field']['checked'] = $set->getShowImageInFooter();
        $settings['libhrs']['field']['value'] = $set->getLibraryHours();
        $settings['libphn']['field']['value'] = $set->getLibraryPhone();
        $settings['liburl']['field']['value'] = $set->getLibraryUrl();
        $settings['opacurl']['field']['value'] = $set->getOpacUrl();
        $settings['adtime']['field']['value'] = $set->getAdminSessionTimeout();
        $settings['pbtime']['field']['value'] = $set->getPublicSessionTimeout();
        $settings['perpage']['field']['value'] = $set->getItemsPerPage();
        $settings['purge']['field']['value'] = $set->getPurgeHistoryAfterMonths();
        $settings['locale']['field']['selected'] = $set->getLocale();
        $settings['htmlchar']['field']['value'] = $set->getCharset();
        $settings['langatt']['field']['value'] = $set->getHtmlLangAttr();

		$smarty->assign('settings',$settings);
		$smarty->display('admin/settings.tpl','admin');

	}

	else
	{
		#****************************************************************************
  		#*  Validate data
  		#****************************************************************************
		SmartyValidate::connect($smarty);
       	if(SmartyValidate::is_valid($_POST))
       	{
        	// no errors
           	SmartyValidate::disconnect();
			$set->setLibraryName($_POST["libName"]);
  			$set->setLibraryDesc($_POST["libDesc"]);
			$set->setLibraryImageUrl($_POST["libImgUrl"]);
			$set->setShowImageInFooter(isset($_POST["showImg"]));
			$set->setLibraryHours($_POST["libHours"]);
			$set->setLibraryPhone($_POST["libPhone"]);
			$set->setLibraryUrl($_POST["libUrl"]);
			$set->setOpacUrl($_POST["opacUrl"]);
			$set->setAdminSessionTimeout($_POST["adminSess"]);
			$set->setPublicSessionTimeout($_POST["publicSess"]);
			$set->setItemsPerPage($_POST["perPage"]);
			$set->setPurgeHistoryAfterMonths($_POST["purgeMonths"]);
			$set->setLocale($_POST["locale"]);
			$set->setCharset($_POST["charset"]);
			$set->setHtmlLangAttr($_POST["lang"]);

			if ($setQ->update($set)) {
    			$smarty->assign('contentStatusMsg',$loc->getText('adminSettings_Updated'));
    			$set->updateSmartyConfig($smarty);
  			}
  			else
  			{
  				$smarty->assign('contentStatusMsg','Error Updating Settings');
  			}

  			$setQ->close();

  			$settings['libnm']['field']['value'] = $set->getLibraryName();
       		$settings['libdesc']['field']['value'] = $set->getLibraryDesc();
       		$settings['imgurl']['field']['value'] = $set->getLibraryImageUrl();
       		$settings['showimg']['field']['checked'] = $set->getShowImageInFooter();
       		$settings['libhrs']['field']['value'] = $set->getLibraryHours();
       		$settings['libphn']['field']['value'] = $set->getLibraryPhone();
       		$settings['liburl']['field']['value'] = $set->getLibraryUrl();
       		$settings['opacurl']['field']['value'] = $set->getOpacUrl();
       		$settings['adtime']['field']['value'] = $set->getAdminSessionTimeout();
       		$settings['pbtime']['field']['value'] = $set->getPublicSessionTimeout();
       		$settings['perpage']['field']['value'] = $set->getItemsPerPage();
       		$settings['purge']['field']['value'] = $set->getPurgeHistoryAfterMonths();
       		$settings['locale']['field']['selected'] = $set->getLocale();
       		$settings['htmlchar']['field']['value'] = $set->getCharset();
       		$settings['langatt']['field']['value'] = $set->getHtmlLangAttr();

           	$smarty->assign('settings',$settings);
           	unset($_SESSION['postVars']);
 			unset($_SESSION['pageErrors']);
  			unset($_POST);
  			unset($set);
  			unset($setQ);
			$smarty->display('admin/settings.tpl','admin');
			exit;

       	} else {
        	// error, redraw the form
           	$smarty->assign($_POST);
           	$settings['libnm']['field']['value'] = $_POST["libName"];
        	$settings['libdesc']['field']['value'] = $_POST["libDesc"];
        	$settings['imgurl']['field']['value'] = $_POST["libImgUrl"];
        	$settings['showimg']['field']['checked'] = $_POST["showImg"];
        	$settings['libhrs']['field']['value'] = $_POST["libHours"];
        	$settings['libphn']['field']['value'] = $_POST["libPhone"];
        	$settings['liburl']['field']['value'] = $_POST["libUrl"];
        	$settings['opacurl']['field']['value'] = $_POST["opacUrl"];
        	$settings['adtime']['field']['value'] = $_POST["adminSess"];
        	$settings['pbtime']['field']['value'] = $_POST["publicSess"];
        	$settings['perpage']['field']['value'] = $_POST["perPage"];
        	$settings['purge']['field']['value'] = $_POST["PurgeMonths"];
        	$settings['locale']['field']['selected'] = $_POST["locale"];
        	$settings['htmlchar']['field']['value'] = $_POST["charset"];
        	$settings['langatt']['field']['value'] = $_POST["lang"];

           	$smarty->assign('settings',$settings);
			$smarty->display('admin/settings.tpl','admin');
       	}
	}