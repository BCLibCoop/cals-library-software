{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<form id="userRequestSearchForm" name="requestSearch" method="GET"  >
<input disabled type="button" id="addreqbutton" value="{$submitButtonLabel}" onclick="addReq();" >
&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="{$cancelButtonLabel}" onclick="self.location='user_view.php?uid={$uid}'">
&nbsp;&nbsp;&nbsp;&nbsp;<label>{$showAllLabel}&nbsp;<input type="checkbox" id="showall"  onclick="toggleShowAllSearch();"/></label>
<input type="hidden" id="hbibid" name="bid" value="" />
<input type="hidden" id="huid" name="uid" value="{$uid}" />

<div class="adminTable"  style="width:90%">
<table  class="adminTable" >
<thead>
<tr  >
    <th style="width:30%"class="left" >{$searchBar.title.label}<br/><input size="40" maxlength="40" id="srchtitle" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchtitle');}{/literal},600);"></th>
    <th style="width:30%">{$searchBar.author.label}<br/><input size="40" maxlength="30" id="srchauthor" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchauthor');}{/literal},600);"></th>
    <th style="width:30%">{$searchBar.subject.label}<br/><input size="40" maxlength="30" id="srchsubj" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchsubj');}{/literal},600);"></th>
    <th class="right" style="width:10%" >{$searchBar.snum.label}<br/><input size="10" maxlength="20" id="srchsnum" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchsnum');}{/literal},600);"></th>
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

{/block}

{block name="endScripts"}
<script type="text/javascript" src="{$APP_ROOT}/javascript/tableFuncs.js"></script>	
<script type="text/javascript" src="{$APP_ROOT}/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/innershiv.js"></script>
<script type="text/javascript">
{literal}
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
{/literal}
</script>

{/block}

