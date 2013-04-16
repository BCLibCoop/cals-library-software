{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{if $devsInfo}
{foreach from=$devsInfo item=aDev}
<tr class="{if $aDev@iteration is even}primary{else}alt1{/if}" onmouseover="storeVals(this);">
<td  class="left" id="uname" >
{if $aDev->getValidated()}
	{if $aDev->getUserId()}
	{html_inputField type=$funcs.edit.field.type options=$funcs.edit.field.options value=$funcs.edit.field.value}&nbsp;&nbsp;{$aDev->getUserFullname()}
	{else}
	{html_inputField type=$funcs.assign.field.type options=$funcs.assign.field.options value=$funcs.assign.field.value}&nbsp;&nbsp;{$funcs.assign.value}
	{/if}
{else}
{html_inputField type=$funcs.add.field.type options=$funcs.add.field.options value=$funcs.add.field.value}&nbsp;&nbsp;{$funcs.add.value}
{/if}
</td>
<td  class="right" id="mntpnt" align="center">{$aDev->getMountPoint()}</td>
<td id="rowdevid" style="display:none">{$aDev->getDeviceId()}</td>
<td id='rowser' style='display:none'>{$aDev->getSerialNumber()}</td>
<td id='rowvend' style='display:none'>{$aDev->getVendorCode()}</td>
<td id='rowprod' style='display:none'>{$aDev->getProductCode()}</td>	  
</tr>
{/foreach}
{else}
<tr><td colspan="2">No Devices Found</td></tr>
{/if}


