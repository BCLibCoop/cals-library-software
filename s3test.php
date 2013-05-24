<?php
require 's3.php';
try {
$objInfo = s3_object_head('popular/emma/emma.xmlx');
} catch(Aws\S3\Exception\NoSuchKeyException $e) {
//var_dump($e);
}

$f = 'popular/emma/emma.xml';
$f = 'restricted/S00004/x00004_fortune_and_misfortune_are_both_a_blessing_S00004.zip';
$lf = 's3://nnels/Books/'.$f;
$objInfo = s3_object_head($f);
print($objInfo['ContentLength']."\n");
print(filesize($lf)."\n");
print(file_exists($lf)."\n");

#$obj = s3_object_get('popular/emma/emma.xml');
#print_r($objInfo['data:protected']);
#echo $obj['Body'];
?>
