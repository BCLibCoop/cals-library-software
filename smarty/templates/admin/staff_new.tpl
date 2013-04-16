{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<br/>
<form name="newstaffform" method="POST" action="../admin/staff_list.php">
<table class="primary">
  <tr>
    <th colspan="2"></th>
  </tr>
  {foreach from=$info item=part}
  <tr >
    <td nowrap="true" align="right" class="primary">{$part.label}</td>
    <td valign="top" class="primary">
    {foreach from=$part.tabs item=auth}
    	<label>{$auth.label}{html_inputField type=$auth.field.type name=$auth.field.name value=$auth.field.value checked=$auth.field.checked  options=$auth.field.options}</label>&nbsp;&nbsp;
    {/foreach}
    {if !$part.tabs}
    	{if $part.validate}
    		{foreach from=$part.validate key=svid item=msg}
    			{validate id=$svid message=$msg assign="error_{$part.field.name}"}
    		{/foreach}
    	{/if}
    	{html_inputField type=$part.field.type name=$part.field.name value=$part.field.value checked=$part.field.checked  options=$part.field.options}
    	{if {"{$error_{$part.field.name}}"}}
    	<font color="red">&nbsp;{"{$error_{$part.field.name}}"}</font>
    	{/if}
    {/if}
    </td>
  </tr>
  {/foreach}
  <tr>
    <td align="center" colspan="2" class="primary">
      <input type="button" onClick="javascript:this.form.action='staff_new.php';this.form.submit();" value="{$submitButtonLabel}" class="button">
      <input type="submit"  value="{$cancelButtonLabel}" class="button">
    </td>
  </tr>
</table>
</form>

{/block}