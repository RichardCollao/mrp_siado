<?php

/**
 * HELPERS TAGS 
 */
function helper_unordered_list($items) {
    if (is_empty($items)) {
        return;
    }
    $list = '<ul>';
    foreach ($items as $item) {
        $list .= '<li>' . $item . '</li>';
    }
    $list .= '</ul>';
    return $list;
}

function helper_ordered_list($items) {
    if (is_empty($items)) {
        return;
    }
    $list = '<ol>';
    foreach ($items as $item) {
        $list .= '<li>' . $item . '</li>';
    }
    $list .= '</ol>';
    return $list;
}

// Prepara el tag <option> de la etiqueta <select> y realiza una comparacion para autoseleccionar la opcion deseada.
function helper_option($value, $str, $select = '') {
    $tag = '<option value="' . $value . '"';
    // Si $value es igual a $select, entonces se incluira el parametro 
    // selected="selected"
    if ($select != '' & $value == $select) {
        $tag .= ' selected="selected" ';
    }
    $tag .= '>' . $str . '</option>';
    return $tag;
}

function helper_img($path, $parameters = array()) {
    $str_parameters = '' . implode(' ', $parameters);
    $tag = '<img src="' . $path . '"' . $str_parameters . ' />';
    return $tag;
}

/**
 * HELPERS BLOCKS
 */
function helper_select_country($param) {
    $tag = '<select name="country">';
    $tag .= '<option value="">&nbsp;</option>';
    foreach (Country::getList() as $extention => $country) {
        $tag .= helper_tag_option($extention, $country, $param);
    }
    $tag .= '</select>';
    return $tag;
}
