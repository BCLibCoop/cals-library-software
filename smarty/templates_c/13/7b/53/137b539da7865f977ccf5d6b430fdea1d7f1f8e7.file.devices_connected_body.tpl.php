<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 14:36:22
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/devices/devices_connected_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:36635549951650866303861-92434048%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '137b539da7865f977ccf5d6b430fdea1d7f1f8e7' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/devices/devices_connected_body.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '36635549951650866303861-92434048',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'devsInfo' => 0,
    'aDev' => 0,
    'funcs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516508663a7c45_33444482',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516508663a7c45_33444482')) {function content_516508663a7c45_33444482($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_inputField')) include '/Library/WebServer/Documents/Library/openbiblio/smarty/plugins/function.html_inputField.php';
?>




<?php if ($_smarty_tpl->tpl_vars['devsInfo']->value){?>
<?php  $_smarty_tpl->tpl_vars['aDev'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aDev']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['devsInfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aDev']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aDev']->key => $_smarty_tpl->tpl_vars['aDev']->value){
$_smarty_tpl->tpl_vars['aDev']->_loop = true;
 $_smarty_tpl->tpl_vars['aDev']->iteration++;
?>
<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['aDev']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>" onmouseover="storeVals(this);">
<td  class="left" id="uname" >
<?php if ($_smarty_tpl->tpl_vars['aDev']->value->getValidated()){?>
	<?php if ($_smarty_tpl->tpl_vars['aDev']->value->getUserId()){?>
	<?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['funcs']->value['edit']['field']['type'],'options'=>$_smarty_tpl->tpl_vars['funcs']->value['edit']['field']['options'],'value'=>$_smarty_tpl->tpl_vars['funcs']->value['edit']['field']['value']),$_smarty_tpl);?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['aDev']->value->getUserFullname();?>

	<?php }else{ ?>
	<?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['funcs']->value['assign']['field']['type'],'options'=>$_smarty_tpl->tpl_vars['funcs']->value['assign']['field']['options'],'value'=>$_smarty_tpl->tpl_vars['funcs']->value['assign']['field']['value']),$_smarty_tpl);?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['funcs']->value['assign']['value'];?>

	<?php }?>
<?php }else{ ?>
<?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['funcs']->value['add']['field']['type'],'options'=>$_smarty_tpl->tpl_vars['funcs']->value['add']['field']['options'],'value'=>$_smarty_tpl->tpl_vars['funcs']->value['add']['field']['value']),$_smarty_tpl);?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['funcs']->value['add']['value'];?>

<?php }?>
</td>
<td  class="right" id="mntpnt" align="center"><?php echo $_smarty_tpl->tpl_vars['aDev']->value->getMountPoint();?>
</td>
<td id="rowdevid" style="display:none"><?php echo $_smarty_tpl->tpl_vars['aDev']->value->getDeviceId();?>
</td>
<td id='rowser' style='display:none'><?php echo $_smarty_tpl->tpl_vars['aDev']->value->getSerialNumber();?>
</td>
<td id='rowvend' style='display:none'><?php echo $_smarty_tpl->tpl_vars['aDev']->value->getVendorCode();?>
</td>
<td id='rowprod' style='display:none'><?php echo $_smarty_tpl->tpl_vars['aDev']->value->getProductCode();?>
</td>	  
</tr>
<?php } ?>
<?php }else{ ?>
<tr><td colspan="2">No Devices Found</td></tr>
<?php }?>


<?php }} ?>