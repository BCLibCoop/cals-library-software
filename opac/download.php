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


 	#****************************************************************************
  	#*  Retrieving POST var
  	#****************************************************************************
  	$copyid = $_GET['c'];

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
  			$symFile = md5($origFile);
  			$symFile = md5($symFile.$copy->getFilePath());
  			$downloadPath = '/tmp/dls';
  			if((!file_exists($downloadPath))){
  				mkdir($downloadPath,0777,true);
  			}
  			$downloadPath .='/';

  			if ((file_exists($origFile)))
  			{

  				if((!file_exists($downloadPath.$symFile)))
  				{
  					symlink($origFile,$downloadPath.$symFile);
  				}

  				$filesize = filesize($origFile);
  				$basename = pathinfo($origFile,PATHINFO_BASENAME);


  				header('Content-Description: File Transfer');
    	 		header('Content-Type: application/octet-stream');
    	 		header("Accept-Ranges: bytes");
    	 		header('Content-Disposition: attachment; filename="'.$basename.'";');
    	 		header('Content-Transfer-Encoding: binary');
    			header('Content-Length: '.$filesize );
    			header('Cache-Control: must-revalidate, post-check=0, pre-check=1');
    			header('X-Sendfile: '.$downloadPath.$symFile);

    			unset($_SESSION['_user']['returnPage']);

  			}
	}
?>