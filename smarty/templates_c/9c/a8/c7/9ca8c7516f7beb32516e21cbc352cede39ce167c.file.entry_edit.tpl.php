<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 18:05:06
         compiled from "/Library/WebServer/Documents/cals/smarty/templates/catalog/entry_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:853478215516d22526a1e16-86610526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ca8c7516f7beb32516e21cbc352cede39ce167c' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/catalog/entry_edit.tpl',
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
  'nocache_hash' => '853478215516d22526a1e16-86610526',
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
  'unifunc' => 'content_516d2252addc49_43675452',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516d2252addc49_43675452')) {function content_516d2252addc49_43675452($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/cals/libs/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_validate')) include '/Library/WebServer/Documents/cals/libs/SmartyValidate/plugins/function.validate.php';
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


<div style="width:90%">

<?php if ($_smarty_tpl->tpl_vars['entry']->value->getIsRestricted()){?>
<p><font color="red"><?php echo $_smarty_tpl->tpl_vars['restrictedWarning']->value;?>
</font></p>
<?php }?>

<form id="entryeditform" method="post" action="entry_edit.php">
<input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['submitButtonLabel'];?>
"  />&nbsp;&nbsp;
<input type="button" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['newFieldButtonLabel'];?>
" onclick="self.location='entry_marc_new.php?bid=<?php echo $_smarty_tpl->tpl_vars['bibid']->value;?>
'" />&nbsp;&nbsp;
<input type="button" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['cancelButtonLabel'];?>
" onclick="self.location='entry_view.php?bid=<?php echo $_smarty_tpl->tpl_vars['bibid']->value;?>
'" />&nbsp;&nbsp;
<input type="hidden" name="bid" value="<?php echo $_smarty_tpl->tpl_vars['bibid']->value;?>
"/>
<input type="hidden" id="chmid" name="chmid" value="">
<font><?php echo $_smarty_tpl->tpl_vars['labels']->value['requiredWarning'];?>
</font>


<table class="adminTable" >
<thead>
	<tr >
		<th class="left" style="font-size: 1em"><?php echo $_smarty_tpl->tpl_vars['labels']->value['tagLabel'];?>
</th>
		<th colspan="2" class="right" style="font-size: 1em"><?php echo $_smarty_tpl->tpl_vars['labels']->value['generalInfoLabel'];?>
</th>
	</tr>
</thead>
<tbody>

<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable("1", true, 0);?>
<?php  $_smarty_tpl->tpl_vars["part"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["part"]->_loop = false;
 $_smarty_tpl->tpl_vars["tidx"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value['general']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["part"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["part"]->key => $_smarty_tpl->tpl_vars["part"]->value){
$_smarty_tpl->tpl_vars["part"]->_loop = true;
 $_smarty_tpl->tpl_vars["tidx"]->value = $_smarty_tpl->tpl_vars["part"]->key;
 $_smarty_tpl->tpl_vars["part"]->iteration++;
?>
	<?php if ($_smarty_tpl->tpl_vars['validators']->value[$_smarty_tpl->tpl_vars['tidx']->value]){?>
		<?php  $_smarty_tpl->tpl_vars["dummy"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["dummy"]->_loop = false;
 $_smarty_tpl->tpl_vars["id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['validators']->value[$_smarty_tpl->tpl_vars['tidx']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["dummy"]->key => $_smarty_tpl->tpl_vars["dummy"]->value){
$_smarty_tpl->tpl_vars["dummy"]->_loop = true;
 $_smarty_tpl->tpl_vars["id"]->value = $_smarty_tpl->tpl_vars["dummy"]->key;
?>
			<?php echo smarty_function_validate(array('id'=>$_smarty_tpl->tpl_vars['id']->value,'message'=>$_smarty_tpl->tpl_vars['validators']->value[$_smarty_tpl->tpl_vars['tidx']->value][$_smarty_tpl->tpl_vars['id']->value]['msg'],'assign'=>"error_fld_".((string)$_smarty_tpl->tpl_vars['tidx']->value)),$_smarty_tpl);?>

		<?php } ?>
	<?php }?>
	<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td width="8%" align="center"  class="left"><?php if ($_smarty_tpl->tpl_vars['generalButtons']->value[$_smarty_tpl->tpl_vars['tidx']->value]){?><input type="button" value="<?php echo $_smarty_tpl->tpl_vars['tidx']->value;?>
" onclick="self.location='entry_marc_edit.php?f=<?php echo $_smarty_tpl->tpl_vars['part']->value['field']->getFieldid();?>
'"/><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['tidx']->value;?>
<?php }?></td>
	<td width="35%" ><?php if ($_smarty_tpl->tpl_vars['part']->value['field']->getIsRequired()){?><sup>*</sup><?php }?><?php echo $_smarty_tpl->tpl_vars['part']->value['desc'];?>
</td>
	<td class="right"><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['part']->value['type'],'name'=>"flds[".((string)$_smarty_tpl->tpl_vars['tidx']->value)."]",'value'=>$_smarty_tpl->tpl_vars['part']->value['field']->getFieldData(),'options'=>$_smarty_tpl->tpl_vars['part']->value['options']),$_smarty_tpl);?>
</td>
	</tr>
	<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['error_fld_'.($_smarty_tpl->tpl_vars['tidx']->value)]->value;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>
	<tr><td colspan="3" align="center" class="error"><?php echo $_smarty_tpl->tpl_vars['error_fld_'.($_smarty_tpl->tpl_vars['tidx']->value)]->value;?>
</td></tr>
	<?php }?>
	<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, true, 0);?>
