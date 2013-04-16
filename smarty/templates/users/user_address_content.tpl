{* Smarty Template *}
{*debug *}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
 
<form name="addaddressform" method="post" action="user_new_address.php">
<input type="hidden" name="uid" value="{$uid}" />
{if $addrSel}
Type :&nbsp;{html_options  name=$addrSel.name options=$addrSel.options id='addrSel' }
<div id="addressBody">
{$addressBody}
</div>
<br/>
<div>
<center>
<input type="{$addrSubmitButton.type}"   value="{$addrSubmitButton.label}" >
<input type="{$addrCancelButton.type}"  onclick="{$addrCancelButton.onclick}" value="{$addrCancelButton.label}">
</center> </div>

{else}
No Addresses Found
<div>
<center>
<input type="button"  onclick="{$addrCancelButton.onclick}" value="{$addrCancelButton.label}">
</center> 
</div>
{/if}

 </form>
 


