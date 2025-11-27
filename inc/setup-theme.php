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
			'footer'  => 'Footer Menu',
			'alternative' => 'Alternative Menu'
		]);

		// Register sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar do Blog', 'horsens' ),
			'id'            => 'sidebar-blog',
			'description'   => esc_html__( 'Adicione widgets aqui.', 'horsens' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-12">', // Container do widget
			'after_widget'  => '</div>',
			// Título estilizado (Serifa, Azul Escuro, Linha Decorativa)
			'before_title'  => '<h3 class="widget-title font-serif text-2xl text-brand-azul-escuro mb-6 flex items-center after:content-[\'\'] after:h-px after:flex-1 after:bg-brand-marrom/40 after:ml-4">',
			'after_title'   => '</h3>',
    	) );
		
	}
endif;