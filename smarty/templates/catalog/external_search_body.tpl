{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
 
 {*
 define('MARC_TITLE', '245a');
define('MARC_AUTHOR', '100a');
define('MARC_ISBN', '020a');
define('MARC_SUBTITLE', '245b');
define('MARC_PUBLICATION_PLACE', '260a');
define('MARC_PUBLISHER', '260b');
define('MARC_PUBLICATION_DATE', '260c');
define('MARC_PAGES', '300a');
define('MARC_SUBJECT', '650a');
 *}
 
{nocache}
{if $errors}
<tr  >
    <th colspan="3" style="width:98%" class="both" >Errors</th>
</tr>
	{foreach from=$errors item=anError}
		<tr class='{if $anEntry@iteration is even}primary{else}alt1{/if}' style="width:98%">
		<td class='both' id='title' style='padding-left:2em;width:90%' >
			{$anError.server} - {$anError.msg}
		</td>
		</tr>
	{/foreach}
	
{/if}
{foreach from=$results key=svrLabel item=aServer}
	<tr><th colspan="3" style="width:98%" class="both" >{$svrLabel}</th></tr>
	{foreach from=$aServer item=anEntry}
		{assign var="fields" value=$anEntry->getBiblioFields()}
		{if $fields.245a}
		<tr class='{if $anEntry@iteration is even}primary{else}alt1{/if}' style="width:98%">
		<td class='left' id='title' style='padding-left:2em;width:70%' >
		{$labels.title} : {$fields.245a->getFieldData()}<br />
		{if $fields.100a}{$labels.author} : {$fields.100a->getFieldData()}<br />{/if}
		{if $fields.020a}{$labels.isbn} : {$fields.020a->getFieldData()}<br />{/if}
		
		{if $fields.260b && $fields.260a}
			{$labels.pubPlace} : {$fields.260a->getFieldData()}<br />
			{$labels.publisher} : {$fields.260b->getFieldData()}<br />
		{/if}
		{if $fields.260c}{$labels.pubDate} : {$fields.260c->getFieldData()}<br />{/if}		
		</td>
		<td class="right">
			<form method="POST" action="entry_new_like.php"> 
			<input type="submit" value="{$labels.useThis}">
			{foreach from=$fields key="tag" item="fld"}
			{* tag : {$tag} -> {$fld->getFieldData()}<br />
			*}
			<input type="hidden" name="flds[{$tag}]" value="{$fld->getFieldData()}">
			{/foreach}
			{* set the bid so the entry_new_like.php will process the fields properly *}
			<input type="hidden" name="bid" value="0">
			</form>
		</td>
		</tr>
		{/if}
	{/foreach}
	<tr><td><br /></td></tr>
{/foreach}

{/nocache}

