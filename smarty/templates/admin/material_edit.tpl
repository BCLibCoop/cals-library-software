{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<form name="editmaterialform" method="POST" action="../admin/materials_list.php">
<input type="hidden" name="mid" value="{$mid}">


	<table width="50%" class="adminTable">
		<tr>
		  <th class="left" ></th><th class="right"></th>
		</tr>
		<tr class="alt1">
		  <td align="right" class="left" >{$fields.descr.label}</td>
		  <td class="right">
		  	{validate id='v_descEmpty' message=$fields.descr.validate.v_descEmpty assign='error_descr'}
		    {html_inputField type=$fields.descr.field.type name=$fields.descr.field.name value=$fields.descr.field.value options=$fields.descr.field.options}
		  </td>
		</tr>
		{if $error_descr}
		<tr><td colspan="2" align="center"><font class="error">{$error_descr}</font></td></tr>
		{/if}
		<tr class="primary">
		  <td align="right" class="left">{$fields.img.label}</td>
		  <td class="right">
		  	{validate id='v_imgNmEmpty' message=$fields.img.validate.v_imgNmEmpty assign='error_imgNm'}
		    {html_inputField type=$fields.img.field.type name=$fields.img.field.name value=$fields.img.field.value options=$fields.img.field.options}
		  </td>
		</tr>
		{if $error_imgNm}
		<tr><td colspan="2" align="center"><font class="error">{$error_imgNm}</font></td></tr>
		{/if}
		<tr class="alt1">
		  <td align="right" class="left" >{$fields.recom.label}</td>
		  <td class="right">
		    {html_inputField type=$fields.recom.field.type name=$fields.recom.field.name value=$fields.recom.field.value checked=$fields.recom.field.checked}
		  </td>
		</tr>
		<tr class="primary">
		  <td align="right" class="left" >{$fields.deflt.label}</td>
		  <td class="right">
		    {html_inputField type=$fields.deflt.field.type name=$fields.deflt.field.name value=$fields.deflt.field.value checked=$fields.deflt.field.checked}
		  </td>
		</tr>
		
		<tr >
		  <td align="center" colspan="2" class="primary">
		     <input type="button" onClick="javascript:this.form.action='material_edit.php';this.form.submit();" value="{$submitButtonLabel}" class="button">
		    <input type="submit" value="{$cancelButtonLabel}" class="button">
		   
		  </td>
		</tr>
	</table>


</form>

{/block}