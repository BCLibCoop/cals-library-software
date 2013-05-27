{* Smarty Template *}
{*debug *}

{*
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}

	<!-- Begin Stylesheets -->

		<link rel="stylesheet" href="../css/coda-slider.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../css/scrolling-table.css" type="text/css" media="screen" />

	<!-- End Stylesheets -->
{block name='editPrefix'}{/block}

<div class="coda-slider-wrapper">
	<div class="coda-slider preload" id="user-info-slider">
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">General</h2>
				<div class="content">
				{nocache}
				{block name='general'}{/block}
				{/nocache}
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Addresses</h2>
				<div class="content" >
				{nocache}
				{block name='userAddress'}{/block}
				{/nocache}
				</div>

			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Preferences</h2>
				<div class="content">
				{nocache}
				{block name='userPrefs'}{/block}
				{/nocache}
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Profiles</h2>
				<div class="content" >
				{nocache}
				{block name='userProfiles'}{/block}
				{/nocache}
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Requests</h2>
				<div class="content" >
				{nocache}
				{block name='userRequests'}{/block}
				{/nocache}
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Reading History</h2>
				<div class="content" >
				{nocache}
				{block name='userHistory'}{/block}
				{/nocache}
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-wrapper">
				<h2 class="title">Notes</h2>
				<div class="content" >
				{nocache}
				{block name='userNotes'}{/block}
				{/nocache}
				</div>
			</div>
		</div>
	</div><!-- .coda-slider -->

</div><!-- .coda-slider-wrapper -->

{block name='editSuffix'}{/block}

{/block}

{block name='endScripts' }
<!-- Begin JavaScript -->
<script type="text/javascript" src="{$APP_ROOT}/javascript/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/jquery.coda-slider.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/innershiv.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/tableFuncs.js"></script>
<script type="text/javascript">
	<!--
{literal}
    Agent.prototype.method = 'GET';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;

    var addrChg = new Agent();

	addrChg.success = function ( resp ) {
 		document.getElementById("addressBody").innerHTML=resp;
	}

	$().ready(function()
	{
		$('#user-info-slider').codaSlider(
		{
			dynamicArrows:false,
			autoHeight:true
		});
	});

	function changeAddress()
	{
		var filterStr = '';
		var addel = null;
		var el = document.getElementById('addrSel');
		if(el == null) return false;

		filterStr = 'aid='+escape(el.value);
		// check if we are editing
		addel = document.getElementById('addr');
		if ((addel != undefined)  && (addel != null))
			filterStr=filterStr+'&e';
		addrChg.set_action('userAddressFilter.php?'+filterStr);
		addrChg.request('');
	}

{/literal}
-->
</script>


{/block}
