{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}


<form name="editstaffform" method="POST" action="staff_list.php">
<input type="hidden" name="uid" value="{$staffid}">
<table width="50%" class="adminTable">
  <tr>
    <th align="left" ></th><th align="right" ></th>
  </tr>
  {foreach from=$info item=part}
  <tr >
    <td nowrap="true" align="right" class="primary">{$part.label}</td>
    <td valign="top" class="primary">
    {foreach from=$part.tabs item=auth}
    	{$auth.label}{html_inputField type=$auth.field.type name=$auth.field.name value=$auth.field.value checked=$auth.field.checked options=$auth.field.options}&nbsp;{$aSetting.postLabel}
    {/foreach}
    {if !$part.tabs}
    	{if $part.validate}
    		{foreach from=$part.validate key=svid item=msg}
    			{validate id=$svid message=$msg assign="error_{$part.field.name}"}
    		{/foreach}
    	{/if}
    	{html_inputField type=$part.field.type name=$part.field.name value=$part.field.value checked=$part.field.checked options=$part.field.options}
    	<font color="red">&nbsp;{"{$error_{$part.field.name}}"}</font>
    {/if}
    </td>
  </tr>
  {/foreach}
  <tr>
    <td align="center" colspan="2" class="primary">
      <input type="button" onClick="javascript:this.form.action='staff_edit.php';this.form.submit();" value="{$submitButtonLabel}" class="button">
      <input type="submit"  value="{$cancelButtonLabel}" class="button">
    </td>
  </tr>
</table>
</form>
{/block}



