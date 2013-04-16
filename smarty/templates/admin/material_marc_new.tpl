{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<form name="materialmarceditform" action="material_marc_list.php?cd={$matId}" method="post"  >
<input type="hidden" name="mid" value="{$matId}">
  
<table width="60%" class="adminTable" >
<tr>
<th class="left" width="25%"></th><th class="right"></th>
</tr>

<tr class="primary">
	{validate id='v_tagNE' message=$fields.tag.validate.v_tagNE assign='error_tag'}
	{validate id='v_tagII' message=$fields.tag.validate.v_tagII assign='error_tag'}
	{validate id='v_tagRa' message=$fields.tag.validate.v_tagRa assign='error_tag'}
	<td align="right" class="left">{$fields.tag.label}</td>
<td align="left" class="right">{html_inputField type=$fields.tag.field.type name=$fields.tag.field.name value=$fields.tag.field.value options=$fields.tag.field.options}

<input type="button" onClick="javascript:popSecondary('../catalog/usmarc_select.php?retpage=)" value="Select" class="button">
</td></tr>
{if $error_tag}
<tr><td></td><td><font class="error">{$error_tag}</font></td></tr>
{/if}

<tr class="alt1">
	{validate id='v_subfieldNE' message=$fields.subfield.validate.v_subfieldNE assign='error_subfield'}
	{validate id='v_subfieldIA' message=$fields.subfield.validate.v_subfieldIA assign='error_subfield'}
	<td align="right" class="left">{$fields.subfield.label}</td>
<td align="left" class="right">{html_inputField type=$fields.subfield.field.type name=$fields.subfield.field.name value=$fields.subfield.field.value options=$fields.subfield.field.options}

</td></tr>
{if $error_subfield}
<tr><td></td><td><font class="error">{$error_subfield}</font></td></tr>
{/if}

<tr class="primary">
	{validate id='v_descNE' message=$fields.descr.validate.v_descNE assign='error_descr'}
	<td align="right" class="left">{$fields.descr.label}</td>
<td align="left" class="right">{html_inputField type=$fields.descr.field.type name=$fields.descr.field.name value=$fields.descr.field.value options=$fields.descr.field.options}
		
</td></tr>
{if $error_descr}
<tr><td></td><td><font class="error">{$error_descr}</font></td></tr>
{/if}


<tr class="alt1">
	<td align="right" class="left">{$fields.req.label}</td>
<td align="left" class="right">{html_inputField type=$fields.req.field.type name=$fields.req.field.name value=$fields.req.field.value checked=$fields.req.field.checked}
</td></tr>

<tr class="primary">
	<td align="right" class="left">{$fields.ctrl.label}</td>
	
<td align="left" class="right">{html_inputField type=$fields.ctrl.field.type name=$fields.ctrl.field.name options=$fields.ctrl.field.options selected=$fields.ctrl.field.selected onclick=$fields.ctrl.field.onclick}
<label id="textFieldLabel" style='{if $fields.ctrl.field.selected !=0}display:none{/if}'>&nbsp;Enter the Default value.</label>
<label id="checkLabel" style='{if $fields.ctrl.field.selected !=2}display:none{/if}'>&nbsp;Enter the Checked value only.</label>
<label id="selectLabel"  style='{if $fields.ctrl.field.selected !=3}display:none{/if}'>&nbsp;Separate items with commas.</label>
<br/><input size="50" id='ctrlvalues' name='{$fields.ctrlvals.field.name}' type='text' style='{if $fields.ctrl.field.selected !=1}{else}display:none{/if}' value='{$fields.ctrlvals.field.value}' >

</td></tr>
<tr class="alt1">
	<td align="right" class="left">{$fields.show.label}</td>
<td align="left" class="right">{html_inputField type=$fields.show.field.type name=$fields.show.field.name value=$fields.show.field.value checked=$fields.show.field.checked}

</td></tr>
		<tr >
		  <td align="center" colspan="2" class="primary">
		     <input type="button" onClick="javascript:this.form.action='material_marc_new.php';this.form.submit();" value="{$submitButtonLabel}" class="button">
		    <input type="submit" value="{$cancelButtonLabel}" class="button">
		  </td>
		</tr>
</table>
</FORM>
{/block}

{block name="endScripts" append}
  <script type="text/javascript">
    <!--
	function showHideElements(val)
    {
      	document.getElementById('ctrlvalues').style.display=(val!=1)?'':'none';
		document.getElementById('checkLabel').style.display=(val==2)?'':'none';
		document.getElementById('selectLabel').style.display=(val==3)?'':'none';
		document.getElementById('textFieldLabel').style.display=(val==0)?'':'none';
		if(val==1)
        	document.getElementById('ctrlvalues').value = '';
	}
    -->
  </script>
{/block}