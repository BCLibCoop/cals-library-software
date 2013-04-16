<?php

error_reporting(E_ALL);


$d_data = "\"Accession Number\",\"Finish Date\",\"Title\",\"Author\",\"Narrator\",\"Agency\",\"Tapes\",\"Length\",\"copies\",\"ISBN\",\"Aurora biblio\",\"Digital\",\"MP3\",\"Daisy\",\"In Aurora\"\n";
$db_name = "DB_abwa_books";
$table_name = "t_audio";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");

$data_sql = "select * from $table_name order by accno";
$total_result = @mysql_query($data_sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$d_accno = $row['accno'];
	$d_finish_date = $row['finish_date'];	
	$d_title = $row['title'];
	$d_author = $row['author'];	
	$d_narrator = $row['arrator'];	
	$d_agency = $row['agency'];
	$d_tapes = $row['tapes'];
	$d_length = $row['length'];
	$d_copies = $row['copies'];
	$d_isbn = $row['isbn'];
	$aurora_bib = $row['aurora_bib'];
	$d_mp3 = $row['mp3'];
	$digital = $row['digital'];	
	$daisy = $row['daisy'];
	$aurora = $row['aurora'];
	
	$d_data .= "\"$d_accno\",\"$d_finish_date\",\"$d_title\",\"$d_author\",\"$d_narrator\",\"$d_agency\",\"$d_tapes\",\"$d_length\",\"$d_copies\",\"$d_isbn\",\"$aurora_bib\",\"$digital\",\"$d_mp3\",\"$daisy\",\"$aurora\"\n";
	
}

mysql_close($connection);
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="digitallist.csv"');
print  $d_data;
exit;


?>

