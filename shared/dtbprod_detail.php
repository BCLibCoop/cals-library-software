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

  require_once("isbn.php");


  $loc = new Localize(OBIB_LOCALE,"shared");
  setlocale(LC_MONETARY, 'en_AU');

$orgpublisher = "";
	$id = $_GET['id'];
	$update = $_POST['update'];

if ($update) {

$id = $_POST['id'];
$dig = $_POST['digital'];
$the_producer = $_POST['the_producer'];
$the_format = $_POST['the_format'];
$in_aurora = $_POST['in_aurora'];
$notes = $_POST['notes'];

$in_obi = $_POST['in_obi'];
//echo "in_obi is $in_obi<p>";
if ($in_obi == 'on') {$in_obi = "YES";} else {$in_obi = "NO";}

$in_mono = $_POST['in_mono'];
if ($in_mono == 'on') {$in_mono = "YES";} else {$in_mono = "NO";}

$in_mp3 = $_POST['in_mp3'];
if ($in_mp3 == 'on') {$in_mp3 = "YES";} else {$in_mp3 = "NO";}

if ($in_aurora == 'on') {$in_aurora = 1;} else {$in_aurora = 0;}
if ($dig = "on") {$digital = "Digital";} else {$digital = "";}
$db_name = "DB_abwa_books";
$table_name = "t_audio";


$sql_update = "update $table_name set digital = \"$digital\",producer = \"$the_producer\",daisy = \"$the_format\",aurora = \"$in_aurora\",mono = \"$in_mono\",mp3 = \"$in_mp3\",obi = \"$in_obi\",notes = \"$notes\"  where id = $id";


$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");

$total_result = @mysql_query($sql_update, $connection) or die("$sql_update Error #". mysql_errno() . ": " . mysql_error());

print "Record Updated";


}



/*
$db_name = "DB_abwa_books";
$table_name = "t_audio";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");
$sqla = "select * from t_dtbproducers order by last_name";

$total_result = @mysql_query($sqla, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$name = strtoupper($row['last_name']).", ".$row['first_name'];
	$prod_id = $row['id'];
 	$theProducers .= "<option value=\"$prod_id\">$name</option>";
}


$sql = "select distinct aud from t_sales order by aud";

$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$audience = $row['aud'];

 	$thePr .= "<option>$audience </option>";
}
*/
mysql_close($connection);









$db_name = "DB_abwa_books";
$table_name = "t_audio";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");

$sql = "select  * from $table_name where (id = \"$id\") ";

$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$title = $row['title'];
	$author = $row['author'];
	$accno = $row['accno'];
	$editURL = "<a href=\"dtbprodedit.php?accno=$accno\">Edit $accno</a>";
	$accno = preg_replace("/ /", "", $accno);
	$aurora_bib = $row['aurora_bib'];
	$id = $row['id'];
	$digital = $row['digital'];
	$mp3 = $row['mp3'];
	$aurora = $row['aurora'];
	$mp3 = $row['mp3'];
	$obi = $row['obi'];
	$mono = $row['mono'];
	$notes = $row['notes'];








	$producer = $row['producer'];


	$daisy = $row['daisy'];


$theformat .= "<option></option>";
$sqla = "select  * from t_daisy";
$total_result = @mysql_query($sqla, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$d_format = $row['daisy_format'];

		if ($daisy == $d_format){
 			$theformat .= "<option selected>$d_format</option>\n";
 		} else {
 			$theformat .= "<option>$d_format</option>\n";

 		}
 }


$theProducers .= "<option selected></option>";
$sqlb = "select distinct * from t_dtbproducers";
$total_result = @mysql_query($sqlb, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$name = strtoupper($row['last_name']).", ".$row['first_name'];
		$prod_id = $row['prod_id'];



		if ($producer == $prod_id){
 			$theProducers .= "<option value=\"$prod_id\" selected>$name</option>\n";
 		} else {
 			$theProducers .= "<option value=\"$prod_id\">$name</option>\n";
 		}



}
if ($producer == null) {$theProducers .= "<option selected></option>";}



if ($digital != '') {
	$theDigital = "<input type=\"checkbox\" name=\"digital\" checked/ title=\"Converted to digital?\">";
} else {
	$theDigital = "<input type=\"checkbox\" name=\"digital\" title=\"Converted to digital?\"/>";
}

if ($aurora == 0) {
	$aurora_display = "<input type=\"checkbox\" name=\"in_aurora\" title=\"Book in Aurora?\" />";
} else {
	$aurora_display = "<input type=\"checkbox\" name=\"in_aurora\" checked  title=\"Book in Aurora?\" />";
}


if ($obi != 'YES') {
	$obi_display = "<input type=\"checkbox\" name=\"in_obi\" title=\"Book processed in Obi?\" />";
} else {
	$obi_display = "<input type=\"checkbox\" name=\"in_obi\" checked title=\"Book processed in Obi?\" />";
}

