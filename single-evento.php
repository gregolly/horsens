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

                        <div class="flex gap-2 mt-4">
                            <a href="#" class="w-8 h-8 flex items-center justify-center bg-brand-marrom text-white hover:bg-brand-azul-escuro transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a href="#" class="w-8 h-8 flex items-center justify-center bg-brand-marrom text-white hover:bg-brand-azul-escuro transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                            </a>
                        </div>

                    </div>
                </aside>

            </div>

            <div class="mt-16 pt-8 border-t border-brand-azul-escuro/10 flex justify-between text-sm font-sans text-brand-azul-escuro/70">
                <div class="text-left">
                    <?php previous_post_link('%link', '<span class="block text-2xl mb-1">‹</span> %title'); ?>
                </div>
                <div class="text-right">
                    <?php next_post_link('%link', '<span class="block text-2xl mb-1">›</span> %title'); ?>
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