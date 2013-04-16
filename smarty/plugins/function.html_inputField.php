<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {html_inputField} function plugin
 *
 * File:       function.html_inputField.php<br>
 * Type:       function<br>
 * Name:       html_checkboxes<br>
 * Date:       24.Feb.2003<br>
 * Purpose:    Prints out a list of checkbox input types<br>
 * Examples:
 * <pre>
 * {html_checkboxes values=$ids output=$names}
 * {html_checkboxes values=$ids name='box' separator='<br>' output=$names}
 * {html_checkboxes values=$ids checked=$checked separator='<br>' output=$names}
 * </pre>
 * @link http://smarty.php.net/manual/en/language.function.html.checkboxes.php {html_checkboxes}
 *      (Smarty online manual)
 * @author     Christopher Kvarme <christopher.kvarme@flashjab.com>
 * @author credits to Monte Ohrt <monte at ohrt dot com>
 * @version    1.0
 * @param array $params parameters
 * Input:<br>
 *           - name       (optional) - string default "checkbox"
 *           - values     (required) - array
 *           - options    (optional) - associative array
 *           - checked    (optional) - array default not set
 *           - separator  (optional) - ie <br> or &nbsp;
 *           - output     (optional) - the output next to each checkbox
 *           - assign     (optional) - assign the output as an array to this variable
 * @param object $template template object
 * @return string
 * @uses smarty_function_escape_special_chars()
 */
function smarty_function_html_inputField($params, $template)
{
    require_once(SMARTY_PLUGINS_DIR . 'shared.escape_special_chars.php');

	$type = 'text';
    $name = null;
    $value = null;
    $selected = null;
    $label = false;
    $disabled = false;
    $checked = false;
    $options = array();
    $output = $extra = '';


    foreach($params as $_key => $_val) {
        switch($_key) {
        	case 'type':
        	case 'name':
        	case 'value':
        	case 'selected':
            	$$_key = $_val;
                break;
            case 'label':
                $$_key = (bool)$_val;
                break;
            case 'options':
                $$_key = (array)$_val;
                break;
            case 'checked':
                $checked = (bool)$_val;
                break;		
            default:
            	if(!is_array($_val)) {
                    $extra .= ' '.$_key.'="'.smarty_function_escape_special_chars($_val).'"';
                } else {
                    trigger_error("html_checkboxes: extra attribute '$_key' cannot be an array", E_USER_NOTICE);
                }
                break;
        }
    }

	switch ($type) {
	case 'textarea':
	  $output .= '<textarea name="'.smarty_function_escape_special_chars($name).'" ';
	  foreach ($options as $k => $v) {
	    $output .= smarty_function_escape_special_chars($k).'="'.smarty_function_escape_special_chars($v).'" ';
	  }
	  $output .= $extra.">".smarty_function_escape_special_chars($value)."</textarea>";
	  break;
	case 'checkbox':
	  $output .= '<input type="checkbox" ';
	  $output .= 'name="'.smarty_function_escape_special_chars($name).'" ';
	  $output .= 'value="'.smarty_function_escape_special_chars($value).'" ';
	  $output .= ($checked==true)?'checked="checked" ':'';
	  
	  foreach ($options as $k => $v) {
	    $output .= smarty_function_escape_special_chars($k).'="'.smarty_function_escape_special_chars($v).'" ';
	  }
	  $output .= $extra."/>";
	  break;
	case 'select':
		require_once(SMARTY_PLUGINS_DIR . 'function.html_options.php');
		$output = smarty_function_html_options($params, $template);
		break;
	default:
	  $output .= '<input type="'.smarty_function_escape_special_chars($type).'" ';
	  $output .= 'name="'.smarty_function_escape_special_chars($name).'" ';
	  $output .= (isset($value))?'value="'.smarty_function_escape_special_chars($value).'" ':'';
	  
	  foreach ($options as $k => $v) {
	    $output .= smarty_function_escape_special_chars($k).'="'.smarty_function_escape_special_chars($v).'" ';
	  }
	  $output .= $extra."/>";
	  break;
	}
	
	$output = ($label==true)?'<label>'.$output.'</label>':$output;
	return $output;



}
