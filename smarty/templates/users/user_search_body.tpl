{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{foreach from=$clients item=aClient}
<tr onclick='selectUser(this)' class='{if $aClient@iteration is even}primary{else}alt1{/if}'>
<td class='left' id='name' style='padding-left:2em'>{$aClient->fullname}</td>
<td align='center'>{$aClient->username}</td>
<td align='center'>{$aClient->phone}</td>
<td >{$aClient->address}</td>
<td align='center' class='right'>{$aClient->jadeid}</td>
<td id='uid' style='display:none'>{$aClient->userid}</td>
</tr>
{/foreach}
