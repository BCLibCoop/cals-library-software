{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<div style="width:80%">
<input type="button" onclick="self.location='{$newMaterialButton.ref}'" value="{$newMaterialButton.label}"><br>
<table class="adminTable">
  <tr >
    <th class="left">{$columnHeaders.funcs}<font class="small">*</font></th>
    <th >{$columnHeaders.descr}</th>
    <th >{$columnHeaders.recom}</th>
    <th >{$columnHeaders.deflt}</th>
    <th >{$columnHeaders.img}</th>
    <th class="right">{$columnHeaders.bibcnt}</th>
  </tr>
{foreach from=$materials item='aMat'}
  <tr valign="middle" class="{if $aMat@iteration is even}primary{else}alt1{/if}">
  	<td class="left" >
  		<select onclick="location.href='{$funcs.baseRef}'+this.value;">
  		<option value="{$funcs.marc.ref}{$aMat->getCode()}" >{$funcs.marc.label}</option>
  		<option value="{$funcs.edit.ref}{$aMat->getCode()}" >{$funcs.edit.label}</option>
  		<option value="{$funcs.del.ref}{$aMat->getCode()}" {if $aMat->getCount()}disabled="disabled"{/if}>{$funcs.del.label}</option>
  	</select>
  	</td>
    <td>{$aMat->getDescription()}</td>
    <td align="center" {if !$aMat->getShouldRecommend()} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25" height="25">{/if}</td>
    <td align="center" {if !$aMat->getDefaultFlg()} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25" height="25">{/if}</td>
    <td ><img src="../images/{$aMat->getImageFile()}" width="25" height="25" valign="middle" alt="{$aMat->getDescription()}">&nbsp;{$aMat->getImageFile()}</td>
    <td align="center" class="right">{$aMat->getCount()}</td>
  </tr>
{/foreach}  
</table>
</div>
{/block}