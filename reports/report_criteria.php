<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  $tab = "reports";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");


  $nav = "reportcriteria";
  require_once(__ROOT__."admin/header_admin.php");

  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Report.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");

  if (isset($_SESSION['postVars']['type'])) {
    $type = $_SESSION['postVars']['type'];
  } elseif (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
  } else {
    header('Location: ../reports/index.php');
    exit(0);
  }

  list($rpt, $err) = Report::create_e($type);
  if ($err) {
    header('Location: ../reports/index.php');
    exit(0);
  }

  Nav::node('reportcriteria', 'Report Criteria');
  include(str_replace('//','/',dirname(__FILE__).'/')."../shared/header-old.php");

  #****************************************************************************
  #*  getting form vars
  #****************************************************************************
  require(str_replace('//','/',dirname(__FILE__).'/')."../shared/get_form_vars.php");

  echo '<h1>'.$loc->getText($rpt->title()).'</h1>';

  if (isset($_REQUEST['msg'])) {
    echo '<p><font class="error">'.H($_REQUEST['msg']).'</font></p>';
  }
?>

<form name="reportcriteriaform" method="GET" action="../reports/run_report.php">
<input type="hidden" name="type" value="<?php echo H($rpt->type()) ?>" />

<?php
  $format = array(
    array('select', '__format', array('title'=>'Format'), array(
      array('paged', array('title'=>'HTML (page-by-page)')),
      array('html', array('title'=>'HTML (one big page)')),
      array('csv', array('title'=>'CSV')),
    )),
  );
  $params = array_merge($rpt->paramDefs(), $format);
  Params::printForm($params);
?>

<input type="submit" value="Submit" class="button" />
</form>
<?php include(str_replace('//','/',dirname(__FILE__).'/')."../admin/footer_admin.php"); ?>