<?php } ?>

<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td class="left" ></td>
	<td style="vertical-align:top"><?php echo $_smarty_tpl->tpl_vars['labels']->value['callNumberLabel'];?>
</td>
	<td width="50%" class="right"><input type="textfield" name="callno1" value="<?php echo $_smarty_tpl->tpl_vars['entry']->value->getCallNmbr1();?>
" size="20" maxlength="20" /><br/>
	<input type="textfield" name="callno2" value="<?php echo $_smarty_tpl->tpl_vars['entry']->value->getCallNmbr2();?>
" size="20" maxlength="20" /><br/>
	<input type="textfield" name="callno3" value="<?php echo $_smarty_tpl->tpl_vars['entry']->value->getCallNmbr3();?>
" size="20" maxlength="20" /></td>
	<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>

<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td class="left"></td>
	<td><?php echo $_smarty_tpl->tpl_vars['labels']->value['restrictedLabel'];?>
</td>
	<td width="50%" class="right"><?php echo smarty_function_html_inputField(array('type'=>"checkbox",'value'=>"1",'name'=>"restr",'checked'=>$_smarty_tpl->tpl_vars['entry']->value->getIsRestricted()),$_smarty_tpl);?>
</td>
	<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td class="left"></td>
	<td><?php echo $_smarty_tpl->tpl_vars['labels']->value['showInOpacLabel'];?>
</td>
	<td width="50%" class="right"><?php echo smarty_function_html_inputField(array('type'=>"checkbox",'value'=>"1",'name'=>"showinopac",'checked'=>$_smarty_tpl->tpl_vars['entry']->value->showInOpac()),$_smarty_tpl);?>
</td>
	<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td class="left"></td>
	<td><?php echo $_smarty_tpl->tpl_vars['labels']->value['saleableLabel'];?>
</td>
	<td width="50%" class="right"><?php echo smarty_function_html_inputField(array('type'=>"checkbox",'value'=>"1",'name'=>"saleable",'checked'=>$_smarty_tpl->tpl_vars['entry']->value->getIsSaleable()),$_smarty_tpl);?>
</td>
	<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td class="left"></td>
	<td><?php echo $_smarty_tpl->tpl_vars['labels']->value['audience'];?>
</td>
	<td width="50%" class="right"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"audid",'selected'=>$_smarty_tpl->tpl_vars['audiences']->value['selected'],'options'=>$_smarty_tpl->tpl_vars['audiences']->value['options']),$_smarty_tpl);?>
</td>
	<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td class="left"></td>
	<td><?php echo $_smarty_tpl->tpl_vars['labels']->value['collection'];?>
</td>
	<td width="50%" class="right"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"colid",'selected'=>$_smarty_tpl->tpl_vars['collections']->value['selected'],'options'=>$_smarty_tpl->tpl_vars['collections']->value['options']),$_smarty_tpl);?>
</td>
	<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td class="left"></td>
	<td><?php echo $_smarty_tpl->tpl_vars['labels']->value['material'];?>
