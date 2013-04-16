<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 15:09:30
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/opac/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:143395063651650021aae341-07789174%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '734e6362248a5fed60448be4d1fa32dc7d10536c' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/opac/search.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
    '4ee9e29cd611c42900ba7854567fa7b71adba663' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/private/opac_layout.tpl',
      1 => 1365576060,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143395063651650021aae341-07789174',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51650021bf9ce2_82424024',
  'variables' => 
  array (
    'charset' => 0,
    'labelTodaysDate' => 0,
    'labelLibraryHours' => 0,
    'labelLibraryPhone' => 0,
    'loginOutButton' => 0,
    'helpPage' => 0,
    'footerHelp' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51650021bf9ce2_82424024')) {function content_51650021bf9ce2_82424024($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/modifier.date_format.php';
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
	</div>
</div> <!-- header -->
<hr/>
<div id="contentWrapper">
<div style="margin: 0 50px 0 50px;">
<h1>Login</h1>
<p>Registered users of the library can use the button below to login to the system. Once logged in you will not be requested for your username or password to download copyrighted works.</p>
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

		</div>
	</div>


</div>
<hr/>

<div id="footer">
	<div id="footerWarning">
		<p><strong>Warning</strong> Aboriginal and Torres Strait Islander peoples are advised that files, books and recordings in this collection may contain images or sound recordings of people who are deceased.</p>
	</div>
		<center>
		  <a href="../shared/about.php">About Us</a>
		  <?php if ($_smarty_tpl->tpl_vars['helpPage']->value){?>
		  <a href="javascript:popSecondary('../shared/help.php?page="<?php echo $_smarty_tpl->tpl_vars['helpPage']->value;?>
"')"><?php echo $_smarty_tpl->tpl_vars['footerHelp']->value;?>
</a>
		  <?php }?>
		  <br><br>
		  <div id="footerBanner">
		  <table>
		  	<tr >
		  	<?php if ($_smarty_tpl->getConfigVariable('libraryShowImageInFooter')=='1'){?>
		  		<td><img src="../images/GuideDogslogo.jpg" width="170" border="0"  alt="Guide Dogs WA logo"></td>
		  	<?php }?>
		  		<td><strong>Beyond Books, Beyond Barriers</strong><br/>The Braille and Talking Book Library of the <br/>Association for the Blind of Western Australia</td>
		  	</tr>
		  </table>
		  </div>
		</center>
		<br> <br><br>
		</div>
 
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