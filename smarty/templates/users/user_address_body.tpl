{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
<br/>
<table width="100%">
    {foreach $addrFields as $aField}
    <tr >
    	<td width="30%" align="right">{$aField.label}</td>
    	<td width="70%" align="left">
    	{if $aField.field}
    		{html_inputField type=$aField.field.type name=$aField.field.name value=$aField.field.value options=$aField.field.options}
    	{else}
    		{$aField.value}
    	{/if}
    	</td>
    </tr>
{/foreach}
</table>

