<?php
$tab = "o";
require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

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


$title = $_GET[title];
$author = $_GET[author];
$uri = $_GET[uri];
$uri = $uri . "&tab=opac";


//Collect the fields

if ($_POST['submit']) {
	include("config.inc");
	
	$lname = addslashes($_POST['lname']);
	$gname = addslashes($_POST['gname']);
	$address1 = addslashes($_POST['address1']);
	$address2 = addslashes($_POST['address2']);
	$city = addslashes($_POST['city']);
	$state = $_POST['state'];
	$postal = $_POST['postal'];
	$country = $_POST['country'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];	
	$fax = $_POST['fax'];
	$daisy3 = $_POST['daisy3'];
	$daisy2 = $_POST['daisy2'];
	$daisy_text = $_POST['daisy_text'];
	$braille = $_POST['braille'];
	$largeprint = $_POST['largeprint'];
	$epub = $_POST['epub'];
	$cd = $_POST['cd'];
	$title = addslashes($_POST['title']);
	$author = addslashes($_POST['author']);
	$uri =  $_POST['uri'];
	$libpatron = $_POST['libpatron'];
	$ipod = $_POST['ipod'];
	$book_title = $_POST['book_title'];
	$book_author = $_POST['book_author'];
	
	
	if ($book_title) {
	

	# FIXME: SQL injection security	
	$sql = "INSERT INTO t_main SET
	last_name='$lname',
	given_name='$gname',
	address1='$address1',
	city='$city',
	state='$state',
	postcode='$postal',
	nation='$country',
	email='$email',
	phone='$phone',
	daisy3='1',
	daisy2='$daisy2',
	ipod='$ipod',
	daisy_text='$daisy_text',
	braille='$braille',
	largeprint='$largeprint',
	epub='$epub',
	cd='$cd',
	title='$book_title',
	author='$book_author',
	uri='$uri',
	origin_date='$today',
	libpatron='$libpatron'";
	

$total_result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

$format_list = "Daisy/NISO z3986, ";
//if ($daisy3) {$format_list = $format_list . "Daisy/NISO z3986, ";}
if ($ipod) {$format_list = $format_list . "iPod Audiobook, ";}

if ($daisy2) {$format_list = $format_list . "Daisy202, ";}
if ($daisy_text) {$format_list = $format_list . "Daisy Text Only, ";}
if ($braille) {$format_list = $format_list . "Brialle, ";}
if ($largeprint) {$format_list = $format_list . "Large Print (PDF), ";}
if ($epub) {$format_list = $format_list . "EPub, ";}
if ($cd) {$format_list = $format_list . "CD, ";}
if ($ipod) {$format_list = $format_list . "IPod Audiobook, ";}
	
$to_mail_message = "
TITLE: 	$book_title
AUTHOR:	$book_author
FORMATS: $format_list

$gname $lname
$address1
$city, $state $postal
$country
$email
$phone";

$from_mail_message = "
Your request below has been sent to the National Network of Equitable Library Servics (NNELS).
".$to_mail_message;

$to_mail_subject = "Book production request for $book_title";
$from_mail_subject = "Your book production request for $book_title";
$to_headers = "From: $email" . "\r\n" .
    "Reply-To: $email" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();
$from_headers = "From: nnels@libraries.coop" . "\r\n" .
    "Reply-To: nnels@libraries.coop" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

# $tomail is set in config.inc
mail ($tomail, $to_mail_subject, $to_mail_message, $to_headers);
mail ($email, $from_mail_subject, $from_mail_message, $from_headers);

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'thankyou.php';
header("Location: http://$host$uri/$extra");
exit;

} else {

	$message = "<p style=\"font-size: large; color: red; font-weight: bold;\" align=\"center\">Please complete all the required fields.</p>";


}

}


?>



<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");
  $headerLoc = new Localize(OBIB_LOCALE,"shared");

// code html tag with language attribute if specified.
echo "<html";
if (OBIB_HTML_LANG_ATTR != "") {
  echo " lang=\"".H(OBIB_HTML_LANG_ATTR)."\"";
}
echo ">\n";

// code character set if specified
if (OBIB_CHARSET != "") { ?>
<META http-equiv="content-type" content="text/html; charset=<?php echo H(OBIB_CHARSET); ?>">
<?php } ?>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/css/forms.css" />

 




<style type="text/css">
  <?php include(str_replace('//','/',dirname(__FILE__).'/')."../css/style.php");?>

