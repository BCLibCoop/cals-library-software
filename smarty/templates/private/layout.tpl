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

<link rel="stylesheet" type="text/css" href="../css/admin.css" title="style" />
<title>{block name="pageTitle"}{$smarty.config.libraryName}{/block}</title>

{/block} {* end head block *}
</head>

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.libraries.coop/piwik/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "2"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><!-- Piwik Image Tracker -->
<img src="https://piwik.libraries.coop/piwik/piwik.php?idsite=2&amp;rec=1"
style="border:0" alt="" />
<!-- End image tracker-->
</noscript>
<!-- End Piwik Code -->
<body>
<div id="header">
	<div id="logo">
	{if $smarty.config.libraryImageUrl != ''}
      <img src="../images/{$smarty.config.libraryImageUrl}" alt="Guide Dogs WA logo"></td>
    {/if}
	</div>
	<div>
		<div id='libraryDetails'>
			<p>{$labelTodaysDate}{$smarty.now|date_format}
			{if $smarty.config.libraryHours != ''}
          		<br/>{$labelLibraryHours}{$smarty.config.libraryHours}
 	        {/if}
            {if $smarty.config.libraryPhone != ''}
          		<br/>{$labelLibraryPhone}{$smarty.config.libraryPhone}
       		{/if}
       		</p>
		</div>

		<div id='libraryName'>
			<h1><strong>{$smarty.config.libraryName}</strong></h1>
			<h5>{$smarty.config.libraryDescription}</h5>
		</div>
	</div>
</div>

{if !$isPublic}
	<div id="tabMenuWrapper">
		{block name='tabMenu'}{/block}
	</div>
{/if}
<div id="contentWrapper">
	<div id="content">
		{if $loginOutButton}
			<input style="margin-left:-85px;margin-top:-15px;" type="button" value="{$loginOutButton.label}" onclick="self.location='{$loginOutButton.ref}'"><br/>
		{/if}
		{block name="content"}{/block}
	</div>
</div>

{block name="footer"}
<div id="footer">
	<div id="footerWarning">
		<p><strong>Warning</strong> Aboriginal and Torres Strait Islander peoples are advised that files, books and recordings in this collection may contain images or sound recordings of people who are deceased.</p>
	</div>
		<center>
		  <a href="../shared/about.php">About Us</a>
		  {if $helpPage}
		  <a href="javascript:popSecondary('../shared/help.php?page="{$helpPage}"')">{$footerHelp}</a>
		  {/if}
		  <br><br>
		  <div id="footerBanner">
		  <table>
		  	<tr >
		  	{if $smarty.config.libraryShowImageInFooter == '1'}
		  		<td><img src="../images/GuideDogslogo.jpg" width="170" border="0"  alt="Guide Dogs WA logo"></td>
		  	{/if}
		  		<td><strong>Beyond Books, Beyond Barriers</strong><br/>The Braille and Talking Book Library of the <br/>Association for the Blind of Western Australia</td>
		  	</tr>
		  </table>
		  </div>


		</center>
		<br> <br><br>
		</div>
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
