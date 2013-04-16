<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 13:55:52
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/catalog/entry_admin_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12226812455164fee84cfc06-74606272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f02bba980bbdce2224fdac48c9dd19fb4495cacd' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/catalog/entry_admin_view.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
    'fbf982da55d9b57e0fea288cf103a9e2c8eb2988' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/private/admin_layout.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
    '64e6d3581c3478256e4b1cbfd1dc36460970b41a' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/private/layout.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12226812455164fee84cfc06-74606272',
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
  'unifunc' => 'content_5164fee888e0a2_66839966',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5164fee888e0a2_66839966')) {function content_5164fee888e0a2_66839966($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/modifier.date_format.php';
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

<h3>
<?php if ($_smarty_tpl->tpl_vars['entryFields']->value['245a']){?> 
	<?php echo $_smarty_tpl->tpl_vars['entryFields']->value['245a']->getFieldData();?>
&nbsp;
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['entryFields']->value['245b']){?> 
	<?php echo $_smarty_tpl->tpl_vars['entryFields']->value['245a']->getFieldData();?>
&nbsp;
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['entryFields']->value['035a']){?> 
	<?php echo $_smarty_tpl->tpl_vars['entryFields']->value['035a']->getFieldData();?>
&nbsp;
<?php }?>
</h3>
<?php if ($_smarty_tpl->tpl_vars['entryFields']->value['520a']){?> 
<p><?php echo $_smarty_tpl->tpl_vars['entryFields']->value['520a']->getFieldData();?>
</p>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['entry']->value->getIsRestricted()){?>
<p><font color="red"><?php echo $_smarty_tpl->tpl_vars['restrictedWarning']->value;?>
</font></p>
<?php }?>


<input type="button" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['newCopyButtonLabel'];?>
" onclick="self.location='entry_copy_new.php?bid=<?php echo $_smarty_tpl->tpl_vars['bibid']->value;?>
'" />&nbsp;&nbsp;

