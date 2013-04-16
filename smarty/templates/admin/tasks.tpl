{* Smarty Template *}
{*debug *}

{*
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

<div style="width:70%">

	<input type="button" class="button" value="Refill Recommendations" onclick="updateRecommendations();">
	<br/><br/>
	<table id="recomtbl">
		<tbody></tbody>
	</table>
      <br/><br/>
      <input type="button" class="button" value="Update All Indexes" onclick="updateIndexes();">
	<br/><br>
	<table id="indexertbl">
		<tbody></tbody>
	</table>

</div>
{/block}
{block name="endScripts"}

<script type="text/javascript" src="{$APP_ROOT}/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/innershiv.js"></script>
<script type="text/javascript">

{literal}
<!--
	Agent.prototype.method = 'GET';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;

    var indexer = new Agent();
	var recommender = new Agent();

	indexer.success = function ( resp )
	{
		//alert(this.agent.state);
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('indexertbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements
		newBody.appendChild(innerShiv(resp));
		document.getElementById('indexertbl').replaceChild(newBody,oldBody);

	}

	recommender.success = function ( resp ) {
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('recomtbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements
		newBody.appendChild(innerShiv(resp));
		document.getElementById('recomtbl').replaceChild(newBody,oldBody);
	}

	function updateRecommendations()
	{
		recommender.set_action('refill_requests.php?so=1'+'&ts='+ new Date().getTime());
		recommender.request("");
	}

	function updateIndexes()
	{
		indexer.set_action('update_indexes.php?so=1'+'&ts='+ new Date().getTime());
		indexer.request("");
	}

-->
{/literal}
</script>
{/block}

