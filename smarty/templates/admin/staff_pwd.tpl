{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<form name="pwdresetform" method="POST" action="../admin/staff_list.php">
<input type="hidden" name="uid" value="{$staffid}">


<table width="45%" class="primary">
  <tr>
    <th colspan="2" ></th>
  </tr>
  <tr>
    <td nowrap="true"  align="right">{$info.pass.label}</td>
    <td >
     {validate id="passEmpty" message=$info.pass.validate.passEmpty assign="passMsg"}
     
      <input type="password" name="pass" size="20" maxlength="20" value="{$info.pass.value}">
 	</td>
 </tr>	
 {if $passMsg}
    <tr><td></td><td><font class="error">{$passMsg}</font></td></tr>
 {/if}
 
  <tr>
    <td nowrap="true" align="right"> {$info.pass2.label}</td>
    <td >
    {validate id="pass2Empty" message=$info.pass2.validate.pass2Empty assign="pass2Msg"}
    {validate id="passNE" message=$info.pass2.validate.passNE assign="pass2Msg"}
    <input type="password" name="pass2" size="20" maxlength="20" value="{$info.pass2.value}">
	</td>
  </tr>	
  {if $pass2Msg}
    <tr><td></td><td><font class="error">{$pass2Msg}</font></td></tr>
  {/if}
  
  <tr>
    <td align="center" colspan="2" class="primary">
      
      <input type="button" onClick="javascript:this.form.action='staff_pwd.php';this.form.submit();" value="{$submitButtonLabel}" class="button">
      <input type="submit" value="{$cancelButtonLabel}" class="button">
    </td>
  </tr>
</table>




</form>
{/block}

