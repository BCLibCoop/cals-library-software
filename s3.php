<?php
require 'AWSSDKforPHP/aws.phar';
require 'database_constants.php';
use Aws\S3\S3Client;
$config = $_CONFIG['aws_s3'];
$s3v2 = S3Client::factory($config);
#$result = $s3v2->listBuckets();
#print_r($result['Buckets']);

function os_path_join() {
  return preg_replace('~[/\\\]+~', DIRECTORY_SEPARATOR, implode(DIRECTORY_SEPARATOR, array_filter(func_get_args(), function($p) {
    return $p !== '';
  })));
}

$bucket = $_CONFIG['aws_s3']['bucket'];
$prefix = $_CONFIG['aws_s3']['prefix'];
$objName = os_path_join($prefix, 'popular/emma/emma.xml');
$objInfo = $s3v2->HeadObject(array(
			'Bucket' => $bucket,
			'Key' => $objName));
$obj = $s3v2->GetObject(array(
			'Bucket' => $bucket,
			'Key' => $objName));

echo $obj['Body'];

// Copyright 3 Robin H. Johnson <robbat2@sitka.bclibraries.ca>
?>
