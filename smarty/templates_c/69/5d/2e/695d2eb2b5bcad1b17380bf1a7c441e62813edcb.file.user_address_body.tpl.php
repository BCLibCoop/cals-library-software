<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 14:20:44
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_address_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:391068510516504bcecd362-98517399%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '695d2eb2b5bcad1b17380bf1a7c441e62813edcb' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_address_body.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '391068510516504bcecd362-98517399',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'addrFields' => 0,
    'aField' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516504bd01fd89_52498552',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516504bd01fd89_52498552')) {function content_516504bd01fd89_52498552($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_inputField')) include '/Library/WebServer/Documents/Library/openbiblio/smarty/plugins/function.html_inputField.php';
?>



<br/>
<table width="100%">
    <?php  $_smarty_tpl->tpl_vars['aField'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aField']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['addrFields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aField']->key => $_smarty_tpl->tpl_vars['aField']->value){
$_smarty_tpl->tpl_vars['aField']->_loop = true;
?>
    <tr >
    	<td width="30%" align="right"><?php echo $_smarty_tpl->tpl_vars['aField']->value['label'];?>
</td>
    	<td width="70%" align="left">
    	<?php if ($_smarty_tpl->tpl_vars['aField']->value['field']){?>
    		<?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['aField']->value['field']['type'],'name'=>$_smarty_tpl->tpl_vars['aField']->value['field']['name'],'value'=>$_smarty_tpl->tpl_vars['aField']->value['field']['value'],'options'=>$_smarty_tpl->tpl_vars['aField']->value['field']['options']),$_smarty_tpl);?>

    	<?php }else{ ?>
    		<?php echo $_smarty_tpl->tpl_vars['aField']->value['value'];?>

    	<?php }?>
    	</td>
    </tr>
<?php } ?>
</table>

<?php }} ?>