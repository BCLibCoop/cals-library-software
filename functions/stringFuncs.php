<?php



  // for sorting strings longest to shortest
  function lencmp($a, $b) {
    $ac = count($a);
    $bc = count($b);
    if ($ac == $bc) {
      return 0;
    }
    return $ac > bc ? -1 : +1;
  }

  	function explodeStr($str, $stripStops=false ,$stemWords=true,$punctExceptions=null,$minlen=3)
  	{
  		require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/stemmer.inc");
  		// replace punctuation, double and single quotes
  		// and whitespace (tab, return, linefeed, etc
  		// with a space for simpler exploding

   		$str = strtoascii($str);

  		if (!isset($punctExceptions)) // check if we have any punctuation chars to ignore
  			$str = preg_replace('/[[:punct:]]|"|\'|\s/',' ',$str);
  		else
  		{
  			$punct = array('/\s/'=>' ',"/\'/"=>' ', '/\"/'=>' ', '/\`/'=>' ', '/\!/'=>' ', '/\@/'=>' ',
  							'/\#/'=>' ', '/\$/'=>' ', '/\%/'=>' ', '/\^/'=>' ', '/\&/'=>' ',
  							'/\*/'=>' ', '/\(/'=>' ', '/\)/'=>' ', '/\{/'=>' ',	'/\}/'=>' ',
  							'/\[/'=>' ', '/\]/'=>' ', '/\:/'=>' ', '/\;/'=>' ', '/\,/'=>' ',
  							'/\</'=>' ', '/\>/'=>' ', '/\./'=>' ',  '/\?/'=>' ', '/\//'=>' ',
  							'/\\\/'=>' ', '/\|/'=>' ', '/\-/'=>' ', '/\_/'=>' ', '/\+/'=>' ',
  							'/\=/'=>' ' );

  			$punct = array_merge($punct,$punctExceptions);
  			// split the key value pairs
  			$keys = array_keys($punct);
  			ksort($keys);
  			$vals= array_values($punct);
  			ksort($vals);

   			$str = preg_replace($keys,$vals,$str);
  		}

  		$elements = explode(' ',$str);
  		$stops = '';
  		$stemmer = new Stemmer();

  		if($stripStops==true) $stops = array_flip(stopWords());

  		foreach($elements as $k => $word) {
  			$word = strtolower(trim($word));
  			if ((strlen($word)<$minlen))
  			{
  				unset($elements[$k]);
  				continue;
  			}
  			// check if we are stripping stop words
  			if (($stripStops==true) && (isset($stops[$word])))
  			{
				unset($elements[$k]);
  				continue;
  			}
  			// pass through words that are the exact minimum length
  			// this stops them being removed by the stemmer
  			if (strlen($word) == $minlen)
  			{
  				$elements[$k] = $word;
  				continue;
  			}

  			$elements[$k] = ($stemWords==true)?$stemmer->stem($word):$word;
  		}
  		// reindex the elements because we may have removed items
  		$elements = array_merge($elements);
  		return $elements;
  	}

  	function strtoascii($string)
  	{
  		$out = $string;
  		$enc = mb_detect_encoding($out);
  		if ($enc != 'ASCII')
  		{	//echo $enc." ".$string."\n";
  			$out = @iconv($enc, 'UTF-8', $string);
			if ($out === false)
				echo $enc." -> ".$string."<br/>";

			$out = cleanString($out);
  		}
  		$out = trim($out);
  		return $out;
  	}

  	function stopWords()
  	{
	  	return array(
	  'able','about','above','according','accordingly','across','actually','after','afterwards','again','against','all','allow','allows','almost','alone','along','already','also','although','always','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','around','aside','ask','asking','associated','available','away','awfully',
	  		'be','became','because','become','becomes','becoming','been','before','beforehand','behind','being','believe','below','beside','besides','best','better
between','beyond','both','brief','but','by',
'came','can','cannot','cause','causes','certain','certainly','changes','clearly','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','course','currently',
'definitely','described','despite','did','different','do','does','doing','done','down','downwards','during','each','edu','eg','eight','either','else','elsewhere','enough','entirely','especially','etc','even','ever','every','everybody','everyone','everything','everywhere','exactly','example','except',
'far','few','fifth','first','five','followed','following','follows','for','former','formerly','forth','four','from','further','furthermore',
'get','gets','getting','given','gives','goes','going','gone','got','gotten','greetings',
'had','happens','hardly','has','have','having','hello','help','hence','her','here','hereafter','hereby','herein','hereupon','hers','herself','him','himself','his','hither','hopefully','how','howbeit','however',
'ignored','immediate','in','inasmuch','inc','indeed','indicate','indicated','indicates','inner','insofar','instead','into','inward','itself',
'just',
'keep','keeps','kept','know','known','knows',
'last','lately','later','latter','latterly','least','less','lest','let','like','liked','likely','little','look','looking','looks','ltd',
'mainly','many','may','maybe','me','mean','meanwhile','merely','might','more','moreover','most','mostly','much','must','my','myself',
'name','namely','near','nearly','necessary','need','needs','neither','never','nevertheless','new','next','nine','no','nobody','none','noone','nor','normally','not','nothing','novel','now','nowhere',
'obviously','off','often','okay','old','on','once','one','ones','only','onto','or','other','others','otherwise','ought','our','ours','ourselves','out','outside','over','overall','own',
'particular','particularly','per','perhaps','placed','please','plus','possible','presumably','probably','provides',
'que','quite',
'rather','really','reasonably','regarding','regardless','regards','relatively','respectively','right',
'said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','she','should','since','six','so','some','somebody','somehow','someone','something','sometime','sometimes','somewhat','somewhere
soon','sorry','specified','specify','specifying','still','sub','such','sup','sure',
'take','taken','tell','tends','than','thank','thanks','thanx','that','thats','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','therefore','therein','theres','thereupon','these','they','think','third','this','thorough','thoroughly','those','though','three','through','throughout','thru
thus','to','together','too','took','toward','towards','tried','tries','truly','try','trying','twice','two',
'under','unfortunately','unless','unlikely','until','unto','up','upon','us','use','used','useful','uses','using','usually',
'value','various','very','via','viz','vs',
'want','wants','was','way','we','welcome','well','went','were','what','whatever','when','whence','whenever','where','whereafter','whereas','whereby','wherein','whereupon','wherever','whether','which','while','whither','who','whoever','whole','whom','whose','why','will','willing','wish','with','within','without','wonder','would',
'yes','yet','you','you','your','yours','yourself','yourselves','zero'
	  	);
  	}


