{* Smarty Template *}
{*
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
{extends file='private/opac_layout.tpl'}
{block name='content'}
{*debug*}
<div style="margin:0 5% 0 5%;">
<input class="button" type="button" value="Back to Results" onClick="window.history.back()">
<input class="button" type="button" value="Back to Search" onClick="js:self.location='index.php'">
{* --- Basic Info --- *}
<div style="width:100%;clear:both;">
<div style="width:85%;float:left">
<h1 style="clear:both;">
{if $fields['general']['245a']} {* title *}
	{$fields['general']['245a']['data']}
{/if}
{if $fields['general']['245b']} {* title remainder *}
&nbsp;{$fields['general']['245b']['data']}
{/if}
{if $fields['general']['035a']} {* System Number *}
&nbsp;{$fields['general']['035a']['data']}
{/if}
</h1>
{if $fields['general']['520a']} {* Short Description *}
<p>{$fields['general']['520a']['data']}</p>
{/if}
{if $restricted}
<p><font color="red">{$labels.restrictedMessage}</font></p>
{/if}
</div>
<div style="width:15%;float:right">

<img src="data:image/png;base64,{$qrcode}"/>
</div>
</div>

<!-- <div style="clear:both;"></div> -->
<h2>Copies</h2>
{if $copies}
<table>
<thead>
	<tr>
		<th class="left">{$labels.copyFormat}</th>
		<th>{$labels.copySize}</th>
		<th class="right">{$labels.copyPlayTime}</th>
	</tr>
</thead>
<tbody>
{nocache}
{foreach from=$copies key="idx" item="aCopy"}
	<tr >
	{if $aCopy.error}
		<td colspan="3" class="both" align="center">{$aCopy.error}</td>
	{else}
		<td class="left" width="50%"><input type="button" class="button" value="{$aCopy.downloadButtonText}" onclick="js:self.location='{$aCopy.downloadButtonUrl}'"></td>
		<td>{$aCopy.size}</td>
		<td class="right">{$aCopy.playTime}</td>
	{/if}
	</tr>
{/foreach}
{/nocache}
</tbody>
</table>
{else}
&nbsp;&nbsp;{$labels.noCopies}<br/>
{/if}

{* --- General Info --- *}


<table class="primary" style="width:90%;" itemtype="http://schema.org/Book">
  <thead>
  <tr>
    <th align="left" colspan="2" nowrap="yes">
     {$labels.entryInfoGeneral}
    </th>
  </tr>
  </thead>
  <tbody>
  	{foreach from=$fields['general'] key='tag' item="fld"}
  	<tr >
  		<td class="primary" style="width:30%;" valign="top">&nbsp;{$fld['descr']}</td>
  		<td style="width:70%" valign="top" class="primary">&nbsp;{$fld['data']}</td>
  	</tr>
 {/foreach}
 	<tr><td>&nbsp;</td></tr>
  </tbody>
  <thead>
  <tr>
    <th align="left" colspan="2" nowrap="yes">
     {$labels.entryInfoExtra}
    </th>
  </tr>
  </thead>
  <tbody>
  	{foreach from=$fields['extra'] key='tag' item="fld"}
  	<tr>
  		<td class="primary" style="width:30%;" valign="top">&nbsp;{$fld['descr']}</td>
  		<td style="width:70%" valign="top" class="primary">&nbsp;{$fld['data']}</td>
  	</tr>
 {/foreach}
 <tr><td>&nbsp;</td></tr>
</tbody>
</table>


</div>
{/block}
