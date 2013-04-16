<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 15:19:26
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/devices/devices_list_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121076895165127e8edca5-15088006%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f00d485bc8db1cb2eec05a208214fd9cbbfe4f62' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/devices/devices_list_body.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121076895165127e8edca5-15088006',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'devsInfo' => 1,
    'aDev' => 1,
    'labels' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5165127e9aa795_02858582',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5165127e9aa795_02858582')) {function content_5165127e9aa795_02858582($_smarty_tpl) {?>




<?php  $_smarty_tpl->tpl_vars['aDev'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aDev']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['devsInfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aDev']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aDev']->key => $_smarty_tpl->tpl_vars['aDev']->value){
$_smarty_tpl->tpl_vars['aDev']->_loop = true;
 $_smarty_tpl->tpl_vars['aDev']->iteration++;
?>
<tr onclick="storeVals(this);" class="<?php if (!(1 & $_smarty_tpl->tpl_vars['aDev']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>">
<td  class="left" id="uname" ><?php if ($_smarty_tpl->tpl_vars['aDev']->value->uname){?><?php echo $_smarty_tpl->tpl_vars['aDev']->value->uname;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['notAssigned'];?>
<?php }?></td>
<td  class="right" id="encid" align="center"><?php echo $_smarty_tpl->tpl_vars['aDev']->value->barcd;?>
</td>
<td id="devid" style="display:none"><?php echo $_smarty_tpl->tpl_vars['aDev']->value->devid;?>
</td>
</tr>
<?php } ?>
<?php }} ?>