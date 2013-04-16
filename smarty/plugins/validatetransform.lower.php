<?php

 /**
 * transform fuction, lowercase a value
 *
 * @param string $value the value being trimmed
 * @param array  $params the parameters passed to the transform function
 * @param array  $formvars the form variables
 */

function smarty_validate_transform_lower($value, $params, &$formvars) {
    return strtolower($value);
}

?>
