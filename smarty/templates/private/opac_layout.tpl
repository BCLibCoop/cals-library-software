{* Smarty Template *}
{*debug *}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
{* Base Layout For DLS Pages *}
{config_load file="DLS.cfg" section='Library'}
{$charset = ($smarty.config.charset!='')?$smarty.config.charset:'utf-8'}
<head>
{block name="head"}
<meta http-equiv="content-type" content="text/html; charset={$charset}">
<meta http-equiv="content-style-type" content="text/css" />
<meta name="language" content="en" />
<meta name="author" content="Kieren Eaton" />
<meta name="description" content="Digital Library Information Service">
<!--
 <meta name="Description" content="Guide Dogs and other services for people who are vision impaired" />
<meta name="Keywords" content="" />
<meta name="robots" content="index,follow" />
-->
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="stylesheet" type="text/css" href="../css/opac.css" title="style" />
<title>{block name="pageTitle"}{$smarty.config.libraryName}{/block}</title>
{/block} {* end head block *}
</head>
<body>
<div id="header">
	{if $smarty.config.libraryImageUrl != ''}
      <img src="../images/{$smarty.config.libraryImageUrl}" alt="Guide Dogs WA logo" >
    {/if}
    <p>
    	<h1><strong>{$smarty.config.libraryName}</strong></h1>
    	<p>{$smarty.config.libraryDescription}</p>
    </p>

	<div id="hours">
		{$labelTodaysDate}{$smarty.now|date_format}&nbsp;
			{if $smarty.config.libraryHours != ''}
          		Opening Hours : {$labelLibraryHours}{$smarty.config.libraryHours}&nbsp;
 	        {/if}
            {if $smarty.config.libraryPhone != ''}
          		Phone : {$labelLibraryPhone}{$smarty.config.libraryPhone}&nbsp;
       		{/if}
	</div>
</div> <!-- header -->
<hr/>
<div id="contentWrapper">

		<div id="content">
		{block name="content"}{/block}
		</div>
		
		
<div id="content">	
	<h1 class="greenbar">Login</h1>
	<p>Registered users of the library can use the button below to login to the system. Once logged in you will not be requested for your username or password to download copyrighted works.</p>

	<center>
			{if $loginOutButton}<input type="button" class="button" value="{$loginOutButton.label}" onclick="self.location='{$loginOutButton.ref}'"><br/>{/if}
	</center>
</div>
	

</div>
<hr/>
{block name="footer"}
<p class="copyright"><center>Copyright 2012 by the Canadian Accessible Library System/Syst&egrave;me canadien de la biblioth&egrave;que accessible<br/>and the Association for the Blind of Western Australia</center></p>
{/block} {* end footer block *}
</body>
{block name="endScripts"}
<script type="text/javascript">
<!--
function popSecondary(url) {
    var SecondaryWin;
    SecondaryWin = window.open(url,"secondary","resizable=yes,scrollbars=yes,width=535,height=400");
    self.name="main";
}
function popSecondaryLarge(url) {
    var SecondaryWin;
    SecondaryWin = window.open(url,"secondary","toolbar=yes,resizable=yes,scrollbars=yes,width=700,height=500");
    self.name="main";
}
function backToMain(URL) {
    var mainWin;
    mainWin = window.open(URL,"main");
    mainWin.focus();
    this.close();
}
-->
</script>
{/block}{* end endScripts block *}
</html>
{*

<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");
  $headerLoc = new Localize(OBIB_LOCALE,"shared");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
<?php
// code html tag with language attribute if specified.
if (OBIB_HTML_LANG_ATTR != "") {
  echo "xml:lang=\"".H(OBIB_HTML_LANG_ATTR)."\" lang=\"".H(OBIB_HTML_LANG_ATTR)."\"";
}
else
	echo "xml:lang=\"en\" lang=\"en\"";
echo ">\n";

// code character set if specified
if (OBIB_CHARSET != "") { ?>
<META http-equiv="content-type" content="text/html; charset=<?php echo H(OBIB_CHARSET); ?>">
<?php } ?>

<style type="text/css">
  <?php include(str_replace('//','/',dirname(__FILE__).'/')."../css/style.php");?>

</style>
<meta name="description" content="OpenBiblio Library Automation System">
<?php //echo $refresh; ?>
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
<body bgcolor="<?php echo H(OBIB_PRIMARY_BG);?>" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" marginheight="0" marginwidth="0" <?php
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
   <td rowspan="2">
    <?php
         if (OBIB_LIBRARY_IMAGE_URL != "") {
           echo "<img align=\"middle\" src=\"".H(OBIB_LIBRARY_IMAGE_URL)."\" border=\"0\" height=\"60\" alt=\"Guide Dogs WA logo\"></td>";
         }
         if (!OBIB_LIBRARY_USE_IMAGE_ONLY) {
           echo "<td width=\"100%\" class=\"title\" valign=\"top\"><strong> ".H(OBIB_LIBRARY_NAME)."</strong></td></tr><tr><td width=\"100%\" class=\"title\" valign=\"top\"><span style=\"font-size: 12pt;\">Braille and Talking Book Library Services</span></td></tr>";
         }
       ?>
    </td>
    <tr>
</table>
      <div style="text-align: center;"><font class="small"><?php echo $headerLoc->getText("headerTodaysDate"); ?> <?php echo $headerLoc->getText("headerTodaysDate"); ?> <?php if (OBIB_LIBRARY_HOURS != "") echo $headerLoc->getText("headerLibraryHours");?> <?php if (OBIB_LIBRARY_HOURS != "") echo H(OBIB_LIBRARY_HOURS);?> <?php if (OBIB_LIBRARY_PHONE != "") echo $headerLoc->getText("headerLibraryPhone");?> <font class="small"><?php if (OBIB_LIBRARY_PHONE != "") echo H(OBIB_LIBRARY_PHONE);?></font></div>
       </td>

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
<!--<table height="100%" width="100%" cellpadding="10" cellspacing="0" border="0">




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
      <?php //include(str_replace('//','/',dirname(__FILE__).'/')."../navbars/opac.php"); ?>
      </font>
    <br><br><br><br>
    </td>
    <td bgcolor="<?php echo H(OBIB_BORDER_COLOR);?>"><img src="../images/shim.gif" width="1" height="1" border="0"></td>
    <td bgcolor="<?php echo H(OBIB_PRIMARY_BG);?>"><img src="../images/shim.gif" width="1" height="1" border="0"></td>







    <td height="100%" width="100%" valign="top"> -->
      <font class="primary">
      <br>
<!-- **************************************************************************************
     * beginning of main body
     **************************************************************************************-->
*}