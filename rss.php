<?php

require 'database_constants.php';
$pubdate = date('r');

$table_name = "biblio";
$connection = @mysql_connect(OBIB_HOST, OBIB_USERNAME, OBIB_PWD) or die("Couldn't Connect.");
$db = @mysql_select_db(OBIB_DATABASE, $connection) or die("Couldn't select database.");



$sql = "select * from biblio,biblio_copy,biblio_field where (biblio.opac_flg=1) and (biblio.bibid = biblio_copy.bibid) and (biblio_field.tag = 520) and (biblio.bibid = biblio_field.bibid) order by biblio.last_change_dt desc  limit 5";

$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

while ($row = mysql_fetch_array($total_result)) {
	$bibid = $row['bibid'];
	$title = $row['title'];
	$title_remainder = $row['title_remainder'];
	$author = $row['author'];
	$link = $row['file_path'];
	$desc = $row['field_data'];
	$title = preg_replace("\/\","",$title);
	$title_remainder = preg_replace("\/\","",$title_remainder);

$items .= "
<item>
    <title>$title $title_remainder</title>
    <pubDate>$pubdate</pubDate>
    <link>http://www.guidedogswa.org$link</link>
    <description>$desc</description>
</item>

";




}


header("Content-Type: application/xml; charset=ISO-8859-1");

?>
<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; ?>
<rss version="2.0">
<channel>
  <title>ABWA Library New DAISY books</title>
  <link>http://www.guidedogswa.org/</link>
  <description>Keeping you up to day on the laster DAISY digital talking books from the Association for the Blind of Western Australia.</description>
  <pubDate><?php echo $pubdate; ?></pubDate>
  <?php echo $items; ?>
</channel>
</rss>
