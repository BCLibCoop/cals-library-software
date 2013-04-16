{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<div style="width:70%">
<br />
<table>
<tr><td><input  type="text" id="srchqry" >
&nbsp;&nbsp;<input type="button"  value="Search"  onclick="doSearch()" /></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td >Servers to search&nbsp;&nbsp;</td>
	<td>{html_inputField type="select" options=$serverList.servers name="svrs" id="svrs" selected=$serverList.selected multiple="multiple" }</td>
</tr>
</table>
<br />

<table  class="adminTable"  >
<thead>
<tr  >
    <th style="width:100%"class="both" >{$labels.results}</th>
</tr>
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:71%">
<table  class="adminTable" id="resultstbl">	
{nocache}		
<tbody>
</tbody>
{/nocache}	
</table>
</div>

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
{/literal}
</script>

{/block}

