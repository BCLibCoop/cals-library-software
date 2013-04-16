{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<form id="userSearchForm" name="userSearch" method="GET" action=""  >
<input disabled="disabled" type="button" id="view" value="View details" onclick="doAction(this.id);" class="button">
<input disabled="disabled" type="button" id="request" onClick="doAction(this.id)" value="Request a book" class="button">	 
<input type="hidden" id="huserid" name="uid" value="" />

<div class="adminTable"  style="width:90%">
<table  class="adminTable" >
<thead>
<tr  >
    <th style="width:20%"class="left" >{$searchBar.name.label}<br/><input style="width:10em" maxlength="20" id="srchname" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchname');}{/literal},700);"></th>
    <th style="width:15%">{$searchBar.username.label}<br/><input style="width:10em" maxlength="20" id="srchuname" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchuname');}{/literal},700);"></th>
    <th style="width:15%">{$searchBar.phone.label}<br/><input style="width:10em" maxlength="15" id="srchphn" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchphn');}{/literal},700);"></th>
    <th style="width:40%" >{$searchBar.address.label}<br/><input style="width:15em" maxlength="20" id="srchaddr" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchaddr');}{/literal},700);"></th>
    <th style="width:10%" class="right">{$searchBar.jade.label}<br/><input style="width:5em" maxlength="10" id="srchjade" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchjade');}{/literal},700);"></th>
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
{/literal}
</script>

{/block}

