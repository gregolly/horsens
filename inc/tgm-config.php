<?php
/**
 * Configuração dos Plugins Necessários (TGM)
 */

function _horsens_register_required_plugins() {
	/*
	 * Array de plugins
	 */
	$plugins = array(

		// 1. SEU PLUGIN: EVENTOS
		array(
			'name'               => 'Horsens Eventos',
			'slug'               => 'horsens-events', // IMPORTANTE: A pasta DENTRO do zip deve ter esse nome exato
			'source'             => get_template_directory() . '/inc/bundled-plugins/horsens-events.zip',
			'required'           => true,
			'version'            => '1.0',
            'force_activation'   => false, 
		),

		// 2. SEU PLUGIN: CORE
		array(
			'name'               => 'Funcionalidades Personalizadas',
			'slug'               => 'horsens-post-types', // IMPORTANTE: A pasta DENTRO do zip deve ter esse nome exato
			'source'             => get_template_directory() . '/inc/bundled-plugins/horsens-post-types.zip',
			'required'           => true,
		),

		// 3. PLUGIN EXTERNO: ACF
		array(
			'name'      => 'Advanced Custom Fields Pro',
			'slug'      => 'advanced-custom-fields-pro',
			'required'  => true,
		),
	);

	/*
	 * Configurações da Ferramenta
	 */
	$config = array(
		'id'           => 'horsens',                 
		'default_path' => '',                      
		'menu'         => 'tgmpa-install-plugins', 
		'has_notices'  => true,                    
		'dismissable'  => true,                    
		'dismiss_msg'  => '',                      
		'is_automatic' => true, // Tenta ativar automaticamente                    
		'message'      => '',                      
	);

	tgmpa( $plugins, $config );
}
// Registra a função no gancho do TGM
add_action( 'tgmpa_register', '_horsens_register_required_plugins' );