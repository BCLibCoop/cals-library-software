{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
{nocache}
{foreach from=$devsInfo item=aDev}
<tr onclick="storeVals(this);" class="{if $aDev@iteration is even}primary{else}alt1{/if}">
<td  class="left" id="uname" >{if $aDev->uname}{$aDev->uname}{else}{$labels.notAssigned}{/if}</td>
<td  class="right" id="encid" align="center">{$aDev->barcd}</td>
<td id="devid" style="display:none">{$aDev->devid}</td>
</tr>
{/foreach}
{nocache}