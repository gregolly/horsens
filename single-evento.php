<?php
/**
 * Template para exibir um Evento único (CPT: evento)
 * Layout: Monca Trail (Tailwind CSS)
 */

get_header(); 
?>

<div class="w-full bg-brand-off-white min-h-screen py-12 px-4 sm:px-6 lg:px-8" data-scroll-reveal>
    <main id="main" class="max-w-7xl mx-auto">
    <?php 
    // Breadcrumb com fallback
    if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
        rank_math_the_breadcrumbs();
    } elseif ( function_exists( 'yoast_breadcrumb' ) ) {
        yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
    }
    ?>

    <?php
    if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        // Recuperar metadados
        $event_id = get_the_ID();
        $data = get_post_meta($event_id, '_horsens_data', true);
        $local = get_post_meta($event_id, '_horsens_local', true);
        $duracao = get_post_meta($event_id, '_horsens_duracao', true);
        
        // Consulta de inscritos
        $inscritos_query = new WP_Query(array(
            'post_type' => 'horsens_inscricao',
            'meta_key' => '_horsens_evento_id',
            'meta_value' => $event_id,
            'fields' => 'ids',
            'posts_per_page' => -1
        ));
        $num_inscritos = $inscritos_query->found_posts;
        wp_reset_postdata();

        // Link de Inscrição
        $link_inscricao = site_url('/inscricao?event_id=' . $event_id);
        
        // Formatação de Data
        $data_formatada = $data ? date_i18n('j \d\e F, Y', strtotime($data)) : 'A definir';
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-12 w-full h-64 md:h-96 bg-brand-cafe overflow-hidden shadow-sm">
                    <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24">
                
                <div class="lg:col-span-7">
                    <h1 class="font-serif text-4xl md:text-5xl text-brand-azul-escuro uppercase tracking-wide mb-4">
                        <?php the_title(); ?>
                    </h1>
                    <div class="w-16 h-1 bg-brand-marrom mb-8"></div> <div class="prose prose-lg text-brand-azul-escuro/80 font-sans leading-relaxed mb-10">
                        <?php 
                        // Mostra excerpt se tiver, senão content
                        if ( has_excerpt() ) {
                            the_excerpt();
                        } else {
                            the_content();
                        }
                        ?>
                    </div>

                    <a href="<?php echo esc_url($link_inscricao); ?>" 
                       class="inline-block bg-brand-marrom text-white font-sans font-medium uppercase tracking-widest py-4 px-12 hover:bg-brand-azul-escuro transition-colors duration-300 shadow-sm text-center min-w-[200px]">
                       Inscreva-se
                    </a>
                </div>

                <aside class="lg:col-span-5 lg:pt-4">
                    <div class="flex flex-col gap-y-6 font-sans text-sm md:text-base">
                        
                        <div class="flex justify-between items-baseline border-b border-brand-azul-escuro/10 pb-2">
                            <span class="text-brand-marrom font-bold uppercase tracking-wider">Participantes:</span>
                            <span class="text-brand-azul-escuro font-medium"><?php echo $num_inscritos; ?></span>
                        </div>

                        <div class="flex justify-between items-baseline border-b border-brand-azul-escuro/10 pb-2">
                            <span class="text-brand-marrom font-bold uppercase tracking-wider">Tipo:</span>
                            <span class="text-brand-azul-escuro text-right">
                                <?php 
                                $categories = get_the_terms($event_id, 'category');
                                if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                                    echo esc_html( $categories[0]->name );   
                                } else {
                                    echo '-';
                                }
                                ?>
                            </span>
                        </div>

                        <div class="flex justify-between items-baseline border-b border-brand-azul-escuro/10 pb-2">
                            <span class="text-brand-marrom font-bold uppercase tracking-wider">Localização:</span>
                            <span class="text-brand-azul-escuro text-right"><?php echo esc_html($local); ?></span>
                        </div>

                        <div class="flex justify-between items-baseline border-b border-brand-azul-escuro/10 pb-2">
                            <span class="text-brand-marrom font-bold uppercase tracking-wider">Data:</span>
                            <span class="text-brand-azul-escuro text-right"><?php echo $data_formatada; ?></span>
                        </div>

                        <div class="flex justify-between items-baseline border-b border-brand-azul-escuro/10 pb-2">
                            <span class="text-brand-marrom font-bold uppercase tracking-wider">Duração:</span>
                            <span class="text-brand-azul-escuro text-right"><?php echo esc_html($duracao); ?></span>
                        </div>

                        <?php 
                        $tags = get_the_tags();
                        if ($tags) : 
                        ?>
                        <div class="flex justify-between items-baseline border-b border-brand-azul-escuro/10 pb-2">
                            <span class="text-brand-marrom font-bold uppercase tracking-wider">Tags:</span>
                            <span class="text-brand-azul-escuro text-right">
                                <?php 
                                $tag_names = wp_list_pluck($tags, 'name');
                                echo esc_html(implode(', ', $tag_names)); 
                                ?>
                            </span>
                        </div>
                        <?php endif; ?>

                    <?php if( have_rows('contato_sociais', 'option') ): ?>
                        <div class="flex gap-4">
                            <?php 
                            while( have_rows('contato_sociais', 'option') ): the_row(); 
                                $icon = get_sub_field('social_icon');
                                $url = get_sub_field('social_url');
                            ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank"
                                class="w-12 h-12 bg-brand-marrom text-white p-3 hover:opacity-50 transition-colors">
                                    <?php if ($icon): ?>
                                        <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" class="w-full h-full object-contain">
                                    <?php endif; ?>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    </div>
                </aside>

            </div>

            <div class="mt-16 pt-8 border-t border-brand-azul-escuro/10 flex justify-between text-sm font-sans text-brand-azul-escuro/70">
                <div class="text-left">
                    <?php
                    previous_post_link(
                        '<span class="flex flex-col items-start group">%link</span>',
                        '<span class="text-base font-bold uppercase tracking-widest text-brand-marrom group-hover:text-brand-azul-escuro transition-colors">Evento Anterior</span>' .
                        '<span class="block text-lg font-serif mt-1 text-brand-azul-escuro">%title</span>'
                    );
                    ?>
                </div>
                <div class="text-right">
                    <?php 
                    next_post_link( 
                        '<span class="flex flex-col items-end group">%link</span>', 
                        '<span class="text-base font-bold uppercase tracking-widest text-brand-marrom group-hover:text-brand-azul-escuro transition-colors">Próximo Evento</span>' . 
                        '<span class="block text-lg font-serif mt-1 text-brand-azul-escuro">%title</span>'
                    ); 
                    ?>
                </div>
            </div>

        </article>

    <?php 
    endwhile; 
    endif;
    ?>

    </main>
</div>

<?php get_footer(); ?>