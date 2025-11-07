	<?php
	/**
	 * Horsens Theme functions and definitions
	 */

	if (!defined('ABSPATH')) {
		exit;
	}

	// Include theme files
	require_once __DIR__ . '/inc/setup-theme.php';
	require_once __DIR__ . '/inc/enqueue-assets.php';
	require_once __DIR__ . '/inc/acf-json-save-point.php';
	require_once __DIR__ . '/inc/acf-json-load-point.php';
	require_once __DIR__ . '/inc/register-options-page.php';
	require_once __DIR__ . '/inc/helpers.php';

	// Hooks
	add_action( 'wp_enqueue_scripts', '_horsens_enqueue_assets' );
	add_action('after_setup_theme', '_horsens_theme_setup');
	add_action('acf/init', '_horsens_register_options_page');
	// Filters
	add_filter('acf/settings/save_json', '_horsens_acf_json_save_point');
	add_filter('acf/settings/load_json', '_horsens_acf_json_load_point');
	add_filter('upload_mimes', '_horsens_cc_mime_types');
	add_filter('wp_check_filetype_and_ext', '_horsens_fix_svg_mime_type', 10, 4);