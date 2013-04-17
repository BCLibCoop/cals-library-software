<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 18:21:12
         compiled from "/Library/WebServer/Documents/cals/smarty/templates/catalog/external_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:937090757516d2618176ae8-05867984%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15bb3e0c40c24fa6d44cdbd86459d600e096a112' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/catalog/external_search.tpl',
      1 => 1365649951,
      2 => 'file',
    ),
    'ba99d9fa779309ebe8f1560f6b421ab4d33e8b81' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/private/admin_layout.tpl',
      1 => 1365649952,
      2 => 'file',
    ),
    '00a02cbf87e68bb8b41a6eea70902b7cb2dd4111' => 
    array (
      0 => '/Library/WebServer/Documents/cals/smarty/templates/private/layout.tpl',
      1 => 1365649952,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '937090757516d2618176ae8-05867984',
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
  'unifunc' => 'content_516d26182f59d9_57908458',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516d26182f59d9_57908458')) {function content_516d26182f59d9_57908458($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/cals/libs/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_html_inputField')) include '/Library/WebServer/Documents/cals/smarty/plugins/function.html_inputField.php';
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


<div style="width:70%">
<br />
<table>
<tr><td><input  type="text" id="srchqry" >
&nbsp;&nbsp;<input type="button"  value="Search"  onclick="doSearch()" /></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td >Servers to search&nbsp;&nbsp;</td>
	<td><?php echo smarty_function_html_inputField(array('type'=>"select",'options'=>$_smarty_tpl->tpl_vars['serverList']->value['servers'],'name'=>"svrs",'id'=>"svrs",'selected'=>$_smarty_tpl->tpl_vars['serverList']->value['selected'],'multiple'=>"multiple"),$_smarty_tpl);?>
</td>
</tr>
</table>
<br />

<table  class="adminTable"  >
<thead>
<tr  >
    <th style="width:100%"class="both" ><?php echo $_smarty_tpl->tpl_vars['labels']->value['results'];?>
</th>
</tr>
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:71%">
<table  class="adminTable" id="resultstbl">	
		
<tbody>
</tbody>
	
</table>
</div>


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
    
    var extSrch = new Agent();
	
	extSrch.success = function ( resp ) 
	{ 		
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('resultstbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements 
		newBody.appendChild(innerShiv(resp));
		document.getElementById('resultstbl').replaceChild(newBody,oldBody);
	
	}
	
	function init() 
	{
		document.getElementById('srchqry').focus();
	}

	window.onload = init;

	function doSearch()
	{
 		var oldBody = document.getElementById('resultstbl').getElementsByTagName('tbody')[0];
		document.getElementById('resultstbl').replaceChild(document.createElement("tbody"),oldBody);
	
		var svrs = document.getElementById("svrs");
		var filterStr = "";
		var selSvrs = new Array();
		for (idx=0 ; idx<svrs.options.length; idx++)
		{
			if(svrs.options[idx].selected == true)
			{	
				//selSvrs[svrs.options[idx].text]=svrs.options[idx].value;
				filterStr = filterStr + "&s[" + svrs.options[idx].text +"]="+ encodeURIComponent(svrs.options[idx].value);
			}
		}
		
		qry = document.getElementById("srchqry").value;
		if (filterStr == "" ||  qry == "") return;
		
		filterStr = filterStr + "&q=" + encodeURIComponent(qry);
		
		extSrch.set_action('externalSearchFilter.php'+ '?' + new Date().getTime());
		extSrch.request(filterStr);
	}

-->

</script>


</html><?php }} ?>