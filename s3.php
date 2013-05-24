<?php
// Copyright 3 Robin H. Johnson <robbat2@sitka.bclibraries.ca>
require_once 'AWSSDKforPHP/aws.phar';
require_once 'database_constants.php';
use Aws\S3\S3Client;
$config = $_CONFIG['aws_s3'];
global $s3v2;
$s3v2 = S3Client::factory($config);
#$result = $s3v2->listBuckets();
#print_r($result['Buckets']);

function os_path_join() {
  return preg_replace('~[/\\\]+~', DIRECTORY_SEPARATOR, implode(DIRECTORY_SEPARATOR, array_filter(func_get_args(), function($p) {
    return $p !== '';
  })));
}


function s3_object_head($filepath, $params = array()) {
  global $_CONFIG, $s3v2;
  $bucket = $_CONFIG['aws_s3']['bucket'];
  $prefix = $_CONFIG['aws_s3']['prefix'];
  $objName = os_path_join($prefix, $filepath);
  $ret = $s3v2->headObject(array_merge(array('Bucket' => $bucket, 'Key' => $objName), $params));
  return $ret;
}

function s3_object_get($filepath, $params=array()) {
  global $_CONFIG, $s3v2;
  $bucket = $_CONFIG['aws_s3']['bucket'];
  $prefix = $_CONFIG['aws_s3']['prefix'];
  $objName = os_path_join($prefix, $filepath);
  $ret = $s3v2->getObject(array_merge(array('Bucket' => $bucket, 'Key' => $objName), $params));
  return $ret;
}

function s3_object_exists($filepath) {
  global $_CONFIG, $s3v2;
  $bucket = $_CONFIG['aws_s3']['bucket'];
  $prefix = $_CONFIG['aws_s3']['prefix'];
  $objName = os_path_join($prefix, $filepath);
  return $s3v2->doesObjectExist($bucket, $objName);
}

$s3v2->registerStreamWrapper();

?>
