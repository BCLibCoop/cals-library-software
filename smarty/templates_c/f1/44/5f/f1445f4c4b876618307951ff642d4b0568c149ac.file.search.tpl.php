<?php /* Smarty version Smarty-3.1.13, created on 2013-04-13 03:21:40
         compiled from "/Library/WebServer/Documents/cals/smarty/templates/opac/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162521008451685ec42aee48-68264570%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1445f4c4b876618307951ff642d4b0568c149ac' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/opac/search.tpl',
      1 => 1365650388,
      2 => 'file',
    ),
    '8753c23466afc162daf0701e8f49d57472c20c56' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/private/opac_layout.tpl',
      1 => 1365664340,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162521008451685ec42aee48-68264570',
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
  'unifunc' => 'content_51685ec4408c03_67617292',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51685ec4408c03_67617292')) {function content_51685ec4408c03_67617292($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/cals/libs/Smarty/plugins/modifier.date_format.php';
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
		
<div style="margin:20px 0 0 -40px">
<input  type="button" class="button" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['back'];?>
" onclick="js:self.location='index.php';">
</div>
<div style="margin:0 5% 0 1%;">
<br/>
<table  class="adminTable"  style="width:100%">
<thead><tr><th><?php echo $_smarty_tpl->tpl_vars['labels']->value['searchCrit'];?>
</th></tr></thead>
<tbody >
<tr><td></td></tr>
<?php  $_smarty_tpl->tpl_vars['ent'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ent']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['ent']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['ent']->key => $_smarty_tpl->tpl_vars['ent']->value){
$_smarty_tpl->tpl_vars['ent']->_loop = true;
 $_smarty_tpl->tpl_vars['ent']->index++;
?>
<?php if ($_smarty_tpl->tpl_vars['ent']->index){?><tr><td><hr/></td></tr><?php }?>
<tr style="border:1px solid black;">
	<td ><?php echo $_smarty_tpl->tpl_vars['labels']->value['title'];?>
 : <a href="view.php?b=<?php echo $_smarty_tpl->tpl_vars['ent']->value['bibid'];?>
"><?php echo $_smarty_tpl->tpl_vars['ent']->value['title'];?>
</a>
		 <br/><?php echo $_smarty_tpl->tpl_vars['labels']->value['author'];?>
 : <?php echo $_smarty_tpl->tpl_vars['ent']->value['author'];?>

		 <br/><?php echo $_smarty_tpl->tpl_vars['labels']->value['systemNum'];?>
 : <?php echo $_smarty_tpl->tpl_vars['ent']->value['snum'];?>

		 <br/><?php echo $_smarty_tpl->tpl_vars['labels']->value['collection'];?>
 : <?php echo $_smarty_tpl->tpl_vars['ent']->value['collection'];?>

		 <?php if ($_smarty_tpl->tpl_vars['ent']->value['restricted']){?><font color="red"><br/><?php echo $_smarty_tpl->tpl_vars['labels']->value['restrictedMsg'];?>
</font><?php }?>
		 <?php if ($_smarty_tpl->tpl_vars['ent']->value['copyTypes']){?><br/><?php echo $_smarty_tpl->tpl_vars['labels']->value['copyTypes'];?>
 : <?php echo $_smarty_tpl->tpl_vars['ent']->value['copyTypes'];?>
<?php }else{ ?><br/><a href="request.php?bibid=<?php echo $_smarty_tpl->tpl_vars['ent']->value['bibid'];?>
$"><?php echo $_smarty_tpl->tpl_vars['labels']->value['requestProd'];?>
</a><?php }?>
	</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<br/>

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