</style>
<meta name="description" content="OpenBiblio Library Automation System">
<?php echo $refresh; ?>
<title><?php echo H(OBIB_LIBRARY_NAME);?></title>

<script type="text/javascript">
<!--
function popSecondary(url) {
    var SecondaryWin;
    SecondaryWin = window.open(url,"secondary","resizable=yes,scrollbars=yes,width=535,height=400");
}
function returnLookup(formName,fieldName,val) {
    window.opener.document.forms[formName].elements[fieldName].value=val;
    window.opener.focus();
    this.close();
}
-->
</script>


</head>
<body bgcolor="<?php echo H(OBIB_PRIMARY_BG);?>" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" marginheight="0" marginwidth="0" onLoad="document.orderform.gname.focus()" <?php
  if (isset($focus_form_name) && ($focus_form_name != "")) {
    if (preg_match('/^[a-zA-Z0-9_]+$/', $focus_form_name)
        && preg_match('/^[a-zA-Z0-9_]+$/', $focus_form_field)) {
      echo 'onLoad="self.focus();document.'.$focus_form_name.".".$focus_form_field.'.focus()"';
    }
  } ?> >


<!-- **************************************************************************************
     * Library Name and hours
     **************************************************************************************-->
<table class="primary" width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr bgcolor="<?php echo H(OBIB_TITLE_BG);?>">
    <td width="100%" class="title" valign="top">
       <table border="0">
    <tr>
    <td rowspan="2">
       <?php
         if (OBIB_LIBRARY_IMAGE_URL != "") {
           echo "<img align=\"middle\" src=\"".H(OBIB_LIBRARY_IMAGE_URL)."\" border=\"0\" height=\"60\" alt=\"Guide Dogs WA logo\"></td>";
         }
         if (!OBIB_LIBRARY_USE_IMAGE_ONLY) {
           echo "<td width=\"100%\" class=\"title\" valign=\"top\"><strong> ".H(OBIB_LIBRARY_NAME)."</strong></td></tr><tr><td width=\"100%\" class=\"title\" valign=\"top\"><span style=\"font-size: 12pt;\">Canadian Accessible Library System</span></td></tr>";
         }
       ?>
       </table>    </td>
    <td valign="top">
      <table class="primary" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td class="title" nowrap="yes"><font class="small"><?php echo $headerLoc->getText("headerTodaysDate"); ?></font></td>
          <td class="title" nowrap="yes"><font class="small"><?php echo H(date($headerLoc->getText("headerDateFormat")));?></font></td>
        </tr>
        <tr>
          <td class="title" nowrap="yes"><font class="small"><?php if (OBIB_LIBRARY_HOURS != "") echo $headerLoc->getText("headerLibraryHours");?></font></td>
          <td class="title" nowrap="yes"><font class="small"><?php if (OBIB_LIBRARY_HOURS != "") echo H(OBIB_LIBRARY_HOURS);?></font></td>
        </tr>
        <tr>
          <td class="title" nowrap="yes"><font class="small"><?php if (OBIB_LIBRARY_PHONE != "") echo $headerLoc->getText("headerLibraryPhone");?></font></td>
          <td class="title" nowrap="yes"><font class="small"><?php if (OBIB_LIBRARY_PHONE != "") echo H(OBIB_LIBRARY_PHONE);?></font></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<!-- **************************************************************************************
     * Tabs
     **************************************************************************************-->
<table class="primary" width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td bgcolor="<?php echo H(OBIB_BORDER_COLOR);?>"><img src="../images/shim.gif" width="1" height="1" border="0"></td>
  </tr>
</table>
<!-- **************************************************************************************
     * Left nav
     **************************************************************************************-->
