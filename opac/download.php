<?php
 	#****************************************************************************
  	#*  Checking for POST vars.
  	#****************************************************************************
  	if (!isset($_GET['c'])) {
    	header("Location: index.php");
    	exit();
  	}



	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once('loginCheck.php');

	require_once(__ROOT__."functions/sessionFuncs.php");
	require_once(__ROOT__."classes/BiblioCopy.php");
  	require_once(__ROOT__."classes/BiblioCopyQuery.php");
  	require_once(__ROOT__."classes/Biblio.php");
  	require_once(__ROOT__."classes/BiblioQuery.php");
	require_once '../s3.php';


 	#****************************************************************************
  	#*  Retrieving POST var
  	#****************************************************************************
  	$copyid = (int)$_GET['c'];

  	// get the bibid
  	$copyQ = new BiblioCopyQuery();
  	$copy = $copyQ->getCopy($copyid);
  	if (($copy === false))
	{
		header("location: index.php?msg=".H('Invalid Copy id'));
		exit;
	}

  	$bibid = $copy->getBiblioId();
  	$bibQ = new BiblioQuery();
  	$bib = $bibQ->getEntry($bibid,false);

  	if (($bib->getIsRestricted() === true) && ($isGuest===true) )
	{
		header("location: view.php?b=".$bibid."&msg=".H('Session Expired Please login'));
		exit;
	}

	unset($bib);
	unset($bibQ);
	unset($copyQ);

  	if(($copy != false))
  	{
  		   	$origFile = ROOT_ARCHIVES_PATH;
  			$origFile .= $copy->getFilePath();

  			if ((file_exists($origFile)))
  			{

  				$filesize = filesize($origFile);
  				$basename = pathinfo($origFile,PATHINFO_BASENAME);

				$bucket =  $_CONFIG['aws_s3']['bucket'];
				$prefix =  $_CONFIG['aws_s3']['prefix'];
				$expiry_time = '+30 minutes';
				$old_key =  $copy->getFilePath();
				$old_key =  os_path_join($bucket, $prefix, $old_key);
				if(isset($_SESSION['_user'])) {
					$uid = $_SESSION['_user']['id'];
				} else {
					$uid = 'guest';
				}
				$hash_input = sprintf('user=%s,bib=%d,copy=%d,ts=%d', $uid, $bibid, $copyid, time());
				# The hash is so that users can't just guess the URL.
				$tmp_key =  sprintf('downloads/%d/%s/%s', strtotime($expiry_time), md5($hash_input), $basename);
				# For debug only:
				#header('X-HashInput: '.$hash_input."\n");
				#header('X-OldKey: '.$old_key."\n");
				#header('X-TmpKey: '.$tmp_key."\n");
				# We know the object already exists, so we don't need to check for 404 NoSuchKey
				
				# S3 calls start here:
				$s3v2->copyObject(array(
				  'CopySource' => $old_key,
				  'Key' => $tmp_key,
				  'Bucket' => $bucket,
				  'Expires' => $expiry_time,
				  'StorageClass' => 'REDUCED_REDUNDANCY',
				  'PathStyle' => true,
				));
				$command = $s3v2->getCommand('GetObject', array(
				  'Key' => $tmp_key,
				  'Bucket' => $bucket,
				  'PathStyle' => true,
				  'ResponseCacheControl' => 'must-revalidate, post-check=0, pre-check=1',
				  'ResponseContentDisposition' => 'attachment; filename="'.$basename.'";',
				  'ResponseContentType' => 'application/octet-stream',
				));
				#print("signed\n");
				$signedUrl = $command->createPresignedUrl($expiry_time);

				# Redirect the user to the signed storage URL.
				#print('Location: '.$signedUrl."\n");
				header('Location: '.$signedUrl);

			}
	}
?>
