<?php /* Smarty version Smarty-3.1.13, created on 2013-04-11 08:31:57
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/catalog/entry_marc_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11927422575166047d9788a1-58552980%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd222c531369a34ca64c79d63986502f77b7f2c52' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/catalog/entry_marc_body.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11927422575166047d9788a1-58552980',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'labels' => 1,
    'blocks' => 1,
    'tags' => 1,
    'ind1' => 1,
    'ind2' => 1,
    'subFlds' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5166047d9ffd94_31573870',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5166047d9ffd94_31573870')) {function content_5166047d9ffd94_31573870($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_inputField')) include '/Library/WebServer/Documents/Library/openbiblio/smarty/plugins/function.html_inputField.php';
?>




  <tr class="primary">
    <td align="right" class="left"><?php echo $_smarty_tpl->tpl_vars['labels']->value['blockLabel'];?>
 :&nbsp;</td>
    <td  class="right"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"b",'selected'=>$_smarty_tpl->tpl_vars['blocks']->value['selected'],'options'=>$_smarty_tpl->tpl_vars['blocks']->value['options'],'id'=>"block",'onchange'=>"doBlockChange();"),$_smarty_tpl);?>
</td>
  </tr>
  <tr class="alt1">
    <td align="right" class="left"><?php echo $_smarty_tpl->tpl_vars['labels']->value['tagLabel'];?>
 :&nbsp;</td>
    <td  class="right"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"t",'selected'=>$_smarty_tpl->tpl_vars['tags']->value['selected'],'options'=>$_smarty_tpl->tpl_vars['tags']->value['options'],'id'=>"tag",'onchange'=>"doTagChange();"),$_smarty_tpl);?>
</td>
  </tr>
  <tr class="primary">
    <td align="right" nowrap="true" class="left" ><label for="i1"><?php echo $_smarty_tpl->tpl_vars['labels']->value['ind1Label'];?>
 :&nbsp;</label></td>
    <td  class="right"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"i1",'selected'=>$_smarty_tpl->tpl_vars['ind1']->value['selected'],'options'=>$_smarty_tpl->tpl_vars['ind1']->value['options']),$_smarty_tpl);?>
</td>
  </tr>
  <tr class="alt1">
    <td align="right" nowrap="true" class="left" ><label for="i2"><?php echo $_smarty_tpl->tpl_vars['labels']->value['ind2Label'];?>
 :&nbsp;</label> </td>
    <td  class="right"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"i2",'selected'=>$_smarty_tpl->tpl_vars['ind2']->value['selected'],'options'=>$_smarty_tpl->tpl_vars['ind2']->value['options']),$_smarty_tpl);?>
</td>
   </tr>

  <tr class="primary">
    <td align="right" nowrap="true" class="left" ><?php echo $_smarty_tpl->tpl_vars['labels']->value['subfieldLabel'];?>
 :&nbsp;</td>
    <td  class="right"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"s",'selected'=>$_smarty_tpl->tpl_vars['subFlds']->value['selected'],'options'=>$_smarty_tpl->tpl_vars['subFlds']->value['options']),$_smarty_tpl);?>
</td>
  </tr>
<?php }} ?>