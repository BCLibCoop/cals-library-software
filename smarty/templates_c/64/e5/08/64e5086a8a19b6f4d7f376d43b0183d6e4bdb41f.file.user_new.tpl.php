<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 16:13:42
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_new.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128471138251651f360a61b7-65773943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64e5086a8a19b6f4d7f376d43b0183d6e4bdb41f' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_new.tpl',
      1 => 1365570927,
      2 => 'file',
    ),
    'eab866f4f1194916bbcf1434ba63a783b1c78952' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_layout.tpl',
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
  'nocache_hash' => '128471138251651f360a61b7-65773943',
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
  'unifunc' => 'content_51651f3645e949_49338265',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51651f3645e949_49338265')) {function content_51651f3645e949_49338265($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_validate')) include '/Library/WebServer/Documents/Library/openbiblio/libs/SmartyValidate/plugins/function.validate.php';
if (!is_callable('smarty_function_html_inputField')) include '/Library/WebServer/Documents/Library/openbiblio/smarty/plugins/function.html_inputField.php';
if (!is_callable('smarty_function_html_options')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/function.html_options.php';
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


	<!-- Begin Stylesheets -->

		<link rel="stylesheet" href="../css/coda-slider.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../css/scrolling-table.css" type="text/css" media="screen" />

	<!-- End Stylesheets -->

<form name="adduserform" method="post" action="user_new.php">
<input type="submit"   value="<?php echo $_smarty_tpl->tpl_vars['submitButtonLabel']->value;?>
" >
<input type="button"   value="<?php echo $_smarty_tpl->tpl_vars['cancelButtonLabel']->value;?>
" onclick="self.location='user_search.php'" >


<div class="coda-slider-wrapper">
	<div class="coda-slider preload" id="user-info-slider">
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">General</h2>
				<div class="content">
				
				

<table width="100%">
<tr><td>
<table class="adminTable" width="70%">
<?php  $_smarty_tpl->tpl_vars['anItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['anItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infoLeft']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['anItem']->key => $_smarty_tpl->tpl_vars['anItem']->value){
$_smarty_tpl->tpl_vars['anItem']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['anItem']->value['validate']){?>
    	<?php  $_smarty_tpl->tpl_vars['msg'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['msg']->_loop = false;
 $_smarty_tpl->tpl_vars['svid'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['anItem']->value['validate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['msg']->key => $_smarty_tpl->tpl_vars['msg']->value){
$_smarty_tpl->tpl_vars['msg']->_loop = true;
 $_smarty_tpl->tpl_vars['svid']->value = $_smarty_tpl->tpl_vars['msg']->key;
?>
    			<?php echo smarty_function_validate(array('id'=>$_smarty_tpl->tpl_vars['svid']->value,'message'=>$_smarty_tpl->tpl_vars['msg']->value,'assign'=>"error_".((string)$_smarty_tpl->tpl_vars['anItem']->value['field']['name'])),$_smarty_tpl);?>

    	<?php } ?>
    <?php }?>
<tr><td align="right" width="50%"><?php echo $_smarty_tpl->tpl_vars['anItem']->value['label'];?>
</td><td width="50%"align="left"><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['type'],'name'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['name'],'value'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['checked'],'options'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['options'],'selected'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['selected']),$_smarty_tpl);?>
</td></tr>
	<?php ob_start();?><?php echo ((string)$_smarty_tpl->tpl_vars['error_'.($_smarty_tpl->tpl_vars['anItem']->value['field']['name'])]->value);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>
    	<tr><td colspan="2" align="center"><font color="red">&nbsp;<?php echo ((string)$_smarty_tpl->tpl_vars['error_'.($_smarty_tpl->tpl_vars['anItem']->value['field']['name'])]->value);?>
</font></td></tr>
    <?php }?>	
<?php } ?>
</table>
</td>

<td>
<table class="adminTable" width="30%">
<?php  $_smarty_tpl->tpl_vars['anItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['anItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['infoRight']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['anItem']->key => $_smarty_tpl->tpl_vars['anItem']->value){
$_smarty_tpl->tpl_vars['anItem']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['anItem']->value['validate']){?>
    	<?php  $_smarty_tpl->tpl_vars['msg'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['msg']->_loop = false;
 $_smarty_tpl->tpl_vars['svid'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['anItem']->value['validate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['msg']->key => $_smarty_tpl->tpl_vars['msg']->value){
$_smarty_tpl->tpl_vars['msg']->_loop = true;
 $_smarty_tpl->tpl_vars['svid']->value = $_smarty_tpl->tpl_vars['msg']->key;
?>
    			<?php echo smarty_function_validate(array('id'=>$_smarty_tpl->tpl_vars['svid']->value,'message'=>$_smarty_tpl->tpl_vars['msg']->value,'assign'=>"error_".((string)$_smarty_tpl->tpl_vars['anItem']->value['field']['name'])),$_smarty_tpl);?>

    	<?php } ?>
    <?php }?>
<tr><td align="right" width="50%"><?php echo $_smarty_tpl->tpl_vars['anItem']->value['label'];?>
</td><td width="50%"align="left"><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['type'],'name'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['name'],'value'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['checked'],'options'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['options'],'selected'=>$_smarty_tpl->tpl_vars['anItem']->value['field']['selected']),$_smarty_tpl);?>
</td></tr>
	<?php ob_start();?><?php echo ((string)$_smarty_tpl->tpl_vars['error_'.($_smarty_tpl->tpl_vars['anItem']->value['field']['name'])]->value);?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2){?>
    	<tr><td colspan="2" align="center"><font color="red">&nbsp;<?php echo ((string)$_smarty_tpl->tpl_vars['error_'.($_smarty_tpl->tpl_vars['anItem']->value['field']['name'])]->value);?>
</font></td></tr>
    <?php }?>
