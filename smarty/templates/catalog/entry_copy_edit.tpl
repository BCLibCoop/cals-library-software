{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}


{extends file='private/admin_layout.tpl'}

{block name='content' append}

<form name="editCopyForm" method="POST" action="entry_copy_edit.php">
<table class="primary">
  <tr>
    <th colspan="2" nowrap="yes" align="left">{$labels.form}
    </th>
  </tr>
  <tr>
    <td nowrap="true" class="primary" valign="middle"><sup>*</sup>{$fields.path.label}&nbsp;:</td>
    <td valign="top" class="primary">
     {validate id="v_pathEmpty" message=$fields.path.validate.msg assign="error_filepath"}
      {html_InputField type=$fields.path.field.type name=$fields.path.field.name value=$fields.path.field.value options=$fields.path.field.options}
    </td>
  </tr>
  	{if $error_filepath}
    	<tr><td colspan="2" align="center"><font color="red">{"{$error_filepath}"}</font></td></tr>
    {/if}	

    <tr>
    <td class="primary" valign="middle" align="right">{$fields.format.label}&nbsp;:</td>
    <td valign="top" class="primary">
     {html_InputField type=$fields.format.field.type name=$fields.format.field.name selected=$fields.format.field.selected options=$fields.format.field.options}
    </td>
  	</tr>   	
    <tr>
    <td class="primary" valign="middle" align="right">{$fields.content.label}&nbsp;:</td>
    <td valign="top" class="primary">
     {html_InputField type=$fields.content.field.type name=$fields.content.field.name selected=$fields.content.field.selected options=$fields.content.field.options}
    </td>
  	</tr>   
<tr><td colspan="2" align="center"><input type="submit" value="{$labels.submitButton}" />&nbsp;&nbsp;<input type="button" value="{$labels.cancelButton}" onclick="self.location='entry_view.php?bid={$bibid}'" /></td></tr>
</table>
<input type="hidden" name="cid" value="{$copyid}">

</form>


{/block}