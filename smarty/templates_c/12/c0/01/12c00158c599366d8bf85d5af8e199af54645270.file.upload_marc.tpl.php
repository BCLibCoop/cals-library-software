<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 17:51:31
         compiled from "/Library/WebServer/Documents/cals/smarty/templates/catalog/upload_marc.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1726571163516d1f23cb2bc8-26258491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12c00158c599366d8bf85d5af8e199af54645270' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/catalog/upload_marc.tpl',
      1 => 1365649951,
      2 => 'file',
    ),
    'ba99d9fa779309ebe8f1560f6b421ab4d33e8b81' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/private/admin_layout.tpl',
      1 => 1365649952,
      2 => 'file',
    ),
    '00a02cbf87e68bb8b41a6eea70902b7cb2dd4111' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/private/layout.tpl',
      1 => 1365649952,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1726571163516d1f23cb2bc8-26258491',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'charset' => 0,
    'labelTodaysDate' => 0,
    'labelLibraryHours' => 0,
    'labelLibraryPhone' => 0,
    'isPublic' => 0,
    'loginOutButton' => 0,
    'helpPage' => 0,
    'footerHelp' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516d1f23eadad4_41135211',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516d1f23eadad4_41135211')) {function content_516d1f23eadad4_41135211($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/cals/libs/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_html_inputField')) include '/Library/WebServer/Documents/cals/smarty/plugins/function.html_inputField.php';
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

<link rel="stylesheet" type="text/css" href="../css/admin.css" title="style" />
<title><?php echo $_smarty_tpl->getConfigVariable('libraryName');?>
</title>

 

</head>
<body>
<div id="header">
	<div id="logo">
	<?php if ($_smarty_tpl->getConfigVariable('libraryImageUrl')!=''){?>
      <img src="../images/<?php echo $_smarty_tpl->getConfigVariable('libraryImageUrl');?>
" alt="Guide Dogs WA logo"></td>
    <?php }?>
	</div>
	<div>
		<div id='libraryDetails'>
			<p><?php echo $_smarty_tpl->tpl_vars['labelTodaysDate']->value;?>
<?php echo smarty_modifier_date_format(time());?>

			<?php if ($_smarty_tpl->getConfigVariable('libraryHours')!=''){?>
          		<br/><?php echo $_smarty_tpl->tpl_vars['labelLibraryHours']->value;?>
<?php echo $_smarty_tpl->getConfigVariable('libraryHours');?>

 	        <?php }?>
            <?php if ($_smarty_tpl->getConfigVariable('libraryPhone')!=''){?>
          		<br/><?php echo $_smarty_tpl->tpl_vars['labelLibraryPhone']->value;?>
<?php echo $_smarty_tpl->getConfigVariable('libraryPhone');?>

       		<?php }?>
       		</p>
		</div>

		<div id='libraryName'>
			<h1><strong><?php echo $_smarty_tpl->getConfigVariable('libraryName');?>
</strong></h1>
			<h5><?php echo $_smarty_tpl->getConfigVariable('libraryDescription');?>
</h5>
		</div>
	</div>
</div>

<?php if (!$_smarty_tpl->tpl_vars['isPublic']->value){?>
	<div id="tabMenuWrapper">
		
<link rel="stylesheet" type="text/css" href="../css/tabs.css" />
<div id="tabBox">
	<ul id="adminTabs">
	<?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value){
$_smarty_tpl->tpl_vars['tab']->_loop = true;
?>
		<li <?php if ($_smarty_tpl->tpl_vars['tab']->value['items']){?>class='selected'<?php }?>>
			<a <?php if (!$_smarty_tpl->tpl_vars['tab']->value['items']){?>href="<?php echo $_smarty_tpl->tpl_vars['tab']->value['ref'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['tab']->value['label'];?>
</a>
			
			<?php if ($_smarty_tpl->tpl_vars['tab']->value['items']){?>
				<span>
				<?php  $_smarty_tpl->tpl_vars['navItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['navItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tab']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['navItem']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['navItem']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['navItem']->key => $_smarty_tpl->tpl_vars['navItem']->value){
$_smarty_tpl->tpl_vars['navItem']->_loop = true;
 $_smarty_tpl->tpl_vars['navItem']->iteration++;
 $_smarty_tpl->tpl_vars['navItem']->last = $_smarty_tpl->tpl_vars['navItem']->iteration === $_smarty_tpl->tpl_vars['navItem']->total;
?>
					<a <?php if ($_smarty_tpl->tpl_vars['navItem']->value['selected']==false){?>href="<?php echo $_smarty_tpl->tpl_vars['navItem']->value['ref'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['navItem']->value['label'];?>
</a><?php if (!$_smarty_tpl->tpl_vars['navItem']->last){?>&nbsp;|&nbsp;<?php }?>
				<?php } ?>
				</span>
			<?php }?>
			
		</li>
	<?php } ?>
	</ul>
</div>

	</div>
<?php }?>
<div id="contentWrapper">
	<div id="content">
		<?php if ($_smarty_tpl->tpl_vars['loginOutButton']->value){?>
			<input style="margin-left:-85px;margin-top:-15px;" type="button" value="<?php echo $_smarty_tpl->tpl_vars['loginOutButton']->value['label'];?>
" onclick="self.location='<?php echo $_smarty_tpl->tpl_vars['loginOutButton']->value['ref'];?>
'"><br/>
		<?php }?>
		
	<?php if ($_smarty_tpl->tpl_vars['contentStatusMsg']->value){?>
		<pre><font class="error"><?php echo $_smarty_tpl->tpl_vars['contentStatusMsg']->value;?>
</font></pre>
	<?php }?>
	<h1><?php echo $_smarty_tpl->tpl_vars['contentHeader']->value;?>
</h1>
	<?php if ($_smarty_tpl->tpl_vars['contentDesc']->value){?>
	<h2><?php echo $_smarty_tpl->tpl_vars['contentDesc']->value;?>
</h2>
	<?php }?>


<div style="width:60%">
<form enctype="multipart/form-data" action="upload_marc.php" method="post">

<b><?php echo $_smarty_tpl->tpl_vars['labels']->value['defaults'];?>
&nbsp;:</b>
<table class="adminTable"/>
<tbody>
<tr><td style="width:20%" align="right"><?php echo $_smarty_tpl->tpl_vars['labels']->value['material'];?>
&nbsp;:&nbsp;</td><td style="width:80%" align="left"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"matid",'selected'=>$_smarty_tpl->tpl_vars['selMatId']->value,'options'=>$_smarty_tpl->tpl_vars['materials']->value),$_smarty_tpl);?>
</td></tr>
<tr><td style="width:20%" align="right"><?php echo $_smarty_tpl->tpl_vars['labels']->value['collection'];?>
&nbsp;:&nbsp;</td><td style="width:80%" align="left"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"colid",'selected'=>$_smarty_tpl->tpl_vars['selColId']->value,'options'=>$_smarty_tpl->tpl_vars['collections']->value),$_smarty_tpl);?>
</td></tr>
<tr><td style="width:20%" align="right"><?php echo $_smarty_tpl->tpl_vars['labels']->value['showOpac'];?>
&nbsp;:&nbsp;</td><td style="width:80%"  align="left"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['opacChecked']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo smarty_function_html_inputField(array('type'=>"checkbox",'value'=>"1",'name'=>"opac",'checked'=>$_tmp1),$_smarty_tpl);?>
 </td></tr>
