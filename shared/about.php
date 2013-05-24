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
<title>About Us</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href=".css" />
</head>
<body>


<h2>Digital Library for People with a Print Disability</h2>

<p>The Canadian Accessible Library System (CALS) is a digital public library of on-demand titles for alternate format materials.  Individuals with active library cards can <a href="mailto:nnels@bc.libraries.coop">contact nnels</a> to register for the site. This site is a beta test with full release scheduled in Fall 2013.
</p> 

<p>This library is available to any person with a print disability: blind or other vision impairment, dyslexia, inability to hold a book. <a href="http://nationalnetwork.ca">National Network of Equitable Library Services(NNELS)</a> is an evolving network of library users, librarians, library associations, print producers, alternate format producers and others.

<p>The project, provides access to library books through a network of exchange as well as open library content.  This is a digital audio on demand project for inter-library loan of alternate format materials.


<h2>Audio on Demand</h2>

<p>After conducting your search, items found will be listed. Some books have not yet been produced into alternative formats so, if after choosing an item from the list does not include download click the <em>Request Production</em> link and complete the form.</p> 

<p>For produced titles you can download directly to use on a portable device or on disc.  The library contains DAISY format items which bundle MP3 files, a braille-ready file and etext.</p>


<h3>Free DAISY playback software</h3>

<p>Below are links to free DAISY digital talking book playback software. Commercial software is also available as well as hardware based playback devices for more information contact your local library .</p>
<ul>
	<li>Cross platform - <a href="http://code.google.com/p/emerson-reader/downloads/list">Emerson</a> is cross platform (Windows, Macintosh and Linux) DAISY and EPub reader software.</li>
        <li>iOS - <a href="https://itunes.apple.com/au/app/daisyworm/id383777731?mt=8">DAISY Worm</a>
	<li>Windows - <a href="http://amis.sourceforge.net/">Adaptive Multimedia Information System</a> (AMIS)</li>
	<li>Macintosh - <a href="http://www.cucat.org/projects/olearia/">Olearia</a> MacOS 10.5 or better required.</li>
</ul>

<h3>Installing DAISY file sets</h3>
<p>To install DAISY file sets onto CDs for playback in CD based DAISY players or to play on MP3 enabled CD players, simply unzip the file once it is downloaded. There will be a new directory with the title's DAISY file set in it. Simply copy all of these files to the root (top) level of the CD and write the CD using your computer's software for doing so.</p>

<h2>Other formats</h2>

<p>In addition to the DAISY format with playlists some titles are also offered in DAISY text only, playable on some newer DAISY playback devices and software, in large print PDF files, and in UEBC braille ready files (BRF) formatted to A4 paper and other formats as requested.</p>

<?php require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>
