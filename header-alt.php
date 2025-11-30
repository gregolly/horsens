<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset=”<?php bloginfo('charset'); ?>”>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-brand-off-white font-serif'); ?>>
<?php wp_body_open(); ?>

<header id="header" class="bg-brand-cafe">
    <div class="container mx-auto">
        <nav aria-label="Global" class="relative z-10 flex items-center justify-between p-6 lg:px-8">
            
            <div class="flex lg:flex-1">
                <div id="logo">
                    <?php
                    if (has_custom_logo()) {
                        // Lógica para não linkar o logo na home, apenas nas internas
                        if ( !is_front_page()) {
                            $logo_alt = get_field('logo_alt', 'option');
                            // Ajuste o tamanho w-32 ou w-40 conforme sua preferência
                            echo "<a href='" . esc_url(home_url('/')) . "'>";
                            echo "<img class='w-32 md:w-40 h-auto' src='" . esc_url($logo_alt['url']). "' alt='" . esc_attr($logo_alt['alt']) . "' />";
                            echo "</a>";
                        } elseif (!is_single()) {
                            // Fallback para o logo padrão do customizer se não houver campo ACF
                            $custom_logo_id = get_theme_mod('custom_logo');
                            if (has_custom_logo()) {
                                echo "<a href='" . esc_url(home_url('/')) . "'>";
                                echo wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                                    'class' => 'custom-logo w-32 md:w-40 h-auto',
                                    'alt'   => get_bloginfo('name')
                                ) );
                                echo "</a>";
                            }
                        }
                    } else {
                        // Fallback de texto
                        echo "<a href='" . esc_url(home_url('/')) . "' class='text-decoration-none text-white'><h1 class='text-2xl font-bold font-serif'>Horsens</h1></a>";
                    }
                    ?>
                </div>
            </div>

            <div class="hidden lg:flex lg:gap-x-8">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'alternative', // Verifique se o nome do local do menu está correto
                    'container'      => false,
                    'menu_class'     => 'flex gap-x-8',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'fallback_cb'    => false,
                    // Classes Tailwind: Texto branco, fonte sans, hover bege
                    'link_before'    => '<span class="text-sm font-sans font-medium leading-6 text-white hover:text-brand-bege-claro transition-colors duration-200">',
                    'link_after'     => '</span>'
                ));
                ?>
            </div>

            <div class="flex flex-1 justify-end gap-x-4 items-center">
                
                <div id="search" class="flex">
                    <button id="search-open-button" type="button" class="p-2 text-white hover:text-brand-bege-claro transition-colors duration-200 focus:outline-none" aria-label="Abrir busca">
                        <svg width="24" height="24" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.6667 0C4.78826 0 0 4.78826 0 10.6667C0 16.5451 4.78826 21.3333 10.6667 21.3333C13.2229 21.3333 15.5705 20.4256 17.4104 18.9187L23.7792 25.2875C23.8775 25.3899 23.9952 25.4716 24.1255 25.5279C24.2557 25.5842 24.3959 25.614 24.5378 25.6154C24.6797 25.6168 24.8205 25.59 24.9519 25.5363C25.0833 25.4827 25.2027 25.4034 25.303 25.303C25.4034 25.2027 25.4827 25.0833 25.5363 24.9519C25.59 24.8205 25.6168 24.6797 25.6154 24.5378C25.614 24.3959 25.5842 24.2557 25.5279 24.1255C25.4716 23.9952 25.3899 23.8775 25.2875 23.7792L18.9187 17.4104C20.4256 15.5705 21.3333 13.2229 21.3333 10.6667C21.3333 4.78826 16.5451 0 10.6667 0ZM10.6667 2.13333C15.3921 2.13333 19.2 5.9412 19.2 10.6667C19.2 15.3921 15.3921 19.2 10.6667 19.2C5.9412 19.2 2.13333 15.3921 2.13333 10.6667C2.13333 5.9412 5.9412 2.13333 10.6667 2.13333Z" fill="currentColor"/>
                        </svg>
                    </button>
                </div>

                <div id="menu" class="flex lg:hidden"> 
                    <button id="menu-button" type="button" class="p-2 text-white hover:text-brand-bege-claro transition-colors duration-200 focus:outline-none" aria-label="Abrir menu">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.20002 7.46667H28.8M3.20002 14.9333H28.8M3.20002 22.4H28.8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>

            </div>
        </nav>
    </div>
</header>