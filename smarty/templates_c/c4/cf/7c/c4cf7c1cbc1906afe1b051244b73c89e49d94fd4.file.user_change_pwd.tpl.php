<?php /* Smarty version Smarty-3.1.13, created on 2013-04-11 11:09:12
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_change_pwd.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19675517465166295886c842-53331744%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4cf7c1cbc1906afe1b051244b73c89e49d94fd4' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_change_pwd.tpl',
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
  'nocache_hash' => '19675517465166295886c842-53331744',
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
  'unifunc' => 'content_51662958a84fe2_44419376',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51662958a84fe2_44419376')) {function content_51662958a84fe2_44419376($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_validate')) include '/Library/WebServer/Documents/Library/openbiblio/libs/SmartyValidate/plugins/function.validate.php';
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

<form name="pwdresetform" method="POST" action="../users/user_search.php">
<input type="hidden" name="uid" value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
">


<table width="45%" class="primary">
  <tr>
    <th colspan="2" ></th>
  </tr>
  <tr>
    <td nowrap="true"  align="right"><?php echo $_smarty_tpl->tpl_vars['info']->value['pass']['label'];?>
</td>
    <td >
     <?php echo smarty_function_validate(array('id'=>"v_passEmpty",'message'=>$_smarty_tpl->tpl_vars['info']->value['pass']['validate']['passEmpty'],'assign'=>"passMsg"),$_smarty_tpl);?>

     
      <input type="password" name="pass" size="20" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['pass']['value'];?>
">
 	</td>
 </tr>	
 <?php if ($_smarty_tpl->tpl_vars['passMsg']->value){?>
    <tr><td colspan="2" align="center"><font class="error"><?php echo $_smarty_tpl->tpl_vars['passMsg']->value;?>
</font></td></tr>
 <?php }?>
 
  <tr>
    <td nowrap="true" align="right"> <?php echo $_smarty_tpl->tpl_vars['info']->value['pass2']['label'];?>
</td>
    <td >
    <?php echo smarty_function_validate(array('id'=>"v_pass2Empty",'message'=>$_smarty_tpl->tpl_vars['info']->value['pass2']['validate']['pass2Empty'],'assign'=>"pass2Msg"),$_smarty_tpl);?>

    <?php echo smarty_function_validate(array('id'=>"v_passNE",'message'=>$_smarty_tpl->tpl_vars['info']->value['pass2']['validate']['passNE'],'assign'=>"pass2Msg"),$_smarty_tpl);?>

    <input type="password" name="pass2" size="20" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['pass2']['value'];?>
">
	</td>
  </tr>	
  <?php if ($_smarty_tpl->tpl_vars['pass2Msg']->value){?>
    <tr><td colspan="2" align="center"><font class="error"><?php echo $_smarty_tpl->tpl_vars['pass2Msg']->value;?>
</font></td></tr>
  <?php }?>
  
  <tr>
    <td align="center" colspan="2" class="primary">
      
      <input type="button" onClick="javascript:this.form.action='user_change_pwd.php';this.form.submit();" value="<?php echo $_smarty_tpl->tpl_vars['submitButtonLabel']->value;?>
" >
      <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['cancelButtonLabel']->value;?>
" >
    </td>
  </tr>
</table>




</form>

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