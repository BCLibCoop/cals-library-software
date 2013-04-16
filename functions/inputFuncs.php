<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/errorFuncs.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Dm.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/DmQuery.php");

define("OBIB_TEXT_CTRL", "0");
define("OBIB_TEXTAREA_CTRL", "1");
define("OBIB_CHECKBOX_CTRL", "2");
define("OBIB_SELECT_CTRL", "3");

/*********************************************************************************
 * Draws input html tag of type text.
 * @param string $tag input field tag
 * @param string $subfieldCd input field subfield code
 * @param boolean $required true if field is required
 * @param array_reference &$fieldIds reference to array containing field ids if updating fields
 * @param array_reference &$postVars reference to array containing all input values
 * @param array_reference &$pageErrors reference to array containing all input errors
 * @param array_reference &$marcTags reference to array containing marc tag descriptions
 * @param array_reference &$marcSubflds reference to array containing marc subfield descriptions
 * @param boolean $showTagDesc set to true if the tag description should also show
 * @param string $ctrlType see defined constants OBIB_TEXT_CTRL & OBIB_TEXTAREA_CTRL above
 * @param int $occur input field occurance if field is being entered as repeatable
 * @return void
 * @access public
 *********************************************************************************
 */
function printUsmarcInputText($tag, $subfieldCd, $required, &$postVars, &$pageErrors, &$marcTags, &$marcSubflds, $showTagDesc, $ctrlType, $occur='',$ctrlValues='')
{
	$arrayIndex = makeCompositeTag($tag,$subfieldCd);
	$formIndex = $arrayIndex.$occur;
	$size = 40;
	$maxLen = 300;
	$cols = 55;
	$rows = 4;
	
	$value = (isset($postVars['values'][$formIndex]))?$postVars['values'][$formIndex]:'';
	$fieldId = (isset($postVars['fieldIds'][$formIndex]))?$postVars['fieldIds'][$formIndex]:'';
	$error = (isset($pageErrors[$formIndex]))?$pageErrors[$formIndex]:null;
	
	echo "<tr><td class=\"primary\" valign=\"top\">\n";
	if ($required)
	{
		echo "<sup>*</sup> ";
	}
	if (($showTagDesc)
		&& (isset($marcTags[$tag]))
		&& (isset($marcSubflds[$arrayIndex])))
	{
		echo H($marcTags[$tag]->getDescription());
		echo " (".H($marcSubflds[$arrayIndex]->getDescription()).")";
	} 
	elseif (isset($marcSubflds[$arrayIndex]))
	{
		echo H($marcSubflds[$arrayIndex]->getDescription());
	}
	
	if ($occur != "")
	{
		echo " ".H($occur+1);
	}
	
	echo ":\n</td>\n";
	echo "<td valign=\"top\" class=\"primary\">\n";
	if ($ctrlType == OBIB_TEXT_CTRL)
	{
		echo "<input type=\"text\"";
		echo " name=\"values[".H($formIndex)."]\" size=\"".H($size)."\" maxlength=\"".H($maxLen)."\" ";
		echo "value=\"".H($value)."\" >";
	} 
	elseif ($ctrlType == OBIB_CHECKBOX_CTRL)
	{
		echo "<input name='values[".H($formIndex)."]' type='checkbox' onClick='this.value=this.checked?'".H($ctrlValues[0])."':'';' ";
		echo "value='".H($ctrlValues[0])."' ";
		echo ($value == $ctrlValues[0])?"checked >\n":">\n";
	}
	elseif ($ctrlType == OBIB_SELECT_CTRL)
	{
		echo "<select name='values[".H($formIndex)."]' >\n";
		foreach ($ctrlValues as $k=>$val)
		{
			echo '<option value="'.$val.'" ';
			echo ($value == $val)?"selected>":'>';
			echo $val."</option>\n";
		}		
		echo "</select>\n";
	}

	else
	{
		echo "<textarea name=\"values[".H($formIndex)."]\" cols=\"".H($cols)."\" rows=\"".H($rows)."\">";
		echo H($value)."</textarea>";
	}
	if (isset($error))
	{
		echo "<br><font class=\"error\">";
		echo $error."</font>";
	}
	echo "<input type=\"hidden\" name=\"indexes[]\" value=\"".H($formIndex)."\" >\n";
	echo "<input type=\"hidden\" name=\"tags[".H($formIndex)."]\" value=\"".H($tag)."\" >\n";
	echo "<input type=\"hidden\" name=\"subfieldCds[".H($formIndex)."]\" value=\"".H($subfieldCd)."\" >\n";
	echo "<input type=\"hidden\" name=\"fieldIds[".H($formIndex)."]\" value=\"".H($fieldId)."\" >\n";
	echo "<input type=\"hidden\" name=\"requiredFlgs[".H($formIndex)."]\" value=\"".H($required)."\" >\n";
	echo "</td></tr>\n";
}