if ($mono != 'YES') {
	$mono_display = "<input type=\"checkbox\" name=\"in_mono\" title=\"Book converted to mono?\" />";
} else {
	$mono_display = "<input type=\"checkbox\" name=\"in_mono\" checked title=\"Book converted to mono?\" />";
}

if ($mp3 != 'YES')  {
	$MP3_display = "<input type=\"checkbox\" name=\"in_mp3\" title=\"Book converted to mp3?\" />";
} else {
	$MP3_display = "<input type=\"checkbox\" name=\"in_mp3\" checked title=\"Book converted to mp3?\" />";
}


	if (preg_match('/d/',$accno)) {$leader = "978-81-";} else {$leader = "978-80-";}

	$local_isbn = preg_replace("/[a-z]+| /", "", $accno);
	$tmp_isbn = "$leader$local_isbn-";
	$checksum = mod11_checksum("$tmp_isbn", "10");
	$check_digit = make_checkdigit($checksum);
	$isbn = $tmp_isbn . $check_digit;


	//$format = $row['format'];
 	$thelist .= "<tr><td>$accno<br/>$aurora_bib</td><td><strong>$title</strong></td><td>$author</td><td>$theDigital</td><td>$mono_display</td><td>$obi_display</td><td>$MP3_display</td><td><select name=\"the_producer\" title=\"Producer's name\">$theProducers</select>\n</td><td><select name=\"the_format\" title=\"Daisy format\">$theformat</select>\n</td><td>$isbn</td><!-- <td>$aurora_display</td> --></tr>";



 	//OCLC list


}



mysql_close($connection);

//build the metatdata views
$connection = @mysql_connect(OBIB_HOST,OBIB_USERNAME,OBIB_PWD) or die("Couldn't Connect.");
$db = @mysql_select_db(OBIB_DATABASE, $connection) or die("Couldn't select database.");

$accno_new = preg_replace("/ /", "", $accno);

$metatsql = "select distinct b.bibid from biblio as b,biblio_field as bf where (bf.tag = \"35\" and bf.field_data = \"$accno_new\") and (b.bibid = bf.bibid)";

$total_result = @mysql_query($metatsql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$bibid = $row['bibid'];

}

$metatsql2 = "select field_data from biblio_field as bf where (bf.tag = \"520\" and bf.subfield_cd = \"a\")  and (bibid = \"$bibid\")";

$total_result = @mysql_query($metatsql2, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$description = htmlentities($row['field_data']);

}

$metatsql2 = "select field_data from biblio_field as bf where (bf.tag = \"260\" and bf.subfield_cd = \"b\") and (bibid = \"$bibid\")";

$total_result = @mysql_query($metatsql2, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$publisher = $row['field_data'];

}
//(bf.tag = \"534\" and bf.subfield_cd = \"c\") or
$metatsql2 = "select field_data from biblio_field as bf where  (bf.tag = \"260\" and bf.subfield_cd = \"b\") and (bibid = \"$bibid\")";

$total_result = @mysql_query($metatsql2, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$orgpublisher = $row['field_data'];
		if ($orgpublisher == '') {$orgpublisher = "Assocaition for the Blind of Western Australia";}
		$orgpublisher = preg_replace("/&/", "and", $orgpublisher);
		$orgpublisher = htmlentities($orgpublisher);


}

$metatsql2 = "select field_data from biblio_field as bf where (bf.tag = \"659\" and bf.subfield_cd = \"b\") and (bibid = \"$bibid\")";

$total_result = @mysql_query($metatsql2, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$subject = $row['field_data'];

}

if ($subject == '') {
$metatsql2 = "select topic1,topic2,topic3 from biblio as bf where (bibid = \"$bibid\")";
$total_result = @mysql_query($metatsql2, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$subject = $row['topic1'] . " " . $row['topic2'] . " " . $row['topic3'];

}


}

$metatsql2 = "select  field_data from biblio_field as bf where (bf.tag = \"700\" and bf.subfield_cd = \"a\") and (bibid = \"$bibid\") limit 1";

$total_result = @mysql_query($metatsql2, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$narrator = $row['field_data'];

}

$metatsql2 = "select field_data from biblio_field as bf where (bf.tag = \"534\" and bf.subfield_cd = \"z\")  and (bibid = \"$bibid\")";
$total_result = @mysql_query($metatsql2, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());


while ($row = mysql_fetch_array($total_result)) {
		echo " Start searching for source. $metatsql2";
		$source = $row['field_data'];
		}
echo " End searching for source. $metatsql2 $source";

