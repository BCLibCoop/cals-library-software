{* Smarty Template *}
{*debug *}

{*
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/opac_layout.tpl'}
{block name='content' }
<div style="margin:20px 0 0 -40px">
<input  type="button" class="button" value="{$labels.back}" onclick="js:self.location='index.php';">
</div>
<div style="margin:0 5% 0 1%;">
<br/>
<table  class="adminTable"  style="width:100%">
<thead><tr><th>{$labels.searchCrit}</th></tr></thead>
<tbody >
<tr><td></td></tr>
{foreach $entries as $ent}
{if $ent@index}<tr><td><hr/></td></tr>{/if}
<tr style="border:1px solid black;">
	<td >{$labels.title} : <a href="view.php?b={$ent.bibid}">{$ent.title}</a>
		 <br/>{$labels.author} : {$ent.author}
		 <br/>{$labels.systemNum} : {$ent.snum}
		 <br/>{$labels.collection} : {$ent.collection}
		 {if $ent.restricted}<font color="red"><br/>{$labels.restrictedMsg}</font>{/if}
		 {if $ent.copyTypes}<br/>{$labels.copyTypes} : {$ent.copyTypes}{else}<br/><a href="request.php?bibid={$ent.bibid}$">{$labels.requestProd}</a>{/if}
	</td>
</tr>
{/foreach}
</tbody>
</table>
</div>
<br/>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24139575-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">

 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-26676150-1']);
 _gaq.push(['_trackPageview']);

 (function() {
   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();

</script>
{/block}

