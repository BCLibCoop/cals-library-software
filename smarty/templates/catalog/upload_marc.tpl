{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
 

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<div style="width:60%">
<form enctype="multipart/form-data" action="upload_marc.php" method="post">

<b>{$labels.defaults}&nbsp;:</b>
<table class="adminTable"/>
<tbody>
<tr><td style="width:20%" align="right">{$labels.material}&nbsp;:&nbsp;</td><td style="width:80%" align="left">{html_inputField type="select" name="matid" selected=$selMatId options=$materials}</td></tr>
<tr><td style="width:20%" align="right">{$labels.collection}&nbsp;:&nbsp;</td><td style="width:80%" align="left">{html_inputField type="select" name="colid" selected=$selColId options=$collections}</td></tr>
<tr><td style="width:20%" align="right">{$labels.showOpac}&nbsp;:&nbsp;</td><td style="width:80%"  align="left">{html_inputField type="checkbox" value="1" name="opac" checked={$opacChecked}} </td></tr>
<tr><td colspan="2"></td></tr>
<tr><td style="width:20%" align="right">{$labels.testUpload}&nbsp;:&nbsp;</td><td style="width:80%"  align="left">{html_inputField type="checkbox" value="1" name="test" checked=$testChecked}&nbsp;&nbsp;&nbsp;{$labels.testNote}</td></tr>

</tbody>

</table>
<br/>
{$labels.uploadFile}&nbsp;:&nbsp;<input type="file" name="datafiles"><br><br>
  <input type="submit" value="{$labels.submit}">
</form>

<br/>
{nocache}
{foreach from=$testRecords item="record"}
<h2>{$labels.marcRecord}</h2>
<table class="adminTable">
<thead>
	<th>{$labels.tag}</th>
	<th>{$labels.subfld}</th>
	<th>{$labels.data}</th>
</thead>
<tbody>
{foreach from=$record->getBiblioFields() key="tag" item="field"}
<tr class="{if $field@iteration is even}primary{else}alt1{/if}"><td class="left">{$field->getTag()}</td><td>{$field->getSubfieldCd()}</td><td class="right">{$field->getFieldData()}</td></tr>
{/foreach}
</tbody>
</table>
<br/>
{/foreach}
{/nocache}
</div>

{/block}


