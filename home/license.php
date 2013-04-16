<?php
  $tab = "home";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  $nav = "license";
  require_once(__ROOT__."admin/header_admin.php");
  $smarty->display('home/license.tpl','home');
