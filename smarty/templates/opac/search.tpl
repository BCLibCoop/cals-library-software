{* Smarty Template *}
{*debug *}

{*
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/opac_layout.tpl'}
{block name='content' }
<div style="margin:20px 0 0 -40px">
</div>
<div>
<p><input  type="button" class="button" value="{$labels.back}" onclick="js:self.location='index.php';"></p>
<h1 class="greenbar">{$labels.searchCrit}</h1>
{foreach $entries as $ent}
{if $ent@index}<hr/>{/if}


<p>{$labels.title} : <a href="view.php?b={$ent.bibid}">{$ent.title}</a>
		 <br/>{$labels.author} : {$ent.author}
		 <br/>{$labels.collection} : {$ent.collection}
		 {if $ent.copyTypes}<br/>{$labels.copyTypes} : {$ent.copyTypes}{else}<br/><a href="request.php?b={$ent.bibid}$">{$labels.requestProd}</a>{/if}
		 <br/>{$labels.systemNum} : {$ent.snum}
		 {if $ent.restricted}<font color="red"><br/>{$labels.restrictedMsg}</font>{/if}		 
</p>
	 
{/foreach}
</div>
<br/>
{/block}