/*
	function  stopWords()
	{
		return array('able','about','above','actually','adj','after','again','ago','ahead','aint','all','allow','along','already','also','although','am','an','and','appear','appreciate','appropriate','are','arent','around','as','ask','associated','at','available','away','awfully',
'back','be','became','because','become','been','before','begin','behind','being','below','beside','better','between','beyond','both','but','by',
'came','can','change','clear','co','com','come','contain','could','cs',
'did','do','down',
'each','edu','eg','either','else','end','enough','et','etc','even','ever','ex','exact',
'few','follow','for','form','found','from','further',
'get','give','go','got',
'had','half','has','have','he','hed','hell','help','hence','her','here','hes','hi','him','his','hopeful','how',
'id','ie','if','im','in','inc','indeed','indicate','inner','inside','insofar','instead','into','inward','is','it','itself','ive',
'just',
'keep','kept','know',
'last','late','latter','least','less','let','like','little','look','low','ltd',
'made','main','make','man','may','me','mean','mere','might','mine','minus','miss','more','most','mr','mrs','much','must','my',
'name','near','need','neither','never','new','next','no','nor','not','now',
'of','oh','ok','on','once','one','onto','or','other','ought','our','out','over',
'particular','past','per','perhap','please','plus','presume','provide',
'que','quite','qv',
'rather','rd','re','reason','recent','regard',
'said','same','saw','say','see','self','sent','shall','shant','she','should','since','so','some','soon','still','sub','such','sup','sure',
'take','tell','tend','th','than','thank','that','the','their','there','these','thin','this','those','though','through','thus','till','to','together','too','toward','try','ts',
'un','under','undo','unless','unlike','until','unto','up','us','use',
'very','via','viz','vs',
'want','was','we','wed','well','went','were','what','when','where','whether','which','while','whilst','whither','who','whose','why','will','with','wont','would',
'yes','yet','you');
	}
*/

	function UTF8ToEntities ($string) {
    /* note: apply htmlspecialchars if desired /before/ applying this function
    /* Only do the slow convert if there are 8-bit characters */
    /* avoid using 0xA0 (\240) in ereg ranges. RH73 does not like that */
    if (! preg_match("/[\200-\237]/", $string) and ! preg_match("/[\241-\377]/", $string))
        return $string;

    // reject too-short sequences
    $string = preg_replace("/[\302-\375]([\001-\177])/", "&#65533;\\1", $string);
    $string = preg_replace("/[\340-\375].([\001-\177])/", "&#65533;\\1", $string);
    $string = preg_replace("/[\360-\375]..([\001-\177])/", "&#65533;\\1", $string);
    $string = preg_replace("/[\370-\375]...([\001-\177])/", "&#65533;\\1", $string);
    $string = preg_replace("/[\374-\375]....([\001-\177])/", "&#65533;\\1", $string);

    // reject illegal bytes & sequences
        // 2-byte characters in ASCII range
    $string = preg_replace("/[\300-\301]./", "&#65533;", $string);
        // 4-byte illegal codepoints (RFC 3629)
    $string = preg_replace("/\364[\220-\277]../", "&#65533;", $string);
        // 4-byte illegal codepoints (RFC 3629)
    $string = preg_replace("/[\365-\367].../", "&#65533;", $string);
        // 5-byte illegal codepoints (RFC 3629)
    $string = preg_replace("/[\370-\373]..../", "&#65533;", $string);
        // 6-byte illegal codepoints (RFC 3629)
    $string = preg_replace("/[\374-\375]...../", "&#65533;", $string);
        // undefined bytes
    $string = preg_replace("/[\376-\377]/", "&#65533;", $string);

    // reject consecutive start-bytes
    $string = preg_replace("/[\302-\364]{2,}/", "&#65533;", $string);

    // decode four byte unicode characters
    $string = preg_replace(
        "/([\360-\364])([\200-\277])([\200-\277])([\200-\277])/e",
        "'&#'.((ord('\\1')&7)<<18 | (ord('\\2')&63)<<12 |" .
        " (ord('\\3')&63)<<6 | (ord('\\4')&63)).';'",
    $string);

    // decode three byte unicode characters
    $string = preg_replace("/([\340-\357])([\200-\277])([\200-\277])/e",
"'&#'.((ord('\\1')&15)<<12 | (ord('\\2')&63)<<6 | (ord('\\3')&63)).';'",
    $string);

    // decode two byte unicode characters
    $string = preg_replace("/([\300-\337])([\200-\277])/e",
    "'&#'.((ord('\\1')&31)<<6 | (ord('\\2')&63)).';'",
    $string);

    // reject leftover continuation bytes
    $string = preg_replace("/[\200-\277]/", "&#65533;", $string);

    return $string;
}

	function cleanUTF8($aStr)
	{
		$outStr = preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]'.
 								'|[\x00-\x7F][\x80-\xBF]+'.
 								'|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*'.
 								'|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})'.
 								'|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
 								'?', $aStr );

		$outStr = preg_replace('/\xE0[\x80-\x9F][\x80-\xBF]'.
 							'|\xED[\xA0-\xBF][\x80-\xBF]/S','?', $outStr );

 		return $outStr;
	}


	function cleanString($text) {
    // 1) convert á ô => a o
    $text = preg_replace("/[áàâãªä]/u","a",$text);
    $text = preg_replace("/[ÁÀÂÃÄ]/u","A",$text);
    $text = preg_replace("/[ÍÌÎÏ]/u","I",$text);
    $text = preg_replace("/[íìîï]/u","i",$text);
    $text = preg_replace("/[éèêë]/u","e",$text);
    $text = preg_replace("/[ÉÈÊË]/u","E",$text);
    $text = preg_replace("/[óòôõºö]/u","o",$text);
    $text = preg_replace("/[ÓÒÔÕÖ]/u","O",$text);
    $text = preg_replace("/[úùûü]/u","u",$text);
    $text = preg_replace("/[ÚÙÛÜ]/u","U",$text);
    $text = preg_replace("/[’‘‹›‚]/u","'",$text);
    $text = preg_replace("/[“”«»„]/u",'"',$text);
    $text = str_replace("–","-",$text);
    $text = str_replace(" "," ",$text);
    $text = str_replace("ç","c",$text);
    $text = str_replace("Ç","C",$text);
    $text = str_replace("ñ","n",$text);
    $text = str_replace("Ñ","N",$text);

    //2) Translation CP1252. &ndash; => -
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark
    $trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook
    $trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark
    $trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis
    $trans[chr(134)] = '&dagger;';    // Dagger
    $trans[chr(135)] = '&Dagger;';    // Double Dagger
    $trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent
    $trans[chr(137)] = '&permil;';    // Per Mille Sign
    $trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron
    $trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark
    $trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE
    $trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark
    $trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark
    $trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark
    $trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark
    $trans[chr(149)] = '&bull;';    // Bullet
    $trans[chr(150)] = '&ndash;';    // En Dash
    $trans[chr(151)] = '&mdash;';    // Em Dash
    $trans[chr(152)] = '&tilde;';    // Small Tilde
    $trans[chr(153)] = '&trade;';    // Trade Mark Sign
    $trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron
    $trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark
    $trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE
    $trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
    $trans['euro'] = '&euro;';    // euro currency symbol
    ksort($trans);

    foreach ($trans as $k => $v) {
        $text = str_replace($v, $k, $text);
    }

    // 3) remove <p>, <br/> ...
    $text = strip_tags($text);

    // 4) &amp; => & &quot; => '
    $text = html_entity_decode($text);

    // 5) remove Windows-1252 symbols like "TradeMark", "Euro"...
    $text = preg_replace('/[^(\x20-\x7F)]*/','', $text);

    $targets=array("\r\n","\n","\r","\t");
    $results=array(" "," "," ","");
    $text = str_replace($targets,$results,$text);

    return ($text);
}
?>