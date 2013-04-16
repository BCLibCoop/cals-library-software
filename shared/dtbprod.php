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
$theSubjects .= "<option>All</option>";
$theAuds .= "<option>All</option>";



$db_name = "DB_abwa_books";
$table_name = "t_audio";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");

$c_sql = "select count(digital) as digital, count(daisy) as daisy from $table_name";
$total_result = @mysql_query($c_sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$c_digital = $row['digital'];
	$c_daisy = $row['daisy'];	
}

$thecounts = "<p>Converted to Digital: <strong>$c_digital</strong><br/>
Converted to Daisy: <strong>$c_daisy</strong><br/>
<a href=\"dtbprod_list.php\">Download current data</a></p>";

mysql_close($connection);




if ($_GET['allbooks'] != '') {

$db_name = "DB_abwa_books";
$table_name = "t_audio";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");
$sql = "select * from t_sales";

$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$title = $row['title'];
	$author = $row['author'];
	$accno = $row['accno'];
	$accno = preg_replace("/ /", "", $accno);
	
	//$format = $row['format'];
 	$thelist .= "<p><strong>$title</strong><br/>$author<br/>accno<br /></p>";
 	
}




mysql_close($connection);



}


if ($_GET['submit'] != '') {

$searchtext = $_GET['searchtext'];
$searchauthor = $_GET['searchauthor'];
$searchaccno = $_GET['searchaccno'];
$subject = $_GET['subject'];
$audience = $_GET['theaud'];

$subject = "All";
$audience = "All";

$db_name = "DB_abwa_books";
$table_name = "t_audio";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");
$nobraille = "AND tapetime NOT LIKE \"braille%\"";


if ($searchauthor){


if ($subject == 'All' and $audience  == 'All') {
$sql = "select * from $table_name where (author like \"%$searchauthor%\")";

}  elseif ($subject == 'All' and $audience  != 'All') {
	
	$sql = "select * from $table_name where (author like \"%$searchauthor%\")";

} elseif ($subject != 'All' and $audience  == 'All') {
	$sql = "select * from $table_name where (author like \"%$searchauthor%\")";

} else {
	$sql = "select * from $table_name where (author like \"%$searchauthor%\")";

}



} 



if ($searchtext){

if ($subject == 'All' and $audience  == 'All') {
$sql = "select * from $table_name where (title like \"%$searchtext%\") ";

}  elseif ($subject == 'All' and $audience  != 'All') {
	
	$sql = "select * from $table_name where (title like \"%$searchtext%\") ";

} elseif ($subject != 'All' and $audience  == 'All') {
	$sql = "select * from $table_name where (title like \"%$searchtext%\") ";

} else {
	$sql = "select * from $table_name where (title like \"%$searchtext%\") ";

}


}

if ($searchaccno){

if ($subject == 'All' and $audience  == 'All') {
$sql = "select * from $table_name where (accno like \"%$searchaccno%\") ";

}  elseif ($subject == 'All' and $audience  != 'All') {
	
	$sql = "select * from $table_name where (accno like \"%$searchaccno%\") ";

} elseif ($subject != 'All' and $audience  == 'All') {
	$sql = "select * from $table_name where (accno like \"%$searchaccno%\") ";

} else {
	$sql = "select * from $table_name where (accno like \"%$searchaccno%\") ";

}


}


$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$title = $row['title'];
	$author = $row['author'];
	$accno = $row['accno'];
	$accno = preg_replace("/ /", "", $accno);
	$id = $row['id'];

	//$format = $row['format'];
 	$thelist .= "<p><strong><a href=\"dtbprod_detail.php?id=$id\">$accno $title</a></strong> $author</p>";
}
mysql_close($connection);
echo $sql;



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
	color: #6c6c6c;
	font-size: large;
}

.form {
	background-color: #cacaca;
}

</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>ABWA Accession List</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href=".css" />
</head>
<body>

<h2>Accession List</h2>
<?php echo $thecounts; ?>

<p><a href="dtbprodnew.php">Create New Entry (tape conversion)</a> | <a href="newdigital.php">Create New Entry (digital conversion)</a></p> 

<p class="form">
<table>
<form action="dtbprod.php" name="booksearch" method="get">
<tr><td>Self Number:</td><td><input type="text" name="searchaccno" size="6"/></td></tr>
<tr><td><span class="big-OR">OR</span></td></tr>
<tr><td>Title:</td><td><input type="text" name="searchtext" size="80"/></td></tr>
<tr><td><span class="big-OR">OR</span></td></tr>
<tr><td>Author (surname):</td><td><input type="text" name="searchauthor" size="80"/></td></tr>
<!-- <span class="big-OR">AND</span><br/> 
Subject: <select name="subject"> <?php echo $theSubjects; ?> </select>
Audience: <select name="theaud"> <?php echo $theAuds; ?> </select> -->
</table>
<input type="submit" name="submit"/>



</form>

</p>



<?php echo "$searchresults $thelist"; ?>


<?php require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>