<?php
require 's3.php';
try {
$objInfo = s3_object_head('popular/emma/emma.xmlx');
} catch(Aws\S3\Exception\NoSuchKeyException $e) {
//var_dump($e);
}

$objInfo = s3_object_head('popular/emma/emma.xml');
print($objInfo['ContentLength']."\n");
print(filesize('s3://nnels/Books/popular/emma/emma.xml')."\n");

#$obj = s3_object_get('popular/emma/emma.xml');
#print_r($objInfo['data:protected']);
#echo $obj['Body'];
?>
