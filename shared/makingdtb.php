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


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">

.smallfont {
	font-size: small;
}

</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>DTB Instructions</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href=".css" />
</head>
<body>


<h2>Introduction</h2>

<p>Thank you for your willingness to help the Association for the Blind of Western Australia in producing digital talking books. This page provides instructions for processing the text files you will receive from us into word processor formats used to produce digital talking books.</p> 

<p>To perform this work you will need a computer and either Microsoft Word, an version or OpenOffice which can be downloaded for free from <a href="www.openoffice.org">OpenOffice.org</a> There are versions of Open Office which will run on Windows, Macintosh and Linux computers.</p>

<h2>Text Files</h2>

When a request for production of a book is made from our system we retrieve a text file of that work and perform some basic check on format and layout of the document. We will then forward to you the text file for further processing in your word processor.

<p>Open the text file in your word processor set to standard A4 paper size. You do not need to be concerned about fonts or font size of the document.</p>

<p>Your primary task is to identify major and minor sections of the work and mark the start of those as headings. For example if the work has 10 chapters each starting with the chapter title then that chapter title would be given the style <q>Heading 1</q>. If there are sub sections of the work they would be given a style of <q>Heading 2</q>. as a rule you should not have more than three levels of headings deep.</p>

<p>These headings can by applied by simply placing the text cursor in the line of text and selecting the style required from the styles menu or palette. </p>

<h2>Other Formatting</h2>

<p>It is also helpful to do some other simple Formatting tasks such as converting strings of all uppercase letter into title case like this: THIS IS ALL UPPERCASE LETTERS becomes this: This is all Uppercase Letters.</p> 

<p>Lists of items should be converted to true lists using your word processors list building functions.</p>

<p>Abbreviations should be expanded out there full word meanings so as to avoid confusion with abbreviation like st. meaning either Street or Saint.</p>


<?php require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>