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


<h2>Braille and Talking Book Library</h2>

<p>The Association's Dr. Geoff Gallop Braille and Talking Book Library provides a State-wide postal lending service of talking books in cassette format. It also has a Library Resource Centre where visitors may browse collections of: cassette and CD talking books; audio described videos; Braille books; multi - media books for children; toys and games and borrow items over the counter.</p> 

<p>This library is available to any client of the Association. If you are blind or have a vision impairment <!-- or have a print disability (dyslexia) --> and would like to enquire about your eligibility to access this service, please contact the Association for the Blind of Western Australia on (08) 9311 8202.</p>

<h2>Beyond Books, Beyond Barriers</h2>

<a href="http://www.abwa.asn.au/">The Association for Blind of Western Australia</a> is engaged in a joint, long-term library project with the <a href="http://www.slwa.wa.gov.au/">State Library of Western Australia</a> called "Beyond Books, Beyond Barriers". This project is working towards giving access to online library resources, in audio format, to people with a print disability - even the broader community. 

<p>As part of the project, this initial service provides access to works in the public domain where copyright has expired. The range of items in electronic text format includes many favourites and classics, which can now be transformed on demand, into audio format and made available to your library.</p> 

<p>Using automated tools, the text is converted to high quality synthesised* speech. The finished product can be provided to you in MP3 DAISY format.</p>

<p>This is an invaluable service for people who seek a particular book that does not currently exist in audio form.</p>

<p>*While these texts are not read by a human voice, the synthetic speech is of an increasingly high standard and may be considered acceptable by the listener, particularly if it allows the prompt audio production of a work that currently exists only in text format.</p>

<h2>Audio on Demand - requesting production</h2>

<p>After conducting your search, items found will be listed. Most books have not yet been produced into alternative formats so, after choosing your item from the resulting list, simply press the <em>Request Production</em> link and complete the form.</p> 

<p>One option presented will be the ability to directly download the electronic audio file onto a disc or portable device. It you choose this option, you will be notified by email when it is available and will then have immediate access to the item, for which there will be no charge.</p>

<p>Alternatively, you might prefer to receive the item on cassette, standard CD or MP3 file on disk. If this is the case, please complete the form as specified and the product will be produced for you by the Association's Braille and Talking Book Library. It will then be posted to you with an invoice for $19.99. (Registered members of the Association's library will not be invoiced.)</p>

<h2>Two collections</h2>
<p>The Beyond Book, Beyond Barriers collection is divided into two parts. The first part is made up of works in the public domain and includes classic works out of copyright as well as the growing collection of public documents <!-- and oral histories held by the State Library of Western Australia -->. This collection is open to the public without restriction.</p>

<p>The second part of the collection is comprised of copyrighted works produced by the Association for the Blind of Western Australia. Whilst access to these books via its library service is restricted to clients of the Association for the Blind, these books can be made more broadly available for eligible use. They may be lent to other libraries on inter-library loan or purchased by libraries and individuals. Eligible users are those with a print disability, which includes people with a vision impairment or people who cannot read print for another reason such as dyslexia.</p>

<p>In all cases we comply with the <a href="http://www.ag.gov.au/www/agd/agd.nsf/page/Copyright">Copyright Act (1968)</a> as amended.</p>


<h2>DAISY formats</h2>
<p>When you request an item, one choice of format is DAISY. This is a specialised MP3 form, developed particularly for people who are blind or vision impaired. A DAISY item selected from this service can be played on any DAISY playback software and hardware devices but can also be loaded onto all digital music players such as an Apple iPod, or played in disc format on MP3 enabled compact disk players.</p>


<h3>Free DAISY playback software</h3>
<p>Below are links to free DAISY digital talking book playback software. Commercial software is also available as well as hardware based playback devices for more information contact the Association for the Blind of Western Australia at (08) 9311 8202.</p>
<ul>
	<li>Cross platform - <a href="http://code.google.com/p/emerson-reader/downloads/list">Emerson</a> is cross platform (Windows, Macintosh and Linux) DAISY and EPub reader software.</li>
	<li>Windows - <a href="http://amis.sourceforge.net/">Adaptive Multimedia Information System</a> (AMIS)</li>
	<li>Macintosh - <a href="http://www.cucat.org/projects/olearia/">Olearia</a> MacOS 10.5 or better required.</li>
</ul>

<h3>Installing DAISY file sets</h3>
<p>To install DAISY file sets onto CDs for playback in CD based DAISY players or to play on MP3 enabled CD players, simply unzip the file once it is downloaded. There will be a new directory with the title's DAISY file set in it. Simply copy all of these files to the root (top) level of the CD and write the CD using your computer's software for doing so.</p>

<h2>Other formats</h2>

<p>In addition to the DAISY format with playlists some titles are also offered in DAISY text only, playable on some newer DAISY playback devices and software, in large print PDF files, and in UEBC braille ready files (BRF) formatted to A4 paper and other formats as requested.</p>

<?php require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>