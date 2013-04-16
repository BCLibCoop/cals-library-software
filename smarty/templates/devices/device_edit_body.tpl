{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
{nocache}
{foreach from=$clientNames item=aName}
<tr onclick="updateInfo(this);" class="{if $aName@iteration is even}primary{else}alt1{/if}">
<td class="both" colspan="3"  id="name" style="padding-left:5em">{$aName->fullname}</td>
<td id="uid" style="display:none">{$aName->userid}</td>
<td id="uname" style="display:none">{$aName->username}</td>
</tr>
{/foreach}
{/nocache}