<table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr bgcolor="<?php echo H(OBIB_ALT1_BG);?>">
    <td colspan="6"><img src="../images/shim.gif" width="1" height="15" border="0"></td>
  </tr>
  <tr>
    <td bgcolor="<?php echo H(OBIB_ALT1_BG);?>"><img src="../images/shim.gif" width="10" height="1" border="0"></td>
    <td bgcolor="<?php echo H(OBIB_ALT1_BG);?>"><img src="../images/shim.gif" width="140" height="1" border="0"></td>
    <td bgcolor="<?php echo H(OBIB_BORDER_COLOR);?>"><img src="../images/shim.gif" width="1" height="1" border="0"></td>
    <td bgcolor="<?php echo H(OBIB_BORDER_COLOR);?>"><img src="../images/shim.gif" width="10" height="1" border="0"></td>
    <td bgcolor="<?php echo H(OBIB_BORDER_COLOR);?>"><img src="../images/shim.gif" width="1" height="1" border="0"></td>
    <td bgcolor="<?php echo H(OBIB_BORDER_COLOR);?>"><img src="../images/shim.gif" width="10" height="1" border="0"></td>
  </tr>
  <tr>
    <td bgcolor="<?php echo H(OBIB_ALT1_BG);?>"><img src="../images/shim.gif" width="1" height="1" border="0"></td>
    <td valign="top" bgcolor="<?php echo H(OBIB_ALT1_BG);?>">
      <font  class="alt1">
      <?php include(str_replace('//','/',dirname(__FILE__).'/')."../navbars/opac.php"); ?>
      </font>
    <br><br><br><br>
    </td>
    <td bgcolor="<?php echo H(OBIB_BORDER_COLOR);?>"><img src="../images/shim.gif" width="1" height="1" border="0"></td>
    <td bgcolor="<?php echo H(OBIB_PRIMARY_BG);?>"><img src="../images/shim.gif" width="1" height="1" border="0"></td>
    <td height="100%" width="100%" valign="top">
      <font class="primary">
      <br>
<!-- **************************************************************************************
     * beginning of main body
     **************************************************************************************-->








<h1>Production Request</h1>


<p>Complete this form to submit your request. Our network can producing the book you will be notified when it is ready for download.</p>
<?php echo $message; ?>
<p><strong>Bold</strong> fields are required.</p>

<form action="request-new.php" method="post" name="orderform">

	
    
    <fieldset><legend>Personal Information</legend>
    <!--
      <div class="notes">
        <h4>Personal Information</h4>
        <p class="last">Please enter your name and address as they are listed for your debit card, credit card, or bank account.</p>
       </div>
       -->
      <div class="optional">
        
        <label for="first_name">First Name:</label><br/>
        <input type="text" name="gname" id="first_name" class="inputText" size="30" maxlength="100" value="" />
      </div>
      <div class="optional">
        
        <label for="last_name">Last Name:</label><br/>
        <input type="text" name="lname" id="last_name" class="inputText" size="30" maxlength="100" value="" />
      </div>
      
      <div class="optional">

      <label for="libpatronid" class="labelCheckbox">
          <input type="checkbox" name="libpatron" id="libpatronid" class="inputCheckbox" value="1"  onclick="Hideme()" />Library Patron</label>
         <!--<small>Library patrons with a print disability may request production of works held under copyright. NNELS can request copies to produce in alternate format on their behalf.</small> -->
          </div>
      
      
      
      
      <div class="optional">
        
        <label for="address_1">Address:</label><br/>
        <input type="text" name="address1" id="address_1" class="inputText" size="30" maxlength="100" value="" />
        <!--<input type="text" name="address2" id="address_2" class="inputText" size="10" maxlength="100" value="" /> -->
      </div>
      <div class="optional">
        
        <label for="city">City:</label><br/>
        <input type="text" name="city" id="city" class="inputText" size="30" maxlength="100" value="" />
      </div>
      <div class="optional">
        
        <label for="state">State:</label><br/>
        
