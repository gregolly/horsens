<?php
/**
 * Theme setup functionality
 */
if (! function_exists('_horsens_theme_setup')) :
	function _horsens_theme_setup(): void {
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('custom-logo', array(
			'height'        => 160,
			'width'         => 160,
			'flex-height'    => true,
			'flex-width'     => true,
		));
		add_theme_support('html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		]);

		// Register menus
		register_nav_menus([
			'primary' => 'Primary Menu',
			'footer'  => 'Footer Menu'
		]);
	}
endif;