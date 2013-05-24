<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

/**********************************************************************************
 *   Instructions for translators:
 *
 *   All gettext key/value pairs are specified as follows:
 *     $trans["key"] = "<php translation code to set the $text variable>";
 *   Allowing translators the ability to execute php code withint the transFunc string
 *   provides the maximum amount of flexibility to format the languange syntax.
 *
 *   Formatting rules:
 *   - Resulting translation string must be stored in a variable called $text.
 *   - Input arguments must be surrounded by % characters (i.e. %pageCount%).
 *   - A backslash ('\') needs to be placed before any special php characters
 *     (such as $, ", etc.) within the php translation code.
 *
 *   Simple Example:
 *     $trans["homeWelcome"]       = "\$text='Welcome to OpenBiblio';";
 *
 *   Example Containing Argument Substitution:
 *     $trans["searchResult"]      = "\$text='page %page% of %pages%';";
 *
 *   Example Containing a PHP If Statment and Argument Substitution:
 *     $trans["searchResult"]      =
 *       "if (%items% == 1) {
 *         \$text = '%items% result';
 *       } else {
 *         \$text = '%items% results';
 *       }";
 *
 **********************************************************************************
 */

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

#****************************************************************************
#*  Translation text for page index.php
#****************************************************************************

$trans["publicSummaryHeader"]             = "\$text = 'Online Public Access Catalog (OPAC)';";
$trans["publicSummaryDesc"]             = "\$text = 'Welcome to our library\'s \"Audio on Demand\" service where we can convert into audio format any copyright free, electronic text item available from the public domain via Project Gutenberg Australia and other sources. More information
If you do not find the title you are searching for please tell us so that we may investigate adding it to our collection. You may use our book request form to do so.';";



$trans["opac_Header"]        = "\$text='Online Public Access Catalog (OPAC)';";

$welcome_en = "Welcome to the Canadian Accessible Library System, a service provided by The BC Libraries Cooperative with the support of the Provincial and Territorial Libraries Council of Canada. Please use the form below to search for accessible titles from our holdings. Titles are protected by copyright will require that you have a username and password to access. To register, please email <a href='mailto:nnels@libraries.coop'>nnels@libraries.coop</a></p>";
$welcome_fr = "<p>Bienvenue sur le syst&egrave;me de biblioth&egrave;que canadienne accessible un service des biblioth&egrave;ques provinciales du Canada. S'il vous pla&icirc;t utiliser le formulaire ci-dessous pour rechercher des titres accessibles de nos exploitations. S'il vous pla&icirc;t noter que le titre prot&eacute;g&eacute; par le droit d'auteur, il faudra que vous avez un nom d'utilisateur et mot de passe sur ce syst&egrave;me.";
if ($lang != 'fr') {
$trans["opac_WelcomeMsg"]    = '$text="'.$welcome_en.$welcome_fr.'";';
} else {
$trans["opac_WelcomeMsg"]    = '$text="'.$welcome_fr.$welcome_en.'";';
}

$trans["opac_searchTitle"]   = "\$text='Search for Books by : ';";
$trans["opac_title"]         = "\$text='Title';";
$trans["opac_author"]        = "\$text='Author';";
$trans["opac_subject"]       = "\$text='Subject';";
$trans["opac_search"]        = "\$text='Search';";
$trans["opac_isbn"]          = "\$text='ISBN';";
$trans["opac_systemNumber"]    = "\$text='System Number';";
$trans["opac_all"]			 = "\$text='All';";
$trans["opac_criteria"]			 = "\$text='Search results for : %crit%';";
$trans["opac_collection"]			 = "\$text='Collection';";
$trans["opac_copyTypes"]			 = "\$text='Available Formats';";
$trans["opac_restrictedMsg"]			 = "\$text='This title is protected by copyright, downloads are limited to the print disabled.';";
$trans["opac_restrictedFullMsg"] = "\$text='Distribution of this title is restricted to patrons who are blind or disabled. You will be required to provide your username and password to download this title. If you have any questions please contact the <a href=\"http://www.abwa.asn.au/\">Association for the Blind of Western Australia</a> on 1800 658 388 or email: <a href=\"mailto:hello@guidedogswa.com.au\">hello@guidedogswa.com.au</a>';";
$trans["opac_requestProduction"]			 = "\$text='Request production of this title';";
$trans["opac_backToSearch"]			 = "\$text='Back to Search';";