<select name="state" id="state" class="selectOne">
<option value="">Select a Province/Territory</option>
<option value="" disabled>---------------</option>
<option value="AB">AB - Alberta</option>
<option value="BC">BC - British Columbia</option>
<option value="MB">MB - Manitoba</option>
<option value="NB">NB - New Brunswick</option>
<option value="NL">NL - Newfoundland and Labrador</option>
<option value="NT">NT - Northwest Territories</option>
<option value="NS">NS - Nova Scotia</option>
<option value="NU">NU - Nunavut</option>
<option value="ON">ON - Ontario</option>
<option value="PE">PE - Prince Edward Island</option>
<option value="QC">QC - Quebec</option>
<option value="SK">SK - Saskatchewan</option>
<option value="YT">YT - Yukon</option>
<option value="" disabled>---------------</option>
<option value="AL">AL - Alabama</option>
<option value="AK">AK - Alaska</option>
<option value="AZ">AZ - Arizona</option>
<option value="AR">AR - Arkansas</option>
<option value="CA">CA - California</option>
<option value="CO">CO - Colorado</option>
<option value="CT">CT - Connecticut</option>
<option value="DE">DE - Delaware</option>
<option value="DC">DC - District of Columbia</option>
<option value="FL">FL - Florida</option>
<option value="GA">GA - Georgia</option>
<option value="HI">HI - Hawaii</option>
<option value="ID">ID - Idaho</option>
<option value="IL">IL - Illinois</option>
<option value="IN">IN - Indiana</option>
<option value="IA">IA - Iowa</option>
<option value="KS">KS - Kansas</option>
<option value="KY">KY - Kentucky</option>
<option value="LA">LA - Louisiana</option>
<option value="ME">ME - Maine</option>
<option value="MD">MD - Maryland</option>
<option value="MA">MA - Massachusetts</option>
<option value="MI">MI - Michigan</option>
<option value="MN">MN - Minnesota</option>
<option value="MS">MS - Mississippi</option>
<option value="MO">MO - Missouri</option>
<option value="MT">MT - Montana</option>
<option value="NE">NE - Nebraska</option>
<option value="NV">NV - Nevada</option>
<option value="NH">NH - New Hampshire</option>
<option value="NJ">NJ - New Jersey</option>
<option value="NM">NM - New Mexico</option>
<option value="NY">NY - New York</option>
<option value="NC">NC - North Carolina</option>
<option value="ND">ND - North Dakota</option>
<option value="OH">OH - Ohio</option>
<option value="OK">OK - Oklahoma</option>
<option value="OR">OR - Oregon</option>
<option value="PA">PA - Pennsylvania</option>
<option value="RI">RI - Rhode Island</option>
<option value="SC">SC - South Carolina</option>
<option value="SD">SD - South Dakota</option>
<option value="TN">TN - Tennessee</option>
<option value="TX">TX - Texas</option>
<option value="UT">UT - Utah</option>
<option value="VT">VT - Vermont</option>
<option value="VA">VA - Virginia</option>
<option value="WA">WA - Washington</option>
<option value="WV">WV - West Virginia</option>
<option value="WI">WI - Wisconsin</option>
<option value="WY">WY - Wyoming</option>
<option value="" disabled>---------------</option>
<option value="AE">AE - Armed Forces Africa</option>
<option value="AA">AA - Armed Forces Americas (except Canada)</option>
<option value="AE">AE - Armed Forces Canada</option>
<option value="AE">AE - Armed Forces Europe</option>
<option value="AE">AE - Armed Forces Middle East</option>
<option value="AP">AP - Armed Forces Pacific</option>
<option value="" disabled>---------------</option>
<option value="AS">AS - American Samoa</option>
<option value="FM">FM - Federated States of Micronesia</option>
<option value="GU">GU - Guam</option>
<option value="MH">MH - Marshall Islands</option>
<option value="MP">MP - Northern Mariana Islands</option>
<option value="PW">PW - Palau</option>
<option value="PR">PR - Puerto Rico</option>
<option value="VI">VI - Virgin Islands</option>
<option value="" disabled>---------------</option>
<option value="XX">XX - Other State/Province/Territory</option>
</select>

      </div>
      <div class="optional">
        
        <label for="postal">Postal Code:</label><br/>
        <input type="text" name="postal" id="postal" class="inputText" size="10" maxlength="50" value="" />
      </div>
      <div class="optional">
        
        <label for="country">Country:</label><br/>
        
