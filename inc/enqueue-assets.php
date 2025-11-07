<?php
if (!function_exists('_horsens_enqueue_assets')) :
function _horsens_enqueue_assets(): void {
	$css_version = filemtime( get_template_directory() . '/dist/css/style.min.css' );
	$js_version = filemtime( get_template_directory(). '/dist/js/bundle.min.js' );

    wp_enqueue_style(
        'horsens-main-style',
	    get_template_directory_uri() . '/dist/css/style.min.css',
        [],
		$css_version
    );

    wp_enqueue_script(
        'horsens-main-js',
	    get_template_directory_uri() . '/dist/js/bundle.min.js',
        [],
        $js_version,
        true // Carrega o script no rodapé (footer)
    );
}
endif;
