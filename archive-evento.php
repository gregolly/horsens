<?php
/**
 * Template Name: Eventos Personalizados
 */

get_header(); 

$args = array(
    'post_type'      => 'evento',
    'post_status'    => 'publish',
    'posts_per_page' => 10,
    'paged'          => ( get_query_var('paged') ) ? get_query_var('paged') : 1,
    'meta_query' => array(
        array(
            'key' => '_horsens_data',
            'compare' => 'EXISTS',
        )
    ),
    'meta_key'       => '_horsens_data',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
);

$eventos_query = new WP_Query( $args );
?>

<div id="primary" class="w-full bg-brand-off-white min-h-screen py-12 px-4 sm:px-6 lg:px-8">

    <main id="main" class="max-w-7xl mx-auto">
        <?php 
        // Breadcrumb com fallback
        if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
            rank_math_the_breadcrumbs();
        } elseif ( function_exists( 'yoast_breadcrumb' ) ) {
            yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
        }
        ?>

        <?php if ( $eventos_query->have_posts() ) : ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">

            <?php
            while ( $eventos_query->have_posts() ) :
                $eventos_query->the_post();

                $event_id = get_the_ID();
                $data = get_post_meta($event_id, '_horsens_data', true);
                $local = get_post_meta($event_id, '_horsens_local', true);
                
                // Formatação da data
                $data_formatada = $data ? date_i18n('d/m/Y', strtotime($data)) : 'Data a definir';
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('group flex flex-col bg-brand-off-white border-2 border-transparent hover:border-blue-500 transition-colors duration-300'); ?>>
                    
                    <div class="relative h-60 w-full bg-brand-cafe overflow-hidden">
                        <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                            <?php 
                            if (has_post_thumbnail()) {
                                // Imagem cobre a área (object-cover) e tem zoom suave no hover
                                the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105']);
                            } else {
                                // Placeholder escuro (brand-cafe) se não houver imagem
                                echo '<div class="w-full h-full flex items-center justify-center text-brand-bege-claro/50 font-sans text-sm tracking-widest uppercase">Sem imagem</div>';
                            }
                            ?>
                        </a>
                        
                        <div class="absolute top-4 right-4 bg-white/90 text-brand-azul-escuro px-3 py-2 font-sans text-xs font-bold uppercase tracking-wider shadow-sm">
                            📅 <?php echo $data_formatada; ?>
                        </div>
                    </div>

                    <div class="flex flex-col flex-grow p-6 pt-8">
                        
                        <div class="mb-2 font-sans text-xs font-bold uppercase tracking-widest text-brand-azul-escuro/50">
                            <?php 
                            $categories = get_the_terms($event_id, 'category');
                            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                                echo esc_html( $categories[0]->name );   
                            }
                            ?>
                        </div>

                        <h2 class="font-serif text-2xl text-brand-azul-escuro uppercase leading-tight mb-3">
                            <a href="<?php the_permalink(); ?>" class="hover:text-brand-marrom transition-colors">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <?php if($local): ?>
                        <p class="font-sans text-sm font-medium text-brand-azul-escuro/60 mb-4 flex items-center gap-1">
                            📍 <?php echo esc_html($local); ?>
                        </p>
                        <?php endif; ?>

                        <div class="font-sans text-brand-azul-escuro/80 text-sm leading-relaxed mb-6 line-clamp-3 flex-grow">
                            <?php 
                            if (has_excerpt()) {
                                echo wp_trim_words(get_the_excerpt(), 15, '...');
                            } else {
                                echo wp_trim_words(get_the_content(), 15, '...');
                            }
                            ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="mt-auto inline-flex items-center font-sans text-xs font-bold uppercase tracking-widest text-brand-marrom hover:text-brand-azul-escuro transition-colors group/btn">
                            Ver Detalhes e Inscrever
                            <span class="ml-2 text-lg leading-none transition-transform duration-300 group-hover:translate-x-1">→</span>
                        </a>
                    </div>

                </article>

            <?php endwhile; ?>
            
            </div>

            <div class="mt-16 text-center font-serif text-lg">
                <div class="inline-flex gap-4 [&>.page-numbers]:text-brand-azul-escuro/50 [&>.page-numbers.current]:text-brand-azul-escuro [&>.page-numbers.current]:font-bold [&>.page-numbers:hover]:text-brand-marrom">
                    <?php
                    echo paginate_links( array(
                        'total' => $eventos_query->max_num_pages,
                        'current' => max( 1, get_query_var('paged') ),
                        'mid_size' => 2,
                        'prev_text' => '«',
                        'next_text' => '»',
                        'type' => 'plain', // Garante saída limpa para estilizarmos com CSS arbitrário acima
                    ) );
                    ?>
                </div>
            </div>

        <?php else : ?>

            <div class="text-center py-20">
                <p class="font-serif text-2xl text-brand-azul-escuro">Nenhum evento encontrado no momento.</p>
            </div>

        <?php endif; ?>

    </main>
</div>

<?php
wp_reset_postdata(); 
get_footer(); 
?>