/* Returns HTML for a form input field with error handling. */
function inputField($type, $name, $value="", $attrs=NULL, $data=NULL) {
  $s = "";
  if (isset($_SESSION['postVars'])) {
    $postVars = $_SESSION['postVars'];
  } else {
    $postVars = array();
  }
  if (isset($postVars[$name])) {
    $value = $postVars[$name];
  }
  if (isset($_SESSION['pageErrors'])) {
    $pageErrors = $_SESSION['pageErrors'];
  } else {
    $pageErrors = array();
  }
  if (isset($pageErrors[$name])) {
    $s .= '<font class="error">'.H($pageErrors[$name]).'</font><br />';
  }
  if (!$attrs) {
    $attrs = array();
  }
  if (!isset($attrs['onChange'])) {
    $attrs['onChange'] = 'modified=true';
  }
  switch ($type) {
  // FIXME radio
  case 'select':
  //added a class for large type GMK April 2010
    $s .= '<select class="form" id="'.H($name).'" name="'.H($name).'" ';
    foreach ($attrs as $k => $v) {
      $s .= H($k).'="'.H($v).'" ';
    }
    $s .= ">\n";
    foreach ($data as $val => $desc) {
      $s .= '<option value="'.H($val).'" ';
      if ($value == $val) {
        $s .= " selected";
      }
      $s .= ">".H($desc)."</option>\n";
    }
    $s .= "</select>\n";
    break;
  case 'textarea':
    $s .= '<textarea name="'.H($name).'" ';
    foreach ($attrs as $k => $v) {
      $s .= H($k).'="'.H($v).'" ';
    }
    $s .= ">".H($value)."</textarea>";
    break;
  case 'checkbox':
    $s .= '<input type="checkbox" ';
    $s .= 'name="'.H($name).'" ';
    $s .= 'value="'.H($data).'" ';
    if ($value == $data) {
      $s .= "checked ";
    }
    foreach ($attrs as $k => $v) {
      $s .= H($k).'="'.H($v).'" ';
    }
    $s .= "/>";
    break;
  default:
    $s .= '<input type="'.H($type).'" ';
    $s .= 'name="'.H($name).'" ';
    if ($value != "") {
      $s .= 'value="'.H($value).'" ';
    }
    foreach ($attrs as $k => $v) {
      $s .= H($k).'="'.H($v).'" ';
    }
    $s .= "/>";
    break;
  }
  return $s;
}

/* Returns HTML for a select box with the contents of $table as options. */
function dmSelect($table, $name, $value="", $all=FALSE, $attrs=NULL) {
  $dmQ = new DmQuery();
 // $dmQ->connect();
  # Don't use getAssoc() so that we can set the default below
  $dms = $dmQ->get($table);
 // $dmQ->close();
  $default = "";
  $options = array();
  if ($all) {
    $options['all'] = 'All';
  }
  foreach ($dms as $dm) {
    $options[$dm->getCode()] = $dm->getDescription();
    if ($dm->getDefaultFlg()) {
      $default = $dm->getCode();
    }
  }
  if ($value == "") {
    $value = $default;
  }
  return inputField('select', $name, $value, $attrs, $options);
}

/*********************************************************************************
 * DEPRECATED, use inputField.  Draws input html tag of type text.
 * @param string $fieldName name of input field
 * @param string $size size of text box
 * @param string $max max input length of text box
 * @param array_reference &$postVars reference to array containing all input values
 * @param array_reference &$pageErrors reference to array containing all input errors
 * @return void
 * @access public
 *********************************************************************************
 */
function printInputText($fieldName,$size,$max,&$postVars,&$pageErrors,$visibility = "visible") {
  $_SESSION['postVars'] = $postVars;
  $_SESSION['pageErrors'] = $pageErrors;
  $attrs = array('size'=>$size,
                 'maxlength'=>$max,
                 'style'=>"visibility: $visibility");
  echo inputField('text', $fieldName, '', $attrs);
}

/*********************************************************************************
 * DEPRECATED, use dmSelect.
 * @param string $fieldName name of input field
 * @param string $domainTable name of domain table to get values from
 * @param array_reference &$postVars reference to array containing all input values
 *********************************************************************************
 */
function printSelect($fieldName,$domainTable,&$postVars,$disabled=FALSE){
  $_SESSION['postVars'] = $postVars;
  $attrs = array();
  if ($disabled) {
    $attrs['disabled'] = '1';
  }
  echo dmSelect($domainTable, $fieldName, "", FALSE, $attrs);
}
?>
