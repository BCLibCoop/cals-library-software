<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcTagDm.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcTagDmQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcSubfieldDm.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcSubfieldDmQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/errorFuncs.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/inputFuncs.php");

  session_cache_limiter(null);

if ($_GET['collection_search'] == 'Search') {

	$collectionCd = $_GET['collectionCd'];


$db = mysql_connect(OBIB_HOST,OBIB_USERNAME,OBIB_PWD) or die ("Could not connect to database server {OBIB_HOST} " . mysql_error());
mysql_select_db(OBIB_DATABASE,$db) or die ("Could not connect to database  {OBIB_HOST} " . mysql_error());


$sql = "SELECT DISTINCT biblio.title,biblio.title_remainder,biblio.bibid FROM {OBIB_DATABASE}.biblio,{OBIB_DATABASE}.biblio_copy where biblio.collection_cd = $collectionCd and biblio_copy.bibid = biblio.bibid order by biblio.title";

$sqlresults = mysql_query($sql,$db) or die ("Error in sql statement $sql <p>" . mysql_error());
while ($row = mysql_fetch_array($sqlresults)) {
		if (is_float($count/2)) {$bkcolour = "tableodd";} else {$bkcolour = "tableeven";}
		$title = $row['title'];
		$title_remainder = $row['title_remainder'];
		$bibid = $row['bibid'];
		$books .= <<<EOF
<tr class="$bkcolour">
<td>
	<a href="/library/openbiblio/shared/biblio_view.php?bibid=$bibid&tab=opac">$title $title_remainder</a>
</td>
</tr>
EOF;

//$books .= $book;



}




}






  $tab = "opac";
  $nav = "home";
  $helpPage = "opac";
  $focus_form_name = "phrasesearch";
  $focus_form_field = "searchText";
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,$tab);

  $lookup = "N";
  if (isset($_GET["lookup"])) {
    $lookup = "Y";
    $helpPage = "opacLookup";
  }
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/header_opac.php");
?>

<h1><?php echo $loc->getText("opac_Header");?></h1>

<table>
<?php echo $books; ?>

</table>

<?php echo $sql; ?>
<?php include(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>
