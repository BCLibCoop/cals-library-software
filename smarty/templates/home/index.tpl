{* Smarty Template *}
{*debug *}

{extends file='private/admin_layout.tpl'}
{block name='content' append}
<br/>
<table class="primary">
  <tr>
    <th>{$indexTab}</th><th align="left">{$indexDesc}</th>
  </tr>
  
  {foreach from=$tabsDesc item=aTab}
  <tr>
    <td align="center" valign="top" class="primary">{$aTab.label}<br><br>
      <img src="../images/{$aTab.image}" border="0" width="30" height="30"></td>
    <td class="primary">{$aTab.descHeader}
      <ul>
      	{foreach from=$aTab.descriptions item=aDesc}
        <li>{$aDesc}</li>
      	{/foreach}
      </ul>
    </td>
  </tr>
  {/foreach}
</table>
{/block}
