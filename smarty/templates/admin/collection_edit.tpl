{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<div style="width:50%">
<form name="editcollectionform" method="POST" action="../admin/collections_list.php">
<input type="hidden" name="cid" value="{$cid}">

<table class="adminTable">
    <tr>
      <th class="left" ></th><th class="right"></th>
    </tr>
    <tr class="primary">
      <td align="right" class="left">{$fields.descr.label} :</td>
      <td  class="right">
      	{validate id='v_descEmpty' message=$fields.descr.validate.msg assign='error_descr'}
        {html_inputField type=$fields.descr.field.type name=$fields.descr.field.name value=$fields.descr.field.value options=$fields.descr.field.options}
      </td>
    </tr>
    {if $error_descr}
    <tr><td colspan="2" align="center"><font class="error">{$error_descr}</font></td></tr>
    {/if}
    <tr class="alt1">
      <td align="right"  class="left">{$fields.deflt.label}? :</td>
      <td class="right">
        {html_inputField type=$fields.deflt.field.type name=$fields.deflt.field.name value=$fields.deflt.field.value checked=$fields.deflt.field.checked}
      </td>
    </tr>
    <tr>
      <td align="center" colspan="2" >
         <input type="button" onClick="javascript:this.form.action='collection_edit.php';this.form.submit();" value="{$submitButtonLabel}" class="button">
        <input type="submit" value="{$cancelButtonLabel}" class="button">
       
      </td>
    </tr>
</table>


</form>
</div>
{/block}