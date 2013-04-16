<?php
$tab = "o";
require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/header_opac.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Biblio.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioCopy.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioCopyQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcTagDm.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcTagDmQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcSubfieldDm.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/UsmarcSubfieldDmQuery.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/marcFuncs.php");
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,"shared");




$title = $_GET['title'];
$author = $_GET['author'];
$uri = $_GET['uri'];
$uri = $uri . "&tab=opac";
$sysNum = $_GET['sysNum'];

$newrequest = htmlspecialchars("newrequest.php?title=$title&sysNum=$sysNum&author=$author&uri=$uri");
$libraryrequest = htmlspecialchars("libraryrequest.php?title=$title&sysNum=$sysNum&author=$author&uri=$uri");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">

.request {
	
	font-weight: bold;
	font-family: sans-serif;
	font-size: x-large;
}

</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Request Talking Book Production</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href=".css" />
<link rel="stylesheet" type="text/css" href="css/forms.css" />
</head>
<body>
<h1>Talking Book Production Request</h1>
<p>You are requesting the following title be produced as a talking book:</p>

<p><strong><?php echo "$title $sysNum"; ?></strong><br/>
<em><?php echo $author; ?></em></p>

<div class="request">
<p>Are you:</p>


<p style="margin-left: 3em;"><a href="<?php echo $newrequest ?>">An Individual Reader</a></p>

<p style="margin-left: 3em;"><a href="<?php echo $libraryrequest ?>">A Library or Agency</a></p>
</div>


<?php require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>