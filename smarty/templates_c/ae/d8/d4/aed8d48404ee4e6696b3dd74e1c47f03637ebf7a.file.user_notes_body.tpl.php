<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 14:20:45
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_notes_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1984924086516504bd09fa82-05605357%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aed8d48404ee4e6696b3dd74e1c47f03637ebf7a' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_notes_body.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1984924086516504bd09fa82-05605357',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'notesHist' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516504bd0e1791_98277622',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516504bd0e1791_98277622')) {function content_516504bd0e1791_98277622($_smarty_tpl) {?>



 
 
<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['notesHist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['row']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['row']->iteration++;
?>
	<tr class='<?php if (!(1 & $_smarty_tpl->tpl_vars['row']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>'><td style="width:70%">
	<?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['row']->value->content, ENT_QUOTES, 'UTF-8', true));?>
</td><td style="width:30%"><?php echo $_smarty_tpl->tpl_vars['row']->value->date;?>
</td></tr>
<?php } ?>
<?php }} ?>