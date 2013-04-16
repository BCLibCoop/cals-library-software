{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}

{block name='content' prepend}

<h1>{$reportListHeader}</h1>

<p>
{$reportListDesc}
<ul>
	{foreach from=$reportsList key=category item=type} 
    <li class="report_category"><strong>{$category}</strong><ul>
    {foreach from=$type item=title}
    <li><a href="../reports/report_criteria.php?type='{$type}'">{$title}</a></li>
    {/foreach}
    </ul></li>
    {/foreach}
</ul>
</p>


{/block}