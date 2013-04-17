<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 18:04:12
         compiled from "/Library/WebServer/Documents/cals/smarty/templates/catalog/entry_marc_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1622412761516d221cddb6c3-92141792%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba7e29d3ff051ef519d287128990bdc7ff271ac2' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/catalog/entry_marc_edit.tpl',
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
  'nocache_hash' => '1622412761516d221cddb6c3-92141792',
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
  'unifunc' => 'content_516d221d007f13_13885425',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516d221d007f13_13885425')) {function content_516d221d007f13_13885425($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/cals/libs/Smarty/plugins/modifier.date_format.php';
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


<div style="width:65%">
<form method="post" action="<?php if (!$_smarty_tpl->tpl_vars['newField']->value){?>entry_marc_edit.php<?php }else{ ?>entry_marc_new.php<?php }?>">
<?php if (!$_smarty_tpl->tpl_vars['newField']->value){?>
<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['fieldid']->value;?>
" name="f"/>
<?php }else{ ?>
<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['bibid']->value;?>
" name="bid"/>
<?php }?>
<table class="adminTable" id="marctbl">
  <thead >
  <tr><th class="both" colspan="2" nowrap="yes" align="left"><?php echo $_smarty_tpl->tpl_vars['labels']->value['fieldInfoLabel'];?>
</th></tr>
  </thead>

  <tbody>
  <?php echo $_smarty_tpl->tpl_vars['tagContent']->value;?>

  </tbody>
  <tbody>
   <tr class="alt1">
    <td align="right" nowrap="true" class="left" ><?php echo $_smarty_tpl->tpl_vars['labels']->value['fieldDataLabel'];?>
 :&nbsp;</td>
    <td class="right"><textarea name="cont"  cols="30" rows="4"><?php echo $_smarty_tpl->tpl_vars['fldContent']->value;?>
</textarea></td>
  </tr>
  
  <tr class="primary">
    <td align="center" colspan="2" class="both">
      <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['submitButtonLabel'];?>
">&nbsp;&nbsp;
      <input type="button" onClick="self.location='entry_edit.php?bid=<?php echo $_smarty_tpl->tpl_vars['bibid']->value;?>
'" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['cancelButtonLabel'];?>
">
    </td>
  </tr>
  <?php if (!$_smarty_tpl->tpl_vars['newField']->value){?>
  <tr class="alt1">
    <td align="center" colspan="2" class="both">
      <input type="button" id="delbutton" onclick="self.location='entry_marc_del.php?fid=<?php echo $_smarty_tpl->tpl_vars['fieldid']->value;?>
';" disabled="disabled" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['deleteLabel'];?>
"/>
      <label><input type="checkbox" onclick="setDeleteButton(this);" /><?php echo $_smarty_tpl->tpl_vars['labels']->value['deleteConfirmLabel'];?>
</label>
    </td>
  </tr>
  <?php }?>
  </tbody>

</table>
</form>
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

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/tableFuncs.js"></script>	
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/innershiv.js"></script>
<script type="text/javascript">

<!--
	function setDeleteButton(el)
	{
		document.getElementById("delbutton").disabled = !el.checked;
	}

	Agent.prototype.method = 'POST';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;
    
    var marcAgent = new Agent();
	
	marcAgent.success = function ( resp ) { 		
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('marctbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements 
		newBody.appendChild(innerShiv(resp));
		document.getElementById('marctbl').replaceChild(newBody,oldBody);
	
	}
	
	function doBlockChange()
	{
	   	filterStr = "&b=" + encodeURIComponent(document.getElementById("block").value);
		
		marcAgent.set_action('entry_marc_change.php'+ '?' + new Date().getTime());
		marcAgent.request(filterStr);
		
	}	

	function doTagChange()
	{
		var filterStr = "";
	   	filterStr = "&b=" + encodeURIComponent(document.getElementById("block").value);
		filterStr += "&t=" + encodeURIComponent(document.getElementById("tag").value);
		marcAgent.set_action('entry_marc_change.php'+ '?' + new Date().getTime());
		marcAgent.request(filterStr);
	}	
	
-->

</script>


</html><?php }} ?>