</td>
	<td width="50%" class="right"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"matid",'selected'=>$_smarty_tpl->tpl_vars['materials']->value['selected'],'options'=>$_smarty_tpl->tpl_vars['materials']->value['options'],'onchange'=>"doMaterialChange(this.value);"),$_smarty_tpl);?>
</td>

</tr>
</tbody>
</table>





<p>
<div id="materialFields">
<table class="adminTable" >
<thead>
	<tr >
		<th class="left" style="font-size: 1em"><?php echo $_smarty_tpl->tpl_vars['labels']->value['tagLabel'];?>
</th>
		<th colspan="2" class="right" style="font-size: 1em"><?php echo $_smarty_tpl->tpl_vars['labels']->value['materialFieldsLabel'];?>
</th>
	</tr>
</thead>

<tbody>
<?php if ($_smarty_tpl->tpl_vars['fields']->value['material']){?>
<?php  $_smarty_tpl->tpl_vars["part"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["part"]->_loop = false;
 $_smarty_tpl->tpl_vars["tidx"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value['material']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["part"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["part"]->key => $_smarty_tpl->tpl_vars["part"]->value){
$_smarty_tpl->tpl_vars["part"]->_loop = true;
 $_smarty_tpl->tpl_vars["tidx"]->value = $_smarty_tpl->tpl_vars["part"]->key;
 $_smarty_tpl->tpl_vars["part"]->iteration++;
?>
	<?php if ($_smarty_tpl->tpl_vars['validators']->value[$_smarty_tpl->tpl_vars['tidx']->value]){?>
	 	<?php  $_smarty_tpl->tpl_vars["dummy"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["dummy"]->_loop = false;
 $_smarty_tpl->tpl_vars["id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['validators']->value[$_smarty_tpl->tpl_vars['tidx']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["dummy"]->key => $_smarty_tpl->tpl_vars["dummy"]->value){
$_smarty_tpl->tpl_vars["dummy"]->_loop = true;
 $_smarty_tpl->tpl_vars["id"]->value = $_smarty_tpl->tpl_vars["dummy"]->key;
?>
			<?php echo smarty_function_validate(array('id'=>$_smarty_tpl->tpl_vars['id']->value,'message'=>$_smarty_tpl->tpl_vars['validators']->value[$_smarty_tpl->tpl_vars['tidx']->value][$_smarty_tpl->tpl_vars['id']->value]['msg'],'assign'=>"error_fld_".((string)$_smarty_tpl->tpl_vars['tidx']->value)),$_smarty_tpl);?>

		<?php } ?> 
	<?php }?>
	<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['part']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>" >
	<td class="left" align="center"  width="8%"><?php echo $_smarty_tpl->tpl_vars['tidx']->value;?>
</td>
	<td width="35%" ><?php if ($_smarty_tpl->tpl_vars['part']->value['required']){?><sup>*</sup><?php }?><?php echo $_smarty_tpl->tpl_vars['part']->value['desc'];?>
</td>
	<td class="right"><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['part']->value['type'],'name'=>"flds[".((string)$_smarty_tpl->tpl_vars['tidx']->value)."]",'value'=>$_smarty_tpl->tpl_vars['part']->value['value'],'selected'=>$_smarty_tpl->tpl_vars['part']->value['selected'],'checked'=>$_smarty_tpl->tpl_vars['part']->value['checked'],'options'=>$_smarty_tpl->tpl_vars['part']->value['options'],'id'=>"flds[".((string)$_smarty_tpl->tpl_vars['tidx']->value)."]"),$_smarty_tpl);?>
</td></tr>

	<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['error_fld_'.($_smarty_tpl->tpl_vars['tidx']->value)]->value;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2){?>
	<tr><td align="center" colspan="3" class="error"><?php echo $_smarty_tpl->tpl_vars['error_fld_'.($_smarty_tpl->tpl_vars['tidx']->value)]->value;?>
</td></tr>
	<?php }?>
<?php } ?>
<?php }else{ ?>
<tr><td colspan="3" align="center"><?php echo $_smarty_tpl->tpl_vars['labels']->value['noMaterialsLabel'];?>
</td></tr>
<?php }?>

</tbody>

</table>
</div>
</p>


<p>
<table class="adminTable" >
<thead>
	<tr>
		<th class="left" style="font-size: 1em"><?php echo $_smarty_tpl->tpl_vars['labels']->value['tagLabel'];?>
</th>
		<th colspan="2" class="right" style="font-size: 1em"><?php echo $_smarty_tpl->tpl_vars['labels']->value['additionalInfoLabel'];?>
