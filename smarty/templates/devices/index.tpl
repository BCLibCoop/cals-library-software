{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<div style="width:60%">
<form name="viewDevicesForm" method="get" action="device_edit.php">
<input type="hidden" id="hdevid" name="did"  value=""/>
<input disabled="disabled" id="submitBtn" type="submit" value="{$submitButtonLabel}" >
<table  class="adminTable"> 
<thead> 
<tr > 
<th class="left">{$userSearchLabel}<br/><input style="width:20em" maxlength="50" id="usrnm" type="text" onkeyup="delayFunction(function() {literal}{ checkField('usrnm');}{/literal},700);"></th> 
<th class="right" >

<div style="float:left;">{$cartridgeSearchLabel}<br/><input style="width:10em" maxlength="30" id="encbc" type="text" onkeyup="delayFunction(function() {literal}{ checkField('encbc');}{/literal},700);">
</div>
	<img  vspace="10" onclick="clearFields();" src="../images/cancel.png" width="25px" height="25px" alt="Reset">
</th> 
</tr>
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:61%">
<table  class="adminTable" id="srchtbl" > 
{nocache}
<tbody > 
</tbody>
{/nocache}
</table>
</div>
</form>

{/block}
{block name='endScripts'}
<script type="text/javascript" src="{$APP_ROOT}/javascript/tableFuncs.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/innershiv.js"></script>
<script type="text/javascript">
{literal}
<!--
	
	Agent.prototype.method = 'POST';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;
    
    document.getElementById('encbc').focus();
       
    var devSrch = new Agent();
	
	devSrch.success = function ( resp ) { 		
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('srchtbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements 
		newBody.appendChild(innerShiv(resp));
		document.getElementById('srchtbl').replaceChild(newBody,oldBody);
	
	}
	
	function clearFields()
	{
		document.getElementById('usrnm').value = '';
		document.getElementById('encbc').value = '';
		document.getElementById("submitBtn").disabled = true;
	}
	
	function checkField(id)
	{
		var el = document.getElementById(id);
		if (el.value.length>2)
		{ 	
			document.getElementById('submitBtn').disabled = true;
			if(el.id=='usrnm')
			{ 
				document.getElementById('encbc').value = '';
				getDevicesInfo(el.value,'');
			}
			else
			{
				document.getElementById('usrnm').value = '';
				getDevicesInfo('',el.value);
			}
		}
	}
	
	function getDevicesInfo(name,barcode)
	{
		var filterStr = '';
		if(name !='') filterStr = 'n='+ encodeURIComponent(name);
		if(barcode != '')filterStr ='b='+ encodeURIComponent(barcode);
		
		devSrch.set_action('deviceSearchFilter.php'+ '?' + new Date().getTime());
		devSrch.request(filterStr);

	}

    function storeVals(el)
    {
		HighlightRowText(el,'#ee2222');
		document.getElementById("hdevid").value = el.cells["devid"].innerHTML;
		document.getElementById("submitBtn").disabled = false;
	}
	
-->
{/literal}	
</script>
{/block}

