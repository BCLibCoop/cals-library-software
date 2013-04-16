{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<input type="button" onclick="self.location='{$newCollectionButton.ref}'" value="{$newCollectionButton.label}"><br>

<div style="width:50%">
<table  class="adminTable">
  <tr >
    <th class="left" width="10%" >{$columnHeaders.funcs}<font class="small">*</font></th>
    <th width="50%">{$columnHeaders.desc}</th>
    <th width="5%" >{$columnHeaders.count}</th>
    <th class="right" width="5%" >{$columnHeaders.deflt}</th>
  </tr>

  {foreach from=$collections item=aColl}
    <tr class="{if $aColl@iteration is even}primary{else}alt1{/if}">
    <td class="left" >
  		<select onclick="location.href='{$funcs.baseRef}'+this.value;">
  			<option value="{$funcs.edit.ref}{$aColl->getCode()}" >{$funcs.edit.label}</option>
  			<option value="{$funcs.del.ref}{$aColl->getCode()}" {if $aColl->getCount()}disabled="disabled"{/if}>{$funcs.del.label}</option>
  	</select>
  	</td>
    <td >{$aColl->getDescription()}</td>
    <td align="center">{$aColl->getCount()}</td>
    <td class="right" align="center" {if !$aColl->getDefaultFlg()} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25" height="25">{/if}</td>
  </tr>
  {/foreach}

</table>

<br>
<table class="primary"><tr><td valign="top" class="noborder">
<font class="small">{$collNote.label}</font></td>
<td class="noborder"><font class="small">{$collNote.text}<br></font>
</td></tr></table>

</div>
{/block}
