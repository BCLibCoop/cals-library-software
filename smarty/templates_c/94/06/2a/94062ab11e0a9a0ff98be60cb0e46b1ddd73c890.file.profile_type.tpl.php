<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 15:40:08
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/profile_type.tpl" */ ?>
<?php /*%%SmartyHeaderCode:640087184516517587a3ba3-01042241%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94062ab11e0a9a0ff98be60cb0e46b1ddd73c890' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/profile_type.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '640087184516517587a3ba3-01042241',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'field' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51651758801d51_11573181',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51651758801d51_11573181')) {function content_51651758801d51_11573181($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_inputField')) include '/Library/WebServer/Documents/Library/openbiblio/smarty/plugins/function.html_inputField.php';
?>

<?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['field']->value['type'],'name'=>'profValue','options'=>$_smarty_tpl->tpl_vars['field']->value['content'],'id'=>'profValue'),$_smarty_tpl);?>


<?php }} ?>