<tr><td colspan="2"></td></tr>
<tr><td style="width:20%" align="right"><?php echo $_smarty_tpl->tpl_vars['labels']->value['testUpload'];?>
&nbsp;:&nbsp;</td><td style="width:80%"  align="left"><?php echo smarty_function_html_inputField(array('type'=>"checkbox",'value'=>"1",'name'=>"test",'checked'=>$_smarty_tpl->tpl_vars['testChecked']->value),$_smarty_tpl);?>
&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['labels']->value['testNote'];?>
</td></tr>

</tbody>

</table>
<br/>
<?php echo $_smarty_tpl->tpl_vars['labels']->value['uploadFile'];?>
&nbsp;:&nbsp;<input type="file" name="datafiles"><br><br>
  <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['submit'];?>
">
</form>

<br/>

<?php  $_smarty_tpl->tpl_vars["record"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["record"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['testRecords']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["record"]->key => $_smarty_tpl->tpl_vars["record"]->value){
$_smarty_tpl->tpl_vars["record"]->_loop = true;
?>
<h2><?php echo $_smarty_tpl->tpl_vars['labels']->value['marcRecord'];?>
</h2>
<table class="adminTable">
<thead>
	<th><?php echo $_smarty_tpl->tpl_vars['labels']->value['tag'];?>
</th>
	<th><?php echo $_smarty_tpl->tpl_vars['labels']->value['subfld'];?>
</th>
	<th><?php echo $_smarty_tpl->tpl_vars['labels']->value['data'];?>
</th>
</thead>
<tbody>
<?php  $_smarty_tpl->tpl_vars["field"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["field"]->_loop = false;
 $_smarty_tpl->tpl_vars["tag"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['record']->value->getBiblioFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["field"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["field"]->key => $_smarty_tpl->tpl_vars["field"]->value){
$_smarty_tpl->tpl_vars["field"]->_loop = true;
 $_smarty_tpl->tpl_vars["tag"]->value = $_smarty_tpl->tpl_vars["field"]->key;
 $_smarty_tpl->tpl_vars["field"]->iteration++;
?>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['field']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>"><td class="left"><?php echo $_smarty_tpl->tpl_vars['field']->value->getTag();?>
</td><td><?php echo $_smarty_tpl->tpl_vars['field']->value->getSubfieldCd();?>
</td><td class="right"><?php echo $_smarty_tpl->tpl_vars['field']->value->getFieldData();?>
</td></tr>
<?php } ?>
</tbody>
</table>
<br/>
<?php } ?>

</div>


	</div>
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

</html><?php }} ?>