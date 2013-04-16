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

$accno = $_GET['accno'];

$submit = $_POST['submit'];

$db_name = "DB_abwa_books";
$table_name = "t_audio";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");


$sql = "select * from $table_name where accno = '$accno'";

$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$d_accno = $row['accno'];
	$d_finish_date = $row['finish_date'];	
	$d_title = $row['title'];
	$d_author = $row['author'];	
	$d_narrator = $row['narrator'];	
	$d_agency = $row['agency'];
	$d_tapes = $row['tapes'];
	$d_length = $row['length'];
	$d_copies = $row['copies'];
	$d_isbn = $row['isbn'];
	$d_oclc = $row['oclc'];
	$aurora_bib = $row['aurora_bib'];
	$d_mp3 = $row['mp3'];
	$d_obi = $row['obi'];
	$d_mono = $row['mono'];
	$d_notes = $row['notes'];
	$digital = $row['digital'];	
	$daisy = $row['daisy'];
	$aurora = $row['aurora'];
	$id = $row['id'];
	
}

if ($digital != '') {$digital_check = "true";} else {$digital_check = "false";}
//if ($d_mp3 != '') {$mp3_check = "true";} else {$mp3_check = "false";}
if ($d_mp3 != '' or $d_mp3 == "YES") {$mp3_check = "true";} else {$mp3_check = "false";}
if ($d_obi != '' or $d_obi == "YES") {$obi_check = "true";} else {$obi_check = "false";}
if ($d_mono != '' or $d_mono == "YES") {$mono_check = "true";} else {$mono_check = "false";}




if ($submit !='') {

$accno = $_POST['accno'];
$title = $_POST['title'];
$id = $_POST['id'];
$creator = $_POST['creator'];
$tapes = $_POST['tapes'];
$length = $_POST['length'];
$agency = $_POST['agency'];
$copies = $_POST['copies'];
$aurora = $_POST['aurora'];
$oclc = $_POST['oclc'];
$isbn = $_POST['isbn'];
$narrator = $_POST['narrator'];
$daisy = $_POST['daisy'];
$digital = $_POST['digital'];
$producer = $_POST['producer'];
$mono = $_POST['mono'];
$obi = $_POST['obi'];
$mp3 = $_POST['mp3'];

$sql = "update $table_name set accno = \"$accno\",title = \"$title\",author = \"$creator\",tapes = \"$tapes\",length = \"$length\",agency = \"$agency\",copies = \"$copies\",aurora_bib = \"$aurora\",oclc = \"$oclc\",isbn = \"$isbn\",narrator = \"$narrator\",digital = \"$digital\",finish_date = \"$today\",mp3 = \"$mp3\",mono = \"$mono\",obi = \"$obi\",notes = \"$notes\"  where id = $id";


print "$sql";


$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");

$total_result = @mysql_query($sql, $connection) or die("$sql_update Error #". mysql_errno() . ": " . mysql_error());
mysql_close($connection);


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

<p class="form"><form action="dtbprodedit.php" name="booknew" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>".?

<table>
<tr><td>Accension No.:</td> <td><input type="text" name="accno" size="6" value="<?php echo $accno; ?>" /> </td></tr>
<tr><td>Title:</td> <td><input type="text" name="title" size="50" onblur="document.wcfn.q.value = document.booknew.title.value" value="<?php echo $d_title ?>"/></td></tr>
<tr><td>Author:</td> <td><input type="text" name="creator" size="50" value="<?php echo $d_author ?>"/></td></tr>
<tr><td>Narrator:</td> <td><input type="text" name="narrator" size="50" value="<?php echo $d_narrator ?>"/></td></tr>
<tr><td>Tapes:</td> <td><input type="text" name="tapes" size="2" value="<?php echo $d_tapes ?>"/></td></tr>
<tr><td>Length:</td> <td><input type="text" name="length" size="6" value="<?php echo $d_length ?>"/></td></tr>
<tr><td>Agency:</td> <td><input type="text" name="agency" size="5" value="<?php echo $d_agency ?>"/></td></tr>
<tr><td>Copies:</td> <td><input type="text" name="copies" size="2" value="<?php echo $d_copies ?>"/></td></tr>
<tr><td>Aurora ID:</td> <td><input type="text" name="aurora" size="5" value="<?php echo $aurora_bib ?>"/></td></tr>

<tr><td>OCLC:</td> <td><input type="text" name="oclc" size="15" value="<?php echo $d_oclc ?>"/></td></tr>
<tr><td>ISBN:</td> <td><input type="text" name="isbn" size="15" onblur="document.wcfn.q.value = document.booknew.isbn.value" value="<?php echo $d_isbn ?>"/></td></tr>
<tr><td>Converted to digital:</td> <td><input type="checkbox" name="digital" value="Digital" checked="<?php echo $digital_check; ?>" title="Converted to digital"/></td></tr>
<tr><td>Converted to Mono:</td> <td><input type="checkbox" name="mono" value="YES" checked="<?php echo $mp3_check; ?>" title="Converted to Mono"/></td></tr> 
<tr><td>Processed in Obi:</td> <td><input type="checkbox" name="obi" value="YES" checked="<?php echo $mp3_check; ?>" title="Processed in Obi"/></td></tr>   
<tr><td>Converted to MP3:</td> <td><input type="checkbox" name="mp3" value="YES" checked="<?php echo $mp3_check; ?>" title="Converted to MP3"/></td></tr>  
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
<input type="submit" name="submit" value="Edit Book"/>





</form>







</p>
<p><a href="dtbprod.php">Back to Search</a> | <a href="../opac/" target="_blank">Library Search</a>  | <a href="http://www.worldcat.org" target="_blank">WorldCat Search</a></p>


<?php echo "$searchresults $thelist"; ?>


<?php require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>