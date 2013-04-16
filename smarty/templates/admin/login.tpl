{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<br>
<center>
<form name="loginform" method="POST" action="../admin/adminLogin.php">
<table width="40%">
	<tr>
	<td>
	
	<table class="primary">
	<tr>
    	<th colspan="2">{$formHeader}</th>
  	</tr>
	<tr>
    	<td valign="top" class="noborder">{$usernameLabel}</td>
    	<td valign="top" class="noborder">
    	
      	<input type="text" name="uname" size="20" maxlength="20" value="" >
    </td>
  	</tr>
  	<tr>
    	<td valign="top" class="noborder">{$passwordLabel}</td>
    	<td valign="top" class="noborder">
      	{validate id='v_login' message={$invalidLoginMsg} assign='error_login'} 
      	<input type="password" name="pwd" size="20" maxlength="20" value="" >
      	{if $error_login}
      	<font class="error">{$error_login}</font>
      	{/if}
    </td>
  </tr>

  <tr>
    <td colspan="2" align="center" class="noborder">
      <input type="submit" value="{$submitButtonLabel}" class="button">
    </td>
  </tr>
</table>
</td>
	</tr>
</table>

</form>
</center>
{/block}
