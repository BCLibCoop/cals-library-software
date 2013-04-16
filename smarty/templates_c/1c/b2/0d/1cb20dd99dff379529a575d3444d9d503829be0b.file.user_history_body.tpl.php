<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 14:20:45
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_history_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:703919354516504bd079513-71077554%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cb20dd99dff379529a575d3444d9d503829be0b' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_history_body.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '703919354516504bd079513-71077554',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'readHist' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516504bd09ac92_04852867',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516504bd09ac92_04852867')) {function content_516504bd09ac92_04852867($_smarty_tpl) {?>



 
 
<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['readHist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['row']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['row']->iteration++;
?>
	<tr class='<?php if (!(1 & $_smarty_tpl->tpl_vars['row']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>'><td width="5%"><center><?php echo $_smarty_tpl->tpl_vars['row']->value->idx;?>
</center></td><td width="60%">&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['row']->value->title;?>
</td><td width="30%"><center><?php echo $_smarty_tpl->tpl_vars['row']->value->date;?>
</center></td></tr>
<?php } ?>
<?php }} ?>