<?php } ?>
</table>
</td>
</tr>
</table>

				
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Addresses</h2>
				<div class="content" >
				
				
Type :&nbsp;<?php echo smarty_function_html_options(array('name'=>$_smarty_tpl->tpl_vars['addrSel']->value['name'],'options'=>$_smarty_tpl->tpl_vars['addrSel']->value['options'],'selected'=>$_smarty_tpl->tpl_vars['addrSel']->value['selected']),$_smarty_tpl);?>

<?php echo $_smarty_tpl->tpl_vars['addressBody']->value;?>


				
				</div>

			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Preferences</h2>
				<div class="content">
				
				
<table class="adminTable" style="width:70%;padding-left:5%">
<tr class="primary">
<td class="left" valign="top"><label><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['viol']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['viol']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['viol']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['prefs']->value['viol']['field']['checked']),$_smarty_tpl);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['viol']['label'];?>
</label></td>
<td class="right" valign="top"><label><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['lang']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['lang']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['lang']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['prefs']->value['lang']['field']['checked']),$_smarty_tpl);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['lang']['label'];?>
</label></td>
</tr>
<tr class="alt1"><td colspan="2" class="both" valign="top"><label><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['sex']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['sex']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['sex']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['prefs']->value['sex']['field']['checked']),$_smarty_tpl);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['sex']['label'];?>
</label></td>
</tr>
<tr class="primary">
<td class="left" valign="top"><label><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['bookS']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['bookS']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['bookS']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['prefs']->value['bookS']['field']['checked']),$_smarty_tpl);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['bookS']['label'];?>
</label></td>
<td  class="right" valign="top"><label><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['bookL']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['bookL']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['bookL']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['prefs']->value['bookL']['field']['checked']),$_smarty_tpl);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['bookL']['label'];?>
</label></td>
</tr>
<tr class="alt1"><td class="left"valign="top"><label><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['narrM']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['narrM']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['narrM']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['prefs']->value['narrM']['field']['checked']),$_smarty_tpl);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['narrM']['label'];?>
</label></td>
<td  class="right" valign="top"><label><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['narrF']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['narrF']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['narrF']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['prefs']->value['narrF']['field']['checked']),$_smarty_tpl);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['narrF']['label'];?>
</label></td>
</tr>
<tr class="primary">
<td  colspan="2" class="both" valign="top"><label><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['narrS']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['narrS']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['narrS']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['prefs']->value['narrS']['field']['checked']),$_smarty_tpl);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['narrS']['label'];?>
</label></td>
</tr>
<tr class="alt1">
<td class="both" colspan="2" valign="top"><label><?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['brail']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['brail']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['brail']['field']['value'],'checked'=>$_smarty_tpl->tpl_vars['prefs']->value['brail']['field']['checked']),$_smarty_tpl);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['brail']['label'];?>
</label></td>
</tr>
<tr class="primary">
<td class="both" colspan="2" align="center" ><?php echo $_smarty_tpl->tpl_vars['prefs']->value['perDev']['label'];?>
&nbsp;:<?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['perDev']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['perDev']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['perDev']['field']['value'],'options'=>$_smarty_tpl->tpl_vars['prefs']->value['perDev']['field']['options']),$_smarty_tpl);?>
</td>
</tr>
<tr class="alt1">
<td class="both" colspan="2" align="center"><?php echo $_smarty_tpl->tpl_vars['prefs']->value['maxQ']['label'];?>
&nbsp;:<?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['prefs']->value['maxQ']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['prefs']->value['maxQ']['field']['name'],'value'=>$_smarty_tpl->tpl_vars['prefs']->value['maxQ']['field']['value'],'options'=>$_smarty_tpl->tpl_vars['prefs']->value['maxQ']['field']['options']),$_smarty_tpl);?>
</td>
</tr>
</table>

				
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Profiles</h2>
				<div class="content" >
				
				
<?php echo $_smarty_tpl->tpl_vars['noProfilesMsg']->value;?>


				
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Requests</h2>
				<div class="content" >
				
				
<?php echo $_smarty_tpl->tpl_vars['noRequestsMsg']->value;?>


				
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Reading History</h2>
				<div class="content" >
				
				
<?php echo $_smarty_tpl->tpl_vars['noHistoryMsg']->value;?>


				
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Notes</h2>
				<div class="content" >
				
				
				
				</div>
			</div>
		</div>
	</div><!-- .coda-slider -->

</div><!-- .coda-slider-wrapper -->


</form>



	</div>
</div>

 
</body>

<!-- Begin JavaScript -->
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/jquery.coda-slider.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/AJAXagent.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/innershiv.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/tableFuncs.js"></script>
<script type="text/javascript">
	<!--

    Agent.prototype.method = 'GET';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;

    var addrChg = new Agent();

	addrChg.success = function ( resp ) {
 		document.getElementById("addressBody").innerHTML=resp;
	}

	$().ready(function()
	{
		$('#user-info-slider').codaSlider(
		{
			dynamicArrows:false,
			autoHeight:true
		});
	});

	function changeAddress()
	{
		var filterStr = '';
		var addel = null;
		var el = document.getElementById('addrSel');
		if(el == null) return false;

		filterStr = 'aid='+escape(el.value);
		// check if we are editing
		addel = document.getElementById('addr');
		if ((addel != undefined)  && (addel != null))
			filterStr=filterStr+'&e';
		addrChg.set_action('userAddressFilter.php?'+filterStr);
		addrChg.request('');
	}


-->
</script>



</html><?php }} ?>