<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 14:20:42
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_search_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1768176640516504ba4688b6-63634552%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ae2a445e7650201f649385d4a4885e1955b9943' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_search_body.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1768176640516504ba4688b6-63634552',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'clients' => 0,
    'aClient' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516504ba4fc056_49163158',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516504ba4fc056_49163158')) {function content_516504ba4fc056_49163158($_smarty_tpl) {?>




<?php  $_smarty_tpl->tpl_vars['aClient'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aClient']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['clients']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['aClient']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['aClient']->key => $_smarty_tpl->tpl_vars['aClient']->value){
$_smarty_tpl->tpl_vars['aClient']->_loop = true;
 $_smarty_tpl->tpl_vars['aClient']->iteration++;
?>
<tr onclick='selectUser(this)' class='<?php if (!(1 & $_smarty_tpl->tpl_vars['aClient']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>'>
<td class='left' id='name' style='padding-left:2em'><?php echo $_smarty_tpl->tpl_vars['aClient']->value->fullname;?>
</td>
<td align='center'><?php echo $_smarty_tpl->tpl_vars['aClient']->value->username;?>
</td>
<td align='center'><?php echo $_smarty_tpl->tpl_vars['aClient']->value->phone;?>
</td>
<td ><?php echo $_smarty_tpl->tpl_vars['aClient']->value->address;?>
</td>
<td align='center' class='right'><?php echo $_smarty_tpl->tpl_vars['aClient']->value->jadeid;?>
</td>
<td id='uid' style='display:none'><?php echo $_smarty_tpl->tpl_vars['aClient']->value->userid;?>
</td>
</tr>
<?php } ?>
<?php }} ?>