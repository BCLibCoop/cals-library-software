{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<center>
<font class="error">{$deleteConfirmMsg}</font><br/>
<form name="delcollectionform" method="POST" action="collections_list.php">
<br><br>
	  <input type="hidden" value="{$collId}" name="cd">
      <input type="button" value="{$submitButtonLabel}" onclick="javascript:this.form.action='collection_del.php';this.form.submit();" class="button">
      <input type="submit" value="{$cancelButtonLabel}" class="button">
</form>
</center>
{/block}
