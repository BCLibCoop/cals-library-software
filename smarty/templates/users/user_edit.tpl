{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='users/user_layout.tpl'}

{block name='editPrefix' }
<form name="edituserform" method="post" action="user_edit.php">
<input type="hidden" value="{$uid}" name="uid" id="uid">
<input type="submit"   value="Update Details" >
<input type="button"   value="Cancel" onclick="self.location='user_view.php?uid={$uid}'" >
{/block}



{block name='general'}
<table class="adminTable" style="width:80%">
{foreach from=$info item='anItem'}
   	{foreach from=$anItem.validate key='svid' item='msg'}
		{validate id=$svid message=$msg assign="error_{$anItem.field.name}"}
   	{/foreach}
<tr><td align="right" width="50%">{$anItem.label}</td><td width="50%"align="left">{html_inputField type=$anItem.field.type name=$anItem.field.name value=$anItem.field.value checked=$anItem.field.checked options=$anItem.field.options selected=$anItem.field.selected}</td></tr>
	{if {"{$error_{$anItem.field.name}}"}}
    	<tr><td colspan="2" align="center"><font color="red">&nbsp;{"{$error_{$anItem.field.name}}"}</font></td></tr>
    {/if}	
{/foreach}
</table>
{/block}

{block name='userAddress'}
{if $addrSel}
Type :&nbsp;{html_options name=$addrSel.name options=$addrSel.options onchange='changeAddress();' id='addrSel' }&nbsp;&nbsp;Change to:&nbsp;{html_options name=$addrChgSel.name options=$addrChgSel.options}
<div id="addressBody">
{$addressBody}
</div>
<input type="button"  onclick="doAddrDel();" value="Delete This Address">
{else}
No Addresses Found
{/if}
<br/><br/> NOTE: only the currently selected address will be updated. 
{/block}

{block name='userPrefs'}
<table class="adminTable" style="width:70%;padding-left:5%">
<tr class="primary">
<td class="left" valign="top"><label>{html_inputField type=$prefs.viol.field.type name=$prefs.viol.field.name value=$prefs.viol.field.value checked=$prefs.viol.field.checked}&nbsp;{$prefs.viol.label}</label></td>
<td class="right" valign="top"><label>{html_inputField type=$prefs.lang.field.type name=$prefs.lang.field.name value=$prefs.lang.field.value checked=$prefs.lang.field.checked}&nbsp;{$prefs.lang.label}</label></td>
</tr>
<tr class="alt1"><td colspan="2" class="both" valign="top"><label>{html_inputField type=$prefs.sex.field.type name=$prefs.sex.field.name value=$prefs.sex.field.value checked=$prefs.sex.field.checked}&nbsp;{$prefs.sex.label}</label></td>
</tr>
<tr class="primary">
<td class="left" valign="top"><label>{html_inputField type=$prefs.bookS.field.type name=$prefs.bookS.field.name value=$prefs.bookS.field.value checked=$prefs.bookS.field.checked}&nbsp;{$prefs.bookS.label}</label></td>
<td  class="right" valign="top"><label>{html_inputField type=$prefs.bookL.field.type name=$prefs.bookL.field.name value=$prefs.bookL.field.value checked=$prefs.bookL.field.checked}&nbsp;{$prefs.bookL.label}</label></td>
</tr>
<tr class="alt1"><td class="left"valign="top"><label>{html_inputField type=$prefs.narrM.field.type name=$prefs.narrM.field.name value=$prefs.narrM.field.value checked=$prefs.narrM.field.checked}&nbsp;{$prefs.narrM.label}</label></td>
<td  class="right" valign="top"><label>{html_inputField type=$prefs.narrF.field.type name=$prefs.narrF.field.name value=$prefs.narrF.field.value checked=$prefs.narrF.field.checked}&nbsp;{$prefs.narrF.label}</label></td>
</tr>
<tr class="primary">
<td  colspan="2" class="both" valign="top"><label>{html_inputField type=$prefs.narrS.field.type name=$prefs.narrS.field.name value=$prefs.narrS.field.value checked=$prefs.narrS.field.checked}&nbsp;{$prefs.narrS.label}</label></td>
</tr>
<tr class="alt1">
<td class="both" colspan="2" valign="top"><label>{html_inputField type=$prefs.brail.field.type name=$prefs.brail.field.name value=$prefs.brail.field.value checked=$prefs.brail.field.checked}&nbsp;{$prefs.brail.label}</label></td>
</tr>
<tr class="primary">
<td class="both" colspan="2" align="center" >{$prefs.perDev.label}&nbsp;:{html_inputField type=$prefs.perDev.field.type name=$prefs.perDev.field.name value=$prefs.perDev.field.value options=$prefs.perDev.field.options }</td>
</tr>
<tr class="alt1">
<td class="both" colspan="2" align="center">{$prefs.maxQ.label}&nbsp;:{html_inputField type=$prefs.maxQ.field.type name=$prefs.maxQ.field.name value=$prefs.maxQ.field.value options=$prefs.maxQ.field.options }</td>
</tr>
</table>
{/block}