</th>
	</tr>
</thead>
<tbody>

<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable("1", true, 0);?>
<?php  $_smarty_tpl->tpl_vars["part"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["part"]->_loop = false;
 $_smarty_tpl->tpl_vars["tidx"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value['other']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["part"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["part"]->key => $_smarty_tpl->tpl_vars["part"]->value){
$_smarty_tpl->tpl_vars["part"]->_loop = true;
 $_smarty_tpl->tpl_vars["tidx"]->value = $_smarty_tpl->tpl_vars["part"]->key;
 $_smarty_tpl->tpl_vars["part"]->iteration++;
?>
	<?php if ($_smarty_tpl->tpl_vars['validators']->value[$_smarty_tpl->tpl_vars['tidx']->value]){?>
		<?php  $_smarty_tpl->tpl_vars["dummy"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["dummy"]->_loop = false;
 $_smarty_tpl->tpl_vars["id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['validators']->value[$_smarty_tpl->tpl_vars['tidx']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["dummy"]->key => $_smarty_tpl->tpl_vars["dummy"]->value){
$_smarty_tpl->tpl_vars["dummy"]->_loop = true;
 $_smarty_tpl->tpl_vars["id"]->value = $_smarty_tpl->tpl_vars["dummy"]->key;
?>
			<?php echo smarty_function_validate(array('id'=>$_smarty_tpl->tpl_vars['id']->value,'message'=>$_smarty_tpl->tpl_vars['validators']->value[$_smarty_tpl->tpl_vars['tidx']->value][$_smarty_tpl->tpl_vars['id']->value]['msg'],'assign'=>"error_fld_".((string)$_smarty_tpl->tpl_vars['tidx']->value)),$_smarty_tpl);?>

		<?php } ?>		
	<?php }?>
	<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td align="center" class="left" width="8%"><input type="button" value="<?php echo $_smarty_tpl->tpl_vars['tidx']->value;?>
" onclick="self.location='entry_marc_edit.php?f=<?php echo $_smarty_tpl->tpl_vars['part']->value['field']->getFieldid();?>
'"/></td>
	<td width="35%" ><?php if ($_smarty_tpl->tpl_vars['part']->value['field']->getIsRequired()){?><sup>*</sup><?php }?><?php echo $_smarty_tpl->tpl_vars['part']->value['desc'];?>
</td>
	<td class="right"><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['part']->value['type'],'name'=>"flds[".((string)$_smarty_tpl->tpl_vars['tidx']->value)."]",'id'=>"flds[".((string)$_smarty_tpl->tpl_vars['tidx']->value)."]",'value'=>$_smarty_tpl->tpl_vars['part']->value['field']->getFieldData(),'options'=>$_smarty_tpl->tpl_vars['part']->value['options']),$_smarty_tpl);?>
<?php echo $_smarty_tpl->tpl_vars['part']->value['postLabel'];?>

	<?php if ($_smarty_tpl->tpl_vars['tidx']->value=='035a'){?>&nbsp;<input type='button' onclick="getNextSysNum();" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['nextSysNumLabel'];?>
"><?php }?>
	</td></tr>
	<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['error_fld_'.($_smarty_tpl->tpl_vars['tidx']->value)]->value;?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3){?><tr><td align="center" colspan="3" class="error"><?php echo $_smarty_tpl->tpl_vars['error_fld_'.($_smarty_tpl->tpl_vars['tidx']->value)]->value;?>
</td></tr><?php }?>
	<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, true, 0);?>
<?php } ?>

</tbody>
</table>
</p>

</form>
</div>


	</div>
</div>

 
</body>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/tableFuncs.js"></script>	
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/innershiv.js"></script>

<script type="text/javascript">

<!--
	Agent.prototype.method = 'POST';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;
    
    var updateSysNum = new Agent();
	
	updateSysNum.success = function ( resp ) { 		
 		document.getElementById("flds[035a]").value = resp;
	
	}
	
	function getNextSysNum()
	{
		updateSysNum.set_action('update_sys_num.php'+'?'+new Date().getTime());
		updateSysNum.method = "GET";
		updateSysNum.request('');
	}

	function doMaterialChange(val)
	{
		document.getElementById("chmid").value = val;
	    document.forms("entryeditform").submit();		
	}	

-->

</script>


</html><?php }} ?>