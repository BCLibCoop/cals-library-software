{* Smarty Template *}
{*debug *}

{*
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}

{extends file='users/user_layout.tpl'}
{block name='content' prepend}
<input type="hidden" value="{$uid}" id="uid">
&nbsp;<input type="button" value="{$editButtonLabel}" id="edit" onclick="self.location='user_edit.php?uid={$uid}'"  >
&nbsp;&nbsp;&nbsp;
<input type="button" value="{$changePwdButtonLabel}" id="chpwd" onclick="self.location='user_change_pwd.php?uid={$uid}'"  >
&nbsp;&nbsp;&nbsp;
<input type="button"   value="{$backButtonLabel}" onclick="self.location='user_search.php'" >
{/block}

{block name='general'}
<table class="adminTable" style="width:80%">
{foreach from=$info item='anItem'}
<tr><td align="right" width="50%">{$anItem.label}</td><td width="50%"align="left">{$anItem.value}</td></tr>
{/foreach}
</table>
{/block}

{block name='userAddress'}
<div id="addressContent">
{if $addrSel}
Type :&nbsp;{html_options  name=$addrSel.name options=$addrSel.options onchange='changeAddress();' id='addrSel' }
<div id="addressBody">
{$addressBody}
</div>
{else}
No Addresses Found
{/if}
<br/>
<input type="button"  onclick="showNewAddressFields();" value="Add New Address" >
</div>

{/block}

{block name='userPrefs'}
<table class="adminTable" style="width:70%;padding-left:5%">
<tr class="primary">
<td class="left" valign="top"><img src="../images/{if $prefs.viol.value}apply.png{else}cancel.png{/if}" alt="{if $prefs.viol.value}{$labels.yes}{else}{$labels.no}{/if}" width="20" height="20">&nbsp;{$prefs.viol.label}</td>
<td class="right" valign="top"><img src="../images/{if $prefs.lang.value}apply.png{else}cancel.png{/if}" alt="{if $prefs.lang.value}{$labels.yes}{else}{$labels.no}{/if}" width="20" height="20">&nbsp;{$prefs.lang.label}</td>
</tr>
<tr class="alt1"><td colspan="2" class="both" valign="top"><img src="../images/{if $prefs.sex.value}apply.png{else}cancel.png{/if}" alt="{if $prefs.sex.value}{$labels.yes}{else}{$labels.no}{/if}" width="20" height="20">&nbsp;{$prefs.sex.label}</td>
</tr>
<tr><td class="separator" colspan="2"></td></tr>
<tr class="primary">
<td class="left" valign="top"><img src="../images/{if $prefs.bookS.value}apply.png{else}cancel.png{/if}" alt="{if $prefs.bookS.value}{$labels.yes}{else}{$labels.no}{/if}" width="20" height="20">&nbsp;{$prefs.bookS.label}</td>
<td  class="right" valign="top"><img src="../images/{if $prefs.bookL.value}apply.png{else}cancel.png{/if}" alt="{if $prefs.bookL.value}{$labels.yes}{else}{$labels.no}{/if}" width="20" height="20">&nbsp;{$prefs.bookL.label}</td>
</tr>
<tr><td class="separator" colspan="2"></td></tr>
<tr class="alt1"><td class="left"valign="top"><img src="../images/{if $prefs.narrM.value}apply.png{else}cancel.png{/if}" alt="{if $prefs.narrM.value}{$labels.yes}{else}{$labels.no}{/if}" width="20" height="20">&nbsp;{$prefs.narrM.label}</td>
<td  class="right" valign="top"><img src="../images/{if $prefs.narrF.value}apply.png{else}cancel.png{/if}" alt="{if $prefs.narrF.value}{$labels.yes}{else}{$labels.no}{/if}" width="20" height="20">&nbsp;{$prefs.narrF.label}</td>
</tr>

