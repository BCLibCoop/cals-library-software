<?php



$today = gmdate('Y-m-d',time());
$lweek = gmdate('Y-m-d',strtotime ("-1 week"));
$yesterday = gmdate('Y-m-d',strtotime ("-2 day"));
$lmonth = gmdate('Y-m-d',strtotime ("-4 week"));

$db_name = "DB_requests";
$table_name = "t_librequests";
$connection = @mysql_connect("localhost","root","cucat") or die("Couldn't Connect.");
$db = @mysql_select_db($db_name, $connection) or die("Couldn't select database.");

$tomail = "gkearney@gmail.com";




?>