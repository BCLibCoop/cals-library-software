{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<div style="width:90%">
<form name="editdeviceform" method="POST" action="../devices/device_edit.php">
<input type="hidden" id="huserid" name="uid" value="{$uid}" />
<input type="hidden" id="hdevid" name="did"  value="{$did}"/>
<input type="hidden" id="husername" name="unm"  value="{$fields.username.value}"/>
<input type="hidden" id="hfullname" name="fnm"  value="{$fields.name.value}"/>
<div style="width:50%">
<table class="adminTable" >
<thead><tr><th class="left"></th><th class="right"></th></tr></thead>
<tr class="primary">
    <td style="width:10em" align="right" class="left">{$fields.name.label}</td>
    <td id='namelabel' class="right">{$fields.name.value}</td>
</tr>
<tr class="alt1" >
    <td align="right" class="left">{$fields.username.label}</td>
    <td class="right" id='usernamelabel'>{$fields.username.value}</td>
</tr>
<!-- Add a spacer between the header and data -->
<tr><td><p></p></td></tr>
<tr class="primary">
    <td align="right" class="left">{$fields.barcd.label}</td>
    <td align="left" class="right">
   
    {if $fields.barcd.field.value && !$error_barcode}
        <input type="hidden" name="bcd"  value="{$fields.barcd.field.value}"/>
    	{$fields.barcd.field.value}
    {else}
    	{validate id='v_bcNE' message=$fields.barcd.validate.v_bcNE assign='error_barcode'}
    	{validate id='v_bcValid' message=$fields.barcd.validate.v_bcValid assign='error_barcode'}
    	{html_inputField type="text" name="bcd" options=$fields.barcd.field.options}
    {/if}
    </td>
    
</tr><tr>
{if $error_barcode}
<td colspan="2" align="center"><font class="error">{$error_barcode}</font></td>
{/if}
</tr>
<tr  ><td colspan="2"><center><input disabled="disabled" id="submitBtn" type="submit" value="{$submitButtonLabel}" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" id="clrusrbutton" onclick="clearUser();" value="Clear User"/></center></td>
</tr>
</table>
</div>
<br/>
<div style="width:50%">
<table class="adminTable"  > 
<thead> 
<tr > 
<th  class="left">User Search<br/><input style="width:20em" maxlength="50" id="usrnm" type="text" onkeyup="delayFunction(checkField,700);"></th> 
<th style="width:2em" class="right" ><img  vspace="10" onclick="clearFields();" src="../images/cancel.png" width="25px" height="25px" alt="Reset"></th></tr>
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:51%;height:200px">
<table   class="adminTable" id="usersListTable" >
{nocache}
<tbody> 
</tbody>
{/nocache}
</table>
</div>
</form>
</div>

{/block}

{block name=endScripts}
<script type="text/javascript" src="{$APP_ROOT}/javascript/tableFuncs.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/innershiv.js"></script>
<script type="text/javascript">
{literal}
<!--	
	Agent.prototype.method = 'POST';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;
    
    var usrSrch = new Agent();
    
    
	
	usrSrch.success = function ( resp ) { 		
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('usersListTable').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements 
		newBody.appendChild(innerShiv(resp));
		document.getElementById('usersListTable').replaceChild(newBody,oldBody);
	
	}
	


	function init() {

		var el = document.getElementById("huserid");
		document.getElementById("clrusrbutton").disabled = ((el.value == '') || (el.value=='0'));
		document.getElementById("usrnm").focus();
	}
	
window.onload = init;
	
function updateInfo(el){
	HighlightRowText(el,'#ee2222');
	document.getElementById("huserid").value = el.cells['uid'].textContent;
	document.getElementById('usernamelabel').innerHTML = el.cells['uname'].textContent;
	document.getElementById('namelabel').innerHTML = el.cells['name'].textContent;
	document.getElementById('husername').value = el.cells['uname'].textContent;
	document.getElementById('hfullname').value = el.cells['name'].textContent;
	setUpdateButton(true);
	document.getElementById("clrusrbutton").disabled = (document.getElementById("huserid").value == '');

}

	function setUpdateButton(force)
	{
		var el = document.getElementById("bcd");
		if(el != null)
			document.getElementById("submitBtn").disabled = (el.value.length==0);
		else
			document.getElementById("submitBtn").disabled = !force;
	}

	function clearUser(){
	
	document.getElementById('usernamelabel').innerHTML = '&nbsp;';
	document.getElementById('namelabel').innerHTML = '&nbsp;';
	document.getElementById("huserid").value = "";
	document.getElementById('husername').value = '';
	document.getElementById('hfullname').value = '';
	setUpdateButton(true);
	document.getElementById("clrusrbutton").disabled = true;
}

	function clearFields()
	{
		document.getElementById('usrnm').value = '';
		document.getElementById("clientNames").innerHTML='';
	}
	
	function checkField()
	{
		var el = document.getElementById('usrnm');
		if (el.value.length>2)
		{ 		
			var filterStr = 'n='+ encodeURIComponent(el.value);	
			usrSrch.set_action('deviceUsersFilter.php'+ '?' + new Date().getTime());
			usrSrch.request(filterStr);				
		}
		
	}
	
-->
{/literal}
</script>
{/block}