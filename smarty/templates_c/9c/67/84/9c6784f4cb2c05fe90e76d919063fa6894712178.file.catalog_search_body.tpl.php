<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 18:18:00
         compiled from "/Library/WebServer/Documents/cals/smarty/templates/catalog/catalog_search_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:856415184516d2558b02383-69252306%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c6784f4cb2c05fe90e76d919063fa6894712178' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/catalog/catalog_search_body.tpl',
      1 => 1365649951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '856415184516d2558b02383-69252306',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'entries' => 1,
    'anEntry' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516d2558b51e13_62216548',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516d2558b51e13_62216548')) {function content_516d2558b51e13_62216548($_smarty_tpl) {?>




<?php  $_smarty_tpl->tpl_vars['anEntry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['anEntry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['anEntry']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['anEntry']->key => $_smarty_tpl->tpl_vars['anEntry']->value){
$_smarty_tpl->tpl_vars['anEntry']->_loop = true;
 $_smarty_tpl->tpl_vars['anEntry']->iteration++;
?>
<tr onclick='selectTitle(this)' class='<?php if (!(1 & $_smarty_tpl->tpl_vars['anEntry']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>' style="width:98%">
<td class='left' id='title' style='padding-left:2em;width:40%'><?php echo $_smarty_tpl->tpl_vars['anEntry']->value->title;?>
</td>
<td colspan="2" style="width:40%"><?php echo $_smarty_tpl->tpl_vars['anEntry']->value->author;?>
</td>
<td class="right" align='center' style="width:10%;margin-right:0.25em"><?php echo $_smarty_tpl->tpl_vars['anEntry']->value->snum;?>
</td>
<td id='bid' style='display:none'><?php echo $_smarty_tpl->tpl_vars['anEntry']->value->bibid;?>
</td>
</tr>
<?php } ?>

<?php }} ?>