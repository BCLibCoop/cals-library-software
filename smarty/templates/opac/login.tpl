{* Smarty Template *}
{*debug *}




{extends file="private/opac_layout.tpl"}
{block name="content"}
<div style="width:100%;margin:20px 20% 0 20%;">
<div style="width:80%;">

<p><h2>Please enter your username and password.</h2><br/>
<strong>Upon successful validation of your details you will be returned to the previous page,<br>where you can
then click the link to obtain the book.</strong>
</p>
<form name="loginform" method="POST" action="login.php">
<table class="primary" style="width:40%">
	<thead>
  	<tr>
    <th colspan="2">{$labels.header}</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td class="primary" >{$labels.username}</td>
    <td class="primary">
      <input type="text" name="uname" size="20" maxlength="40" value="" >
    </td>
  </tr>
  <tr>
    <td class="primary">{$labels.password}</td>
    <td class="primary"><input type="password" name="pwd" size="20" maxlength="20" value="" ></td>
    {validate id='v_login' message={$labels.invalidLogin} assign='error_login'}

  </tr>
  {if $error_login}
  <tr><td class="primary" colspan="2" style="text-align:center;"><font class="error">{$error_login}</font></td></tr>
  {/if}
  <tr>
    <td colspan="2" align="center" class="noborder">
      <input type="submit" value="{$labels.button}" class="button">
    </td>
  </tr>
</tbody>
</table>
</form>

</div>
</div>
{/block}