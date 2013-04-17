<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 18:22:27
         compiled from "/Library/WebServer/Documents/cals/smarty/templates/catalog/external_search_body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1568614544516d2663cbf6e3-87422634%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4473b4d58cbcb9dee3f940f05a1820ee0883a1a9' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/catalog/external_search_body.tpl',
      1 => 1365649951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1568614544516d2663cbf6e3-87422634',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 1,
    'anError' => 1,
    'results' => 1,
    'svrLabel' => 1,
    'aServer' => 1,
    'anEntry' => 1,
    'fields' => 1,
    'labels' => 1,
    'tag' => 1,
    'fld' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516d2663d99b23_59699586',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516d2663d99b23_59699586')) {function content_516d2663d99b23_59699586($_smarty_tpl) {?>



 
 
 

<?php if ($_smarty_tpl->tpl_vars['errors']->value){?>
<tr  >
    <th colspan="3" style="width:98%" class="both" >Errors</th>
</tr>
	<?php  $_smarty_tpl->tpl_vars['anError'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['anError']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['anError']->key => $_smarty_tpl->tpl_vars['anError']->value){
$_smarty_tpl->tpl_vars['anError']->_loop = true;
?>
		<tr class='<?php if (!(1 & $_smarty_tpl->tpl_vars['anEntry']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>' style="width:98%">
		<td class='both' id='title' style='padding-left:2em;width:90%' >
			<?php echo $_smarty_tpl->tpl_vars['anError']->value['server'];?>
 - <?php echo $_smarty_tpl->tpl_vars['anError']->value['msg'];?>

		</td>
		</tr>
	<?php } ?>
	
<?php }?>
<?php  $_smarty_tpl->tpl_vars['aServer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aServer']->_loop = false;
 $_smarty_tpl->tpl_vars['svrLabel'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['results']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aServer']->key => $_smarty_tpl->tpl_vars['aServer']->value){
$_smarty_tpl->tpl_vars['aServer']->_loop = true;
 $_smarty_tpl->tpl_vars['svrLabel']->value = $_smarty_tpl->tpl_vars['aServer']->key;
?>
	<tr><th colspan="3" style="width:98%" class="both" ><?php echo $_smarty_tpl->tpl_vars['svrLabel']->value;?>
</th></tr>
	<?php  $_smarty_tpl->tpl_vars['anEntry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['anEntry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aServer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['anEntry']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['anEntry']->key => $_smarty_tpl->tpl_vars['anEntry']->value){
$_smarty_tpl->tpl_vars['anEntry']->_loop = true;
 $_smarty_tpl->tpl_vars['anEntry']->iteration++;
?>
		<?php $_smarty_tpl->tpl_vars["fields"] = new Smarty_variable($_smarty_tpl->tpl_vars['anEntry']->value->getBiblioFields(), true, 0);?>
		<?php if ($_smarty_tpl->tpl_vars['fields']->value['245a']){?>
		<tr class='<?php if (!(1 & $_smarty_tpl->tpl_vars['anEntry']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>' style="width:98%">
		<td class='left' id='title' style='padding-left:2em;width:70%' >
		<?php echo $_smarty_tpl->tpl_vars['labels']->value['title'];?>
 : <?php echo $_smarty_tpl->tpl_vars['fields']->value['245a']->getFieldData();?>
<br />
		<?php if ($_smarty_tpl->tpl_vars['fields']->value['100a']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['author'];?>
 : <?php echo $_smarty_tpl->tpl_vars['fields']->value['100a']->getFieldData();?>
<br /><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['fields']->value['020a']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['isbn'];?>
 : <?php echo $_smarty_tpl->tpl_vars['fields']->value['020a']->getFieldData();?>
<br /><?php }?>
		
		<?php if ($_smarty_tpl->tpl_vars['fields']->value['260b']&&$_smarty_tpl->tpl_vars['fields']->value['260a']){?>
			<?php echo $_smarty_tpl->tpl_vars['labels']->value['pubPlace'];?>
 : <?php echo $_smarty_tpl->tpl_vars['fields']->value['260a']->getFieldData();?>
<br />
			<?php echo $_smarty_tpl->tpl_vars['labels']->value['publisher'];?>
 : <?php echo $_smarty_tpl->tpl_vars['fields']->value['260b']->getFieldData();?>
<br />
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['fields']->value['260c']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['pubDate'];?>
 : <?php echo $_smarty_tpl->tpl_vars['fields']->value['260c']->getFieldData();?>
<br /><?php }?>		
		</td>
		<td class="right">
			<form method="POST" action="entry_new_like.php"> 
			<input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['labels']->value['useThis'];?>
">
			<?php  $_smarty_tpl->tpl_vars["fld"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["fld"]->_loop = false;
 $_smarty_tpl->tpl_vars["tag"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["fld"]->key => $_smarty_tpl->tpl_vars["fld"]->value){
$_smarty_tpl->tpl_vars["fld"]->_loop = true;
 $_smarty_tpl->tpl_vars["tag"]->value = $_smarty_tpl->tpl_vars["fld"]->key;
?>
			
			<input type="hidden" name="flds[<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['fld']->value->getFieldData();?>
">
			<?php } ?>
			
			<input type="hidden" name="bid" value="0">
			</form>
		</td>
		</tr>
		<?php }?>
	<?php } ?>
	<tr><td><br /></td></tr>
<?php } ?>



<?php }} ?>