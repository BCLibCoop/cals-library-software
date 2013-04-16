<?php

include "../openbiblio/database_constants.php";

date_default_timezone_set('Australia/Perth');
$bmark = '';
$bookreport = '';
$ctable = '';
$bookorder = '';
$sql_two_months = '';
$btable = '';
$braillereport = '';
//ini_set('display_errors', 1);
//error_reporting(E_ERROR ^ E_WARNING);
// Added by Greg Kearney needed to display QRcodes below
 include $_SERVER['DOCUMENT_ROOT']."/includes/phpqrcode/qrlib.php";
//End of QRcode display.
$colcount = 1;
$previous_s = '';
	$pt = "";
	$now = date('d F Y');

if (isset($_GET['Reorder'])) {


switch ($_GET['timeradio']){
	case "1week":
		$thepast =strtotime("-1 week");
		$two_months = date('d F Y',$thepast);
		$sql_timelimit = date('Y-m-d',$thepast);
		//echo $sql_timelimit;
		break;
	case "2week":
		$thepast =strtotime("-2 week");
		$two_months = date('d F Y',$thepast);
		$sql_timelimit = date('Y-m-01',$thepast);
		break;
	case "1month":
		$thepast =strtotime("-1 month");
		$two_months = date('01 F Y',$thepast);
		$sql_timelimit = date('Y-m-01',$thepast);
		break;
	case "3month":
		$thepast =strtotime("-3 month");
		$two_months = date('01 F Y',$thepast);
		$sql_timelimit = date('Y-m-01',$thepast);
		break;
	case "4month":
		$thepast =strtotime("-4 month");
		$two_months = date('01 F Y',$thepast);
		$sql_timelimit = date('Y-m-01',$thepast);
		break;
	case "6month":
		$thepast =strtotime("-6 month");
		$two_months = date('01 F Y',$thepast);
		$sql_timelimit = date('Y-m-01',$thepast);
		break;
	default;
		$thepast =strtotime("-2 month");
		$two_months = date('01 F Y',$thepast);
		$sql_timelimit = date('Y-m-01',$thepast);
		break;
}	

} else {
		$thepast =strtotime("-2 month");
		$two_months = date('01 F Y',$thepast);
		$sql_timelimit = date('Y-m-01',$thepast);

}



	
	/*
	$twomonthspast =strtotime("-2 month");
	$two_months = date('01 F Y',$twomonthspast);
	$sql_timelimit = date('Y-m-01',$twomonthspast);
*/
	//echo $sql_two_months;
	$db = mysql_connect(OBIB_HOST,OBIB_USERNAME,OBIB_PWD) or die ("Could not connect to database server {OBIB_HOST} " . mysql_error());
	mysql_select_db(OBIB_DATABASE,$db) or die ("Could not connect to database  {OBIB_DATABASE} " . mysql_error());

//$sql = "select distinct biblio_copy.bibid,title from biblio,biblio_copy where biblio_copy.create_dt > '$sql_two_months' and biblio.bibid = biblio_copy.bibid order by title";



$sql = "select distinct b.bibid,title,collection_cd,material_cd
from biblio b, biblio_copy bc
where (bc.create_dt > '$sql_timelimit'
and b.bibid=bc.bibid)
order by collection_cd, title";

//

//echo $sql;

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
	case "21":
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
			$bookreport .= "<hr size=\"2\" solid/><h3><a name=\"$collection\"></a>$collection</h3>";
			$ctable .= "<a href=\"#$collection\"><strong>$collection</strong><br/>\n";
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
			$uid = $row_ta['bibid'];
			$url = "http://www.galloplibrary.com/cals/opac/view.php?b=$uid";
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
				$summary = htmlentities($row_sum['summary'],ENT_QUOTES,"UTF-8");
				$summary = eregi_replace("�", "'", $summary);
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
				if (eregi("Apple",$n)){$narrator = "<br/>Narrated by $n\n<br/>";} else {$narrator = "<br/>";}

		}






			if (eregi('^s|^D|^NZ|^G|^C|^M|^O',$s) and ($s != $previous_s)) {
			$bookreport .= "<p class=\"pbreak\"><strong><a href=\"http://www.galloplibrary.com/cals/opac/view.php?b=$uid\">$title</a></strong>\n<br/><strong>$s</strong> $playtime<br/>\nby $author$narrator$summary</p>\n\n";
			
			
			switch ($colcount){
				case "1":
					$bookorder .= "<tr><td>☐ $s</td>";
					$colcount++;
					break;
				case "4":
					$bookorder .= "<td>☐ $s</td></tr>\n";
					$colcount = 1;
					break;
				default:
					$bookorder .= "<td>☐ $s</td>";
					$colcount++;
					break;			
			
			}
			
			
						 
			
			$previous_s = $s;
			$pt = "";
			}
		}


		}



//Generate the Braille list Below

