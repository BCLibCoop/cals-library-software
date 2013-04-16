{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
{nocache}
{foreach from=$entries item=anEntry}
<tr onclick='selectTitle(this)' class='{if $anEntry@iteration is even}primary{else}alt1{/if}' style="width:98%">
<td class='left' id='title' style='padding-left:2em;width:40%'>{$anEntry->title}</td>
<td colspan="2" style="width:40%">{$anEntry->author}</td>
<td class="right" align='center' style="width:10%;margin-right:0.25em">{$anEntry->snum}</td>
<td id='bid' style='display:none'>{$anEntry->bibid}</td>
</tr>
{/foreach}
{/nocache}
