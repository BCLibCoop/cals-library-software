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
<h3>
{if $entryFields['245a']} {* title *}
	{$entryFields['245a']->getFieldData()}&nbsp;
{/if}
{if $entryFields['245b']} {* title remainder *}
	{$entryFields['245a']->getFieldData()}&nbsp;
{/if}
{if $entryFields['035a']} {* System Number *}
	{$entryFields['035a']->getFieldData()}&nbsp;
{/if}
</h3>
{if $entryFields['520a']} {* Short Description *}
<p>{$entryFields['520a']->getFieldData()}</p>
{/if}
{if $entry->getIsRestricted()}
<p><font color="red">{$restrictedWarning}</font></p>
{/if}

{* --- Copies Info --- *}
<input type="button" value="{$labels['newCopyButtonLabel']}" onclick="self.location='entry_copy_new.php?bid={$bibid}'" />&nbsp;&nbsp;

{if $copies}
<input disabled="disabled" id="editcopybutton" type="button" value="{$labels['editCopyButtonLabel']}" onclick="doEditCopy();" />&nbsp;&nbsp;
<input disabled="disabled" id="delcopybutton" type="button" value="{$labels['delCopyButtonLabel']}" onclick="doDeleteCopy();" />
<label><input disabled="disabled" type="checkbox" id="delcopyconfchk" onclick="setDeleteCopyButton(this);" />&nbsp;{$labels.deleteConfirmCopyLabel}</label>
<input type="hidden" id="hcopyid" />
<table class="adminTable" style="width:60%">
<thead>
	<tr>
		<th class="left">{$labels["copyTypeLabel"]}</th>
		<th>{$labels["copySizeLabel"]}</th>
		<th class="right">{$labels["copyReadingTimeLabel"]}</th>

	</tr>
</thead>
<tbody>
{nocache}
{foreach from=$copies key="idx" item="aCopy"}
	<tr onclick="selectCopy(this);" class="{if $aCopy@iteration is even}primary{else}alt1{/if}">
	{if $copiesExtraInfo[$idx]['errMsg']}
		<td colspan="3" class="both" align="center">{$copiesExtraInfo[$idx]['errMsg']}</td>
		<td id="copyid" style="display:none">{$aCopy->getCopyId()}</td>
	{else}
		<td class="left" width="50%">{$aCopy->getDescription()}</td>
		<td>{$copiesExtraInfo[$idx]['fileSize']}</td>
		<td class="right">{$copiesExtraInfo[$idx]['playTime']}</td>
		<td id="copyid" style="display:none">{$aCopy->getCopyId()}</td>
	{/if}
	</tr>
{/foreach}
{/nocache}
</tbody>
</table>
{else}
&nbsp;&nbsp;{$labels["noCopiesFoundMsg"]}<br/>
{/if}

{* --- General Info --- *}
<br/>
<input type="button" value="{$labels['editBasicButtonLabel']}" onclick="self.location='entry_edit.php?bid={$bibid}'" />&nbsp;&nbsp;
<input type="button" value="{$labels['newLikeButtonLabel']}" onclick="self.location='entry_new_like.php?bid={$bibid}'" />&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" disabled="disabled" id="delentrybutton" value="{$labels['deleteButtonLabel']}" onclick="self.location='entry_delete.php?bid={$bibid}'" />
<label><input type="checkbox" id="delconfchk" onclick="setDeleteEntryButton(this);" />&nbsp;{$labels.deleteConfirmLabel}</label>
<table class="adminTable" style="width:90%">
<thead>
	<tr>
		<th colspan="2" class="both">{$labels["generalInfoLabel"]}</th>
	</tr>