<tr class="primary">
<td  colspan="2" class="both" valign="top"><img src="../images/{if $prefs.narrS.value}apply.png{else}cancel.png{/if}" alt="{if $prefs.narrS.value}{$labels.yes}{else}{$labels.no}{/if}" width="20" height="20">&nbsp;{$prefs.narrS.label}</td>
</tr>
<tr ><td class="separator" colspan="2"></td></tr>
<tr class="alt1">
<td class="both" colspan="2" valign="top"><img src="../images/{if $prefs.brail.value}apply.png{else}cancel.png{/if}" alt="{if $prefs.brail.value}{$labels.yes}{else}{$labels.no}{/if}" width="20" height="20">&nbsp;{$prefs.brail.label}</td>
</tr>
<tr><td class="separator" colspan="2"></td></tr>
<tr class="primary">
<td class="left"  width="50%" align="right">{$prefs.perDev.label}&nbsp;:&nbsp;</td><td class="right" align="left">{$prefs.perDev.value}</td>
</tr>
<tr class="alt1">
<td class="left" width="50%" align="right">{$prefs.maxQ.label}&nbsp;:&nbsp;</td><td class="right" align="left">{$prefs.maxQ.value}</td>
</tr>
</table>
{/block}

{block name='userProfiles'}
<div   style="width:100%">
<table  class="adminTable"  >
<thead>
<tr  >
	<th style="width:150px">Type</th>
    <th style="width:300px">Content</th>
    <th style="width:50px">Likes</th>
    <th style="width:100px">Lang</th>
</tr >
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:100%;height:200px">
<table  class="adminTable" id="profilestbl">
<tbody>
{$profilesBody}
</tbody>
</table>
</div>
<br/>
<div>{html_inputField type="select" name="profType" options=$profSel.options selected=$profSel.selected onchange='changeProfileSelector();' id='profType' }
<div style="margin-left:80px">Prefers&nbsp;{html_inputField label=true type="checkbox" name="profLikes" value=1 id='profLikes' checked='checked'}&nbsp;<span id="profileSelectorContent">{html_inputField type="select" name="profValue" options=$profileValues id="profValue" }</span><br/>in&nbsp;
{html_inputField type="select" name="proflang" options=$profLangSel.options selected=$profLangSel.selected id='profLang' }
</div>
<br/>
<input type="button"  onclick="addProfile();" value="Add This Profile" >

</div>
{/block}

{block name='userRequests'}
<div  style="width:600px;">
&nbsp;<input type="button" value="{$addRequestButtonLabel}" onclick="self.location='user_request.php?uid={$uid}'" >
</div>
<input type="hidden" id="hreqid">
<div class="tableContainer" style="width:600px;height:275px;">
    <table class="scrollTable" style="width:100%;height:inherit;">
    	<thead class="fixedHeader" >
    		<tr>
    			<th style="width:400px">Title</th>
    			<th style="width:200px">Date Requested</th>
    		</tr>
    	</thead>
    	<tbody class="scrollContent" style="height:245px;">
    		{foreach $requests as $row}
    		<tr >
    			<td style="width:400px">{$row->title}</td>
    			<td align="center" style="width:200px">{$row->date}</td>
    		</tr>
    		{/foreach}
    	</tbody>
    </table>
</div><!-- .tableContainer -->
<br/>


{/block}

{block name='userHistory'}
<input type="button" value="Show Full History" onclick="getFullHistory();" />
<div   style="width:100%">
<table  class="adminTable">
<thead>
<tr>
		<th class="left" width="6%"><center>Device<br />Ref</center></th>
		<th width="60%"><center>Title</center></th>
		<th class="right" width="30%"><center>Date Loaded</center></th>
</tr>
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:100%;height:300px">
<table  class="adminTable" id="historyTable">
<tbody>
{$historyBody}
</tbody>
</table>
</div>

{/block}
{block name='userNotes'}
<input type="button" value="Show All Notes" onclick="showAllNotes();" />
<div   style="width:100%">
<table  class="adminTable"  >
<thead>
<tr  >
    <th class="left" style="width:70%"><center>{$noteLabels.search}<br/><input style="width:80%" maxlength="40" id="noteSrchBar" type="text" onkeyup="delayFunction(function() {literal}{ searchNotes();}{/literal},600);"></center></th>
    <th class="right" style="width:30%">{$noteLabels.date}</th>
