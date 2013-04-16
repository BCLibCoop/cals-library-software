<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 14:36:46
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/devices/device_edit_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1223235745165087ed87f11-83704034%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb07d72930705802e80c8c3572954ef33e95283d' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/devices/device_edit_body.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1223235745165087ed87f11-83704034',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'clientNames' => 1,
    'aName' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5165087edd5142_94388654',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5165087edd5142_94388654')) {function content_5165087edd5142_94388654($_smarty_tpl) {?>




<?php  $_smarty_tpl->tpl_vars['aName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['clientNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aName']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aName']->key => $_smarty_tpl->tpl_vars['aName']->value){
$_smarty_tpl->tpl_vars['aName']->_loop = true;
 $_smarty_tpl->tpl_vars['aName']->iteration++;
?>
<tr onclick="updateInfo(this);" class="<?php if (!(1 & $_smarty_tpl->tpl_vars['aName']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>">
<td class="both" colspan="3"  id="name" style="padding-left:5em"><?php echo $_smarty_tpl->tpl_vars['aName']->value->fullname;?>
</td>
<td id="uid" style="display:none"><?php echo $_smarty_tpl->tpl_vars['aName']->value->userid;?>
</td>
<td id="uname" style="display:none"><?php echo $_smarty_tpl->tpl_vars['aName']->value->username;?>
</td>
</tr>
<?php } ?>
<?php }} ?>