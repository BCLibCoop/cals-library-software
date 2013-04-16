{* Smarty Template *}
{*debug *}

{extends file='private/layout.tpl'}
{* Base Admin Layout Template *}

{block name='tabMenu'}
<link rel="stylesheet" type="text/css" href="../css/tabs.css" />
<div id="tabBox">
	<ul id="adminTabs">
	{foreach from=$tabList item=tab}
		<li {if $tab.items}class='selected'{/if}>
			<a {if !$tab.items}href="{$tab.ref}"{/if}>{$tab.label}</a>
			{* Subnav Items *}
			{if $tab.items}
				<span>
				{foreach from=$tab.items item=navItem}
					<a {if $navItem.selected==false}href="{$navItem.ref}"{/if}>{$navItem.label}</a>{if !$navItem@last}&nbsp;|&nbsp;{/if}
				{/foreach}
				</span>
			{/if}
			{* end Subnav *}
		</li>
	{/foreach}
	</ul>
</div>
{/block}

{block name='content'}
	{if $contentStatusMsg}
		<pre><font class="error">{$contentStatusMsg}</font></pre>
	{/if}
	<h1>{$contentHeader}</h1>
	{if $contentDesc}
	<h2>{$contentDesc}</h2>
	{/if}
{/block}

{block name='footer'}{/block}

{block name=endScripts}
<script type="text/javascript">
<!--

function popSecondary(url) {
    var SecondaryWin;
    SecondaryWin = window.open(url,"secondary","resizable=yes,scrollbars=yes,width=535,height=400");
    self.name="main";
}
function popSecondaryLarge(url) {
    var SecondaryWin;
    SecondaryWin = window.open(url,"secondary","toolbar=yes,resizable=yes,scrollbars=yes,width=700,height=500");
    self.name="main";
}
function backToMain(URL) {
    var mainWin;
    mainWin = window.open(URL,"main");
    mainWin.focus();
    this.close();
}
-->
</script>
{/block}
