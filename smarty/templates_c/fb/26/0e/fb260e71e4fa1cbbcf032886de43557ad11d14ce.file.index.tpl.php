<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 08:58:06
         compiled from "/Library/WebServer/Documents/cals/smarty/templates/opac/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1472445373516ca21e66b7d3-17021582%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb260e71e4fa1cbbcf032886de43557ad11d14ce' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/opac/index.tpl',
      1 => 1366073768,
      2 => 'file',
    ),
    '8753c23466afc162daf0701e8f49d57472c20c56' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/private/opac_layout.tpl',
      1 => 1366073768,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1472445373516ca21e66b7d3-17021582',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'charset' => 0,
    'labelTodaysDate' => 0,
    'labelLibraryHours' => 0,
    'labelLibraryPhone' => 0,
    'loginOutButton' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516ca21ebadc66_37670547',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516ca21ebadc66_37670547')) {function content_516ca21ebadc66_37670547($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/cals/libs/Smarty/plugins/modifier.date_format.php';
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
    	<p><?php echo $_smarty_tpl->getConfigVariable('libraryDescription');?>
</p>
    </p>

	<div id="hours">
		<?php echo $_smarty_tpl->tpl_vars['labelTodaysDate']->value;?>
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

		<div id="content">
		
<br/>
<h1><?php echo $_smarty_tpl->tpl_vars['contentHeader']->value;?>
</h1>
<p align="left"><?php echo $_smarty_tpl->tpl_vars['contentMsg']->value;?>
</p>
<br/>
<div  id="mainbody">

<form name="opacsearch" method="GET" action="search.php">
<div >
<table class="primary" align="center">
  <tr>
    <th valign="top" nowrap="yes" align="left" style="padding: 5px 15px 5px 15px;">
    Search Form
      <!--
<?php echo $_smarty_tpl->tpl_vars['labels']->value["srch_header"];?>

    	<select name="t">
        	<option value="1" selected><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_title'];?>
</option>
	        <option value="2"><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_author'];?>
</option>
		    <option value="3"><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_subject'];?>
</option>
		    <option value="4"><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_isbn'];?>
</option>
		    <option value="5"><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_snum'];?>
</option>
		    <option value="0"><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_all'];?>
</option>
        </select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sort By :
		<select name="b">
			 <option value="a" selected><?php echo $_smarty_tpl->tpl_vars['labels']->value["sel_author"];?>
</option>
        	 <option value="t" ><?php echo $_smarty_tpl->tpl_vars['labels']->value["sel_title"];?>
</option>
      	</select>
-->
	</th>
  </tr>
  <tr>
    <td nowrap="true" class="primary" style="padding: 5px 15px 5px 15px;">
        
		<p><label for="searchcrit">Search terms: </label><input type="text" name="c" id="searchcrit" size="60" maxlength="120"></p>
      	
      	<label for="searchby"><?php echo $_smarty_tpl->tpl_vars['labels']->value["srch_header"];?>
 </label>
    	<select name="t" id="searchby">
        	<option value="1" selected><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_title'];?>
</option>
	        <option value="2"><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_author'];?>
</option>
		    <option value="3"><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_subject'];?>
</option>
		    <option value="4"><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_isbn'];?>
</option>
		    <option value="5"><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_snum'];?>
</option>
		    <option value="0"><?php echo $_smarty_tpl->tpl_vars['labels']->value['sel_all'];?>
</option>
        </select>
		&nbsp;&nbsp;<label for="orderby">Sort By: </label>
		<select name="b" id="orderby">
			 <option value="a" selected><?php echo $_smarty_tpl->tpl_vars['labels']->value["sel_author"];?>
</option>
        	 <option value="t" ><?php echo $_smarty_tpl->tpl_vars['labels']->value["sel_title"];?>
</option>
      	</select>
      	<input type="checkbox" name="p" value=1 checked="checked" id="prodcheck">&nbsp;<label for="prodcheck">Search only produced titles</label><br/>
      	<p align="center"><input type="submit" value="Search" class="button"></p>
    </td>
  </tr>
</table>
</div>
</form>

<br/>

<p align="left"><strong><a href="/Library/shelflist/index.php">Shelflist</a></strong> <<?php ?>?php echo date('d F Y'); ?<?php ?>><br/>
This is a list of the talking books which have been produced into DAISY digital talking book format by the Association for the Blind of Western Australia from <<?php ?>?php echo $two_months ?<?php ?>> to <<?php ?>?php echo $now ?<?php ?>> these books can be accessed from the association or online.</p>
</div>

		</div>
		
		
<div id="content">	
	<h1 class="greenbar">Login</h1>
	<p>Registered users of the library can use the button below to login to the system. Once logged in you will not be requested for your username or password to download copyrighted works.</p>

	<center>
			<?php if ($_smarty_tpl->tpl_vars['loginOutButton']->value){?><input type="button" class="button" value="<?php echo $_smarty_tpl->tpl_vars['loginOutButton']->value['label'];?>
" onclick="self.location='<?php echo $_smarty_tpl->tpl_vars['loginOutButton']->value['ref'];?>
'"><br/><?php }?>
	</center>
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

<script>
	window.onload = function() {
		document.getElementById("searchcrit").focus();
  	};
</script>

</html>
<?php }} ?>