$trans["opac_view_copySize"]			 = "\$text='File Size';";
$trans["opac_view_copyFormat"]			 = "\$text='Format';";
$trans["opac_view_copyPlayingTime"]			 = "\$text='Playing Time';";
$trans["opac_view_noCopies"]       = "\$text = 'No copies have been created.';";
$trans["opac_view_copyNotFound"]       = "\$text = 'unable to find this copy. Please notify the System Administrator.';";
//$trans["opac_view_copySize"]			 = "\$text='File Size';";
//$trans["opac_view_copySize"]			 = "\$text='File Size';";
$trans["opac_view_copyDownload"]       = "\$text = 'Download';";
$trans["opac_view_copyLogin"]       = "\$text = 'Login to download';";
$trans["opac_view_entryInfo"]       = "\$text = 'Entry Information';";
$trans["opac_view_entryInfoExtra"]       = "\$text = 'Additional Information';";
//$trans["opac_view_copyLogin"]       = "\$text = 'Login to download';";
//$trans["opac_view_copyLogin"]       = "\$text = 'Login to download';";






#****************************************************************************
#*  Translation text for page loginform.php
#****************************************************************************
$trans["opac_login_header"]         = "\$text = 'Client Login';";
$trans["opac_login_username"]        = "\$text = 'Username';";
$trans["opac_login_password"]        = "\$text = 'Password';";
$trans["opac_login_loginButton"]           = "\$text = 'Login';";
$trans["opac_login_invalidLogin"]           = "\$text = 'Invalid Username or Password';";


 if ($lang != 'fr')  {
$trans["opac_shelflist"]	 = "\$text = 'This is a list of the talking books which have been produced into DAISY digital talking book format by CALS these books can be accessed from CALS or online.<p>Il s\'agit d\'une liste des livres parlants qui ont &eacute;t&eacute; produites en format de livre parl&eacute; num&eacute;rique DAISY par CALS ces livres peuvent &ecirc;tre accessibles &agrave; partir de CALS ou en ligne.';";
} else {
$trans["opac_shelflist"]	 = "\$text = 'Il s\'agit d\'une liste des livres parlants qui ont &eacute;t&eacute; produites en format de livre parl&eacute; num&eacute;rique DAISY par CALS ces livres peuvent &ecirc;tre accessibles &agrave; partir de CALS ou en ligne.<p>This is a list of the talking books which have been produced into DAISY digital talking book format by CALS these books can be accessed from CALS or online.';";
}        
         
if ($lang != 'fr') {
$trans["opac_ca_title"]	 = "\$text = 'Canadian Accessible Library System<br/>Syst&egrave;me canadien de la biblioth&egrave;que accessible';";
} else {
$trans["opac_ca_title"]	 = "\$text = 'Syst&egrave;me canadien de la biblioth&egrave;que accessible<br/>Canadian Accessible Library System';";
}

if ($lang != 'fr') {
$trans["opac_ca_login"]	 = "\$text = 'Registered users of the library can use the button below to login to the system. Once logged in you will not be requested for your username or password to download copyrighted works.<p>Les utilisateurs enregistr&eacute;s de la biblioth&egrave;que peut utiliser le bouton ci-dessous pour vous connecter au syst&egrave;me. Une fois connect&eacute;, vous ne serez pas demand&eacute; votre nom d\'utilisateur ou mot de passe pour t&eacute;l&eacute;charger des oeuvres prot&eacute;g&eacute;es.';";
} else {
$trans["opac_ca_login"]	 = "\$text = 'Les utilisateurs enregistr&eacute;s de la biblioth&egrave;que peut utiliser le bouton ci-dessous pour vous connecter au syst&egrave;me. Une fois connect&eacute;, vous ne serez pas demand&eacute; votre nom d\'utilisateur ou mot de passe pour t&eacute;l&eacute;charger des oeuvres prot&eacute;g&eacute;es.<p>Registered users of the library can use the button below to login to the system. Once logged in you will not be requested for your username or password to download copyrighted works.';";
}



           
?>
