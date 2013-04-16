<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "opac";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
  require_once('loginCheck.php');

  session_cache_limiter(null);
  $nav = "home";

  $helpPage = "opac";

   $labels = array();
   $labels['srch_header']=$loc->getText("opac_searchTitle");
   $labels['sel_title']=$loc->getText("opac_title");
   $labels['sel_author']=$loc->getText("opac_author");
   $labels['sel_subject']=$loc->getText("opac_subject");
   $labels['sel_isbn']=$loc->getText("opac_isbn");
   $labels['sel_snum']=$loc->getText("opac_systemNumber");
   $labels['sel_all']=$loc->getText("opac_all");

   $smarty->assign('labels',$labels);
   $smarty->assign('contentHeader',$loc->getText('opac_Header'));
   $smarty->assign('contentMsg',$loc->getText('opac_WelcomeMsg'));
   $smarty->assign('caTitle',$loc->getText('opac_ca_title'));
   $smarty->assign('caLogin',$loc->getText('opac_ca_login'));

   $smarty->display('opac/index.tpl');
   exit;

/*


<p><strong><a href="/Library/shelflist/index.php">Shelflist</a></strong> <?php echo date('d F Y'); ?><br/>
This is a list of the talking books which have been produced into DAISY digital talking book format by the Association for the Blind of Western Australia from <?php echo $two_months ?> to <?php echo $now ?> these books can be accessed from the association or online.</p>
</div>

*/
