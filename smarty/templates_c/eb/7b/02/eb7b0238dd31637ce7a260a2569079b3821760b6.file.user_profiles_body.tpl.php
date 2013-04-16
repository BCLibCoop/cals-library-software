<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 14:20:45
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_profiles_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:78608810516504bd040164-50310379%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb7b0238dd31637ce7a260a2569079b3821760b6' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_profiles_body.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78608810516504bd040164-50310379',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'profiles' => 0,
    'row' => 0,
    'labels' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516504bd06f252_48380853',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516504bd06f252_48380853')) {function content_516504bd06f252_48380853($_smarty_tpl) {?>





<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['profiles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
<tr >
	<td style="width:150px"><?php echo $_smarty_tpl->tpl_vars['row']->value['type'];?>
</td>
	<td style="width:300px"><?php echo $_smarty_tpl->tpl_vars['row']->value['content'];?>
</td>
	<td style="width:50px"><img src="../images/<?php if ($_smarty_tpl->tpl_vars['row']->value['prefers']){?>apply.png<?php }else{ ?>cancel.png<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['row']->value['prefers']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yes'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['no'];?>
<?php }?>" width="20" height="20"></td>
	<td align="center" style="width:100px"><?php echo $_smarty_tpl->tpl_vars['row']->value['lang'];?>
</td>
</tr>
<?php } ?>
<?php }} ?>