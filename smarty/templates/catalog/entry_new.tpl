{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<div style="width:90%">
{* --- Basic Info --- *}
{if $entry->getIsRestricted()}
<p><font color="red">{$restrictedWarning}</font></p>
{/if}

<form id="entryeditform" method="post" action="entry_new.php">
<input type="submit" value="{$labels['submitButtonLabel']}"  />&nbsp;&nbsp;
<input type="button" value="{$labels['cancelButtonLabel']}" onclick="self.location='catalog_search.php'" />
<input type="hidden" id="chmid" name="chmid" value="">

{* --- General Info --- *}
<table class="adminTable" >
<thead>
	<tr >
		<th class="left" style="font-size: 1em">{$labels.tagLabel}</th>
		<th colspan="2" class="right" style="font-size: 1em">{$labels.generalInfoLabel}</th>
	</tr>
</thead>
<tbody>
{nocache}
{assign var="rowidx" value="1"}
{foreach from=$fields.general key="tidx" item="part"}
	{foreach from=$validators[$tidx] key="id" item="dummy"}
		{validate id=$id message=$validators[$tidx][$id].msg assign="error_fld_{$tidx}"}
	{/foreach}
	
	<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td width="8%" align="center"  class="left">{if $generalButtons[$tidx]}<input type="button" value="{$tidx}" onclick="self.location='entry_marc_edit.php?f={$entryFields[{$tidx}]->getFieldid()}'"/>{else}{$tidx}{/if}</td>
	<td width="35%" >{if $part.required}<sup>*</sup>{/if}&nbsp;{$part.desc}</td>
	<td class="right">{html_inputField type=$part.type name="flds[$tidx]" value=$part.field->getFieldData() options=$part.options}</td>
	</tr>
	{if {$error_fld_{$tidx}}}
	<tr><td colspan="3" align="center" class="error">{$error_fld_{$tidx}}</td></tr>
	{/if}
	{assign var="rowidx" value=$rowidx+1}
{/foreach}
{/nocache}
<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td class="left" ></td>
	<td style="vertical-align:top">{$labels.callNumberLabel}</td>
	<td width="50%" class="right"><input type="textfield" name="callno1"  size="20" maxlength="20" /><br/>
	<input type="textfield" name="callno2"  size="20" maxlength="20" /><br/>
	<input type="textfield" name="callno3"  size="20" maxlength="20" /></td>
	{assign var="rowidx" value=$rowidx+1}
</tr>

<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td class="left"></td>
	<td>{$labels.restrictedLabel}</td>
	<td width="50%" class="right">{html_inputField type="checkbox" value="1" name="restr" checked=$entry->getIsRestricted()}</td>
	{assign var="rowidx" value=$rowidx+1}
</tr>
<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td class="left"></td>
	<td>{$labels.showInOpacLabel}</td>
	<td width="50%" class="right">{html_inputField type="checkbox" value="1" name="showinopac" checked=$entry->showInOpac()}</td>
	{assign var="rowidx" value=$rowidx+1}
</tr>
<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td class="left"></td>
	<td>{$labels.saleableLabel}</td>
	<td width="50%" class="right">{html_inputField type="checkbox" value="1" name="saleable" checked=$entry->getIsSaleable()}</td>
	{assign var="rowidx" value=$rowidx+1}
</tr>

<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td class="left"></td>
	<td>{$collectionType['label']}</td>
	<td width="50%" class="right">{html_inputField type="select" name="colid" selected=$collectionType.selected options=$collections}</td>
	{assign var="rowidx" value=$rowidx+1}
</tr>
<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td class="left"></td>
	<td>{$materialType.label}</td>
	<td width="50%" class="right">{html_inputField type="select" name="matid" selected=$materialType.selected options=$materials  onchange="doMaterialChange(this.value);"}</td>

</tr>
</tbody>
</table>



{* --- Material specific  Info --- *}

<p>
<div id="materialFields">
<table class="adminTable" >
<thead>
	<tr >
		<th class="left" style="font-size: 1em">{$labels.tagLabel}</th>
		<th colspan="2" class="right" style="font-size: 1em">{$labels.materialFieldsLabel}</th>
	</tr>
</thead>
{nocache}
<tbody>
{if $fields.material}
{foreach from=$fields.material key="tidx" item="part"}
	{foreach from=$validators[$tidx] key="id" item="dummy"}
			{validate id=$id message=$validators[$tidx][$id].msg assign="error_fld_{$tidx}"}
	{/foreach} 
	
	<tr class="{if $part@iteration is even}primary{else}alt1{/if}" >
	<td class="left" align="center"  width="8%">{if $part.required}<sup>*</sup>{/if}&nbsp;{$tidx}</td>
	<td width="35%" >{if $part.required}<sup>*</sup>{/if}{$part.desc}</td>
	<td class="right">{html_inputField type=$part.type name="flds[$tidx]" value=$part.value selected=$part.selected checked=$part.checked options=$part.options id="flds[$tidx]"}</td></tr>

	{if {$error_fld_{$tidx}}}
	<tr><td align="center" colspan="3" class="error">{$error_fld_{$tidx}}</td></tr>
	{/if}
{/foreach}
{else}
<tr><td colspan="3" align="center">{$labels.noMaterialsLabel}</td></tr>
{/if}

</tbody>
{/nocache}
</table>
</div>
</p>

{* --- Additional Info --- *}
<p>
<table class="adminTable" >
<thead>
	<tr>
		<th class="left" style="font-size: 1em">{$labels.tagLabel}</th>
		<th colspan="2" class="right" style="font-size: 1em">{$labels.additionalInfoLabel}</th>
	</tr>
</thead>
<tbody>
{nocache}
{assign var="rowidx" value="1"}
{foreach from=$fields.other key="tidx" item="part"}
	{foreach from=$validators[$tidx] key="id" item="dummy"}
		{validate id=$id message=$validators[$tidx][$id].msg assign="error_fld_{$tidx}"}
	{/foreach}		
	<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td align="center" class="left" width="8%">{$tidx}</td>
	<td width="35%" >{if $part.required}<sup>*</sup>{/if}&nbsp;{$part.desc}</td>
	<td class="right">{html_inputField type=$part.type name="flds[$tidx]" id="flds[$tidx]" value=$part.field->getFieldData() options=$part.options}{$part.postLabel}
	{if $tidx == '035a'}&nbsp;<input type='button' onclick="getNextSysNum();" value="{$labels.nextSysNumLabel}">{/if}
	</td></tr>
	{if {$error_fld_{$tidx}}}<tr><td align="center" colspan="3" class="error">{$error_fld_{$tidx}}</td></tr>{/if}
	{assign var="rowidx" value=$rowidx+1}
{/foreach}
{nocache}
</tbody>
</table>
</p>

</form>
</div>

{/block}

{block name="endScripts"}
<script type="text/javascript" src="{$APP_ROOT}/javascript/tableFuncs.js"></script>	
<script type="text/javascript" src="{$APP_ROOT}/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/innershiv.js"></script>

<script type="text/javascript">
{literal}
<!--
	Agent.prototype.method = 'POST';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;
    
    var updateSysNum = new Agent();
	
	updateSysNum.success = function ( resp ) { 		
 		document.getElementById("flds[035a]").value = resp;
	
	}
	
	function getNextSysNum()
	{
		updateSysNum.set_action('update_sys_num.php'+'?'+new Date().getTime());
		updateSysNum.method = "GET";
		updateSysNum.request('');
	}

	function doMaterialChange(val)
	{
		document.getElementById("chmid").value = val;
	    document.forms("entryeditform").submit();		
	}	

-->
{/literal}
</script>

{/block}
