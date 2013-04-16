{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<center>
<font class="error">{$deleteConfirmMsg}</font><br/>
<form name="delmaterialmarcform" method="POST" action="material_marc_list.php?cd={$matId}">
<br><br>
	  <input type="hidden" value="{$fieldId}" name="cd">
      <input type="button" value="{$submitButtonLabel}" onclick="javascript:this.form.action='material_marc_del.php';this.form.submit();" class="button">
      <input type="submit" value="{$cancelButtonLabel}" class="button">
</form>
</center>
{/block}
