{* Smarty Template *}
{*debug *}




{extends file="private/opac_layout.tpl"}
{block name="content"}
<div style="width:100%;margin:10px 10% 0 10%;">
<div style="width:80%;" align="center">

<p><h2>Please enter your username and password.</h2><br/>
Upon successful validation of your details you will be returned to the previous page,<br>where you can
then click the link to obtain the book.
</p>
<form name="loginform" method="POST" action="login.php">

<p class="redbar">{$labels.header}</p>


<table class="primary" style="width:40%">	
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
  </tr>
  </tbody>
</table>

    {validate id='v_login' message={$labels.invalidLogin} assign='error_login'}
  {if $error_login}
  <p><font class="error">{$error_login}</font></p>
  {/if}
        <input type="submit" value="{$labels.button}" class="button">

</form>

</div>
</div>
{/block}