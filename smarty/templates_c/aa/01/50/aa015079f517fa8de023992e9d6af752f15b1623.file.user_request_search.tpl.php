<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 14:32:43
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_request_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2492859185165078bb7ca63-25107999%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa015079f517fa8de023992e9d6af752f15b1623' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_request_search.tpl',
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
  'nocache_hash' => '2492859185165078bb7ca63-25107999',
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
  'unifunc' => 'content_5165078bd85b89_99310709',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5165078bd85b89_99310709')) {function content_5165078bd85b89_99310709($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/modifier.date_format.php';
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


<form id="userRequestSearchForm" name="requestSearch" method="GET"  >
<input disabled type="button" id="addreqbutton" value="<?php echo $_smarty_tpl->tpl_vars['submitButtonLabel']->value;?>
" onclick="addReq();" >
&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="<?php echo $_smarty_tpl->tpl_vars['cancelButtonLabel']->value;?>
" onclick="self.location='user_view.php?uid=<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
'">
&nbsp;&nbsp;&nbsp;&nbsp;<label><?php echo $_smarty_tpl->tpl_vars['showAllLabel']->value;?>
&nbsp;<input type="checkbox" id="showall"  onclick="toggleShowAllSearch();"/></label>
<input type="hidden" id="hbibid" name="bid" value="" />
<input type="hidden" id="huid" name="uid" value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
" />

<div class="adminTable"  style="width:90%">
<table  class="adminTable" >
<thead>
<tr  >
    <th style="width:30%"class="left" ><?php echo $_smarty_tpl->tpl_vars['searchBar']->value['title']['label'];?>
<br/><input size="40" maxlength="40" id="srchtitle" type="text" onkeyup="delayFunction(function() { checkField('srchtitle');},600);"></th>
    <th style="width:30%"><?php echo $_smarty_tpl->tpl_vars['searchBar']->value['author']['label'];?>
<br/><input size="40" maxlength="30" id="srchauthor" type="text" onkeyup="delayFunction(function() { checkField('srchauthor');},600);"></th>
    <th style="width:30%"><?php echo $_smarty_tpl->tpl_vars['searchBar']->value['subject']['label'];?>
<br/><input size="40" maxlength="30" id="srchsubj" type="text" onkeyup="delayFunction(function() { checkField('srchsubj');},600);"></th>
    <th class="right" style="width:10%" ><?php echo $_smarty_tpl->tpl_vars['searchBar']->value['snum']['label'];?>
<br/><input size="10" maxlength="20" id="srchsnum" type="text" onkeyup="delayFunction(function() { checkField('srchsnum');},600);"></th>
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
    
    var catSrch = new Agent();
	
	catSrch.success = function ( resp ) { 		
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('srchtbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements 
		newBody.appendChild(innerShiv(resp));
		document.getElementById('srchtbl').replaceChild(newBody,oldBody);
	
	}
	
	function init() {
		document.getElementById('srchtitle').focus();
	}

	window.onload = init;


	function selectTitle(el)
	{
		HighlightRowText(el,'#ee2222');
		document.getElementById("hbibid").value = el.cells['bid'].textContent;
		document.getElementById("addreqbutton").disabled = false;
	}
	
	function toggleShowAllSearch()
	{
		if(document.getElementById('srchtitle').value.length)
		{	
			checkField('srchtitle');
			return true;
		}
		if(document.getElementById('srchauthor').value.length)
		{
			checkField('srchauthor');
			return true;
		}
		if(document.getElementById('srchsubj').value.length)
		{
			checkField('srchsubj');
			return true;
		}
		if(document.getElementById('srchsnum').value.length)
		{
			checkField('srchsnum');
			return true;
		}
	}
	
	function checkField(id)
	{
		var el = document.getElementById(id);
				
		// authors names can be 2 or more characters long
		if ((el.id=='srchauthor') && (el.value.length<2))
			return false;
		if (el.value.length>2)
		{ 	
			// clear all search fields except the one being used 
			document.getElementById('srchsubj').value = (el.id == 'srchsubj')?el.value:'';
			document.getElementById('srchsnum').value = (el.id == 'srchsnum')?el.value:'';
			document.getElementById("srchtitle").value = (el.id == 'srchtitle')?el.value:'';
			document.getElementById('srchauthor').value = (el.id == 'srchauthor')?el.value:'';
			
			getTitlesList(el);
		}
		
		
	}

	function getTitlesList(el)
	{
		var filterStr = ''; 
		filterStr = (el.id == 'srchtitle')?'t=':filterStr;
		filterStr = (el.id == 'srchauthor')?'a=':filterStr;
		filterStr = (el.id == 'srchsubj')?'g=':filterStr;
		filterStr = (el.id == 'srchsnum')?'s=':filterStr;
		filterStr = filterStr + encodeURIComponent(trim(el.value));
		filterStr = filterStr + '&uid='+document.getElementById('huid').value;
		filterStr = (document.getElementById("showall").checked == true)?filterStr +'&sa=1':filterStr;

		catSrch.set_action('userRequestSearchFilter.php'+ '?' + new Date().getTime());
		catSrch.request(filterStr);
	}

	function trim(str) {
		var	str = str.replace(/^\s\s*/, ''),
		ws = /\s/,
		i = str.length;
		while (ws.test(str.charAt(--i)));
		return str.slice(0, i + 1);
	}
	
	function addReq()
	{
		var form = document.forms['userRequestSearchForm'];
		form.method = "POST";
		form.action = "user_request_add.php";
		form.submit();
	}

-->

</script>


</html><?php }} ?>