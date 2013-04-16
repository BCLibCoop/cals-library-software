{* Smarty Template *}
{*debug *}

{*
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<div style="width:90%">
<form id="catalogSearchForm" name="requestSearch" method="GET"  >
<input disabled type="button" id="viewEntryButton" value="{$submitButtonLabel}" onclick="viewEntry();" >
<input type="hidden" id="hbibid" name="bid" value="" />


<table  class="adminTable"  >
<thead>
<tr  >
    <th style="width:30%"class="left" >{$searchBar.title.label}<br/><input style="width:80%" maxlength="40" id="srchtitle" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchtitle');}{/literal},600);"></th>
    <th style="width:30%">{$searchBar.author.label}{* &nbsp;&nbsp;<input type="checkbox" id="incnarr">&nbsp;include Narrators *}<br/><input style="width:80%" maxlength="30" id="srchauthor" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchauthor');}{/literal},600);"></th>
    <th style="width:30%">{$searchBar.subject.label}<br/><input style="width:80%" maxlength="30" id="srchsubj" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchsubj');}{/literal},600);"></th>
    <th class="right"  >{$searchBar.snum.label}<br/><input style="width:80%" maxlength="20" id="srchsnum" type="text" onkeyup="delayFunction(function() {literal}{ checkField('srchsnum');}{/literal},600);"></th>
</tr>
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:91%">
<table  class="adminTable" id="srchtbl">
{nocache}
<tbody>
</tbody>
{/nocache}
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
		document.getElementById("viewEntryButton").disabled = true;
	}

	window.onload = init;


	function selectTitle(el)
	{

		document.getElementById("hbibid").value = el.cells['bid'].innerHTML;
		document.getElementById("viewEntryButton").disabled = false;
		HighlightRowText(el,'#ee2222');
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
		//filterStr = ((el.id == 'srchauthor') && document.getElementById('incnarr').checked)?'n=1&'+filterStr:filterStr;
		filterStr = (el.id == 'srchsubj')?'g=':filterStr;
		filterStr = (el.id == 'srchsnum')?'s=':filterStr;
		filterStr = filterStr + encodeURIComponent(trim(el.value));

		catSrch.set_action('catalogSearchFilter.php'+ '?' + new Date().getTime());
		catSrch.request(filterStr);
	}

	function trim(str) {
		var	str = str.replace(/^\s\s*/, ''),
		ws = /\s/,
		i = str.length;
		while (ws.test(str.charAt(--i)));
		return str.slice(0, i + 1);
	}

	function viewEntry()
	{
		var form = document.forms['catalogSearchForm'];
		form.action = "entry_view.php";
		form.submit();
	}

-->
{/literal}
</script>

{/block}