<select name="country" id="country" class="selectOne">
<option value="Select a Country">Select a Country</option>
<option value="" disabled>---------------</option>
<option value="Canada">CA - Canada</option>
<option value="Australia" selected="selected">AU - Australia</option>
<option value="New Zealand">NZ - New Zealand</option>
<option value="United States">US - United States</option>
<option value="" disabled>---------------</option>
<option value="Afghanistan">AF - Afghanistan</option>
<option value="Albania">AL - Albania</option>
<option value="Algeria">DZ - Algeria</option>
<option value="American Samoa">AS - American Samoa</option>
<option value="Andorra">AD - Andorra</option>
<option value="Angola">AO - Angola</option>
<option value="Anguilla">AI - Anguilla</option>
<option value="Antarctica">AQ - Antarctica</option>
<option value="Antigua and Barbuda">AG - Antigua and Barbuda</option>
<option value="Argentina">AR - Argentina</option>
<option value="Armenia">AM - Armenia</option>
<option value="Aruba">AW - Aruba</option>
<option value="Australia">AU - Australia</option>
<option value="Austria">AT - Austria</option>
<option value="Azerbaijan">AZ - Azerbaijan</option>
<option value="Bahamas">BS - Bahamas</option>
<option value="Bahrain">BH - Bahrain</option>
<option value="Bangladesh">BD - Bangladesh</option>
<option value="Barbados">BB - Barbados</option>
<option value="Belarus">BY - Belarus</option>
<option value="Belgium">BE - Belgium</option>
<option value="Belize">BZ - Belize</option>
<option value="Benin">BJ - Benin</option>
<option value="Bermuda">BM - Bermuda</option>
<option value="Bhutan">BT - Bhutan</option>
<option value="Bolivia">BO - Bolivia</option>
<option value="Bosnia and Herzegovina">BA - Bosnia and Herzegovina</option>
<option value="Botswana">BW - Botswana</option>
<option value="Bouvet Island">BV - Bouvet Island</option>
<option value="Brazil">BR - Brazil</option>
<option value="British Indian Ocean Territory">IO - British Indian Ocean Territory</option>
<option value="Brunei Darussalam">BN - Brunei Darussalam</option>
<option value="Bulgaria">BG - Bulgaria</option>
<option value="Burkina Faso">BF - Burkina Faso</option>
<option value="Burundi">BI - Burundi</option>
<option value="Cambodia">KH - Cambodia</option>
<option value="Cameroon">CM - Cameroon</option>
<option value="Cape Verde">CV - Cape Verde</option>
<option value="Cayman Islands">KY - Cayman Islands</option>
<option value="Central African Republic">CF - Central African Republic</option>
<option value="Chad">TD - Chad</option>
<option value="Chile">CL - Chile</option>
<option value="China">CN - China</option>
<option value="Christmas Island">CX - Christmas Island</option>
<option value="Cocos (Keeling) Islands">CC - Cocos (Keeling) Islands</option>
<option value="Colombia">CO - Colombia</option>
<option value="Comoros">KM - Comoros</option>
<option value="Congo">CG - Congo</option>
<option value="Congo, Democratic Republic of the">CD - Congo, Democratic Republic of the</option>
<option value="Cook Islands">CK - Cook Islands</option>
<option value="Costa Rica">CR - Costa Rica</option>
<option value="Cote d'Ivoire">CI - Cote d'Ivoire</option>
<option value="Croatia">HR - Croatia</option>
<option value="Cuba">CU - Cuba</option>
<option value="Cyprus">CY - Cyprus</option>
<option value="Czech Republic">CZ - Czech Republic</option>
<option value="Denmark">DK - Denmark</option>
<option value="Djibouti">DJ - Djibouti</option>
<option value="Dominica">DM - Dominica</option>
<option value="Dominican Republic">DO - Dominican Republic</option>
<option value="East Timor">TP - East Timor</option>
<option value="Ecuador">EC - Ecuador</option>
<option value="Egypt">EG - Egypt</option>
<option value="El Salvador">SV - El Salvador</option>
<option value="Equatorial Guinea">GQ - Equatorial Guinea</option>
<option value="Eritrea">ER - Eritrea</option>
<option value="Estonia">EE - Estonia</option>
<option value="Ethiopia">ET - Ethiopia</option>
<option value="Falkland Islands (Malvinas)">FK - Falkland Islands (Malvinas)</option>
<option value="Faroe Islands">FO - Faroe Islands</option>
<option value="Fiji">FJ - Fiji</option>
<option value="Finland">FI - Finland</option>
<option value="France">FR - France</option>
<option value="French Guiana">GF - French Guiana</option>
<option value="French Polynesia">PF - French Polynesia</option>
<option value="French Southern Territories">TF - French Southern Territories</option>
<option value="Gabon">GA - Gabon</option>
<option value="Gambia">GM - Gambia</option>
<option value="Georgia">GE - Georgia</option>
<option value="Germany">DE - Germany</option>
<option value="Ghana">GH - Ghana</option>
<option value="Gibraltar">GI - Gibraltar</option>
<option value="Greece">GR - Greece</option>
<option value="Greenland">GL - Greenland</option>
<option value="Grenada">GD - Grenada</option>
<option value="Guadeloupe">GP - Guadeloupe</option>
<option value="Guam">GU - Guam</option>
<option value="Guatemala">GT - Guatemala</option>
<option value="Guinea">GN - Guinea</option>
<option value="Guinea-Bissau">GW - Guinea-Bissau</option>
<option value="Guyana">GY - Guyana</option>
<option value="Haiti">HT - Haiti</option>
<option value="Heard Island and McDonald Islands">HM - Heard Island and McDonald Islands</option>
<option value="Holy See (Vatican City)">VA - Holy See (Vatican City)</option>
<option value="Honduras">HN - Honduras</option>
<option value="Hong Kong">HK - Hong Kong</option>
<option value="Hungary">HU - Hungary</option>
<option value="Iceland">IS - Iceland</option>
<option value="India">IN - India</option>
<option value="Indonesia">ID - Indonesia</option>
<option value="Iran, Islamic Republic of">IR - Iran, Islamic Republic of</option>
<option value="Iraq">IQ - Iraq</option>
<option value="Ireland">IE - Ireland</option>
<option value="Israel">IL - Israel</option>
<option value="Italy">IT - Italy</option>
<option value="Jamaica">JM - Jamaica</option>
<option value="Japan">JP - Japan</option>
<option value="Jordan">JO - Jordan</option>
<option value="Kazakstan">KZ - Kazakstan</option>
<option value="Kenya">KE - Kenya</option>
<option value="Kiribati">KI - Kiribati</option>
<option value="Korea, Democratic People's Republic of">KP - Korea, Democratic People's Republic of</option>
<option value="Korea, Republic of">KR - Korea, Republic of</option>
<option value="Kuwait">KW - Kuwait</option>
<option value="Kyrgyzstan">KG - Kyrgyzstan</option>
<option value="Lao People's Democratic Republic">LA - Lao People's Democratic Republic</option>
<option value="Latvia">LV - Latvia</option>
<option value="Lebanon">LB - Lebanon</option>
<option value="Lesotho">LS - Lesotho</option>
<option value="Liberia">LR - Liberia</option>
<option value="Libyan Arab Jamahiriya">LY - Libyan Arab Jamahiriya</option>
<option value="Liechtenstein">LI - Liechtenstein</option>
<option value="Lithuania">LT - Lithuania</option>
<option value="Luxembourg">LU - Luxembourg</option>
<option value="Macau">MO - Macau</option>
<option value="Macedonia, The Former Yugoslav Republic of">MK - Macedonia, The Former Yugoslav Republic of</option>
<option value="Madagascar">MG - Madagascar</option>
<option value="Malawi">MW - Malawi</option>
<option value="Malaysia">MY - Malaysia</option>
<option value="Maldives">MV - Maldives</option>
<option value="Mali">ML - Mali</option>
<option value="Malta">MT - Malta</option>
<option value="Marshall Islands">MH - Marshall Islands</option>
<option value="Martinique">MQ - Martinique</option>
<option value="Mauritania">MR - Mauritania</option>
<option value="Mauritius">MU - Mauritius</option>
<option value="Mayotte">YT - Mayotte</option>
<option value="Mexico">MX - Mexico</option>
<option value="Micronesia, Federated States of">FM - Micronesia, Federated States of</option>
<option value="Moldova, Republic of">MD - Moldova, Republic of</option>
<option value="Monaco">MC - Monaco</option>
<option value="Mongolia">MN - Mongolia</option>
<option value="Montserrat">MS - Montserrat</option>
<option value="Morocco">MA - Morocco</option>
<option value="Mozambique">MZ - Mozambique</option>
<option value="Myanmar">MM - Myanmar</option>
<option value="Namibia">NA - Namibia</option>
<option value="Nauru">NR - Nauru</option>
<option value="Nepal">NP - Nepal</option>
<option value="Netherlands">NL - Netherlands</option>
<option value="Netherlands Antilles">AN - Netherlands Antilles</option>
<option value="New Caledonia">NC - New Caledonia</option>
<option value="Nicaragua">NI - Nicaragua</option>
<option value="Niger">NE - Niger</option>
<option value="Nigeria">NG - Nigeria</option>
<option value="Niue">NU - Niue</option>
<option value="Norfolk Island">NF - Norfolk Island</option>
<option value="Northern Mariana Islands">MP - Northern Mariana Islands</option>
<option value="Norway">NO - Norway</option>
<option value="Oman">OM - Oman</option>
<option value="Pakistan">PK - Pakistan</option>
<option value="Palau">PW - Palau</option>
<option value="Palestinian Territory, Occupied">PS - Palestinian Territory, Occupied</option>
<option value="PANAMA">PA - PANAMA</option>
<option value="Papua New Guinea">PG - Papua New Guinea</option>
<option value="Paraguay">PY - Paraguay</option>
<option value="Peru">PE - Peru</option>
<option value="Philippines">PH - Philippines</option>
<option value="Pitcairn">PN - Pitcairn</option>
<option value="Poland">PL - Poland</option>
<option value="Portugal">PT - Portugal</option>
<option value="Puerto Rico">PR - Puerto Rico</option>
<option value="Qatar">QA - Qatar</option>
<option value="Reunion">RE - Reunion</option>
<option value="R  omania">RO - R  omania</option>
<option value="Russian Federation">RU - Russian Federation</option>
<option value="Rwanda">RW - Rwanda</option>
<option value="Saint Helena">SH - Saint Helena</option>
<option value="Saint Kitts and Nevis">KN - Saint Kitts and Nevis</option>
<option value="Saint Lucia">LC - Saint Lucia</option>
<option value="Saint Pierre and Miquelon">PM - Saint Pierre and Miquelon</option>
<option value="Saint Vincent and the Grenadines">VC - Saint Vincent and the Grenadines</option>
<option value="Samoa">WS - Samoa</option>
<option value="San Marino">SM - San Marino</option>
<option value="Sao Tome and Principe">ST - Sao Tome and Principe</option>
<option value="Saudi Arabia">SA - Saudi Arabia</option>
<option value="Senegal">SN - Senegal</option>
<option value="Seychelles">SC - Seychelles</option>
<option value="Sierra Leone">SL - Sierra Leone</option>
<option value="Singapore">SG - Singapore</option>
<option value="Slovakia">SK - Slovakia</option>
<option value="Slovenia">SI - Slovenia</option>
<option value="Solomon Islands">SB - Solomon Islands</option>
<option value="Somalia">SO - Somalia</option>
<option value="South Africa">ZA - South Africa</option>
<option value="South Georgia and the South Sandwich Islands">GS - South Georgia and the South Sandwich Islands</option>
<option value="Spain">ES - Spain</option>
<option value="Sri Lanka">LK - Sri Lanka</option>
<option value="Sudan">SD - Sudan</option>
<option value="Suriname">SR - Suriname</option>
<option value="Svalbard and Jan Mayen">SJ - Svalbard and Jan Mayen</option>
<option value="Swaziland">SZ - Swaziland</option>
<option value="Sweden">SE - Sweden</option>
<option value="Switzerland">CH - Switzerland</option>
<option value="Syrian Arab Republic">SY - Syrian Arab Republic</option>
<option value="Taiwan, Province of China">TW - Taiwan, Province of China</option>
<option value="Tajikistan">TJ - Tajikistan</option>
<option value="Tanzania, United Republic of">TZ - Tanzania, United Republic of</option>
<option value="Thailand">TH - Thailand</option>
<option value="Togo">TG - Togo</option>
<option value="Tokelau">TK - Tokelau</option>
<option value="Tonga">TO - Tonga</option>
<option value="Trinidad and Tobago">TT - Trinidad and Tobago</option>
<option value="Tunisia">TN - Tunisia</option>
<option value="Turkey">TR - Turkey</option>
<option value="Turkmenistan">TM - Turkmenistan</option>
<option value="Turks and Caicos Islands">TC - Turks and Caicos Islands</option>
<option value="Tuvalu">TV - Tuvalu</option>
<option value="Uganda">UG - Uganda</option>
<option value="Ukraine">UA - Ukraine</option>
<option value="United Arab Emirates">AE - United Arab Emirates</option>
<option value="United Kingdom">GB - United Kingdom</option>
<option value="United States Minor Outlying Islands">UM - United States Minor Outlying Islands</option>
<option value="Uruguay">UY - Uruguay</option>
<option value="Uzbekistan">UZ - Uzbekistan</option>
<option value="Vanuatu">VU - Vanuatu</option>
<option value="Venezuela">VE - Venezuela</option>
<option value="Viet Nam">VN - Viet Nam</option>
<option value="Virgin Islands, British">VG - Virgin Islands, British</option>
<option value="Virgin Islands, U.S.">VI - Virgin Islands, U.S.</option>
<option value="Wallis and Futuna">WF - Wallis and Futuna</option>
<option value="Western Sahara">EH - Western Sahara</option>
<option value="Yemen">YE - Yemen</option>
<option value="Yugoslavia">YU - Yugoslavia</option>
<option value="Zambia">ZM - Zambia</option>
<option value="Zimbabwe">ZW - Zimbabwe</option></select>

      
      </div>
      
    </fieldset>