$braillesql = "select distinct b.bibid,title,collection_cd,material_cd
from biblio b, biblio_copy bc 
where (bc.create_dt > '$sql_two_months' 
and b.bibid=$bibid 
and b.bibid=bc.bibid 
and (material_cd = '17' or material_cd = '11'))
order by collection_cd, title ";
//echo $braillesql;
$sqlresults = mysql_query($braillesql,$db) or die ("Error in sql statement $sql <p>" . mysql_error());

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
		}


		if ($collection != $bmark) {
			$braillereport .= "<hr size=\"2\" solid/><h3><a name=\"$collection\"></a>$collection</h3>";
			$btable .= "<a href=\"#$collection\"><strong>$collection</strong><br/>\n";
			$bmark = $collection;
		}


		$ta = "	select b.bibid,title,author,field_data as s
				from biblio b, biblio_field bf, biblio_field_data bfd
				where b.bibid=$bibid and bf.bibid=b.bibid 
				and (material_cd = '17' or material_cd = '11')
				and opac_flg = 'Y' and tag ='035'
				and bf.fieldid=bfd.fieldid 
				and field_data LIKE 'B%' ";

		//echo "$ta<br/>";
		$sqlresults_ta = mysql_query($ta,$db) or die ("Error in sql statement $sql <p>" . mysql_error());
		while ($row_ta = mysql_fetch_array($sqlresults_ta)) {
			$title = stripslashes($row_ta['title']);
			$s = $row_ta['s'];
			$author = $row_ta['author'];
			$uid = $row_ta['bibid'];

			}


			$summary = "";
			$sum = "select field_data as summary
				from biblio_field bf, biblio_field_data bfd 
				where bibid='$uid' 
				and tag ='520'
				and bf.fieldid=bfd.fieldid ";

			$sqlresults_sum = mysql_query($sum,$db) or die ("Error in sql statement $sum <p>" . mysql_error());
			while ($row_sum = mysql_fetch_array($sqlresults_sum)) {
				$summary = htmlentities($row_sum['summary'],ENT_QUOTES);
				//$summary = eregi_replace("�", "'", $summary);
		}



			if ($s != $previous_s) {
			$braillereport .= "<p class=\"pbreak\"><div class=\"box\"> </div><strong>$title</strong>\n<br/><strong>$s</strong><br/>\nby $author<br/>\n$summary</p>\n\n";
			
			switch ($colcount){
				case "1":
					$bookorder .= "<tr><td>☐ $s</td>";
					$colcount++;
					break;
				case "4":
					$bookorder .= "<td>☐ $s</td></tr>\n";
					$colcount = 1;
					break;
				default:
					$bookorder .= "<td>☐ $s</td>";
					$colcount++;
					break;			
			
			}
			
			
			$previous_s = $s;
			$pt = "";
			}
}




?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">

body { 	font-family: sans-serif;
		margin-left:.5cm;
		margin-right:.5cm;
}




@media print
{
.pbreak {page-break-before:auto}


.box { border: 1px solid black; 
	height: 2em; /*Specify Height*/
	width:  2em; /*Specify Width*/
	}

.smallbox { border: 1px solid black; 
	height: .5em; /*Specify Height*/
	width:  .5em; /*Specify Width*/
	}
	
h3 {page-break-before:always}

.noprint {
	
	display: none;
	
	visibility: hidden;
	

}


.col {
	columns: 2;

}

}

</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Shelflist <?php echo $now ?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href=".css" />






</head>
<body>

<table border="0" width="100%">
<tr><td align="left"><h1>Shelflist</h1><br/><strong><?php echo $now ?></strong></td><td align="right"><img src="logo_horizontal.jpg" alt="logo_horizontal" width="" height="100" /></td></td></tr>
</table>
<p>A publication of the Dr. Geoff Gallop Braille and Talking Book Library of the Association for the Blind of Western Australia </p>
<h2>New Digital Talking Books<br/>from <?php echo $two_months ?> to <?php echo $now ?></h2>
<p>This is a list of the talking books which have been produced into DAISY digital talking book format or available in downloadable Braille format by the Association for the Blind of Western Australia from <?php echo $two_months ?> to <?php echo $now ?> these books can be accessed from the association or online at http://www.guidedogswa.org/ or by printing order form at the end of this list, checking the box each title and returning book order to us by post or fax at:<br/>
<address>
Library Service<br/>
Association for the Blind of Western Australia<br/>
P.O. Box 101<br/>
Victoria Park, WA 6979<br/>
AUSTRALIA<br/>
Facsimile +61 08 9361 8696<br/>
</address></p>

<div class="noprint">
<form action="index.php" method="get">
<input name="timeradio" type="radio" value="1week"/> One Week
<input name="timeradio" type="radio" value="2week"/> Two Weeks
<input name="timeradio" type="radio" value="1month"/> One Month
<input name="timeradio" type="radio" value=""/> Two Months
<input name="timeradio" type="radio" value="3month"/> Three Months
<input name="timeradio" type="radio" value="4month"/> Four Months
<input name="timeradio" type="radio" value="6month"/> Six Months
<input type="submit" name="Reorder" value="Reorder"/>

</form>
<p><strong><a href="#tbc">Talking Books</a><br/>
<a href="#bc">Braille Books</a></strong></p>
</div>

<div class="">
<h3><a name="order"></a>Book Order</h3>
<p>
<table width="90%" align="left">
<tr><td>Name</td><td>__________________</td><td rowspan="5"><strong>Return this forms to:</strong><br/>Library Services<br/>Association for the Blind of Western Australia<br/>P.O. Box 101<br/>Victoria Park, WA 6101<br/>AUSTRALIA</td></tr>
<tr><td>Address</td><td>__________________</td></tr>
<tr><td>City</td><td>__________________</td></tr>
<tr><td>State</td><td>__________________</td></tr>
<tr><td>Post Code</td> <td>__________________</td></tr>
</table>
</p>
<p>
<table width="90%" align="center">
<?php  echo "$bookorder"; ?>
</table>
</p>
<hr/>
</div>



<h3><a name="tbc"></a>Talking Books</h3>
<div class="noprint"><?php  echo "$ctable"; ?></div>
<?php  echo "$bookreport"; ?>

<h3><a name="bc"></a>Braille Books</h3>
<div class="noprint"><?php  echo "$btable"; ?></div>
<?php  if (isset($braillereport))  {echo "$braillereport";} ?>
<hr/>

</body>
</html>
