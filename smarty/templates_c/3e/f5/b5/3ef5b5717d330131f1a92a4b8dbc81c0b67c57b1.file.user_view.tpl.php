<?php /* Smarty version Smarty-3.1.13, created on 2013-04-10 14:20:45
         compiled from "/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1673152567516504bd0e56f4-65281899%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ef5b5717d330131f1a92a4b8dbc81c0b67c57b1' => 
    array (
      0 => '/Library/WebServer/Documents/Library/openbiblio/smarty/templates/users/user_view.tpl',
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
  'nocache_hash' => '1673152567516504bd0e56f4-65281899',
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
  'unifunc' => 'content_516504bd44a354_31959495',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516504bd44a354_31959495')) {function content_516504bd44a354_31959495($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_html_options')) include '/Library/WebServer/Documents/Library/openbiblio/libs/Smarty/plugins/function.html_options.php';
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

<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
" id="uid">
&nbsp;<input type="button" value="<?php echo $_smarty_tpl->tpl_vars['editButtonLabel']->value;?>
" id="edit" onclick="self.location='user_edit.php?uid=<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
'"  >
&nbsp;&nbsp;&nbsp;
<input type="button" value="<?php echo $_smarty_tpl->tpl_vars['changePwdButtonLabel']->value;?>
" id="chpwd" onclick="self.location='user_change_pwd.php?uid=<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
'"  >
&nbsp;&nbsp;&nbsp;
<input type="button"   value="<?php echo $_smarty_tpl->tpl_vars['backButtonLabel']->value;?>
" onclick="self.location='user_search.php'" >


	<!-- Begin Stylesheets -->

		<link rel="stylesheet" href="../css/coda-slider.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../css/scrolling-table.css" type="text/css" media="screen" />

	<!-- End Stylesheets -->


<div class="coda-slider-wrapper">
	<div class="coda-slider preload" id="user-info-slider">
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">General</h2>
				<div class="content">
				
				
<table class="adminTable" style="width:80%">
<?php  $_smarty_tpl->tpl_vars['anItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['anItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['info']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['anItem']->key => $_smarty_tpl->tpl_vars['anItem']->value){
$_smarty_tpl->tpl_vars['anItem']->_loop = true;
?>
<tr><td align="right" width="50%"><?php echo $_smarty_tpl->tpl_vars['anItem']->value['label'];?>
</td><td width="50%"align="left"><?php echo $_smarty_tpl->tpl_vars['anItem']->value['value'];?>
</td></tr>
<?php } ?>
</table>

				
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Addresses</h2>
				<div class="content" >
				
				
<div id="addressContent">
<?php if ($_smarty_tpl->tpl_vars['addrSel']->value){?>
Type :&nbsp;<?php echo smarty_function_html_options(array('name'=>$_smarty_tpl->tpl_vars['addrSel']->value['name'],'options'=>$_smarty_tpl->tpl_vars['addrSel']->value['options'],'onchange'=>'changeAddress();','id'=>'addrSel'),$_smarty_tpl);?>

<div id="addressBody">
<?php echo $_smarty_tpl->tpl_vars['addressBody']->value;?>

</div>
<?php }else{ ?>
No Addresses Found
<?php }?>
<br/>
<input type="button"  onclick="showNewAddressFields();" value="Add New Address" >
</div>


				
				</div>

			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Preferences</h2>
				<div class="content">
				
				
<table class="adminTable" style="width:70%;padding-left:5%">
<tr class="primary">
<td class="left" valign="top"><img src="../images/<?php if ($_smarty_tpl->tpl_vars['prefs']->value['viol']['value']){?>apply.png<?php }else{ ?>cancel.png<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['prefs']->value['viol']['value']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yes'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['no'];?>
<?php }?>" width="20" height="20">&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['viol']['label'];?>
</td>
<td class="right" valign="top"><img src="../images/<?php if ($_smarty_tpl->tpl_vars['prefs']->value['lang']['value']){?>apply.png<?php }else{ ?>cancel.png<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['prefs']->value['lang']['value']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yes'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['no'];?>
<?php }?>" width="20" height="20">&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['lang']['label'];?>
</td>
</tr>
<tr class="alt1"><td colspan="2" class="both" valign="top"><img src="../images/<?php if ($_smarty_tpl->tpl_vars['prefs']->value['sex']['value']){?>apply.png<?php }else{ ?>cancel.png<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['prefs']->value['sex']['value']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yes'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['no'];?>
<?php }?>" width="20" height="20">&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['sex']['label'];?>
</td>
</tr>
<tr><td class="separator" colspan="2"></td></tr>
<tr class="primary">
<td class="left" valign="top"><img src="../images/<?php if ($_smarty_tpl->tpl_vars['prefs']->value['bookS']['value']){?>apply.png<?php }else{ ?>cancel.png<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['prefs']->value['bookS']['value']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yes'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['no'];?>
<?php }?>" width="20" height="20">&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['bookS']['label'];?>
</td>
<td  class="right" valign="top"><img src="../images/<?php if ($_smarty_tpl->tpl_vars['prefs']->value['bookL']['value']){?>apply.png<?php }else{ ?>cancel.png<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['prefs']->value['bookL']['value']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yes'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['no'];?>
<?php }?>" width="20" height="20">&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['bookL']['label'];?>
</td>
</tr>
<tr><td class="separator" colspan="2"></td></tr>
<tr class="alt1"><td class="left"valign="top"><img src="../images/<?php if ($_smarty_tpl->tpl_vars['prefs']->value['narrM']['value']){?>apply.png<?php }else{ ?>cancel.png<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['prefs']->value['narrM']['value']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yes'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['no'];?>
<?php }?>" width="20" height="20">&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['narrM']['label'];?>
</td>
<td  class="right" valign="top"><img src="../images/<?php if ($_smarty_tpl->tpl_vars['prefs']->value['narrF']['value']){?>apply.png<?php }else{ ?>cancel.png<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['prefs']->value['narrF']['value']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yes'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['no'];?>
<?php }?>" width="20" height="20">&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['narrF']['label'];?>
</td>
</tr>

<tr class="primary">
<td  colspan="2" class="both" valign="top"><img src="../images/<?php if ($_smarty_tpl->tpl_vars['prefs']->value['narrS']['value']){?>apply.png<?php }else{ ?>cancel.png<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['prefs']->value['narrS']['value']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yes'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['no'];?>
<?php }?>" width="20" height="20">&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['narrS']['label'];?>
</td>
</tr>
<tr ><td class="separator" colspan="2"></td></tr>
<tr class="alt1">
<td class="both" colspan="2" valign="top"><img src="../images/<?php if ($_smarty_tpl->tpl_vars['prefs']->value['brail']['value']){?>apply.png<?php }else{ ?>cancel.png<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['prefs']->value['brail']['value']){?><?php echo $_smarty_tpl->tpl_vars['labels']->value['yes'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['labels']->value['no'];?>
<?php }?>" width="20" height="20">&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['brail']['label'];?>
</td>
</tr>
<tr><td class="separator" colspan="2"></td></tr>
<tr class="primary">
<td class="left"  width="50%" align="right"><?php echo $_smarty_tpl->tpl_vars['prefs']->value['perDev']['label'];?>
&nbsp;:&nbsp;</td><td class="right" align="left"><?php echo $_smarty_tpl->tpl_vars['prefs']->value['perDev']['value'];?>
</td>
</tr>
<tr class="alt1">
<td class="left" width="50%" align="right"><?php echo $_smarty_tpl->tpl_vars['prefs']->value['maxQ']['label'];?>
&nbsp;:&nbsp;</td><td class="right" align="left"><?php echo $_smarty_tpl->tpl_vars['prefs']->value['maxQ']['value'];?>
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
				
				
<div   style="width:100%">
<table  class="adminTable"  >
<thead>
<tr  >
	<th style="width:150px">Type</th>
    <th style="width:300px">Content</th>
    <th style="width:50px">Likes</th>
    <th style="width:100px">Lang</th>
</tr >
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:100%;height:200px">
<table  class="adminTable" id="profilestbl">
<tbody>
<?php echo $_smarty_tpl->tpl_vars['profilesBody']->value;?>

</tbody>
</table>
</div>
<br/>
<div><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"profType",'options'=>$_smarty_tpl->tpl_vars['profSel']->value['options'],'selected'=>$_smarty_tpl->tpl_vars['profSel']->value['selected'],'onchange'=>'changeProfileSelector();','id'=>'profType'),$_smarty_tpl);?>

<div style="margin-left:80px">Prefers&nbsp;<?php echo smarty_function_html_inputField(array('label'=>true,'type'=>"checkbox",'name'=>"profLikes",'value'=>1,'id'=>'profLikes','checked'=>'checked'),$_smarty_tpl);?>
&nbsp;<span id="profileSelectorContent"><?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"profValue",'options'=>$_smarty_tpl->tpl_vars['profileValues']->value,'id'=>"profValue"),$_smarty_tpl);?>
</span><br/>in&nbsp;
<?php echo smarty_function_html_inputField(array('type'=>"select",'name'=>"proflang",'options'=>$_smarty_tpl->tpl_vars['profLangSel']->value['options'],'selected'=>$_smarty_tpl->tpl_vars['profLangSel']->value['selected'],'id'=>'profLang'),$_smarty_tpl);?>

</div>
<br/>
<input type="button"  onclick="addProfile();" value="Add This Profile" >

</div>

				
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Requests</h2>
				<div class="content" >
				
				
<div  style="width:600px;">
&nbsp;<input type="button" value="<?php echo $_smarty_tpl->tpl_vars['addRequestButtonLabel']->value;?>
" onclick="self.location='user_request.php?uid=<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
'" >
</div>
<input type="hidden" id="hreqid">
<div class="tableContainer" style="width:600px;height:275px;">
    <table class="scrollTable" style="width:100%;height:inherit;">
    	<thead class="fixedHeader" >
    		<tr>
    			<th style="width:400px">Title</th>
    			<th style="width:200px">Date Requested</th>
    		</tr>
    	</thead>
    	<tbody class="scrollContent" style="height:245px;">
    		<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['requests']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
    		<tr >
    			<td style="width:400px"><?php echo $_smarty_tpl->tpl_vars['row']->value->title;?>
</td>
    			<td align="center" style="width:200px"><?php echo $_smarty_tpl->tpl_vars['row']->value->date;?>
</td>
    		</tr>
    		<?php } ?>
    	</tbody>
    </table>
</div><!-- .tableContainer -->
<br/>



				
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Reading History</h2>
				<div class="content" >
				
				
<input type="button" value="Show Full History" onclick="getFullHistory();" />
<div   style="width:100%">
<table  class="adminTable">
<thead>
<tr>
		<th class="left" width="6%"><center>Device<br />Ref</center></th>
		<th width="60%"><center>Title</center></th>
		<th class="right" width="30%"><center>Date Loaded</center></th>
</tr>
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:100%;height:300px">
<table  class="adminTable" id="historyTable">
<tbody>
<?php echo $_smarty_tpl->tpl_vars['historyBody']->value;?>

</tbody>
</table>
</div>


				
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Notes</h2>
				<div class="content" >
				
				
<input type="button" value="Show All Notes" onclick="showAllNotes();" />
<div   style="width:100%">
<table  class="adminTable"  >
<thead>
<tr  >
    <th class="left" style="width:70%"><center><?php echo $_smarty_tpl->tpl_vars['noteLabels']->value['search'];?>
<br/><input style="width:80%" maxlength="40" id="noteSrchBar" type="text" onkeyup="delayFunction(function() { searchNotes();},600);"></center></th>
    <th class="right" style="width:30%"><?php echo $_smarty_tpl->tpl_vars['noteLabels']->value['date'];?>
</th>
</tr >
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:100%;height:200px">
<table  class="adminTable" id="notestbl">
<tbody>
<?php echo $_smarty_tpl->tpl_vars['notesBody']->value;?>

</tbody>
</table>
</div>
<br />
<center><textarea rows="3" cols="60" id="newnote"></textarea>
<br /><br /><input type="button" value="Add this note" onclick="addNote();" /></center>

				
				</div>
			</div>
		</div>
	</div><!-- .coda-slider -->

</div><!-- .coda-slider-wrapper -->




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



<script type="text/javascript">
<!--

	var newAddr = new Agent();
	var noteAgent = new Agent();
	var showHist = new Agent();
	var profSelAgent = new Agent();
	var profilesAgent = new Agent();

	profilesAgent.success = function (resp)
	{
		if (resp == "") return false;

		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('profilestbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements
		newBody.appendChild(innerShiv(resp));
		document.getElementById('profilestbl').replaceChild(newBody,oldBody);

	}

	noteAgent.success = function (resp)
	{
		if (resp == "") return false;

		document.getElementById("newnote").value="";
		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('notestbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements
		newBody.appendChild(innerShiv(resp));
		document.getElementById('notestbl').replaceChild(newBody,oldBody);
	}

	newAddr.success = function ( resp ) {
 		document.getElementById("addressContent").innerHTML=resp;
	}

	profSelAgent.success = function (resp)
	{
		if (resp == "") return false;
		document.getElementById("profileSelectorContent").innerHTML =resp;
	}

	function changeProfileSelector()
	{
		var el = document.getElementById('profType');
		var typeid = el.options[el.selectedIndex].value;
		profSelAgent.set_action('profileTypeFilter.php?pt='+encodeURIComponent(typeid));
		profSelAgent.request('');
	}

	function addProfile()
	{
		var userid = document.getElementById('uid').value;
		var el = document.getElementById('profLang');
		var lang = el.options[el.selectedIndex].value;
		el = document.getElementById('profType');
		var ptype = el.options[el.selectedIndex].value;
		el = document.getElementById('profValue');
		var pcont = (el.type == 'text')?el.value:el.options[el.selectedIndex].text;
		var prefers = (document.getElementById('profLikes').checked)?1:0;

		profilesAgent.method="POST";
		profilesAgent.set_action('user_profile_add.php?uid='+encodeURIComponent(userid));
		profilesAgent.request('t='+ptype+'&p='+prefers+'&l='+lang+'&c='+pcont);

	}

	showHist.success = function ( resp ) {
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('historyTable').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements
		newBody.appendChild(innerShiv(resp));
		document.getElementById('historyTable').replaceChild(newBody,oldBody);

	}

	function getFullHistory()
	{
		var userid = document.getElementById('uid').value;
		showHist.set_action('userHistoryFilter.php?uid='+encodeURIComponent(userid)+'&fh');
		showHist.request('');
	}

	function showNewAddressFields()
	{
		var userid = document.getElementById('uid').value;
		newAddr.set_action('user_new_address.php?uid='+encodeURIComponent(userid));
		newAddr.request('');
	}


	function addNote()
	{
		document.getElementById("noteSrchBar").value="";
		var userid = document.getElementById('uid').value;
		var note = document.getElementById('newnote').value;
		noteAgent.method="POST";
		noteAgent.set_action('user_note_add.php?uid='+encodeURIComponent(userid));
		noteAgent.request('nt='+note);
	}

	function searchNotes()
	{
		var userid = document.getElementById('uid').value;
		var crit = document.getElementById('noteSrchBar').value;
		noteAgent.method="POST";
		noteAgent.set_action('userNotesFilter.php?uid='+encodeURIComponent(userid));
		noteAgent.request('nt='+crit);
	}

	function showAllNotes()
	{
		var userid = document.getElementById('uid').value;
		document.getElementById("noteSrchBar").value="";
		noteAgent.method="POST";
		noteAgent.set_action('userNotesFilter.php?uid='+encodeURIComponent(userid)+'&sa');
		noteAgent.request('nt=');
	}







-->
</script>

</html><?php }} ?>