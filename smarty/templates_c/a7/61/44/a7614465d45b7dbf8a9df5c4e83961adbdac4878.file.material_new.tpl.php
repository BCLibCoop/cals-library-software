<?php /* Smarty version Smarty-3.1.13, created on 2013-04-11 08:34:56
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/admin/material_new.tpl" */ ?>
<?php /*%%SmartyHeaderCode:696071457516605302134e0-42607178%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7614465d45b7dbf8a9df5c4e83961adbdac4878' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/admin/material_new.tpl',
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
  'nocache_hash' => '696071457516605302134e0-42607178',
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
  'unifunc' => 'content_516605303ebf64_11518013',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516605303ebf64_11518013')) {function content_516605303ebf64_11518013($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_validate')) include '/Library/WebServer/Documents/Library/openbiblio/libs/SmartyValidate/plugins/function.validate.php';
if (!is_callable('smarty_function_html_inputField')) include '/Library/WebServer/Documents/Library/openbiblio/smarty/plugins/function.html_inputField.php';
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


<div style="width:50%">
<form name="newmaterialform" method="POST" action="../admin/materials_list.php">

<table width="50%" class="adminTable">
		<tr>
		  <th class="left" ></th><th class="right"></th>
		</tr>
		<tr class="alt1">
		  <td align="right" class="left" ><?php echo $_smarty_tpl->tpl_vars['fields']->value['descr']['label'];?>
</td>
		  <td class="right">
		  	<?php echo smarty_function_validate(array('id'=>'v_descEmpty','message'=>$_smarty_tpl->tpl_vars['fields']->value['descr']['validate']['v_descEmpty'],'assign'=>'error_descr'),$_smarty_tpl);?>

		    <?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['fields']->value['descr']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['fields']->value['descr']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['fields']->value['descr']['field']['value'],'options'=>$_smarty_tpl->tpl_vars['fields']->value['descr']['field']['options']),$_smarty_tpl);?>

		  </td>
		</tr>
		<?php if ($_smarty_tpl->tpl_vars['error_descr']->value){?>
		<tr><td colspan="2" align="center"><font class="error"><?php echo $_smarty_tpl->tpl_vars['error_descr']->value;?>
</font></td></tr>
		<?php }?>
		<tr class="primary">
		  <td align="right" class="left"><?php echo $_smarty_tpl->tpl_vars['fields']->value['img']['label'];?>
</td>
		  <td class="right">
		  	<?php echo smarty_function_validate(array('id'=>'v_imgNmEmpty','message'=>$_smarty_tpl->tpl_vars['fields']->value['img']['validate']['v_imgNmEmpty'],'assign'=>'error_imgNm'),$_smarty_tpl);?>

		    <?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['fields']->value['img']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['fields']->value['img']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['fields']->value['img']['field']['value'],'options'=>$_smarty_tpl->tpl_vars['fields']->value['img']['field']['options']),$_smarty_tpl);?>

		  </td>
		</tr>
		<?php if ($_smarty_tpl->tpl_vars['error_imgNm']->value){?>
		<tr><td colspan="2" align="center"><font class="error"><?php echo $_smarty_tpl->tpl_vars['error_imgNm']->value;?>
</font></td></tr>
		<?php }?>
		<tr class="alt1">
		  <td align="right" class="left" ><label for="<?php echo $_smarty_tpl->tpl_vars['fields']->value['recom']['field']['options']['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['fields']->value['recom']['label'];?>
</label></td>
		  <td class="right">
		    <?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['fields']->value['recom']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['fields']->value['recom']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['fields']->value['recom']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['fields']->value['recom']['field']['checked'],'options'=>$_smarty_tpl->tpl_vars['fields']->value['recom']['field']['options']),$_smarty_tpl);?>

		  </td>
		</tr>
		<tr class="primary">
		  <td align="right" class="left" ><label for="<?php echo $_smarty_tpl->tpl_vars['fields']->value['deflt']['field']['options']['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['fields']->value['deflt']['label'];?>
</label></td>
		  <td class="right">
		   <?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['fields']->value['deflt']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['fields']->value['deflt']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['fields']->value['deflt']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['fields']->value['deflt']['field']['checked'],'options'=>$_smarty_tpl->tpl_vars['fields']->value['deflt']['field']['options']),$_smarty_tpl);?>

		  </td>
		</tr>
		
		<tr >
		  <td align="center" colspan="2" class="primary">
		     <input type="button" onClick="javascript:this.form.action='material_new.php';this.form.submit();" value="<?php echo $_smarty_tpl->tpl_vars['submitButtonLabel']->value;?>
" class="button">
		    <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['cancelButtonLabel']->value;?>
" class="button">
		   
		  </td>
		</tr>
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

</html><?php }} ?>