</tr >
</thead>
</table>
</div>
<div class="scrollTableWrapper"  style="width:100%;height:200px">
<table  class="adminTable" id="notestbl">
<tbody>
{$notesBody}
</tbody>
</table>
</div>
<br />
<center><textarea rows="3" cols="60" id="newnote"></textarea>
<br /><br /><input type="button" value="Add this note" onclick="addNote();" /></center>
{/block}

{block name='endScripts' append}
<script type="text/javascript">
<!--
{literal}
	var newAddr = new Agent();
	var noteAgent = new Agent();
	var showHist = new Agent();
	var profSelAgent = new Agent();
	var profilesAgent = new Agent();

	profilesAgent.success = function (resp)
	{
		if (resp == "") return false;

		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('profilestbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements
		newBody.appendChild(innerShiv(resp));
		document.getElementById('profilestbl').replaceChild(newBody,oldBody);

	}

	noteAgent.success = function (resp)
	{
		if (resp == "") return false;

		document.getElementById("newnote").value="";
		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('notestbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements
		newBody.appendChild(innerShiv(resp));
		document.getElementById('notestbl').replaceChild(newBody,oldBody);
	}

	newAddr.success = function ( resp ) {
 		document.getElementById("addressContent").innerHTML=resp;
	}

	profSelAgent.success = function (resp)
	{
		if (resp == "") return false;
		document.getElementById("profileSelectorContent").innerHTML =resp;
	}

	function changeProfileSelector()
	{
		var el = document.getElementById('profType');
		var typeid = el.options[el.selectedIndex].value;
		profSelAgent.set_action('profileTypeFilter.php?pt='+encodeURIComponent(typeid));
		profSelAgent.request('');
	}

	function addProfile()
	{
		var userid = document.getElementById('uid').value;
		var el = document.getElementById('profLang');
		var lang = el.options[el.selectedIndex].value;
		el = document.getElementById('profType');
		var ptype = el.options[el.selectedIndex].value;
		el = document.getElementById('profValue');
		var pcont = (el.type == 'text')?el.value:el.options[el.selectedIndex].text;
		var prefers = (document.getElementById('profLikes').checked)?1:0;

		profilesAgent.method="POST";
		profilesAgent.set_action('user_profile_add.php?uid='+encodeURIComponent(userid));
		profilesAgent.request('t='+ptype+'&p='+prefers+'&l='+lang+'&c='+pcont);

	}

	showHist.success = function ( resp ) {
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('historyTable').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements
		newBody.appendChild(innerShiv(resp));
		document.getElementById('historyTable').replaceChild(newBody,oldBody);

	}

	function getFullHistory()
	{
		var userid = document.getElementById('uid').value;
		showHist.set_action('userHistoryFilter.php?uid='+encodeURIComponent(userid)+'&fh');
		showHist.request('');
	}

	function showNewAddressFields()
	{
		var userid = document.getElementById('uid').value;
		newAddr.set_action('user_new_address.php?uid='+encodeURIComponent(userid));
		newAddr.request('');
	}


	function addNote()
	{
		document.getElementById("noteSrchBar").value="";
		var userid = document.getElementById('uid').value;
		var note = document.getElementById('newnote').value;
		noteAgent.method="POST";
		noteAgent.set_action('user_note_add.php?uid='+encodeURIComponent(userid));
		noteAgent.request('nt='+note);
	}

	function searchNotes()
	{
		var userid = document.getElementById('uid').value;
		var crit = document.getElementById('noteSrchBar').value;
		noteAgent.method="POST";
		noteAgent.set_action('userNotesFilter.php?uid='+encodeURIComponent(userid));
		noteAgent.request('nt='+crit);
	}

	function showAllNotes()
	{
		var userid = document.getElementById('uid').value;
		document.getElementById("noteSrchBar").value="";
		noteAgent.method="POST";
		noteAgent.set_action('userNotesFilter.php?uid='+encodeURIComponent(userid)+'&sa');
		noteAgent.request('nt=');
	}






{/literal}
-->
</script>
{/block}
