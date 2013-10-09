<?php
$params = array("PathStyle" => true);
stream_context_set_default(array('s3'=>$params));
#stream_context_get_default(array('s3'=>$params));
var_dump(stream_context_get_options(stream_context_get_default()));
require 's3.php';
var_dump(stream_context_get_options(stream_context_get_default()));
try {
$objInfo = s3_object_head('popular/emma/emma.xmlx');
} catch(Aws\S3\Exception\NoSuchKeyException $e) {
//var_dump($e);
}

#$params = array("PathStyle" => true);
#stream_context_set_default(array('s3'=>$params));

#exit;

global $_CONFIG;
$bucket = $_CONFIG['aws_s3']['bucket'];
$prefix = $_CONFIG['aws_s3']['prefix'];
//
//$f = 'popular/emma/emma.xml';
//$f = 'restricted/S00004/x00004_fortune_and_misfortune_are_both_a_blessing_S00004.zip';
//$f = 'pd/G17401/The_Time_Machine_G17401.zip';
//$lf = sprintf('s3://%s/%s/%s', $bucket, $prefix, $f);
//#$objInfo = s3_object_head($f);
//#print($objInfo['ContentLength']."\n");
//print(filesize($lf)."\n");
//print(file_exists($lf)."\n");
//
//print("Copy\n");
//$old_key = os_path_join($prefix, $f);
//$basename = pathinfo($old_key,PATHINFO_BASENAME);
//$uid = 12345;
//$copyid = 12345;
//$tmp_key =  sprintf('downloads/user-%08x-copy-%08x/%s', $uid, $copyid, $basename);
//$expiry_time = '+1 minutes';
//
//try {
//$command = $s3v2->copyObject(array(
//  'CopySource' => os_path_join($bucket, $old_key),
//  'Key' => $tmp_key,
//  'Bucket' => $bucket,
//  'Expires' => $expiry_time,
//  'StorageClass' => 'REDUCED_REDUNDANCY',
//  'PathStyle' => true,
//));
//} catch(Aws\S3\Exception\NoSuchKeyException $e) {
//printf("%s\n",$e->getResponse());
//}
//$expiry_time = '+5 minutes';
//$command = $s3v2->getCommand('GetObject', array(
//  'Bucket' => $bucket,
//  'Key' => $tmp_key,
//  'ResponseContentDisposition' => 'attachment; filename="data.txt"',
//  'PathStyle' => true,
//));
//$signedUrl = $command->createPresignedUrl($expiry_time);
//print($signedUrl);

#$obj = s3_object_get('popular/emma/emma.xml');
#print_r($objInfo['data:protected']);
#echo $obj['Body'];


$bucket = $_CONFIG['aws_s3']['bucket'] = 'test2';
$prefix = $_CONFIG['aws_s3']['prefix'] = '/';

//$result = $s3v2->listBuckets();
//foreach ($result['Buckets'] as $bucket) {
//        echo "- {$bucket['Name']}\n";
//	print_r($bucket);
//}

$resp = $s3v2->getBucketAcl(array('Bucket' => $bucket, 'PathStyle'=>true));
$acl = $resp;
print_r($acl['Owner']);
print_r($acl['Grants']);
print_r($acl['RequestId']);

$resp = $s3v2->getBucketAcl(array('Bucket' => $bucket, 'PathStyle'=>true, 'GrantRead' => 'nnels:ABWA'));
printf("%s%s"," requestid", $resp['RequestId']);

?>
