<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");
  $navLoc = new Localize(OBIB_LOCALE,"navbars");


 if (isset($_SESSION['_admin']['staffid'])) {
   $sess_userid = $_SESSION['_admin']['staffid'];
 } else {
   $sess_userid = "";
 }
 if ($sess_userid == "") { ?>
  <input type="button" onClick="self.location='../shared/loginAdminForm.php?RET=../reports/index.php'" value="<?php echo $navLoc->getText("login");?>" class="navbutton">
<?php } else { ?>
  <input type="button" onClick="self.location='../shared/logout.php'" value="<?php echo $navLoc->getText("logout");?>" class="navbutton">
<?php } ?>
<br /><br />
<?php
Nav::node('reportlist', 'Report List', '../reports/index.php');
if (isset($_SESSION['rpt_Report'])) {
  Nav::node('results', "Report Results",
           '../reports/run_report.php?type=previous');
}

$helpurl = "javascript:popSecondary('../shared/help.php";
if (isset($helpPage)) {
  $helpurl .= "?page=".$helpPage;
}
$helpurl .= "')";
Nav::node('help', 'Help', $helpurl);

Nav::display("$nav");
?>
