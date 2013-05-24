#!/usr/bin/php

<?php
ini_set('display_errors', 1);
echo "START\n";
date_default_timezone_set ( "UTC" );


include "database_constants.php";


$colcount = 1;
$previous_s = '';
$pt = "";
$now = date('d F Y');

$twomonthspast =strtotime("-2 month");
$two_months = date('01 F Y',$twomonthspast);
$sql_timelimit = date('Y-m-01',$twomonthspast);

echo "$sql_timelimit\n";

$db = mysql_connect(OBIB_HOST,OBIB_USERNAME,OBIB_PWD) or die ("Could not connect to database server {OBIB_HOST} " . mysql_error());
mysql_select_db(OBIB_DATABASE,$db) or die ("Could not connect to database  {OBIB_DATABASE} " . mysql_error());





$sql = "select distinct b.bibid,title,collection_cd,material_cd
from biblio b, biblio_copy bc
where (bc.create_dt > '$sql_timelimit'
and b.bibid=bc.bibid)
order by collection_cd, title";


echo "$sql\n\n";


$sqlresults = mysql_query($sql,$db) or die ("Error in sql statement $sql <p>" . mysql_error());

while ($row = mysql_fetch_array($sqlresults)) {

		$bibid = $row['bibid'];
		$collection = $row['collection_cd'];
		$material = $row['material_cd'];



switch ($collection){
	case "1":
		$collection = "Adult Fiction";
		break;
	case "2":
		$collection = "Adult Nonfiction";
		break;
	case "14":
		$collection = "Juvenile Fiction";
		break;
	case "15":
		$collection = "Juvenile Nonfiction";
		break;
	case "9":
		$collection = "New Books";
		break;	
		}



switch ($material){
	case "1":
		$material = "Public Download";
		break;
	case "13":
		$material = "Restricted Download";
		break;
	case "11":
		$material = "Resticted Braille";
		break;
	case "17":
		$material = "Public Braille";
		break;
		}




		if ($collection != $bmark) {
			$bookreport .= "</level1>\n<level1>\n<h1>$collection</h1>\n";
			$ctable .= "<strong>$collection</strong><br/>\n";
			$bmark = $collection;
		}




		$ta = "	select b.bibid,title,author,field_data as s
				from biblio b, biblio_field bf, biblio_field_data bfd
				where b.bibid='$bibid' 
				and bf.tag ='35' 
				and bf.bibid=b.bibid  
				and bfd.fieldid = bf.fieldid ";
		//echo "$ta<br/>";
		$sqlresults_ta = mysql_query($ta,$db) or die ("Error in sql statement $sql <p>" . mysql_error());
		while ($row_ta = mysql_fetch_array($sqlresults_ta)) {
			$title = stripslashes($row_ta['title']);
			$s = $row_ta['s'];
			$author = $row_ta['author'];
			$author = @eregi_replace("& ", "and ", $author);
			$author = str_ireplace("&", "and", $author);
			$uid = $row_ta['bibid'];
			$qrcode_path = $_SERVER['DOCUMENT_ROOT']."/qrcodes/$uid.png";

			//QRcode::png("$url", "$qrcode_path", "L", 4, 2);
			//QRtools::buildCache();



			$ptime = "select distinct field_data as pt
				from biblio_field_data bfd, biblio_field bf 
				where bibid = '$uid'
				and tag ='306'
				and subfield_cd ='a'
				and bfd.fieldid = bf.fieldid ";
				$pt = "";
				$playtime = "";

			$sqlresults_ptime = mysql_query($ptime,$db) or die ("Error in sql statement $nar <p>" . mysql_error());
			while ($row_ptime = mysql_fetch_array($sqlresults_ptime)) {
				$pt = htmlentities($row_ptime['pt']);

				if (strlen($pt) == 6) {
				$hours = substr($pt, 0 , 2);
				$minutes = 	substr($pt, 2 , 2);
				if ($minutes == '00') {
				$playtime = "$hours hours";
				} else {
				$playtime = "$hours hours $minutes minutes";
				}
				} else {$playtime = "";}
		}



			$summary = "";
			$sum = "select field_data as summary
				from biblio_field_data bfd, biblio_field bf 
				where bibid = '$uid' 
				and tag ='520' 
				and bfd.fieldid = bf.fieldid ";

			$sqlresults_sum = mysql_query($sum,$db) or die ("Error in sql statement $sum <p>" . mysql_error());
			while ($row_sum = mysql_fetch_array($sqlresults_sum)) {
				$summary = $row_sum['summary'];

				//$summary = htmlentities($row_sum['summary'],ENT_QUOTES,"UTF-8");
				$summary = @eregi_replace("�", "'", $summary);
				$summary = @eregi_replace("& ", "and ", $summary);
				$summary = str_ireplace("&", "and", $summary);
		}

			$nar = "select distinct field_data as n
				from biblio_field_data bfd, biblio_field bf 
				where bibid='$uid'
				and tag ='700'
				and subfield_cd ='a'
				and bfd.fieldid = bf.fieldid ";


			$sqlresults_nar = mysql_query($nar,$db) or die ("Error in sql statement $nar <p>" . mysql_error());
			while ($row_nar = mysql_fetch_array($sqlresults_nar)) {
				$n = htmlentities($row_nar['n']);
				if (@eregi("Apple",$n)){$narrator = "<br/>Narrated by $n\n<br/>";} else {$narrator = "<br/>";}

		}




			$title = str_replace ( "& ", "and ", $title);

			if (@eregi('^s|^D|^NZ|^G|^C|^M|^O|^BE',$s) and ($s != $previous_s)) {
			$bookreport .= "<p class=\"pbreak\"><strong>$title</strong>\n<br/><strong>$s</strong> $playtime<br/>\nby $author$narrator$summary</p>\n\n";



}
}
}


