{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<input type="button" onclick="self.location='{$newMarcButton.ref}'" value="{$newMarcButton.label}">
<br>

<div style="width:90%" >
<table  width="90%" class="adminTable">
  <tr >
    <th width="10%" class="left" >{$columnHeaders.funcs}<font class="small">*</font></th>
    <th width="2%">{$columnHeaders.tag}</th>
	<th width="2%">{$columnHeaders.subfield}</th>
	<th width="35%">{$columnHeaders.descr}</th>
	<th width="15%">{$columnHeaders.fld}</th>
	<th width="20%">{$columnHeaders.fldVals}</th>
	<th width="5%">{$columnHeaders.req}</th>
    <th width="5%" class="right"  >{$columnHeaders.show}</th>
  </tr>

  {foreach from=$fields item=aField}
    <tr class="{if $aField@iteration is even}primary{else}alt1{/if}">
    <td width="10%" class="left" >
  		<select onclick="location.href='{$funcs.baseRef}'+this.value;">
  			<option value="{$funcs.edit.ref}{$aField->xrefid}" >{$funcs.edit.label}</option>
  			<option value="{$funcs.del.ref}{$aField->xrefid}" >{$funcs.del.label}</option>
  	</select>
  	</td>
    <td width="2%" align="center">{$aField->tag}</td>
    <td width="2%" align="center">{$aField->subfieldCd}</td>
    <td width="35%">{$aField->descr}</td>
    <td width="15%" align="center">{$ctrlTypes[{$aField->ctrltype}]}</td>
    <td width="32%">{$aField->ctrlvalues}</td>
    <td width="2%" align="center" {if !$aField->required} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25px" height="25px">{/if}</td>
    <td width="2%" class="right" align="center" {if !$aField->show_in_opac} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25px" height="25px">{/if}</td>
 
  </tr>
  {/foreach}

</table>
</div>

{/block}
