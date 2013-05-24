{* Smarty Template *}
{*debug *}

{extends file='private/opac_layout.tpl'}
{block name='content' }
<br/>
<h1>{$contentHeader}</h1>
<p align="left">{$contentMsg}</p>
<br/>
<div  id="mainbody">

<form name="opacsearch" method="GET" action="search.php">
<div >
<table class="primary" align="center">
  <tr>
    <th valign="top" nowrap="yes" align="left" style="padding: 5px 15px 5px 15px;">
    Search Form
      <!--
{$labels["srch_header"]}
    	<select name="t">
        	<option value="1" selected>{$labels['sel_title']}</option>
	        <option value="2">{$labels['sel_author']}</option>
		    <option value="3">{$labels['sel_subject']}</option>
		    <option value="4">{$labels['sel_isbn']}</option>
		    <option value="5">{$labels['sel_snum']}</option>
		    <option value="0">{$labels['sel_all']}</option>
        </select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sort By :
		<select name="b">
			 <option value="a" selected>{$labels["sel_author"]}</option>
        	 <option value="t" >{$labels["sel_title"]}</option>
      	</select>
-->
	</th>
  </tr>
  <tr>
    <td nowrap="true" class="primary" style="padding: 5px 15px 5px 15px;">
        
		<p><label for="searchcrit">Search terms: </label><input type="text" name="c" id="searchcrit" size="60" maxlength="120"></p>
      	
      	<label for="searchby">{$labels["srch_header"]} </label>
    	<select name="t" id="searchby">
        	<option value="1" selected>{$labels['sel_title']}</option>
	        <option value="2">{$labels['sel_author']}</option>
		    <option value="3">{$labels['sel_subject']}</option>
		    <option value="4">{$labels['sel_isbn']}</option>
		    <option value="5">{$labels['sel_snum']}</option>
		    <option value="0">{$labels['sel_all']}</option>
        </select>
		&nbsp;&nbsp;<label for="orderby">Sort By: </label>
		<select name="b" id="orderby">
			 <option value="a" selected>{$labels["sel_author"]}</option>
        	 <option value="t" >{$labels["sel_title"]}</option>
      	</select>
      	<input type="checkbox" name="p" value=1 checked="checked" id="prodcheck">&nbsp;<label for="prodcheck">Search only produced titles</label><br/>
      	<p align="center"><input type="submit" value="Search" class="button"></p>
    </td>
  </tr>
</table>
</div>
</form>

<br/>

<p align="left"><strong><a href="/shelflist/index.php">Shelflist</a></strong><br/>{$phrases['caShelflist']}</p>
</div>
{/block}
{block name='endScripts' append}
<script>
	window.onload = function() {
		document.getElementById("searchcrit").focus();
  	};
</script>
{/block}

/block}

