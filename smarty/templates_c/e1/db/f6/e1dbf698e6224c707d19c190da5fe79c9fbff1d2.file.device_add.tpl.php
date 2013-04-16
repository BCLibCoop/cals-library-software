<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 15:05:48
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/devices/device_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:95616658051650f4ccbd864-84353570%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e1dbf698e6224c707d19c190da5fe79c9fbff1d2' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/devices/device_add.tpl',
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
  'nocache_hash' => '95616658051650f4ccbd864-84353570',
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
  'unifunc' => 'content_51650f4cf12530_26423016',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51650f4cf12530_26423016')) {function content_51650f4cf12530_26423016($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_validate')) include '/Library/WebServer/Documents/Library/openbiblio/libs/SmartyValidate/plugins/function.validate.php';
if (!is_callable('smarty_function_html_inputField')) include '/Library/WebServer/Documents/Library/openbiblio/smarty/plugins/function.html_inputField.php';
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


<form name="adddeviceform" method="POST" action="../devices/device_add.php">
<div style="width:50%">
<input type="hidden" id="huserid" name="usrid" value="" />
<input type="hidden" id="husername" name="usrnm"  value=""/>
<input type="hidden" id="hfullname" name="fullnm"  value=""/>
<input type="hidden" id="hvendid" name="ven"  value="<?php echo $_smarty_tpl->tpl_vars['fields']->value['vend']['value'];?>
"/>
<input type="hidden" id="hprodid" name="pro"  value="<?php echo $_smarty_tpl->tpl_vars['fields']->value['prod']['value'];?>
"/>
<input type="hidden" id="hserial" name="ser"  value="<?php echo $_smarty_tpl->tpl_vars['fields']->value['serial']['value'];?>
"/>

<table class="adminTable" >
<thead><tr><th class="left"></th><th class="right"></th></tr></thead>
<tr class="primary">
    <td style="width:10em" align="right" class="left"><?php echo $_smarty_tpl->tpl_vars['fields']->value['name']['label'];?>
</td>
    <td id='namelabel' class="right"><?php echo $_smarty_tpl->tpl_vars['fields']->value['name']['value'];?>
</td>
</tr>
<tr class="alt1" >
    <td align="right" class="left"><?php echo $_smarty_tpl->tpl_vars['fields']->value['username']['label'];?>
</td>
    <td class="right" id='usernamelabel'><?php echo $_smarty_tpl->tpl_vars['fields']->value['username']['value'];?>
</td>
</tr>
<!-- Add a spacer between the header and data -->
<tr><td><p></p></td></tr>
<tr class="primary">
    <td align="right" class="left"><?php echo $_smarty_tpl->tpl_vars['fields']->value['barcd']['label'];?>
</td>
    <td align="left" class="right">
    	<?php echo smarty_function_validate(array('id'=>'v_bcNE','message'=>$_smarty_tpl->tpl_vars['fields']->value['barcd']['validate']['v_bcNE'],'assign'=>'error_barcode'),$_smarty_tpl);?>

    	<?php echo smarty_function_validate(array('id'=>'v_bcValid','message'=>$_smarty_tpl->tpl_vars['fields']->value['barcd']['validate']['v_bcValid'],'assign'=>'error_barcode'),$_smarty_tpl);?>

    	<?php echo smarty_function_html_inputField(array('type'=>$_smarty_tpl->tpl_vars['fields']->value['barcd']['field']['type'],'name'=>$_smarty_tpl->tpl_vars['fields']->value['barcd']['field']['name'],'options'=>$_smarty_tpl->tpl_vars['fields']->value['barcd']['field']['options']),$_smarty_tpl);?>

    </td>
</tr>
<tr>
<?php if ($_smarty_tpl->tpl_vars['error_barcode']->value){?>
<td colspan="2" align="center"><font class="error"><?php echo $_smarty_tpl->tpl_vars['error_barcode']->value;?>
</font></td>
<?php }?>
</tr>
<tr  ><td colspan="2"><center><input disabled="disabled" id="submitBtn" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['submitButtonLabel']->value;?>
" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" id="clrusrbutton" onclick="clearUser();" value="Clear User"/></center></td>
</tr>
</table>
</div>
<div style="width:50%">
<table class="adminTable"  > 
<thead> 
<tr > 
<th  class="left">User Search<br/><input style="width:20em" maxlength="50" id="usrnm" type="text" onkeyup="delayFunction(checkField,700);"></th> 
<th style="width:2em" class="right" ><img  vspace="10" onclick="clearFields();" src="../images/cancel.png" width="25px" height="25px" alt="Reset"></th></tr>
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:51%;height:200px">
<table   class="adminTable" id="usersListTable" >

<tbody> 
</tbody>

</table>
</div>

</form>



	</div>
</div>

 
</body>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/tableFuncs.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['APP_ROOT']->value;?>
/javascript/innershiv.js"></script>
<script type="text/javascript">

<!--
	
	Agent.prototype.method = 'POST';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;
    
    var usrSrch = new Agent();
	
	usrSrch.success = function ( resp ) { 		
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('usersListTable').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements 
		newBody.appendChild(innerShiv(resp));
		document.getElementById('usersListTable').replaceChild(newBody,oldBody);
	
	}

	function init() {
		document.getElementById("clrusrbutton").disabled = true;
		document.getElementById("usrnm").focus();
	}
window.onload = init;

function updateInfo(el){
	HighlightRowText(el,'#ee2222');
	document.getElementById("huserid").value = el.cells['uid'].textContent;
	document.getElementById('usernamelabel').textContent = el.cells['uname'].textContent;
	document.getElementById('namelabel').textContent = el.cells['name'].textContent;
	document.getElementById('husername').value = el.cells['uname'].textContent;
	document.getElementById('hfullname').value = el.cells['name'].textContent;
	setUpdateButton();

	document.getElementById("clrusrbutton").disabled = (document.getElementById("huserid").value == '');
}

	function setUpdateButton()
	{
		var el = document.getElementById("bcode");
		document.getElementById("submitBtn").disabled = (el.value.length==0);
	}

function clearUser(){
	
	document.getElementById('usernamelabel').textContent = '';
	document.getElementById('namelabel').textContent = '';
	document.getElementById("huserid").value = "";
	document.getElementById('husername').value = '';
	document.getElementById('hfullname').value = '';
	setUpdateButton();
	document.getElementById("clrusrbutton").disabled = true;
}

	function clearFields()
	{
		document.getElementById('usrnm').value = '';
		document.getElementById("clientNames").innerHTML='';
		setUpdateButton();
	}
	
	function checkField()
	{
		var el = document.getElementById('usrnm');
		if (el.value.length>2)
		{ 		
			var filterStr = 'n='+ encodeURIComponent(el.value);	
			usrSrch.set_action('deviceUsersFilter.php'+ '?' + new Date().getTime());
			usrSrch.request(filterStr);				
		}
	}
-->

</script>

</html><?php }} ?>