$bookid = date('Ymdhis');
$shelf_title = "Shelflist $now";
$shelf_date = date('Y-m-d');

$bookreport = str_ireplace("& ", "and ", $bookreport);



$shelflist = <<<EOD
<?xml version='1.0' encoding='UTF-8'?>
<!DOCTYPE dtbook PUBLIC "-//NISO//DTD dtbook 2005-3//EN" "http://www.daisy.org/z3986/2005/dtbook-2005-3.dtd">
<dtbook xmlns="http://www.daisy.org/z3986/2005/dtbook/" version="2005-3" xml:lang="en-AU">
	<head>
		<meta name="dc:Identifier" content="auvpabw-$bookid" />
		<meta name="dc:Language" content="en-AU" />
		<meta name="dc:Title" content="$shelf_title" />
		<meta name="dc:Creator" content="Association for the Blind of Western Australia" />
		<meta name="dc:Publisher" content="Association for the Blind of Western Australia" />
		<meta name="dtb:producer" content="Greg Kearney" />
		<meta name="dc:Date" content="2011-03-16" />
		<meta name="dc:Type" content="Text" />
		<meta name="dc:Format" content="ANSI/NISO Z39.86-2005" />
		<meta name="dtb:uid" content="auvpabw-$bookid" />
		<meta name="dtb:revision" content="1" />
		<meta name="dtb:revisionDate" content="$shelf_date" />
		<meta name="Generator" content="dtbook.php script version 1" />
</head>

<book>
		<frontmatter>
			<doctitle>$shelf_title</doctitle>
			<docauthor>Canadian Accessible Library System</docauthor>
		<level1>
				<h1>About this digital talking book</h1>
				<p>Navigation of this digital talking book is by book type at the first navigation level.</p>
				<p>This digital talking book was produced by the Canadian Accessible Library System</p>
				<p>To support the production of this and other digital talking books or for more information please contact by email at: nnels@libraries.coop</p>
		</level1>
		</frontmatter>	
			
<bodymatter>
	<level1>
	<h1>$shelf_title</h1>		
		
	<p>A publication of the Canadian Accessible Library System.</p>
<p>New Digital Talking Books from $two_months to $now. This is a list of the talking books which have been produced into DAISY digital talking book format or available in downloadable Braille format.</p>

$bookreport
</level1>



</bodymatter>
</book>
</dtbook>
EOD;

$myFile = "shelflist/tmp/input/shelflist.xml";
$fh = fopen($myFile, 'w') or die("can't open file $myFile");
fwrite($fh, $shelflist);
fclose($fh);

`cd shelflist`;

$pipeline_cmd = "shelflist/pipeline/pipeline.sh  shelflist/pipeline/scripts/create_distribute/dtb/Narrator-DtbookToDaisy.taskScript --input=shelflist/tmp/input/shelflist.xml --outputPath=shelflist/tmp/output/";
$r = `$pipeline_cmd`;

#`mv daisy202 Shelflist`;
#`/usr/bin/zip -r Shelflist Shelflist`;
#`rm -Rf Shelflist`;
#`chown gkearney:staff Shelflist.zip`;
#`cp Shelflist.zip /Volumes/DATA/books/autoadd/`;

?>
