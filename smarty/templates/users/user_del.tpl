{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<center>
<font class="error">{$deleteConfirmMsg}</font><br/>
<form name="delform" method="get" action="user_view.php?uid={$uid}">
<br><br>
	  <input type="hidden" value="{$uid}" name="uid">
	  <input type="hidden" value="{$postedVal.value}" name="{$postedVal.name}">
      <input type="button" value="{$submitButton.label}" onclick="{$submitButton.onclick}" >
      <input type="submit" value="{$cancelButton.label}" >
</form>
</center>
{/block}

