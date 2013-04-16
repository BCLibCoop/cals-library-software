<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 13:49:31
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15457784855164fd6bb70bc3-82770238%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '012a3a235be3f5404a58e61b4e885ff02b76cd53' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_search.tpl',
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
  'nocache_hash' => '15457784855164fd6bb70bc3-82770238',
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
  'unifunc' => 'content_5164fd6bcfcce9_58952085',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5164fd6bcfcce9_58952085')) {function content_5164fd6bcfcce9_58952085($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/modifier.date_format.php';
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


<form id="userSearchForm" name="userSearch" method="GET" action=""  >
<input disabled="disabled" type="button" id="view" value="View details" onclick="doAction(this.id);" class="button">
<input disabled="disabled" type="button" id="request" onClick="doAction(this.id)" value="Request a book" class="button">	 
<input type="hidden" id="huserid" name="uid" value="" />

<div class="adminTable"  style="width:90%">
<table  class="adminTable" >
<thead>
<tr  >
    <th style="width:20%"class="left" ><?php echo $_smarty_tpl->tpl_vars['searchBar']->value['name']['label'];?>
<br/><input style="width:10em" maxlength="20" id="srchname" type="text" onkeyup="delayFunction(function() { checkField('srchname');},700);"></th>
    <th style="width:15%"><?php echo $_smarty_tpl->tpl_vars['searchBar']->value['username']['label'];?>
<br/><input style="width:10em" maxlength="20" id="srchuname" type="text" onkeyup="delayFunction(function() { checkField('srchuname');},700);"></th>
    <th style="width:15%"><?php echo $_smarty_tpl->tpl_vars['searchBar']->value['phone']['label'];?>
<br/><input style="width:10em" maxlength="15" id="srchphn" type="text" onkeyup="delayFunction(function() { checkField('srchphn');},700);"></th>
    <th style="width:40%" ><?php echo $_smarty_tpl->tpl_vars['searchBar']->value['address']['label'];?>
<br/><input style="width:15em" maxlength="20" id="srchaddr" type="text" onkeyup="delayFunction(function() { checkField('srchaddr');},700);"></th>
    <th style="width:10%" class="right"><?php echo $_smarty_tpl->tpl_vars['searchBar']->value['jade']['label'];?>
<br/><input style="width:5em" maxlength="10" id="srchjade" type="text" onkeyup="delayFunction(function() { checkField('srchjade');},700);"></th>
</tr>
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:91%">
<table  class="adminTable" id="srchtbl">			
<tbody></tbody>	
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
    
    var userSrch = new Agent();
	
	userSrch.success = function ( resp ) {
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('srchtbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements 
		newBody.appendChild(innerShiv(resp));
		document.getElementById('srchtbl').replaceChild(newBody,oldBody);

	}
	
	function init() {
		document.getElementById('srchname').focus();
	}

	window.onload = init;


	function selectUser(el)
	{
		HighlightRowText(el,'#ee2222');
		document.getElementById("huserid").value = el.cells['uid'].innerHTML;
		document.getElementById("view").disabled = false;
		document.getElementById("request").disabled = false;
	}
	
	function doAction(action){
		var form = document.getElementById('userSearchForm');
		
		if(action=="view")
		{
			form.action = "user_view.php";
			form.submit();
			
		}
		if(action=="request")
		{
			form.action = "user_request.php";
			form.submit();
		}
		
	}
	
	function checkField(id)
	{
		var el = document.getElementById(id);
		if (el.value.length>2)
		{ 	
			// clear all search fields except the one being used 
			document.getElementById('srchname').value = (id == 'srchname')?el.value:'';
			document.getElementById('srchuname').value = (id == 'srchuname')?el.value:'';
			document.getElementById('srchphn').value = (id == 'srchphn')?el.value:'';
			document.getElementById('srchjade').value = (id == 'srchjade')?el.value:'';
			document.getElementById('srchaddr').value = (id == 'srchaddr')?el.value:'';
			getClientInfo(el);
		}
	}

	function getClientInfo(el)
	{
		document.getElementById("huserid").value = "";
		document.getElementById("view").disabled = true;
		document.getElementById("request").disabled = true;
		
		var filterStr = ''; 
		filterStr = (el.id == 'srchname')?'n=':filterStr;
		filterStr = (el.id == 'srchuname')?'u=':filterStr;
		filterStr = (el.id == 'srchphn')?'p=':filterStr;
		filterStr = (el.id == 'srchjade')?'j=':filterStr;
		filterStr = (el.id == 'srchaddr')?'a=':filterStr;
		filterStr = filterStr + encodeURIComponent(trim(el.value));
		userSrch.set_action('userSearchFilter.php'+ '?' + new Date().getTime());
		userSrch.request(filterStr);
	}

	function trim(str) {
		var	str = str.replace(/^\s\s*/, ''),
		ws = /\s/,
		i = str.length;
		while (ws.test(str.charAt(--i)));
		return str.slice(0, i + 1);
	}

-->

</script>


</html><?php }} ?>