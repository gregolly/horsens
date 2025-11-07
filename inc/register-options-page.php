<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('_horsens_register_options_page')) :
    function _horsens_register_options_page() {
        if ( function_exists('acf_add_options_sub_page') ) {

            acf_add_options_sub_page(array(
                'page_title'  => 'Configurações do Tema', // The title on the page itself
                'menu_title'  => 'Configurações da página inicial', // The name in the sidebar menu
                'menu_slug'   => 'theme-general-settings',
                'parent_slug' => 'themes.php', // This puts it under "Appearance"
                'capability'  => 'edit_posts',
                'redirect'    => false
            ));
            
        }
    }   
endif;