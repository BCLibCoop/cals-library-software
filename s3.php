<?php
require 'AWSSDKforPHP/aws.phar';
use Aws\S3\S3Client;
$config = array(
    'key'    => $_CONFIG['s3_key'],
	'secret' => $_CONFIG['s3_secret'],
);
$s3v2 = S3Client::factory($config);
$result = $s3v2->listBuckets();
print_r($result);

$objName = 'popular/emma/emma.xml';
$objInfo = $client->HeadObject(array(
			'Bucket' => $_CONFIG['s3_bucket'], 
			'Key' => $objName));
$obj = $client->GetObject(array(
			'Bucket' => $_CONFIG['s3_bucket'], 
			'Key' => $objName));

echo $obj['Body'];

// Copyright 3 Robin H. Johnson <robbat2@sitka.bclibraries.ca>
?>
