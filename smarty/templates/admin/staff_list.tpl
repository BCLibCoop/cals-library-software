{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}

{block name='content' append}
<div style="width:80%">
<input type="button" onclick="self.location='{$addNewStaffButton.ref}'" value="{$addNewStaffButton.label}">
<table class="adminTable">
  <tr>
  	{foreach from=$adminStaffListColumnHeaders key=k item=label}
    <th  class="{if $label@first}left{elseif $label@last}right{/if}"
    	{if $k=='function'}
    	rowspan="2" 
    	{elseif $k=='auth'}
    	colspan="5"
    	{else}
    	rowspan="2"  nowrap="yes"
    	{/if}>
    	{$label}
    </th>
    {/foreach}
  </tr>
  <tr>
      {foreach from=$adminStaffListTabNames item=label}
      <th>
      {$label}
      </th>
      {/foreach}
  </tr>
	{foreach from=$staffList key="col" item="member"}
  	<tr class="{if $member@iteration is even}primary{else}alt1{/if}" >
  		    <td class="left">
  		<select onclick="location.href='{$funcs.baseRef}'+this.value;">
  			<option value="{$funcs.edit.ref}{$member.id}" >{$funcs.edit.label}</option>
  			<option value="{$funcs.pwd.ref}{$member.id}" >{$funcs.pwd.label}</option>
  			<option value="{$funcs.del.ref}{$member.id}" >{$funcs.del.label}</option>
  	</select>
  	</td>

    	<td align="center" >{$member.surname}</td>
    	<td align="center" >{$member.firstname}</td>
   		<td align="center" >{$member.username}</td>
    	<td align="center" {if !$member.users} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25" height="25">{/if}</td>
    	<td align="center" {if !$member.devices} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25" height="25">{/if}</td>
    	<td align="center" {if !$member.catalog} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25" height="25">{/if}</td>
    	<td align="center" {if !$member.admin} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25" height="25">{/if}</td>
   		<td align="center" {if !$member.reports} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25" height="25">{/if}</td>
    	<td align="center" class="right"{if !$member.suspended} alt="{$labels.no.label}">{else}><img src="../images/{$labels.yes.image}" alt="{$labels.yes.label}" width="25" height="25">{/if}</td>
 	</tr>
  {/foreach}
</table>
</div>
{/block}
