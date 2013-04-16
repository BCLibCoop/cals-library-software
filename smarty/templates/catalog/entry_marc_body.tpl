{* Smarty Template *}
{*debug*}

{* 
 * This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *}
{nocache}
  <tr class="primary">
    <td align="right" class="left">{$labels.blockLabel} :&nbsp;</td>
    <td  class="right">{html_inputField type="select" name="b" selected=$blocks.selected options=$blocks.options id="block" onchange="doBlockChange();"}</td>
  </tr>
  <tr class="alt1">
    <td align="right" class="left">{$labels.tagLabel} :&nbsp;</td>
    <td  class="right">{html_inputField type="select" name="t" selected=$tags.selected options=$tags.options id="tag" onchange="doTagChange();"}</td>
  </tr>
  <tr class="primary">
    <td align="right" nowrap="true" class="left" ><label for="i1">{$labels.ind1Label} :&nbsp;</label></td>
    <td  class="right">{html_inputField type="select" name="i1" selected=$ind1.selected options=$ind1.options }</td>
  </tr>
  <tr class="alt1">
    <td align="right" nowrap="true" class="left" ><label for="i2">{$labels.ind2Label} :&nbsp;</label> </td>
    <td  class="right">{html_inputField type="select" name="i2" selected=$ind2.selected options=$ind2.options}</td>
   </tr>

  <tr class="primary">
    <td align="right" nowrap="true" class="left" >{$labels.subfieldLabel} :&nbsp;</td>
    <td  class="right">{html_inputField type="select" name="s" selected=$subFlds.selected options=$subFlds.options}</td>
  </tr>
{/nocache}