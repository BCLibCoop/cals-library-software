{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<div style="width:50%">
<form name="editsettingsform" method="POST" action="settings_edit.php">
<table width="70%" class="adminTable" >
<tr ><th class="left"></th><th class="right"></th></tr>

{foreach $settings item='aSetting'}
<tr class="{if $aSetting@iteration is even}primary{else}alt1{/if}">
	<td class="left" align="right">{$aSetting.label}&nbsp;</td>
	<td class="right" >
	{foreach from=$aSetting.validate key='vid' item='msg'}
	{validate id=$vid message=$msg assign="error_{$aSetting.field.name}"}	
	{/foreach}
	{html_inputField type=$aSetting.field.type name=$aSetting.field.name value=$aSetting.field.value checked=$aSetting.field.checked options=$aSetting.field.options}&nbsp;{$aSetting.postLabel}
	{if $error_{$aSetting.field.name}}
	<br/><font color="red">&nbsp;{"{$error_{$aSetting.field.name}}"}</font>
	{/if}
	</td>
</tr>
{/foreach}


  <tr>
    <td align="center" colspan="2" class="primary">
      <input type="submit" value="{$submitButtonLabel}" class="button">
    </td>
  </tr>

</table>
      
</form>
</div>
{/block}
