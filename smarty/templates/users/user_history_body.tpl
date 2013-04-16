{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
 
 
{foreach $readHist as $row}
	<tr class='{if $row@iteration is even}primary{else}alt1{/if}'><td width="5%"><center>{$row->idx}</center></td><td width="60%">&nbsp;&nbsp;{$row->title}</td><td width="30%"><center>{$row->date}</center></td></tr>
{/foreach}