if (!$source) {

		$metatsql2 = "select field_data from biblio_field as bf where (bf.tag = \"020\" and bf.subfield_cd = \"a\")  and (bibid = \"$bibid\")";
		$total_result = @mysql_query($metatsql2, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
		while ($row = mysql_fetch_array($total_result)) {
		$source = $row['field_data'];
		}


}

if (!$source) {

		$source = $isbn;

}

echo " End searching for source. $metatsql2 $source";


$metatsql2 = "select author from biblio where (bibid = \"$bibid\")";

$total_result = @mysql_query($metatsql2, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$creator = $row['author'];

}

$metatsql2 = "select field_data from biblio_field as bf where (bf.tag = \"98\" and bf.subfield_cd = \"c\") and (bibid = \"$bibid\")";

$total_result = @mysql_query($metatsql2, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());
while ($row = mysql_fetch_array($total_result)) {
		$mydate = $row['field_data'];

}
$time = strtotime( $mydate );
$date = date( 'Y-m-d', $time );
if ($date == "1970-01-01") {$date = date('Y');}
$now = date( 'Y-m-d' );

mysql_close($connection);


//OCLC data
$oclc_key = "ildmaAm6jtvysO0hqoESuhfXeM8lSAsBsWhro0KjWXmRBOCMSpB28HwXNuPxSjacbBp1GRBzxTFfTO37";
$oclc_source = preg_replace('/ISBN /i', '', $source);
$oclc_source = preg_replace('/\./', '', $oclc_source);
$oclc_url = "http://www.worldcat.org/webservices/catalog/search/opensearch?q=$oclc_source&format=atom&wskey=$oclc_key";
$oclc_data = file_get_contents("$oclc_url");
preg_match('/<oclcterms:recordIdentifier>([0-9]+)<//oclcterms:recordIdentifier>/', $oclc_data , $regs);
$oclc_number = $regs[1];
//print_r($regs);
if ($oclc_number == ''){$oclc_number = "000000000";}



$metadata = "<pre>
&lt;meta name=\"dc:creator\" content=\"$creator\" /&gt;
&lt;meta name=\"dc:subject\" content=\"$subject\" /&gt;
&lt;meta name=\"dc:description\" content=\"$description\" /&gt;
&lt;meta name=\"dc:source\" content=\"$source\" /&gt;
&lt;meta name=\"dc:date\" content=\"$date\" /&gt;
&lt;meta name=\"ncc:narrator\" content=\"$narrator\" /&gt;
&lt;meta name=\"ncc:SourcePublisher\" content=\"$orgpublisher\" /&gt;
&lt;meta name=\"ncc:multimediaType\" content=\"audioNcc\" /&gt;
&lt;meta name=\"abwa:oclc\" content=\"$oclc_number\" /&gt;
&lt;meta name=\"abwa:shelf\" content=\"$accno\" /&gt;
</pre>";


$d3metadata = "<pre>
&lt;dc:Creator&gt;$creator&lt;/dc:Creator&gt;
&lt;dc:Publisher&gt;Association for the Blind of Western Australia&lt;/dc:Publisher&gt;
&lt;dc:Subject&gt;$subject&lt;/dc:Subject&gt;
&lt;dc:Description&gt;$description&lt;/dc:Description&gt;
&lt;dc:Date&gt;$date&lt;/dc:Date&gt;
&lt;dc:Source&gt;$source&lt;/dc:Source&gt;


&lt;meta name=\"ncc:narrator\" content=\"$narrator\" /&gt;
&lt;meta name=\"ncc:SourcePublisher\" content=\"$orgpublisher\" /&gt;
&lt;meta name=\"ncc:multimediaType\" content=\"audioNcc\" /&gt;
&lt;meta name=\"abwa:oclc\" content=\"$oclc_number\" /&gt;
&lt;meta name=\"abwa:shelf\" content=\"$accno\" /&gt;
</pre>"







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

.txarea {
	border-style: solid;
	background-color: #cccccc;
	border-width: 1px;
}

</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title><?php echo $title ?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href=".css" />
</head>
<body>

<h2>Book Detail for <?php echo $title ?></h2>
<form action="" method="post">
<input type="hidden" value="<?php echo $id ?>" name="id" />
<table class="smallfont">
<tr><th>Shelf No.<br/>Aurora bib.</th><th>Title</th><th>Author</th><th>Converted<br/>to Digital</th><th>Mono</th><th>Obi</th><th>MP3</th><th>Producer</th><th>Daisy Format</th><th>ISBN</th><!-- <th>In Aurora<br/>as DAISY</th> --></tr>
<?php echo "$searchresults $thelist"; ?>
</table>
<p><strong>Notes:</strong><br /><textarea name="notes" class="txarea" cols="80" title="Production notes."><?php echo $notes; ?></textarea></p>
<input type="submit" name="update" value="Update"/>
</form>
<p><a href="dtbprod.php">Back to Search</a> | <?php echo $editURL ?></p>

<h3>2.02 Metatdata</h3>

<?php echo "$metadata"; ?>

<h3>z3986 Metatdata</h3>

<?php echo "$d3metadata"; ?>





<?php require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>