{block name='userProfiles'}
<div class="tableContainer" style="width:750px;height:400px;">
    <table class="scrollTable" style="width:100%;height:inherit;">
    	<thead class="fixedHeader" >
    		<tr>
    			<th style="width:150px">Type</th>
    			<th style="width:300px">Content</th>
    			<th style="width:50px">Likes</th>
    			<th style="width:100px">Lang</th>
    			<th style="width:75px">&nbsp;</th>
    		</tr>
    	</thead>
    	<tbody class="scrollContent" style="height:365px;">
    		{foreach $profiles as $row}
    		<tr >
    			<td align="center" style="width:150px;">{html_options name=$row.proftype.field.name selected=$row.proftype.field.selected options=$row.proftype.field.options}</td>
    			<td align="center" style="width:300px">{html_inputField type=$row.profcont.field.type name=$row.profcont.field.name value=$row.profcont.field.value options=$row.profcont.field.options}</td>
    			<td align="center" style="width:50px">{html_inputField type=$row.prefer.field.type name=$row.prefer.field.name checked=$row.prefer.field.checked value=$row.prefer.field.value}</td>
    			<td align="center" style="width:100px">{html_options name=$row.proflang.field.name selected=$row.proflang.field.selected options=$row.proflang.field.options}</td>
    			<td align="center" style="width:75px"><input type="button" onclick="doProfDel({$row.profid});" value="Remove"></td>
    		</tr>
    		{/foreach}
    	</tbody>
    </table>	
</div><!-- .tableContainer -->	
{/block}

{block name='userRequests'}

<input type="hidden" id="hreqid">
<div class="tableContainer" style="width:600px;height:275px;">
    <table class="scrollTable" style="width:100%;height:inherit;">
    	<thead class="fixedHeader" >
    		<tr>
    			<th style="width:400px">Title</th>
    			<th style="width:200px">Date Requested</th>
    			<th style="width:75px"></th>
    		</tr>
    	</thead>
    	<tbody class="scrollContent" style="height:245px;">
    		{foreach $requests as $row}
    		<tr >
    			<td style="width:400px">{$row->title}</td>
    			<td align="center" style="width:200px">{$row->date}</td>
    			<td align="center" style="width:75px"><input type="button" onclick="doReqDel({$row->reqid});" value="Remove"></td>
    		</tr>
    		{/foreach}
    	</tbody>
    </table>	
</div><!-- .tableContainer -->	
<br/>


{/block}

{block name='userHistory'}
Editing History is not permitted

{/block}

{block name='endScripts' append}
<script type="text/javascript">

<!--
{literal}
	function doAddrDel()
	{
		var userid = document.getElementById('uid').value;
    	var addrid = document.getElementById('addrSel').value;
    	self.location='user_del.php?uid='+encodeURIComponent(userid)+'&aid='+encodeURIComponent(addrid);	
	}
	
	function doReqDel(reqid)
	{
		var userid = document.getElementById('uid').value;
    	self.location='user_del.php?uid='+encodeURIComponent(userid)+'&rid='+encodeURIComponent(reqid);	
	}
	
	function doProfDel(profid)
	{
		var userid = document.getElementById('uid').value;
		self.location='user_del.php?uid='+encodeURIComponent(userid)+'&pid='+encodeURIComponent(profid);
	}
{/literal}
-->
</script>	

{/block}

{block name='editSuffix' }

</form>
{/block}