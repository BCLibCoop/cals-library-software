{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<INPUT TYPE="button" onClick="getConnectedDevices()" VALUE="Update Device List">
<br /><br />	
<form  id="conndevsform" action="" method="POST" >
<input type="hidden" id="hvendid" name="cvend"  value=""/>
<input type="hidden" id="hprodid" name="cprod"  value=""/>
<input type="hidden" id="hserial" name="cserial"  value=""/>
<input type="hidden" id="hdevid" name="did"  value=""/>

<table  class="adminTable" style="width:65%" >
<thead>
	<tr>
		<th style="width:50%" class="left" align="center">{$tableHeader1}</th>
		<th style="width:50%" class="right" align="center">Mount Point</th>
	</tr>
</thead>
</table>
<div class="scrollTableWrapper"  style="width:66%;height:180px">
<table  class="adminTable" id="devstbl">	
{nocache}		
<tbody>
</tbody>
{/nocache}	
</table>
</div>

</form>
{/block}
{block name=endScripts append}
<script type="text/javascript" src="{$APP_ROOT}/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/innershiv.js"></script>
<script type="text/javascript">
<!--
{literal}
	
	Agent.prototype.method = 'POST';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;
    
    var devSrch = new Agent();
	window.onload = init;
	
	function init() {
		getConnectedDevices()
	}

	devSrch.success = function ( resp ) { 		
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('devstbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements 
		newBody.appendChild(innerShiv(resp));
		document.getElementById('devstbl').replaceChild(newBody,oldBody);
	
	}


	function storeVals(el){
  
  	document.getElementById("hserial").value = el.cells['rowser'].textContent;
	document.getElementById("hvendid").value = el.cells['rowvend'].textContent;
	document.getElementById("hprodid").value = el.cells['rowprod'].textContent;
	document.getElementById("hdevid").value = el.cells['rowdevid'].textContent;
	}

	function doSubmit(subAction){
		var form = document.getElementById('conndevsform');
		form.action = subAction;
		form.submit();
	}
	
		function getConnectedDevices()
	{
		devSrch.set_action('connectedDevicesInfo.php'+ '?' + new Date().getTime());
		devSrch.request("");
	
	}
	
{/literal}
-->
</script>

{/block}