<?php if ($_smarty_tpl->tpl_vars['copies']->value){?>
<input disabled="disabled" id="editcopybutton" type="button" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['editCopyButtonLabel'];?>
" onclick="doEditCopy();" />&nbsp;&nbsp;
<input disabled="disabled" id="delcopybutton" type="button" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['delCopyButtonLabel'];?>
" onclick="doDeleteCopy();" />
<label><input disabled="disabled" type="checkbox" id="delcopyconfchk" onclick="setDeleteCopyButton(this);" />&nbsp;<?php echo $_smarty_tpl->tpl_vars['labels']->value['deleteConfirmCopyLabel'];?>
</label>
<input type="hidden" id="hcopyid" />
<table class="adminTable" style="width:60%">
<thead>
	<tr>
		<th class="left"><?php echo $_smarty_tpl->tpl_vars['labels']->value["copyTypeLabel"];?>
</th>
		<th><?php echo $_smarty_tpl->tpl_vars['labels']->value["copySizeLabel"];?>
</th>
		<th class="right"><?php echo $_smarty_tpl->tpl_vars['labels']->value["copyReadingTimeLabel"];?>
</th>

	</tr>
</thead>
<tbody>

<?php  $_smarty_tpl->tpl_vars["aCopy"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["aCopy"]->_loop = false;
 $_smarty_tpl->tpl_vars["idx"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['copies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["aCopy"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["aCopy"]->key => $_smarty_tpl->tpl_vars["aCopy"]->value){
$_smarty_tpl->tpl_vars["aCopy"]->_loop = true;
 $_smarty_tpl->tpl_vars["idx"]->value = $_smarty_tpl->tpl_vars["aCopy"]->key;
 $_smarty_tpl->tpl_vars["aCopy"]->iteration++;
?>
	<tr onclick="selectCopy(this);" class="<?php if (!(1 & $_smarty_tpl->tpl_vars['aCopy']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>">
	<?php if ($_smarty_tpl->tpl_vars['copiesExtraInfo']->value[$_smarty_tpl->tpl_vars['idx']->value]['errMsg']){?>
		<td colspan="3" class="both" align="center"><?php echo $_smarty_tpl->tpl_vars['copiesExtraInfo']->value[$_smarty_tpl->tpl_vars['idx']->value]['errMsg'];?>
</td>
		<td id="copyid" style="display:none"><?php echo $_smarty_tpl->tpl_vars['aCopy']->value->getCopyId();?>
</td>
	<?php }else{ ?>
		<td class="left" width="50%"><?php echo $_smarty_tpl->tpl_vars['aCopy']->value->getDescription();?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['copiesExtraInfo']->value[$_smarty_tpl->tpl_vars['idx']->value]['fileSize'];?>
</td>
		<td class="right"><?php echo $_smarty_tpl->tpl_vars['copiesExtraInfo']->value[$_smarty_tpl->tpl_vars['idx']->value]['playTime'];?>
</td>
		<td id="copyid" style="display:none"><?php echo $_smarty_tpl->tpl_vars['aCopy']->value->getCopyId();?>
</td>
	<?php }?>
	</tr>
<?php } ?>

</tbody>
</table>
<?php }else{ ?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['labels']->value["noCopiesFoundMsg"];?>
<br/>
<?php }?>


<br/>
<input type="button" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['editBasicButtonLabel'];?>
" onclick="self.location='entry_edit.php?bid=<?php echo $_smarty_tpl->tpl_vars['bibid']->value;?>
'" />&nbsp;&nbsp;
<input type="button" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['newLikeButtonLabel'];?>
" onclick="self.location='entry_new_like.php?bid=<?php echo $_smarty_tpl->tpl_vars['bibid']->value;?>
'" />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" disabled="disabled" id="delentrybutton" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['deleteButtonLabel'];?>
" onclick="self.location='entry_delete.php?bid=<?php echo $_smarty_tpl->tpl_vars['bibid']->value;?>
'" />
<label><input type="checkbox" id="delconfchk" onclick="setDeleteEntryButton(this);" />&nbsp;<?php echo $_smarty_tpl->tpl_vars['labels']->value['deleteConfirmLabel'];?>
</label>
<table class="adminTable" style="width:90%">
<thead>
	<tr>
		<th colspan="2" class="both"><?php echo $_smarty_tpl->tpl_vars['labels']->value["generalInfoLabel"];?>
</th>
	</tr>
</thead>
<tbody>

<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable(1, true, 0);?>
<?php  $_smarty_tpl->tpl_vars["gidx"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["gidx"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['generalFields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["gidx"]->key => $_smarty_tpl->tpl_vars["gidx"]->value){
$_smarty_tpl->tpl_vars["gidx"]->_loop = true;
?>
	<?php if ($_smarty_tpl->tpl_vars['tagDescs']->value[$_smarty_tpl->tpl_vars['gidx']->value]){?>
	<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>"><td width="50%" class="left"><?php echo $_smarty_tpl->tpl_vars['tagDescs']->value[$_smarty_tpl->tpl_vars['gidx']->value];?>
</td><td class="right"><?php echo $_smarty_tpl->tpl_vars['entryFields']->value[$_smarty_tpl->tpl_vars['gidx']->value]->getFieldData();?>
</td></tr>
	<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, true, 0);?>
	<?php }?>
<?php } ?>

<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td class="left"  style="vertical-align:top"><?php echo $_smarty_tpl->tpl_vars['labels']->value['callNumberLabel'];?>
</td>
	<td width="50%" class="right"><?php echo $_smarty_tpl->tpl_vars['entry']->value->getCallNmbr1();?>
<br/>
	<?php echo $_smarty_tpl->tpl_vars['entry']->value->getCallNmbr2();?>
<br/>
	<?php echo $_smarty_tpl->tpl_vars['entry']->value->getCallNmbr3();?>
</td>
<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td class="left" ><?php echo $_smarty_tpl->tpl_vars['labels']->value['restrictedLabel'];?>
</td>
	<td width="50%" class="right"><?php if ($_smarty_tpl->tpl_vars['entry']->value->getIsRestricted()){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yesLabel'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['noLabel'];?>
<?php }?><br></td>
<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">
	<td class="left"><?php echo $_smarty_tpl->tpl_vars['labels']->value['showInOpacLabel'];?>
</td>
	<td width="50%" class="right"><?php if ($_smarty_tpl->tpl_vars['entry']->value->showInOpac()){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yesLabel'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['noLabel'];?>
<?php }?></td>
<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>">

	<td class="left"><?php echo $_smarty_tpl->tpl_vars['labels']->value['saleableLabel'];?>
</td>
	<td width="50%" class="right"><?php if ($_smarty_tpl->tpl_vars['entry']->value->getIsSaleable()){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yesLabel'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['noLabel'];?>
<?php }?></td>
<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>"><td class="left"><?php echo $_smarty_tpl->tpl_vars['labels']->value['audience'];?>
</td><td width="50%" class="right"><?php echo $_smarty_tpl->tpl_vars['audience']->value;?>
</td>
<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>"><td class="left"><?php echo $_smarty_tpl->tpl_vars['labels']->value['material'];?>
</td><td width="50%" class="right"><?php echo $_smarty_tpl->tpl_vars['material']->value;?>
</td>
<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>"><td class="left"><?php echo $_smarty_tpl->tpl_vars['labels']->value['collection'];?>
</td><td width="50%" class="right"><?php echo $_smarty_tpl->tpl_vars['collection']->value;?>
</td>
<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, null, 0);?>
</tr>

</tbody>
</table>


<p>
<table class="adminTable" style="width:90%">
<thead>
	<tr>
		<th colspan="2" class="both"><?php echo $_smarty_tpl->tpl_vars['labels']->value["additionalInfoLabel"];?>
</th>
	</tr>
</thead>
<tbody>

<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable(1, true, 0);?>
<?php  $_smarty_tpl->tpl_vars["aField"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["aField"]->_loop = false;
 $_smarty_tpl->tpl_vars["eidx"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['entryFields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["aField"]->key => $_smarty_tpl->tpl_vars["aField"]->value){
$_smarty_tpl->tpl_vars["aField"]->_loop = true;
 $_smarty_tpl->tpl_vars["eidx"]->value = $_smarty_tpl->tpl_vars["aField"]->key;
?>
	
	<?php if (!$_smarty_tpl->tpl_vars['generalFields']->value[$_smarty_tpl->tpl_vars['eidx']->value]){?>
	<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['rowidx']->value)){?>primary<?php }else{ ?>alt1<?php }?>"><td width="50%" class="left"><?php echo $_smarty_tpl->tpl_vars['tagDescs']->value[$_smarty_tpl->tpl_vars['eidx']->value];?>
</td><td class="right"><?php echo $_smarty_tpl->tpl_vars['aField']->value->getFieldData();?>
</td></tr>
	<?php $_smarty_tpl->tpl_vars["rowidx"] = new Smarty_variable($_smarty_tpl->tpl_vars['rowidx']->value+1, true, 0);?>
	<?php }?>
<?php } ?>

</tbody>
</table>
</p>


</div>


	</div>
</div>

 
</body>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/tableFuncs.js"></script>
<script type="text/javascript">

<!--
	document.getElementById("delconfchk").checked = false;
	document.getElementById("delcopyconfchk").checked = false;

	function selectCopy(el)
	{
		if (el.cells['copyid']!=undefined)
		{
			HighlightRowText(el,'#ee2222');
			document.getElementById("editcopybutton").disabled = false;
			document.getElementById("delcopyconfchk").disabled = false;
			document.getElementById("hcopyid").value = el.cells['copyid'].innerHTML;
		}
	}

	function doEditCopy()
	{
		self.location = 'entry_copy_edit.php?cid='+document.getElementById("hcopyid").value;
	}
	function doDeleteCopy()
	{
		self.location = 'entry_copy_delete.php?cid='+document.getElementById("hcopyid").value;
	}
	function setDeleteCopyButton(el)
	{
		document.getElementById("delcopybutton").disabled = !el.checked;
	}

	function setDeleteEntryButton(el)
	{
		document.getElementById("delentrybutton").disabled = !el.checked;
	}

-->

</script>


</html><?php }} ?>