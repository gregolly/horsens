<?php 
if (!defined('ABSPATH')) {
    exit;
}
if (! function_exists('_horsens_acf_json_save_point')) :
function _horsens_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}
endif;