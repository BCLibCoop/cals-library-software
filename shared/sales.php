<?php
//Make the excel file.
if ($_GET['excel'] != '') {
$root = $_SERVER['DOCUMENT_ROOT'];
$filename = "$root/tmp/ABWAbooks.csv";
echo $filename;

$fp = fopen($filename, "w");
if (!is_resource($fp))
{
die("Cannot open $filename");
}
$theBooklist = "\"Title\",\"Author\",\"Description\",\"Media\"\n";

$db_name = "DB_abwa_books";
$table_name = "t_sales";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");
$sql = "select * from t_sales order by title";

$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$title = stripslashes($row['title']);
	$author = stripslashes($row['author']);
	$description = stripslashes($row['summary']);
	$tape = $row['tapetime'];
	preg_match("/[0-9]+/", $tape, $regs);
	$cdcount = $regs[0];
	if ($cdcount > 10) {$mp3disk = 2;} else {$mp3disk = 1;}
	
	$cdprice = money_format('%.2n',$cdcount * 10.85);
	$mp3price = money_format('%.2n',$mp3disk * 48.10);
	$media = "$cdcount Audio CD for $cdprice or $mp3disk MP3 CD for $mp3price";
	//$format = $row['format'];
	
$theBooklist .= "\"$title\",\"$author\",\"$description\",\"$media\"\n";
 	
}
mysql_close($connection);

fwrite($fp, $theBooklist);
fclose($fp);

header('Location: http://www.cucat.org/tmp/ABWAbooks.csv');


}






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
  
  require_once "excel.php";

  
  
  
  $loc = new Localize(OBIB_LOCALE,"shared");
  setlocale(LC_MONETARY, 'en_AU');
$theSubjects .= "<option>All</option>";
$theAuds .= "<option>All</option>";

$db_name = "DB_abwa_books";
$table_name = "t_sales";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");
$sql = "select distinct subject from t_sales order by subject";

$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$subject = $row['subject'];
	
 	$theSubjects .= "<option>$subject</option>";
}


$sql = "select distinct aud from t_sales order by aud";

$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$audience = $row['aud'];
	
 	$theAuds .= "<option>$audience </option>";
}
mysql_close($connection);






if ($_GET['allbooks'] != '') {

$db_name = "DB_abwa_books";
$table_name = "t_sales";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");
$sql = "select * from t_sales";

$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$title = $row['title'];
	$author = $row['author'];
	$description = $row['summary'];
	$tape = $row['tapetime'];
	preg_match("/[0-9]+/", $tape, $regs);
	$cdcount = $regs[0];
	if ($cdcount > 10) {$mp3disk = 2;} else {$mp3disk = 1;}
	
	$cdprice = money_format('%.2n',$cdcount * 10.85);
	$mp3price = money_format('%.2n',$mp3disk * 48.10);
	$media = "$cdcount Audio CD for $cdprice or $mp3disk MP3 CD for $mp3price";
	//$format = $row['format'];
 	$thelist .= "<p><strong>$title</strong><br/>$author<br/>$description<br />  $publisher $media</p>";
 	
}
mysql_close($connection);





}






if ($_GET['submit'] != '') {

$searchtext = $_GET['searchtext'];
$searchauthor = $_GET['searchauthor'];
$subject = $_GET['subject'];
$audience = $_GET['theaud'];

$db_name = "DB_abwa_books";
$table_name = "t_sales";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");
$nobraille = "AND tapetime NOT LIKE \"braille%\"";


if ($searchauthor){


if ($subject == 'All' and $audience  == 'All') {
$sql = "select * from t_sales where (author like \"%$searchauthor%\") $nobraille";

}  elseif ($subject == 'All' and $audience  != 'All') {
	
	$sql = "select * from t_sales where (author like \"%$searchauthor%\") AND aud = \"$audience \" $nobraille";

} elseif ($subject != 'All' and $audience  == 'All') {
	$sql = "select * from t_sales where (author like \"%$searchauthor%\") AND subject = \"$subject\" $nobraille";

} else {
	$sql = "select * from t_sales where (author like \"%$searchauthor%\") AND aud = \"$audience \" AND subject = \"$subject\" $nobraille";

}



} else {

if ($subject == 'All' and $audience  == 'All') {
$sql = "select * from t_sales where (title like \"%$searchtext%\" OR  summary LIKE \"%$searchtext%\") $nobraille";

}  elseif ($subject == 'All' and $audience  != 'All') {
	
	$sql = "select * from t_sales where (title like \"%$searchtext%\" OR  summary LIKE \"%$searchtext%\") AND aud = \"$audience \" $nobraille";

} elseif ($subject != 'All' and $audience  == 'All') {
	$sql = "select * from t_sales where (title like \"%$searchtext%\" OR  summary LIKE \"%$searchtext%\") AND subject = \"$subject\" $nobraille";

} else {
	$sql = "select * from t_sales where (title like \"%$searchtext%\" OR  summary LIKE \"%$searchtext%\") AND aud = \"$audience \" AND subject = \"$subject\" $nobraille";

}


}



$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$title = $row['title'];
	$author = $row['author'];
	$description = $row['summary'];
	$tape = $row['tapetime'];
	$publisher = $row['publisher'];
	preg_match("/[0-9]+/", $tape, $regs);
	$cdcount = $regs[0];
	
	if ($regs[0] > 10) { $mp3disk = 2;} else { $mp3disk = 1;}
	$cdprice = money_format('%.2n',$cdcount * 10.85);
	$mp3price = money_format('%.2n',$mp3disk * 48.10);
	$media = "$cdcount Audio CD for $cdprice or $mp3disk MP3 CD for $mp3price";
	//$format = $row['format'];
 	$thelist .= "<p><strong>$title</strong><br/>$author<br/>$description<br /> $publisher $media</p>";
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
	color: #8d8d8d;
	font-size: large;
}

</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>ABWA Recordings Sales</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href=".css" />
</head>
<body>

<h2>Recording Sales</h2>

<p>The Association is able to offer libraries and other institutions sales of some of the recordings found in it's collection.  Use this form to search for titles or to get a <a href="sales.php?allbooks=true">complete listing of books</a> or  <a href="sales.php?excel=true">Spreadsheet listing</a>.</p> 

<p class="form"><form action="sales.php" name="booksearch" method="get">
Title or description: <input type="text" name="searchtext" size="80"/><br/>
<span class="big-OR">OR</span><br/>
Author (surname): <input type="text" name="searchauthor" size="80"/><br/>
<span class="big-OR">AND</span><br/> 
Subject: <select name="subject"> <?php echo $theSubjects; ?> </select>
Audience: <select name="theaud"> <?php echo $theAuds; ?> </select>
<input type="submit" name="submit"/>



</form></p>



<?php echo "$searchresults $thelist"; ?>


<?php require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>