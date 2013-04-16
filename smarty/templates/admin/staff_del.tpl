{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<center>
<font class="error">{$deleteConfirmMsg}</font><br/>
<form name="delstaffform" method="POST" action="staff_list.php">
<br><br>
	  <input type="hidden" value="{$staffId}" name="id">
      <input type="button" value="{$submitButtonLabel}" onclick="javascript:this.form.action='staff_del.php';this.form.submit();" class="button">
      <input type="submit" value="{$cancelButtonLabel}" class="button">
</form>
</center>
{/block}