</thead>
<tbody>
{nocache}
{assign var="rowidx" value=1}
{foreach from=$generalFields item="gidx"}
	{if $tagDescs[$gidx]}
	<tr class="{if $rowidx is even}primary{else}alt1{/if}"><td width="50%" class="left">{$tagDescs[$gidx]}</td><td class="right">{$entryFields[$gidx]->getFieldData()}</td></tr>
	{assign var="rowidx" value=$rowidx+1}
	{/if}
{/foreach}
{/nocache}
<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td class="left"  style="vertical-align:top">{$labels.callNumberLabel}</td>
	<td width="50%" class="right">{$entry->getCallNmbr1()}<br/>
	{$entry->getCallNmbr2()}<br/>
	{$entry->getCallNmbr3()}</td>
{assign var="rowidx" value=$rowidx+1}
</tr>
<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td class="left" >{$labels.restrictedLabel}</td>
	<td width="50%" class="right">{if $entry->getIsRestricted()}{$labels.yesLabel}{else}{$labels.noLabel}{/if}<br></td>
{assign var="rowidx" value=$rowidx+1}
</tr>
<tr class="{if $rowidx is even}primary{else}alt1{/if}">
	<td class="left">{$labels.showInOpacLabel}</td>
	<td width="50%" class="right">{if $entry->showInOpac()}{$labels.yesLabel}{else}{$labels.noLabel}{/if}</td>
{assign var="rowidx" value=$rowidx+1}
</tr>
<tr class="{if $rowidx is even}primary{else}alt1{/if}">

	<td class="left">{$labels.saleableLabel}</td>
	<td width="50%" class="right">{if $entry->getIsSaleable()}{$labels.yesLabel}{else}{$labels.noLabel}{/if}</td>
{assign var="rowidx" value=$rowidx+1}
</tr>
<tr class="{if $rowidx is even}primary{else}alt1{/if}"><td class="left">{$labels.audience}</td><td width="50%" class="right">{$audience}</td>
{assign var="rowidx" value=$rowidx+1}
</tr>
<tr class="{if $rowidx is even}primary{else}alt1{/if}"><td class="left">{$labels.material}</td><td width="50%" class="right">{$material}</td>
{assign var="rowidx" value=$rowidx+1}
</tr>
<tr class="{if $rowidx is even}primary{else}alt1{/if}"><td class="left">{$labels.collection}</td><td width="50%" class="right">{$collection}</td>
{assign var="rowidx" value=$rowidx+1}
</tr>

</tbody>
</table>

{* --- Additional Info --- *}
<p>
<table class="adminTable" style="width:90%">
<thead>
	<tr>
		<th colspan="2" class="both">{$labels["additionalInfoLabel"]}</th>
	</tr>
</thead>
<tbody>
{nocache}
{assign var="rowidx" value=1}
{foreach from=$entryFields key="eidx" item="aField"}
	{* dont redisplay the general info items *}
	{if !$generalFields[$eidx]}
	<tr class="{if $rowidx is even}primary{else}alt1{/if}"><td width="50%" class="left">{$tagDescs[$eidx]}</td><td class="right">{$aField->getFieldData()}</td></tr>
	{assign var="rowidx" value=$rowidx+1}
	{/if}
{/foreach}
{/nocache}
</tbody>
</table>
</p>


</div>

{/block}

{block name="endScripts"}
<script type="text/javascript" src="{$APP_ROOT}/javascript/tableFuncs.js"></script>
<script type="text/javascript">
{literal}
<!--
	document.getElementById("delconfchk").checked = false;
	document.getElementById("delcopyconfchk").checked = false;

	function selectCopy(el)
	{
		if (el.cells['copyid']!=undefined)
		{
			HighlightRowText(el,'#ee2222');
			document.getElementById("editcopybutton").disabled = false;
			document.getElementById("delcopyconfchk").disabled = false;
			document.getElementById("hcopyid").value = el.cells['copyid'].innerHTML;
		}
	}

	function doEditCopy()
	{
		self.location = 'entry_copy_edit.php?cid='+document.getElementById("hcopyid").value;
	}
	function doDeleteCopy()
	{
		self.location = 'entry_copy_delete.php?cid='+document.getElementById("hcopyid").value;
	}
	function setDeleteCopyButton(el)
	{
		document.getElementById("delcopybutton").disabled = !el.checked;
	}

	function setDeleteEntryButton(el)
	{
		document.getElementById("delentrybutton").disabled = !el.checked;
	}

-->
{/literal}
</script>

{/block}
