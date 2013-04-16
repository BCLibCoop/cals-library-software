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

//if ($_POST['collection_search'] == 'Search') {

	$thesubject = $_POST['thesubject'];
	$searchlimit = $_POST['limit'];


$db = mysql_connect(OBIB_HOST,OBIB_USERNAME,OBIB_PWD) or die ("Could not connect to database server {OBIB_HOST} " . mysql_error());
mysql_select_db(OBIB_DATABASE,$db) or die ("Could not connect to database {OBIB_DATABASE}" . mysql_error());


$sql = "select biblio.title,biblio.bibid,author,title_remainder from biblio,biblio_field where (biblio_field.field_data like '$thesubject')  and (biblio_field.bibid = biblio.bibid)  order by title  ";

//echo $sql;
$count = 1;
$sqlresults = mysql_query($sql,$db) or die ("Error in sql statement $sql <p>" . mysql_error());

while ($row = mysql_fetch_array($sqlresults)) {
		if (is_float($count/2)) {$bkcolour = "background-color: #cccccc;";} else {$bkcolour = "background-color: white;";}
		$title = $row['title'];
		$title_remainder = $row['title_remainder'];
		$author = $row['author'];
		$bibid = $row['bibid'];
		$books .= <<<EOF
<tr style="$bkcolour">
<td>
	<a href="/library/openbiblio/shared/biblio_view.php?bibid=$bibid&tab=opac">$title $title_remainder</a> by $author
</td>
</tr>
EOF;
$count++;

//$books .= $book;



}




//}






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

<table >
<?php echo $books; ?>

</table>


<?php include(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>
