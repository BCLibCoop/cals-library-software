<?php /* Smarty version Smarty-3.1.13, created on 2013-04-11 10:20:20
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/admin/staff_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26137650251661de4340741-21969929%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9d804201ad78176b7a25968f37666b69ec45a2a' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/admin/staff_list.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
    'fbf982da55d9b57e0fea288cf103a9e2c8eb2988' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/private/admin_layout.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
    '64e6d3581c3478256e4b1cbfd1dc36460970b41a' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/private/layout.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26137650251661de4340741-21969929',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'charset' => 0,
    'labelTodaysDate' => 0,
    'labelLibraryHours' => 0,
    'labelLibraryPhone' => 0,
    'isPublic' => 0,
    'loginOutButton' => 0,
    'helpPage' => 0,
    'footerHelp' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51661de45fd5c0_25440383',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51661de45fd5c0_25440383')) {function content_51661de45fd5c0_25440383($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/modifier.date_format.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">


<?php  $_config = new Smarty_Internal_Config("DLS.cfg", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars('Library', 'local'); ?>
<?php $_smarty_tpl->tpl_vars['charset'] = new Smarty_variable($_smarty_tpl->getConfigVariable('charset')!='' ? $_smarty_tpl->getConfigVariable('charset') : 'utf-8', null, 0);?>

<head>



<meta http-equiv="content-type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['charset']->value;?>
">
<meta http-equiv="content-style-type" content="text/css" />
<meta name="language" content="en" />
<meta name="author" content="Kieren Eaton" />
<meta name="description" content="Digital Library Information Service">
<!--
 <meta name="Description" content="Guide Dogs and other services for people who are vision impaired" />
<meta name="Keywords" content="" />
<meta name="robots" content="index,follow" />
-->
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />

<link rel="stylesheet" type="text/css" href="../css/admin.css" title="style" />
<title><?php echo $_smarty_tpl->getConfigVariable('libraryName');?>
</title>

 

</head>
<body>
<div id="header">
	<div id="logo">
	<?php if ($_smarty_tpl->getConfigVariable('libraryImageUrl')!=''){?>
      <img src="../images/<?php echo $_smarty_tpl->getConfigVariable('libraryImageUrl');?>
" alt="Guide Dogs WA logo"></td>
    <?php }?>
	</div>
	<div>
		<div id='libraryDetails'>
			<p><?php echo $_smarty_tpl->tpl_vars['labelTodaysDate']->value;?>
<?php echo smarty_modifier_date_format(time());?>

			<?php if ($_smarty_tpl->getConfigVariable('libraryHours')!=''){?>
          		<br/><?php echo $_smarty_tpl->tpl_vars['labelLibraryHours']->value;?>
<?php echo $_smarty_tpl->getConfigVariable('libraryHours');?>

 	        <?php }?>
            <?php if ($_smarty_tpl->getConfigVariable('libraryPhone')!=''){?>
          		<br/><?php echo $_smarty_tpl->tpl_vars['labelLibraryPhone']->value;?>
<?php echo $_smarty_tpl->getConfigVariable('libraryPhone');?>

       		<?php }?>
       		</p>
		</div>

		<div id='libraryName'>
			<h1><strong><?php echo $_smarty_tpl->getConfigVariable('libraryName');?>
</strong></h1>
			<h5><?php echo $_smarty_tpl->getConfigVariable('libraryDescription');?>
</h5>
		</div>
	</div>
</div>

<?php if (!$_smarty_tpl->tpl_vars['isPublic']->value){?>
	<div id="tabMenuWrapper">
		
<link rel="stylesheet" type="text/css" href="../css/tabs.css" />
<div id="tabBox">
	<ul id="adminTabs">
	<?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value){
$_smarty_tpl->tpl_vars['tab']->_loop = true;
?>
		<li <?php if ($_smarty_tpl->tpl_vars['tab']->value['items']){?>class='selected'<?php }?>>
			<a <?php if (!$_smarty_tpl->tpl_vars['tab']->value['items']){?>href="<?php echo $_smarty_tpl->tpl_vars['tab']->value['ref'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['tab']->value['label'];?>
</a>
			
			<?php if ($_smarty_tpl->tpl_vars['tab']->value['items']){?>
				<span>
				<?php  $_smarty_tpl->tpl_vars['navItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['navItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tab']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['navItem']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['navItem']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['navItem']->key => $_smarty_tpl->tpl_vars['navItem']->value){
$_smarty_tpl->tpl_vars['navItem']->_loop = true;
 $_smarty_tpl->tpl_vars['navItem']->iteration++;
 $_smarty_tpl->tpl_vars['navItem']->last = $_smarty_tpl->tpl_vars['navItem']->iteration === $_smarty_tpl->tpl_vars['navItem']->total;
?>
					<a <?php if ($_smarty_tpl->tpl_vars['navItem']->value['selected']==false){?>href="<?php echo $_smarty_tpl->tpl_vars['navItem']->value['ref'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['navItem']->value['label'];?>
</a><?php if (!$_smarty_tpl->tpl_vars['navItem']->last){?>&nbsp;|&nbsp;<?php }?>
				<?php } ?>
				</span>
			<?php }?>
			
		</li>
	<?php } ?>
	</ul>
</div>

	</div>
<?php }?>
<div id="contentWrapper">
	<div id="content">
		<?php if ($_smarty_tpl->tpl_vars['loginOutButton']->value){?>
			<input style="margin-left:-85px;margin-top:-15px;" type="button" value="<?php echo $_smarty_tpl->tpl_vars['loginOutButton']->value['label'];?>
" onclick="self.location='<?php echo $_smarty_tpl->tpl_vars['loginOutButton']->value['ref'];?>
'"><br/>
		<?php }?>
		
	<?php if ($_smarty_tpl->tpl_vars['contentStatusMsg']->value){?>
		<pre><font class="error"><?php echo $_smarty_tpl->tpl_vars['contentStatusMsg']->value;?>
</font></pre>
	<?php }?>
	<h1><?php echo $_smarty_tpl->tpl_vars['contentHeader']->value;?>
</h1>
	<?php if ($_smarty_tpl->tpl_vars['contentDesc']->value){?>
	<h2><?php echo $_smarty_tpl->tpl_vars['contentDesc']->value;?>
</h2>
	<?php }?>

<div style="width:80%">
<input type="button" onclick="self.location='<?php echo $_smarty_tpl->tpl_vars['addNewStaffButton']->value['ref'];?>
'" value="<?php echo $_smarty_tpl->tpl_vars['addNewStaffButton']->value['label'];?>
">
<table class="adminTable">
  <tr>
  	<?php  $_smarty_tpl->tpl_vars['label'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['label']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['adminStaffListColumnHeaders']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['label']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['label']->iteration=0;
 $_smarty_tpl->tpl_vars['label']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['label']->key => $_smarty_tpl->tpl_vars['label']->value){
$_smarty_tpl->tpl_vars['label']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['label']->key;
 $_smarty_tpl->tpl_vars['label']->iteration++;
 $_smarty_tpl->tpl_vars['label']->index++;
 $_smarty_tpl->tpl_vars['label']->first = $_smarty_tpl->tpl_vars['label']->index === 0;
 $_smarty_tpl->tpl_vars['label']->last = $_smarty_tpl->tpl_vars['label']->iteration === $_smarty_tpl->tpl_vars['label']->total;
?>
    <th  class="<?php if ($_smarty_tpl->tpl_vars['label']->first){?>left<?php }elseif($_smarty_tpl->tpl_vars['label']->last){?>right<?php }?>"
    	<?php if ($_smarty_tpl->tpl_vars['k']->value=='function'){?>
    	rowspan="2" 
    	<?php }elseif($_smarty_tpl->tpl_vars['k']->value=='auth'){?>
    	colspan="5"
    	<?php }else{ ?>
    	rowspan="2"  nowrap="yes"
    	<?php }?>>
    	<?php echo $_smarty_tpl->tpl_vars['label']->value;?>

    </th>
    <?php } ?>
  </tr>
  <tr>
      <?php  $_smarty_tpl->tpl_vars['label'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['label']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['adminStaffListTabNames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['label']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['label']->iteration=0;
 $_smarty_tpl->tpl_vars['label']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['label']->key => $_smarty_tpl->tpl_vars['label']->value){
$_smarty_tpl->tpl_vars['label']->_loop = true;
 $_smarty_tpl->tpl_vars['label']->iteration++;
 $_smarty_tpl->tpl_vars['label']->index++;
 $_smarty_tpl->tpl_vars['label']->first = $_smarty_tpl->tpl_vars['label']->index === 0;
 $_smarty_tpl->tpl_vars['label']->last = $_smarty_tpl->tpl_vars['label']->iteration === $_smarty_tpl->tpl_vars['label']->total;
?>
      <th>
      <?php echo $_smarty_tpl->tpl_vars['label']->value;?>

      </th>
      <?php } ?>
  </tr>
	<?php  $_smarty_tpl->tpl_vars["member"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["member"]->_loop = false;
 $_smarty_tpl->tpl_vars["col"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['staffList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["member"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["member"]->key => $_smarty_tpl->tpl_vars["member"]->value){
$_smarty_tpl->tpl_vars["member"]->_loop = true;
 $_smarty_tpl->tpl_vars["col"]->value = $_smarty_tpl->tpl_vars["member"]->key;
 $_smarty_tpl->tpl_vars["member"]->iteration++;
?>
  	<tr class="<?php if (!(1 & $_smarty_tpl->tpl_vars['member']->iteration)){?>primary<?php }else{ ?>alt1<?php }?>" >
  		    <td class="left">
  		<select onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['funcs']->value['baseRef'];?>
'+this.value;">
  			<option value="<?php echo $_smarty_tpl->tpl_vars['funcs']->value['edit']['ref'];?>
<?php echo $_smarty_tpl->tpl_vars['member']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['funcs']->value['edit']['label'];?>
</option>
  			<option value="<?php echo $_smarty_tpl->tpl_vars['funcs']->value['pwd']['ref'];?>
<?php echo $_smarty_tpl->tpl_vars['member']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['funcs']->value['pwd']['label'];?>
</option>
  			<option value="<?php echo $_smarty_tpl->tpl_vars['funcs']->value['del']['ref'];?>
<?php echo $_smarty_tpl->tpl_vars['member']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['funcs']->value['del']['label'];?>
</option>
  	</select>
  	</td>

    	<td align="center" ><?php echo $_smarty_tpl->tpl_vars['member']->value['surname'];?>
</td>
    	<td align="center" ><?php echo $_smarty_tpl->tpl_vars['member']->value['firstname'];?>
</td>
   		<td align="center" ><?php echo $_smarty_tpl->tpl_vars['member']->value['username'];?>
</td>
    	<td align="center" <?php if (!$_smarty_tpl->tpl_vars['member']->value['users']){?> alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['no']['label'];?>
"><?php }else{ ?>><img src="../images/<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['label'];?>
" width="25" height="25"><?php }?></td>
    	<td align="center" <?php if (!$_smarty_tpl->tpl_vars['member']->value['devices']){?> alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['no']['label'];?>
"><?php }else{ ?>><img src="../images/<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['label'];?>
" width="25" height="25"><?php }?></td>
    	<td align="center" <?php if (!$_smarty_tpl->tpl_vars['member']->value['catalog']){?> alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['no']['label'];?>
"><?php }else{ ?>><img src="../images/<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['label'];?>
" width="25" height="25"><?php }?></td>
    	<td align="center" <?php if (!$_smarty_tpl->tpl_vars['member']->value['admin']){?> alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['no']['label'];?>
"><?php }else{ ?>><img src="../images/<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['label'];?>
" width="25" height="25"><?php }?></td>
   		<td align="center" <?php if (!$_smarty_tpl->tpl_vars['member']->value['reports']){?> alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['no']['label'];?>
"><?php }else{ ?>><img src="../images/<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['label'];?>
" width="25" height="25"><?php }?></td>
    	<td align="center" class="right"<?php if (!$_smarty_tpl->tpl_vars['member']->value['suspended']){?> alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['no']['label'];?>
"><?php }else{ ?>><img src="../images/<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['labels']->value['yes']['label'];?>
" width="25" height="25"><?php }?></td>
 	</tr>
  <?php } ?>
</table>
</div>

	</div>
</div>

 
</body>

<script type="text/javascript">
<!--

function popSecondary(url) {
    var SecondaryWin;
    SecondaryWin = window.open(url,"secondary","resizable=yes,scrollbars=yes,width=535,height=400");
    self.name="main";
}
function popSecondaryLarge(url) {
    var SecondaryWin;
    SecondaryWin = window.open(url,"secondary","toolbar=yes,resizable=yes,scrollbars=yes,width=700,height=500");
    self.name="main";
}
function backToMain(URL) {
    var mainWin;
    mainWin = window.open(URL,"main");
    mainWin.focus();
    this.close();
}
-->
</script>

</html><?php }} ?>