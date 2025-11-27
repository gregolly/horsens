<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset=”<?php bloginfo('charset'); ?>”>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-brand-off-white font-serif'); ?>>
<?php wp_body_open(); ?>

<?php
$hero_height_class = '';
$hero_image_url = '';

if (is_front_page()) {
    $hero_height_class = 'h-[32rem] md:h-screen';
    
    $image_home = get_field('imagem_de_fundo_pagina_inicial', 'option');
    if ( $image_home ) {
        $hero_image_url = $image_home['url'];
    }
} 
elseif (is_singular('vantagens')) {
    $hero_height_class = 'h-[20rem] md:h-[28rem]';

    $image_interna = get_field('imagem_de_fundo_single_vantagens');
    if ($image_interna) {
        $hero_image_url = $image_interna['url'];
    }
} 
elseif (is_singular('evento')) {
    $hero_height_class = 'h-[20rem] md:h-[28rem]';

    $image_interna = get_field('imagem_de_fundo_single_evento');
    if ( $image_interna ) {
        $hero_image_url = $image_interna['url'];
    }
} 
elseif (is_singular('equipe')) {
    $hero_height_class = 'h-[20rem] md:h-[28rem]';

    $image_interna = get_field('imagem_de_fundo_paginas_internas');
    if ( $image_interna ) {
        $hero_image_url = $image_interna['url'];
    }
} 
elseif (is_page_template('archive-evento.php')) {
    $hero_height_class = 'h-[20rem] md:h-[28rem]';

    $image_interna = get_field('imagem_de_fundo_archive_evento');
    if ( $image_interna ) {
        $hero_image_url = $image_interna['url'];
    }
    
} 
elseif (is_home()) {
    $hero_height_class = 'h-[20rem] md:h-[28rem]';

    $blog_page_id = get_option('page_for_posts');

    $image_interna = get_field('imagem_de_fundo_blog', $blog_page_id);
    if ( $image_interna ) {
        $hero_image_url = $image_interna['url'];
    } 
}
else {
    $hero_height_class = 'h-[20rem] md:h-[28rem]';

    $image_interna = get_field('imagem_de_fundo_paginas_internas', 'option');
    if ( $image_interna ) {
        $hero_image_url = $image_interna['url'];
    }
}
?>

