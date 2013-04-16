<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 14:32:56
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_request_search_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:800416017516507981cdb55-44962829%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '291096d329a46add6a9b727b1392ee6f291a8396' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_request_search_body.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '800416017516507981cdb55-44962829',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'entries' => 0,
    'anEntry' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5165079821a908_81000764',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5165079821a908_81000764')) {function content_5165079821a908_81000764($_smarty_tpl) {?>




<?php  $_smarty_tpl->tpl_vars['anEntry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['anEntry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['anEntry']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['anEntry']->key => $_smarty_tpl->tpl_vars['anEntry']->value){
$_smarty_tpl->tpl_vars['anEntry']->_loop = true;
 $_smarty_tpl->tpl_vars['anEntry']->iteration++;
?>
<tr onclick='selectTitle(this)' class='<?php if (!(1 & $_smarty_tpl->tpl_vars['anEntry']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>'>
<td class='left' id='title' style='padding-left:2em;width:40%'><?php echo $_smarty_tpl->tpl_vars['anEntry']->value->title;?>
</td>
<td colspan="2" style="width:40%"><?php echo $_smarty_tpl->tpl_vars['anEntry']->value->author;?>
</td>
<td align='center' style="width:10%"><?php echo $_smarty_tpl->tpl_vars['anEntry']->value->snum;?>
</td>
<td id='bid' style='display:none'><?php echo $_smarty_tpl->tpl_vars['anEntry']->value->bibid;?>
</td>
</tr>
<?php } ?>
<?php }} ?>