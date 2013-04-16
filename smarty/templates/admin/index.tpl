{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<h3></h3><img src="../images/admin.png" border="0" width="30" height="30" >
&nbsp;{$adminSummaryHeader}</h3>
<br/><br/>{$adminSummaryDesc}
{/block}
