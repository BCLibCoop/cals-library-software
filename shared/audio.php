<?php


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
  setlocale(LC_MONETARY, 'en_AU');
  
?>





<h2>Audio on Demand</h2> 
<p>We can provide you with public domain resources in a format to suit your needs. We can obtain digital audio content and electronic text items, from sources such as Librivox and Project Gutenberg Australia. These are converted into different formats and supplied to you. Downloadable audio files attract no charge but fees apply for the production and provision of physical formats (registered members of our Braille and Talking Book Library are exempt).</p>

<p>After conducting your search, items found will be listed. Many of them will probably not yet be available in an alternative format so, after choosing your item from the resulting list, simply press the Request Production link and complete the form.</p>

<p>One option presented will be the ability to directly download the electronic audio file onto a disc or portable device. It you choose this option, you will be notified by email when it is available and will then have immediate access to the item, for which there will be no charge.<p>

<p>Alternatively, you might prefer to receive the item on cassette, standard CD or MP3 file on disk. If this is the case, please complete the form as specified and the item will be produced for you by the Association's Braille and Talking Book Library. It will then be posted to you with an invoice for $19.99 (registered members of the Association’s library will not be invoiced).</p> 


<?php
include(str_replace('//','/',dirname(__FILE__).'/')."../shared/help_footer.php");
?>