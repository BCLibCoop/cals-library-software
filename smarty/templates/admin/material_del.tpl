{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<center>
<font class="error">{$deleteConfirmMsg}</font><br/>
<form name="delmaterialform" method="POST" action="materials_list.php">
<br><br>
	  <input type="hidden" value="{$matId}" name="cd">
      <input type="button" value="{$submitButtonLabel}" onclick="javascript:this.form.action='material_del.php';this.form.submit();" class="button">
      <input type="submit" value="{$cancelButtonLabel}" class="button">
</form>
</center>
{/block}
