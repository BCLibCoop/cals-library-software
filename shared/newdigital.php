<?php



$tab = "o";
require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/header_opac.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Biblio.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioCopy.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioCopyQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcTagDm.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcTagDmQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcSubfieldDm.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcSubfieldDmQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/marcFuncs.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,"shared");
  setlocale(LC_MONETARY, 'en_AU');
$update = $_POST['submit'];
$update_get = $_GET['OpenBiblio'];

$db_name = "DB_abwa_books";
$table_name = "t_audio";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");


$sql_update = "update $table_name set digital = \"$digital\",producer = \"$the_producer\",daisy = \"$the_format\"  where id = $id";



$theformat .= "<option selected></option>";
$sqla = "select * from t_daisy";
$total_result = @mysql_query($sqla, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$d_format = $row['daisy_format'];
		$theformat .= "<option>$d_format</option>\n";

 		}



$theProducers .= "<option selected></option>";
$sqlb = "select distinct * from t_dtbproducers";
$total_result = @mysql_query($sqlb, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {

		$name = strtoupper($row['last_name']).", ".$row['first_name'];
		$prod_id = $row['prod_id'];

 		$theProducers .= "<option value=\"$prod_id\">$name</option>\n";




}


//Get the last Accention Number

$sql_max_number = "select MAX(accno) as maxnumber from t_audio WHERE accno LIKE \"D%\"";
$total_result = @mysql_query($sql_max_number, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$max_number = $row['maxnumber'];
 		}
//$max_number = trim($max_number,"S");
$max_number++;


if ($update) {
$today = date("Y-m-d");
$accno = $_POST['accno'];
$title = addslashes($_POST['title']);
$creator = addslashes($_POST['creator']);
$narrator = addslashes($_POST['narrator']);
$tapes = $_POST['tapes'];
$length = $_POST['length'];
$agency = $_POST['agency'];
$copies = $_POST['copies'];
$aurora = $_POST['aurora'];
$oclc = $_POST['oclc'];
$isbn = $_POST['isbn'];
$digital = $_POST['digital'];
$mp3 = $_POST['mp3'];

$db_name = "DB_abwa_books";
$table_name = "t_audio";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");

// duplicate number testing

$sql_test = "SELECT count(accno) as thecount FROM $table_name WHERE accno = \"$accno\"";

$total_result = @mysql_query($sql_test, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$thecount = $row['thecount'];
	}


if ($thecount > 0) {
	mysql_close($connection);
	$message = "<p>There is a record with the Accession Number $accno in the databse, please us another number.</p>";


} else {



$sql = "INSERT INTO $table_name set accno = \"$accno\",title = \"$title\",author = \"$creator\",tapes = \"$tapes\",length = \"$length\",agency = \"$agency\",copies = \"$copies\",aurora_bib = \"$aurora\",oclc = \"$oclc\",isbn = \"$isbn\",narrator = \"$narrator\",daisy = \"$daisy\",digital = \"$digital\",producer = \"$producer\",finish_date = \"$today\",mp3 = \"$mp3\",id = \"\"  ";


$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");

$total_result = @mysql_query($sql, $connection) or die("$sql_update Error #". mysql_errno() . ": " . mysql_error());
mysql_close($connection);


$sql_id = "SELECT id FROM $table_name where accno = '$accno'";
$total_result = @mysql_query($sql_id, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
	while ($row = mysql_fetch_array($total_result)) {
		$id = $row['id'];

	}


echo "<a href=\"dtbprod_detail.php?id=$id\">Link to book</a>";

}

}



if ($update_get) {

$connection = @mysql_connect(OBIB_HOST,OBIB_USERNAME,OBIB_PWD) or die("Couldn't Connect.");
$db = @mysql_select_db(OBIB_DATABASE, $connection) or die("Couldn't select database.");


	$s = $_GET['q2'];
	$s = addslashes($s);

	if (str_word_count($s) < 2) {
		$sql = "SELECT bibid FROM biblio_field where field_data = '$s'";
	} else {
		$sql = "SELECT bibid FROM biblio where title = '$s'";
		$title_test = 1;
	}

	echo $sql;
	$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
	while ($row = mysql_fetch_array($total_result)) {
		$bibid = $row['bibid'];
	}

	$sql_title = "SELECT * from biblio where bibid = '$bibid'";

	$total_result = @mysql_query($sql_title, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
	while ($row = mysql_fetch_array($total_result)) {
		$title = $row['title'];
		$author = $row['author'];
	}
	echo $sql_title;

	$sql = "SELECT field_data from biblio_field where tag = '700' and bibid = '$bibid' limit 1";

	$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
	while ($row = mysql_fetch_array($total_result)) {
		$narrator = $row['field_data'];
	}

	$sql = "SELECT field_data from biblio_field where tag = '300' and bibid = '$bibid' limit 1";

	$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
	while ($row = mysql_fetch_array($total_result)) {
		$tapes = $row['field_data'];

	}

	$sql = "SELECT field_data from biblio_field where tag = '534' AND field_data LIKE 'ISBN%' and bibid = '$bibid' limit 1";

	$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
	while ($row = mysql_fetch_array($total_result)) {
		$isbn = $row['field_data'];
		$isbn = ltrim($isbn, "ISBN ");
		$isbn = rtrim($isbn, ".");

	}

	if ($title_test = 1) {

	$sql = "SELECT field_data from biblio_field where tag = '35' and bibid = '$bibid' limit 1";

	$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
	while ($row = mysql_fetch_array($total_result)) {
		$max_number = $row['field_data'];

	}

	} else {
		$max_number = $s;
	}


}







?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">

.smallfont {
	font-size: small;
}

.big-OR {
	text-align: center;
	color: #8d8d8d;
	font-size: large;
}

form {
	background-color: #cacaca;
}

</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>New Daisy Production</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href=".css" />
</head>
<body>

<h2>New Daisy Production</h2>
<?php echo $message; ?>

<p class="form"><form action="newdigital.php" name="booknew" method="post">

<table>
<tr><td>Accension No.:</td> <td><input type="text" name="accno" size="6" value="<?php echo $max_number; ?>" onblur="document.openbilio.q2.value = document.booknew.accno.value"/> <small>&lt;- Next Accension No. Replace if entering data for an existing title.</small></td></tr>
<tr><td>Title:</td> <td><input type="text" name="title" size="50" onblur="document.wcfn.q.value = document.booknew.title.value; document.openbilio.q2.value = document.booknew.title.value"  value="<?php echo $title; ?>"/></td></tr>
<tr><td>Author:</td> <td><input type="text" name="creator" size="50" value="<?php echo $author; ?>"/></td></tr>
<tr><td>Narrator:</td> <td><input type="text" name="narrator" size="50" value="<?php echo $narrator; ?>"/></td></tr>
<tr><td>Tapes:</td> <td><input type="text" name="tapes" size="2" maxlength="2" value="<?php echo $tapes; ?>"/></td></tr>
<tr><td>Length:</td> <td><input type="text" name="length" size="20" value="<?php echo $tapes; ?>"/></td></tr>
<tr><td>Agency:</td> <td><input type="text" name="agency" size="5"/></td></tr>
<tr><td>Copies:</td> <td><input type="text" name="copies" size="2"/></td></tr>
<tr><td>Aurora ID:</td> <td><input type="text" name="aurora" size="5"/></td></tr>

<tr><td>OCLC:</td> <td><input type="text" name="oclc" size="15"/></td></tr>
<tr><td>ISBN:</td> <td><input type="text" name="isbn" size="15" onblur="document.wcfn.q.value = document.booknew.isbn.value"  value="<?php echo $isbn; ?>"/></td></tr>
<tr><td>Converted to digital:</td> <td><input type="checkbox" name="digital" value="Digital"/></td></tr>
<tr><td>Converted to MP3:</td> <td><input type="checkbox" name="mp3" value="mp3"/></td></tr>
<!--
<tr><td>Producer:</td> <td><select name="producer">
	<?php echo $theProducers?>
</select></td>
</tr>

<tr><td>DAISY:</td> <td><select name="format">
	<?php echo $theformat ?>
</select></td>
</tr>
-->
</table>


<!-- <span class="big-OR">AND</span><br/>
Subject: <select name="subject"> <?php echo $theSubjects; ?> </select>
Audience: <select name="theaud"> <?php echo $theAuds; ?> </select> -->
<input type="submit" name="submit" value="Add Book"/>





</form>

<!-- BEGIN worldcat.org search box -->
<!-- BEGIN worldcat.org search box -->
<div id="wcs2n">
<form name="wcfn" id="wcfn" method="get" accept-charset="UTF-8" action="http://www.worldcat.org/search" target="_blank" style="margin: 0;">
<input type="hidden" name="qt" value="affiliate" />
<input type="hidden" name="ai" value="Association_gkearney" />
<table>

<tr>
	<td style="text-align: center; font: 11px 'Arial Unicode MS', Arial, Helvetica, Verdana, sans-serif; line-height: 1.3em; margin: 0; text-align: center; width: 150px"><strong>Search for an item in libraries near you:</strong><br /><label for="q" style="color: #666;">Enter title, subject or author</label></td>
</tr>

<tr>
	<td style="text-align: center;"><input type="text" name="q" id="q" size="20" style="border: 1px solid #999; font: 12px 'Arial Unicode MS', Arial, Helvetica, Verdana, sans-serif; width: 130px;" /></td>
</tr>

<tr>
	<td style="text-align: center;">
	<input type="submit" name="wcsbtn2n" id="wcsbtn2n" alt="Search WorldCat" title="Search WorldCat" />
	</td>
</tr>





</table>
</form>


<form name="openbilio" id="openbilio" method="get" accept-charset="UTF-8" action="newdigital.php"  style="margin: 0;">

<table>

<tr>
	<td style="text-align: center; font: 11px 'Arial Unicode MS', Arial, Helvetica, Verdana, sans-serif; line-height: 1.3em; margin: 0; text-align: center; width: 150px"><strong>Information for OpenBiblio:</strong><br /><label for="q2" style="color: #666;">Enter shelf number</label></td>
</tr>

<tr>
	<td style="text-align: center;"><input type="text" name="q2" id="q2" size="20" style="border: 1px solid #999; font: 12px 'Arial Unicode MS', Arial, Helvetica, Verdana, sans-serif; width: 130px;" /></td>
</tr>

<tr>
	<td style="text-align: center;">
	<input type="submit" name="OpenBiblio" id="OpenBiblio" alt="Search OpenBiblio" title="Search OpenBiblio" />
	</td>
</tr>





</table>
</form>


</p>
<p><a href="dtbprod.php">Back to Search</a> | <a href="../opac/" target="_blank">Library Search</a>  | <a href="http://www.worldcat.org" target="_blank">WorldCat Search</a></p>


<?php echo "$searchresults $thelist"; ?>


<?php require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>
