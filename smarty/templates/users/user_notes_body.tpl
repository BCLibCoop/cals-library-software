{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
 
 
{foreach $notesHist as $row}
	<tr class='{if $row@iteration is even}primary{else}alt1{/if}'><td style="width:70%">
	{$row->content|escape|nl2br}</td><td style="width:30%">{$row->date}</td></tr>
{/foreach}