<section id="hero" class="relative <?php echo esc_attr($hero_height_class); ?> overflow-hidden" data-scroll-reveal>
    <div class="relative <?php echo esc_attr($hero_height_class); ?> bg-cover bg-center" 
         style="background-image: url('<?php echo esc_url($hero_image_url); ?>')">
    </div>
        <header id="header" class="absolute inset-x-0 top-0 z-50">
            <div class="container mx-auto">
                <div class="header-overlay-gradient"></div>
                
                <nav aria-label="Global" class="relative z-10 flex items-center justify-between p-6 lg:px-8">
                    
                    <div id="search" class="flex lg:flex">
                        <button id="search-open-button" type="button">
                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.6667 0C4.78826 0 0 4.78826 0 10.6667C0 16.5451 4.78826 21.3333 10.6667 21.3333C13.2229 21.3333 15.5705 20.4256 17.4104 18.9187L23.7792 25.2875C23.8775 25.3899 23.9952 25.4716 24.1255 25.5279C24.2557 25.5842 24.3959 25.614 24.5378 25.6154C24.6797 25.6168 24.8205 25.59 24.9519 25.5363C25.0833 25.4827 25.2027 25.4034 25.303 25.303C25.4034 25.2027 25.4827 25.0833 25.5363 24.9519C25.59 24.8205 25.6168 24.6797 25.6154 24.5378C25.614 24.3959 25.5842 24.2557 25.5279 24.1255C25.4716 23.9952 25.3899 23.8775 25.2875 23.7792L18.9187 17.4104C20.4256 15.5705 21.3333 13.2229 21.3333 10.6667C21.3333 4.78826 16.5451 0 10.6667 0ZM10.6667 2.13333C15.3921 2.13333 19.2 5.9412 19.2 10.6667C19.2 15.3921 15.3921 19.2 10.6667 19.2C5.9412 19.2 2.13333 15.3921 2.13333 10.6667C2.13333 5.9412 5.9412 2.13333 10.6667 2.13333Z" fill="white"/>
                            </svg>
                        </button>
                    </div>

                    <div id="logo" class="lg:flex">
                        <?php
                        if (has_custom_logo()) {
                            if ( !is_front_page()) {
                                $logo_alt = get_field('logo_alt', 'option');
                                
                                echo "<a href='" . esc_url(home_url('/')) . "'>";
                                echo "<img class='w-40' src='" . esc_url($logo_alt['url']). "' alt='" . esc_attr($logo_alt['alt']) . "' />";
                                echo "</a>";

                            } elseif (!is_single()) {
                                $custom_logo_id = get_theme_mod('custom_logo');
                                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                                if (has_custom_logo()) {
                                    
                                    echo "<a href='" . esc_url(home_url('/')) . "'>";
                                    echo wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                                        'class' => 'custom-logo',
                                        'alt'   => get_bloginfo('name')
                                    ) );
                                    echo "</a>";

                                }
                            }
                        } else {
                            echo "<a href='" . esc_url(home_url('/')) . "' class='text-decoration-none text-dark'><h1 class='display-2'>Horsens</h1></a>";
                        }
                        ?>
                    </div>

                    <div id="menu" class="flex lg:flex">
                        <button id="menu-button" type="button">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.20002 7.46667C3.05868 7.46467 2.91834 7.49078 2.78718 7.54349C2.65601 7.5962 2.53663 7.67445 2.43597 7.7737C2.33531 7.87294 2.25537 7.99121 2.20082 8.12161C2.14626 8.25202 2.11816 8.39197 2.11816 8.53333C2.11816 8.67469 2.14626 8.81464 2.20082 8.94505C2.25537 9.07546 2.33531 9.19372 2.43597 9.29297C2.53663 9.39222 2.65601 9.47047 2.78718 9.52318C2.91834 9.57589 3.05868 9.602 3.20002 9.6H28.8C28.9414 9.602 29.0817 9.57589 29.2129 9.52318C29.344 9.47047 29.4634 9.39222 29.5641 9.29297C29.6647 9.19372 29.7447 9.07546 29.7992 8.94505C29.8538 8.81464 29.8819 8.67469 29.8819 8.53333C29.8819 8.39197 29.8538 8.25202 29.7992 8.12161C29.7447 7.99121 29.6647 7.87294 29.5641 7.7737C29.4634 7.67445 29.344 7.5962 29.2129 7.54349C29.0817 7.49078 28.9414 7.46467 28.8 7.46667H3.20002ZM3.20002 14.9333C3.05868 14.9313 2.91834 14.9574 2.78718 15.0102C2.65601 15.0629 2.53663 15.1411 2.43597 15.2404C2.33531 15.3396 2.25537 15.4579 2.20082 15.5883C2.14626 15.7187 2.11816 15.8586 2.11816 16C2.11816 16.1414 2.14626 16.2813 2.20082 16.4117C2.25537 16.5421 2.33531 16.6604 2.43597 16.7596C2.53663 16.8589 2.65601 16.9371 2.78718 16.9898C2.91834 17.0426 3.05868 17.0687 3.20002 17.0667H28.8C28.9414 17.0687 29.0817 17.0426 29.2129 16.9898C29.344 16.9371 29.4634 16.8589 29.5641 16.7596C29.6647 16.6604 29.7447 16.5421 29.7992 16.4117C29.8538 16.2813 29.8819 16.1414 29.8819 16C29.8819 15.8586 29.8538 15.7187 29.7992 15.5883C29.7447 15.4579 29.6647 15.3396 29.5641 15.2404C29.4634 15.1411 29.344 15.0629 29.2129 15.0102C29.0817 14.9574 28.9414 14.9313 28.8 14.9333H3.20002ZM3.20002 22.4C3.05868 22.398 2.91834 22.4241 2.78718 22.4768C2.65601 22.5295 2.53663 22.6078 2.43597 22.707C2.33531 22.8063 2.25537 22.9245 2.20082 23.0549C2.14626 23.1854 2.11816 23.3253 2.11816 23.4667C2.11816 23.608 2.14626 23.748 2.20082 23.8784C2.25537 24.0088 2.33531 24.1271 2.43597 24.2263C2.53663 24.3256 2.65601 24.4038 2.78718 24.4565C2.91834 24.5092 3.05868 24.5353 3.20002 24.5333H28.8C28.9414 24.5353 29.0817 24.5092 29.2129 24.4565C29.344 24.4038 29.4634 24.3256 29.5641 24.2263C29.6647 24.1271 29.7447 24.0088 29.7992 23.8784C29.8538 23.748 29.8819 23.608 29.8819 23.4667C29.8819 23.3253 29.8538 23.1854 29.7992 23.0549C29.7447 22.9245 29.6647 22.8063 29.5641 22.707C29.4634 22.6078 29.344 22.5295 29.2129 22.4768C29.0817 22.4241 28.9414 22.398 28.8 22.4H3.20002Z" fill="white"/>
                            </svg>
                        </button>
                    </div>
                </nav>

                <?php get_template_part('template-parts/hero-call-to-action'); ?>
            </div>
        </header>
    </div>
</section>