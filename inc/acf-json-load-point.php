<?php
if (!defined('ABSPATH')) {
    exit;
}

if (! function_exists('_horsens_acf_json_load_point')) :
function _horsens_acf_json_load_point( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
endif;