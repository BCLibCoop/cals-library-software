{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='users/user_layout.tpl'}

{block name='editPrefix' }
<form name="adduserform" method="post" action="user_new.php">
<input type="submit"   value="{$submitButtonLabel}" >
<input type="button"   value="{$cancelButtonLabel}" onclick="self.location='user_search.php'" >
{/block}

{block name='general'}

<table width="100%">
<tr><td>
<table class="adminTable" width="70%">
{foreach from=$infoLeft item='anItem'}
{if $anItem.validate}
    	{foreach from=$anItem.validate key='svid' item='msg'}
    			{validate id=$svid message=$msg assign="error_{$anItem.field.name}"}
    	{/foreach}
    {/if}
<tr><td align="right" width="50%">{$anItem.label}</td><td width="50%"align="left">{html_inputField type=$anItem.field.type name=$anItem.field.name value=$anItem.field.value checked=$anItem.field.checked options=$anItem.field.options selected=$anItem.field.selected}</td></tr>
	{if {"{$error_{$anItem.field.name}}"}}
    	<tr><td colspan="2" align="center"><font color="red">&nbsp;{"{$error_{$anItem.field.name}}"}</font></td></tr>
    {/if}	
{/foreach}
</table>
</td>

<td>
<table class="adminTable" width="30%">
{foreach from=$infoRight item='anItem'}
{if $anItem.validate}
    	{foreach from=$anItem.validate key='svid' item='msg'}
    			{validate id=$svid message=$msg assign="error_{$anItem.field.name}"}
    	{/foreach}
    {/if}
<tr><td align="right" width="50%">{$anItem.label}</td><td width="50%"align="left">{html_inputField type=$anItem.field.type name=$anItem.field.name value=$anItem.field.value checked=$anItem.field.checked options=$anItem.field.options selected=$anItem.field.selected}</td></tr>
	{if {"{$error_{$anItem.field.name}}"}}
    	<tr><td colspan="2" align="center"><font color="red">&nbsp;{"{$error_{$anItem.field.name}}"}</font></td></tr>
    {/if}
{/foreach}
</table>
</td>
</tr>
</table>
{/block}

{block name='userAddress'}
Type :&nbsp;{html_options name=$addrSel.name options=$addrSel.options selected=$addrSel.selected }
{$addressBody}
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
{$noProfilesMsg}
{/block}

{block name='userRequests'}
{$noRequestsMsg}
{/block}

{block name='userHistory'}
{$noHistoryMsg}
{/block}

{block name='editSuffix' }
</form>
{/block}