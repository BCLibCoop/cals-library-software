<?php /* Smarty version Smarty-3.1.13, created on 2013-04-13 03:21:51
         compiled from "/Library/WebServer/Documents/cals/smarty/templates/opac/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:209589722251685ecf5c5a83-10383162%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f52a2e8ff8e14eff96ff675f62fab06657916b8' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/opac/view.tpl',
      1 => 1365650399,
      2 => 'file',
    ),
    '8753c23466afc162daf0701e8f49d57472c20c56' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/private/opac_layout.tpl',
      1 => 1365664340,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '209589722251685ecf5c5a83-10383162',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'charset' => 0,
    'caTitle' => 0,
    'labelTodaysDate' => 0,
    'labelLibraryHours' => 0,
    'labelLibraryPhone' => 0,
    'caLogin' => 0,
    'loginOutButton' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51685ecf7682d1_16540253',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51685ecf7682d1_16540253')) {function content_51685ecf7682d1_16540253($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/cals/libs/Smarty/plugins/modifier.date_format.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<?php  $_config = new Smarty_Internal_Config("DLS.cfg", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars('Library', 'local'); ?>
<?php $_smarty_tpl->tpl_vars['charset'] = new Smarty_variable($_smarty_tpl->getConfigVariable('charset')!='' ? $_smarty_tpl->getConfigVariable('charset') : 'utf-8', null, 0);?>
<head>

<meta http-equiv="content-type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['charset']->value;?>
">
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
<title><?php echo $_smarty_tpl->getConfigVariable('libraryName');?>
</title>
 
</head>
<body>
<div id="header">

<table class="primary" width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
   <td rowspan="2"><img align="middle" src="/cals/opac/canada_flag.jpg" border="0" height="60" alt="Canada Flag"></td>
    <td  valign="top"><h1><?php echo $_smarty_tpl->tpl_vars['caTitle']->value;?>
</h1></td>
    <tr>
</table>
	<!--
<?php if ($_smarty_tpl->getConfigVariable('libraryImageUrl')!=''){?>
      <img src="../images/<?php echo $_smarty_tpl->getConfigVariable('libraryImageUrl');?>
" alt="Guide Dogs WA logo" >
    <?php }?>
    <p>
    	<h1><strong><?php echo $_smarty_tpl->getConfigVariable('libraryName');?>
</strong></h1>
    	<h4><?php echo $_smarty_tpl->getConfigVariable('libraryDescription');?>
</h4>
    </p>

	<div id="hours">
		Today is : <?php echo $_smarty_tpl->tpl_vars['labelTodaysDate']->value;?>
<?php echo smarty_modifier_date_format(time());?>
&nbsp;
			<?php if ($_smarty_tpl->getConfigVariable('libraryHours')!=''){?>
          		Opening Hours : <?php echo $_smarty_tpl->tpl_vars['labelLibraryHours']->value;?>
<?php echo $_smarty_tpl->getConfigVariable('libraryHours');?>
&nbsp;
 	        <?php }?>
            <?php if ($_smarty_tpl->getConfigVariable('libraryPhone')!=''){?>
          		Phone : <?php echo $_smarty_tpl->tpl_vars['labelLibraryPhone']->value;?>
<?php echo $_smarty_tpl->getConfigVariable('libraryPhone');?>
&nbsp;
       		<?php }?>
-->
	</div>
</div> <!-- header -->
<hr/>
<div id="contentWrapper">
<div style="margin: 0 50px 0 50px;">
<h1>Login</h1>
<p><?php echo $_smarty_tpl->tpl_vars['caLogin']->value;?>
</p>
</div>
<center>
	<div id="content">
		<?php if ($_smarty_tpl->tpl_vars['loginOutButton']->value){?>
			<input type="button" class="button" value="<?php echo $_smarty_tpl->tpl_vars['loginOutButton']->value['label'];?>
" onclick="self.location='<?php echo $_smarty_tpl->tpl_vars['loginOutButton']->value['ref'];?>
'"><br/>
		<?php }?>
		</center>
		<div id="content">
		

<div style="margin:0 5% 0 5%;">
<input class="button" type="button" value="Back to Results" onClick="window.history.back()">
<input class="button" type="button" value="Back to Search" onClick="js:self.location='index.php'">

<div style="width:100%;clear:both;">
<div style="width:85%;float:left">
<h1 style="clear:both;">
<?php if ($_smarty_tpl->tpl_vars['fields']->value['general']['245a']){?> 
	<?php echo $_smarty_tpl->tpl_vars['fields']->value['general']['245a']['data'];?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['fields']->value['general']['245b']){?> 
&nbsp;<?php echo $_smarty_tpl->tpl_vars['fields']->value['general']['245b']['data'];?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['fields']->value['general']['035a']){?> 
&nbsp;<?php echo $_smarty_tpl->tpl_vars['fields']->value['general']['035a']['data'];?>

<?php }?>
</h1>
<?php if ($_smarty_tpl->tpl_vars['fields']->value['general']['520a']){?> 
<p><?php echo $_smarty_tpl->tpl_vars['fields']->value['general']['520a']['data'];?>
</p>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['restricted']->value){?>
<p><font color="red"><?php echo $_smarty_tpl->tpl_vars['labels']->value['restrictedMessage'];?>
</font></p>
<?php }?>
</div>
<div style="width:15%;float:right">
<br/><br/>
<img src="data:image/png;base64,<?php echo $_smarty_tpl->tpl_vars['qrcode']->value;?>
"/>
</div>
</div>
<br/>
<hr/>
<div style="clear:both;"></div>
<h2>Copies</h2>
<?php if ($_smarty_tpl->tpl_vars['copies']->value){?>
<table class="adminTable" >
<thead>
	<tr>
		<th class="left"><?php echo $_smarty_tpl->tpl_vars['labels']->value['copyFormat'];?>
</th>
		<th><?php echo $_smarty_tpl->tpl_vars['labels']->value['copySize'];?>
</th>
		<th class="right"><?php echo $_smarty_tpl->tpl_vars['labels']->value['copyPlayTime'];?>
</th>
	</tr>
</thead>
<tbody>

<?php  $_smarty_tpl->tpl_vars["aCopy"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["aCopy"]->_loop = false;
 $_smarty_tpl->tpl_vars["idx"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['copies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["aCopy"]->key => $_smarty_tpl->tpl_vars["aCopy"]->value){
$_smarty_tpl->tpl_vars["aCopy"]->_loop = true;
 $_smarty_tpl->tpl_vars["idx"]->value = $_smarty_tpl->tpl_vars["aCopy"]->key;
?>
	<tr >
	<?php if ($_smarty_tpl->tpl_vars['aCopy']->value['error']){?>
		<td colspan="3" class="both" align="center"><?php echo $_smarty_tpl->tpl_vars['aCopy']->value['error'];?>
</td>
		<td></td>
	<?php }else{ ?>
		<td class="left" width="50%"><input type="button" class="button" value="<?php echo $_smarty_tpl->tpl_vars['aCopy']->value['downloadButtonText'];?>
" onclick="js:self.location='<?php echo $_smarty_tpl->tpl_vars['aCopy']->value['downloadButtonUrl'];?>
'"></td>
		<td><?php echo $_smarty_tpl->tpl_vars['aCopy']->value['size'];?>
</td>
		<td class="right"><?php echo $_smarty_tpl->tpl_vars['aCopy']->value['playTime'];?>
</td>
	<?php }?>
	</tr>
<?php } ?>

</tbody>
</table>
<?php }else{ ?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['labels']->value['noCopies'];?>
<br/>
<?php }?>


<br/>
<hr/>


<table class="primary" style="width:90%;" itemtype="http://schema.org/Book">
  <thead>
  <tr>
    <th align="left" colspan="2" nowrap="yes">
     <?php echo $_smarty_tpl->tpl_vars['labels']->value['entryInfoGeneral'];?>

    </th>
  </tr>
  </thead>
  <tbody>
  	<?php  $_smarty_tpl->tpl_vars["fld"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["fld"]->_loop = false;
 $_smarty_tpl->tpl_vars['tag'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value['general']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["fld"]->key => $_smarty_tpl->tpl_vars["fld"]->value){
$_smarty_tpl->tpl_vars["fld"]->_loop = true;
 $_smarty_tpl->tpl_vars['tag']->value = $_smarty_tpl->tpl_vars["fld"]->key;
?>
  	<tr >
  		<td class="primary" style="width:30%;" valign="top">&nbsp;<?php echo $_smarty_tpl->tpl_vars['fld']->value['descr'];?>
</td>
  		<td style="width:70%" valign="top" class="primary">&nbsp;<?php echo $_smarty_tpl->tpl_vars['fld']->value['data'];?>
</td>
  	</tr>
 <?php } ?>
 	<tr><td>&nbsp;</td></tr>
  </tbody>
  <thead>
  <tr>
    <th align="left" colspan="2" nowrap="yes">
     <?php echo $_smarty_tpl->tpl_vars['labels']->value['entryInfoExtra'];?>

    </th>
  </tr>
  </thead>
  <tbody>
  	<?php  $_smarty_tpl->tpl_vars["fld"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["fld"]->_loop = false;
 $_smarty_tpl->tpl_vars['tag'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value['extra']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["fld"]->key => $_smarty_tpl->tpl_vars["fld"]->value){
$_smarty_tpl->tpl_vars["fld"]->_loop = true;
 $_smarty_tpl->tpl_vars['tag']->value = $_smarty_tpl->tpl_vars["fld"]->key;
?>
  	<tr >
  		<td class="primary" style="width:30%;" valign="top">&nbsp;<?php echo $_smarty_tpl->tpl_vars['fld']->value['descr'];?>
</td>
  		<td style="width:70%" valign="top" class="primary">&nbsp;<?php echo $_smarty_tpl->tpl_vars['fld']->value['data'];?>
</td>
  	</tr>
 <?php } ?>
</tbody>
</table>


</div>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24139575-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">

 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-26676150-1']);
 _gaq.push(['_trackPageview']);

 (function() {
   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();

</script>

		</div>
	</div>


</div>
<hr/>

<p class="copyright"><center>Copyright 2012 by the Canadian Accessible Library System/Syst&egrave;me canadien de la biblioth&egrave;que accessible<br/>and the Association for the Blind of Western Australia</center></p>
 
</body>

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

</html>
<?php }} ?>