<fieldset><legend>Book Information</legend>
	<div class="required">
        
        <label for="book_title"><strong>Book Title:</strong></label><br/>
        <input type="text" name="book_title" id="book_title" class="inputText" size="30" maxlength="100" value="" />
      </div>
      <div class="optional">
        
        <label for="book_author">Author:</label><br/>
        <input type="text" name="book_author" id="book_author" class="inputText" size="30" maxlength="100" value="" />
      </div>
	</fieldset>




<fieldset><legend>Contact Information</legend>
      
      <!-- <div class="notes">
        <h4>Contact Information</h4>
        <p>Please enter your full email address, for example, <strong>name@domain.com</strong></p>
        <p>It is important that you provide a valid, working email address that you have access to as it must be verified before you can use your account.</p>
        <p class="last">Your phone number will not be shared or used for telemarketing. Your information is protected by our <a href="/legal/privacy_policy/" title="View our Privacy Policy">Privacy Policy</a>.</p>
      </div>
      
      <div class="required">
        <fieldset><legend>How to Contact You?</legend>
          <label for="how_contact_phone" class="labelRadio compact"><input type="radio" name="how_contact" id="how_contact_phone" class="inputRadio" value="Phone" /> Phone</label>
          <label for="how_contact_email" class="labelRadio compact"><input type="radio" name="how_contact" id="how_contact_email" class="inputRadio" value="Email" checked="checked" /> Email</label>
        </fieldset>
      </div> -->
      <div class="optional">
        
        <label for="email">Email:</label><br/>
        <input type="text" name="email" id="email" class="inputText" size="30" maxlength="250" value="" />
        <small>We will never sell or disclose your email address to anyone.</small>
      </div>
     <!-- <div class="required">
        
        <label for="confirm_email">Re-enter Email:</label>
        <input type="text" name="confirm_email" id="confirm_email" class="inputText" size="10" maxlength="250" value="" />
        <small>Must match the email address you just entered above.</small>
      </div> -->
      <div class="optional">
        
        <label for="phone">Phone:</label><br/>
        <input type="text" name="phone" id="phone" class="inputText" size="15" maxlength="50" value="" />
      </div>
      <div class="optional">
        
        <!--<label for="fax">Fax:</label>
        <input type="text" name="fax" id="fax" class="inputText" size="10" maxlength="50" value="" /> -->
      </div>
      <div class="optional">
      
          <!--  <small>There is no charge for physical media delivery (CDs) to libraries.</small> -->

      
      <fieldset><legend>Formats Requested:</legend>

          <label for="formats_checkbox_0" class="labelCheckbox">
          <input type="checkbox" name="daisy3" id="formats_checkbox_0" class="inputCheckbox" value="1" checked="true" disabled="true"/> DAISY with MP3 playlists (always produced)</label>
          
          <label for="formats_checkbox_1" class="labelCheckbox">
          <input type="checkbox" name="ipod" id="formats_checkbox_1" class="inputCheckbox" value="1" />iPod Audiobook Format</label>
          
          <!--
          <label for="formats_checkbox_2" class="labelCheckbox">
          <input type="checkbox" name="daisy_text" id="formats_checkbox_2" class="inputCheckbox" value="1" /> DAISY text only</label>
          
          <label for="formats_checkbox_3" class="labelCheckbox">
          <input type="checkbox" name="largeprint" id="formats_checkbox_3" class="inputCheckbox" value="1" /> Large Print (PDF)</label>
          
          <label for="formats_checkbox_4" class="labelCheckbox">
          <input type="checkbox" name="braille" id="formats_checkbox_4" class="inputCheckbox" value="1" />  Braille Ready File (BRF)</label>
          
          <label for="formats_checkbox_5" class="labelCheckbox">
          <input type="checkbox" name="epub" id="formats_checkbox_5" class="inputCheckbox" value="1" /> EPub file</label>
          
          <label for="formats_checkbox_6" class="labelCheckbox">
          <input type="checkbox" name="cd" id="formats_checkbox_6" class="inputCheckbox" value="1" /> Physical CD. <span id="Layer02">(A$19.99)</span>
          </label>
			-->
        </fieldset>
      </div>
</fieldset>

<fieldset><legend>Submit Request</legend>

<p>By submitting your request you agree not to copy for others or make a loan of works covered under the Copyright Act.</p>
<div class="submit">
        <div>
          <input type="submit" class="inputSubmit" value="Submit" name="submit"/>
          <input type="submit" class="inputSubmit" value="Cancel" />
        </div>
      </div>






</fieldset>





</form>

<hr/>

<?php require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/footer.php"); ?>
