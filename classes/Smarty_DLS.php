<?php

// load Smarty library
require_once(__ROOT__.'libs/Smarty/Smarty.class.php');
require_once(__ROOT__.'libs/SmartyValidate/SmartyValidate.class.php');

class Smarty_DLS extends Smarty {

   function __construct()
   {

        parent::__construct();

	$this->SetCaching(Smarty::CACHING_OFF);
	$this->SetUseSubDirs(true);

        $this->SetTemplateDir(__ROOT__.'smarty/templates');
        $this->SetCompileDir(__ROOT__.'smarty/templates_c');
        $this->SetConfigDir(__ROOT__.'smarty/configs');
        $this->SetCacheDir(__ROOT__.'smarty/cache');
      	$this->addPluginsDir(__ROOT__.'smarty/plugins');
      	$this->addPluginsDir(__ROOT__.'libs/SmartyValidate/plugins');
	$this->caching = 0;

      	if(ini_get('display_errors')==1)
		{
			//$this->SetDebugging(true);
			//! TODO: remove the following line after development is complete
			$this->SetDebugging(false);

			$this->SetErrorReporting(true);
			$this->SetErrorUnassigned(true);
			$this->SetForceCompile(true);

		}


		$localRoot = dirname(dirname($_SERVER["SCRIPT_FILENAME"]));
		$serverPath =  	$_SERVER["DOCUMENT_ROOT"];
		$appRoot = str_replace($serverPath, '', $localRoot);
		$appRoot .= ($appRoot!='')?"/":"";
		$this->assign("APP_ROOT",$appRoot);

   }

}
