{* Smarty Template *}
{*debug*}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}


{extends file='private/admin_layout.tpl'}

{block name='content' append}

<div style="width:65%">
<form method="post" action="{if !$newField}entry_marc_edit.php{else}entry_marc_new.php{/if}">
{if !$newField}
<input type="hidden" value="{$fieldid}" name="f"/>
{else}
<input type="hidden" value="{$bibid}" name="bid"/>
{/if}
<table class="adminTable" id="marctbl">
  <thead >
  <tr><th class="both" colspan="2" nowrap="yes" align="left">{$labels.fieldInfoLabel}</th></tr>
  </thead>
{nocache}
  <tbody>
  {$tagContent}
  </tbody>
  <tbody>
   <tr class="alt1">
    <td align="right" nowrap="true" class="left" >{$labels.fieldDataLabel} :&nbsp;</td>
    <td class="right"><textarea name="cont"  cols="30" rows="4">{$fldContent}</textarea></td>
  </tr>
  
  <tr class="primary">
    <td align="center" colspan="2" class="both">
      <input type="submit" value="{$labels.submitButtonLabel}">&nbsp;&nbsp;
      <input type="button" onClick="self.location='entry_edit.php?bid={$bibid}'" value="{$labels.cancelButtonLabel}">
    </td>
  </tr>
  {if !$newField}
  <tr class="alt1">
    <td align="center" colspan="2" class="both">
      <input type="button" id="delbutton" onclick="self.location='entry_marc_del.php?fid={$fieldid}';" disabled="disabled" value="{$labels.deleteLabel}"/>
      <label><input type="checkbox" onclick="setDeleteButton(this);" />{$labels.deleteConfirmLabel}</label>
    </td>
  </tr>
  {/if}
  </tbody>
{/nocache}
</table>
</form>
</div>
{/block}
{block name="endScripts" append}
<script type="text/javascript" src="{$APP_ROOT}/javascript/tableFuncs.js"></script>	
<script type="text/javascript" src="{$APP_ROOT}/javascript/AJAXAgent.js"></script>
<script type="text/javascript" src="{$APP_ROOT}/javascript/innershiv.js"></script>
<script type="text/javascript">
{literal}
<!--
	function setDeleteButton(el)
	{
		document.getElementById("delbutton").disabled = !el.checked;
	}

	Agent.prototype.method = 'POST';
	Agent.prototype.format = 'text'; // text, xml //
	Agent.prototype.async = true;
    
    var marcAgent = new Agent();
	
	marcAgent.success = function ( resp ) { 		
 		var newBody = document.createElement("tbody");
 		var oldBody = document.getElementById('marctbl').getElementsByTagName('tbody')[0];
		// using innerShiv as a workaround for IE being ReadOnly innerHtml in tbody elements 
		newBody.appendChild(innerShiv(resp));
		document.getElementById('marctbl').replaceChild(newBody,oldBody);
	
	}
	
	function doBlockChange()
	{
	   	filterStr = "&b=" + encodeURIComponent(document.getElementById("block").value);
		
		marcAgent.set_action('entry_marc_change.php'+ '?' + new Date().getTime());
		marcAgent.request(filterStr);
		
	}	

	function doTagChange()
	{
		var filterStr = "";
	   	filterStr = "&b=" + encodeURIComponent(document.getElementById("block").value);
		filterStr += "&t=" + encodeURIComponent(document.getElementById("tag").value);
		marcAgent.set_action('entry_marc_change.php'+ '?' + new Date().getTime());
		marcAgent.request(filterStr);
	}	
	
-->
{/literal}
</script>

{/block}

