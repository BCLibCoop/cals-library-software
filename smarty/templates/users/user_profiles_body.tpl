{* Smarty Template *}
{*debug *}

{*
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}


{foreach $profiles as $row}
<tr >
	<td style="width:150px">{$row.type}</td>
	<td style="width:300px">{$row.content}</td>
	<td style="width:50px"><img src="../images/{if $row.prefers}apply.png{else}cancel.png{/if}" alt="{if $row.prefers}{$labels.yes}{else}{$labels.no}{/if}" width="20" height="20"></td>
	<td align="center" style="width:100px">{$row.lang}</td>
</tr>
{/foreach}
