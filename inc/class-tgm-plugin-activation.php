<?php

if (!function_exists('_horsens_register_required_plugins')) :
    function _horsens_register_required_plugins() {
        $plugins = array(

            // --- SEU PLUGIN 1: EVENTOS ---
            array(
                'name'               => 'Horsens Eventos', // Nome que aparece na lista
                'slug'               => 'horsens-events', // A pasta do plugin (ex: wp-content/plugins/horsens-events)
                'source'             => get_template_directory() . '/inc/bundled-plugins/horsens-events.zip', // Onde está o zip
                'required'           => true, // É obrigatório?
                'version'            => '1.0', // Versão atual (opcional, mas bom para controle)
                'force_activation'   => false, // Se true, o usuário não consegue desativar
            ),

            // --- SEU PLUGIN 2: CORE ---
            array(
                'name'               => 'Funcionalidades Personalizadas',
                'slug'               => 'horsens-post-types', // Supondo que a pasta do plugin seja essa
                'source'             => get_template_directory() . '/inc/bundled-plugins/horsens-post-types.zip',
                'required'           => true,
            ),

            // --- PLUGINS EXTERNOS (ACF, etc) continuam aqui ---
            array(
                'name'      => 'Advanced Custom Fields',
                'slug'      => 'advanced-custom-fields',
                'required'  => true,
            ),
        );

        $config = array(
            'id'           => 'horsens',
            'default_path' => '',
            'menu'         => 'tgmpa-install-plugins',
            'has_notices'  => true,
            'dismissable'  => true,
            'is_automatic' => true, // DICA: Mude para 'true' para tentar ativar assim que instalar
        );

        tgmpa( $plugins, $config );
    }
endif;