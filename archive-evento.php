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

<div id="evento" class="w-full bg-brand-off-white min-h-screen py-12 px-4 sm:px-6 lg:px-8" data-scroll-reveal>

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
                
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('group flex flex-col bg-brand-off-white border-2 border-transparent transition-colors duration-300'); ?>>
                    
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
                    </div>

                    <div class="flex flex-col flex-grow p-6 pt-8 bg-brand-bg-section">
                        
                    <div class="mb-2 font-sans text-xs font-bold uppercase tracking-widest text-brand-azul-escuro/50">
                        <?php 
                        $categories = get_the_terms($event_id, 'category');
                        
                        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                            // 1. Extrai apenas os nomes do array de objetos de categoria
                            $category_names = wp_list_pluck( $categories, 'name' );
                            
                            // 2. Junta os nomes com uma vírgula e espaço
                            echo esc_html( implode( ', ', $category_names ) );   
                        }
                        ?>
                    </div>

                        <h2 class="font-serif text-2xl text-brand-azul-escuro uppercase leading-tight">
                            <a href="<?php the_permalink(); ?>" class="hover:text-brand-marrom transition-colors">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <?php 
                            // Formatação da data
                            $data_formatada = $data ? date_i18n('d/m/Y', strtotime($data)) : 'Data a definir';
                        ?>
                        <div class="text-brand-cafe font-sans text-xs">
                            <?php echo $data_formatada; ?>,
                            <?php if($local): ?>
                                <?php echo esc_html($local); ?>
                            <?php endif; ?>
                        </div>

                        <div class="font-sans text-brand-azul-escuro/80 text-sm leading-relaxed mb-6 mt-2 line-clamp-3 flex-grow">
                            <?php 
                            if (has_excerpt()) {
                                echo wp_trim_words(get_the_excerpt(), 15, '...');
                            } else {
                                echo wp_trim_words(get_the_content(), 15, '...');
                            }
                            ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="mt-auto inline-flex items-center font-sans text-xs font-bold uppercase tracking-widest text-brand-marrom hover:text-brand-azul-escuro transition-colors group/btn">
                            Ver Detalhes e Inscrever-se
                            <span class="ml-2 text-lg leading-none transition-transform duration-300 group-hover:translate-x-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_105_1798)">
                                    <path d="M0.0529182 11.6279C0.207585 11.4578 0.368084 11.3962 0.595249 11.3729C0.6613 11.3721 0.727363 11.372 0.793416 11.3726C0.830146 11.3723 0.866876 11.3721 0.904719 11.3719C1.02798 11.3712 1.15122 11.3716 1.27448 11.3719C1.36366 11.3717 1.45284 11.3714 1.54203 11.371C1.78724 11.3701 2.03245 11.3702 2.27766 11.3703C2.54204 11.3704 2.80641 11.3696 3.07079 11.3689C3.52889 11.3678 3.98698 11.3673 4.44508 11.3671C5.10742 11.3668 5.76975 11.3657 6.43209 11.3644C7.50665 11.3624 8.58121 11.361 9.65577 11.36C10.6997 11.359 11.7436 11.3577 12.7875 11.3561C12.8358 11.356 12.8358 11.356 12.885 11.3559C13.2082 11.3554 13.5313 11.3549 13.8545 11.3543C16.5645 11.3499 19.2745 11.3465 21.9846 11.3438C21.9631 11.3224 21.9416 11.301 21.9195 11.279C21.3978 10.7593 20.8763 10.2394 20.3552 9.7192C20.1031 9.46764 19.851 9.21617 19.5986 8.9649C19.3787 8.74594 19.159 8.52681 18.9395 8.30748C18.8232 8.19132 18.7068 8.07524 18.5903 7.95936C18.4602 7.8301 18.3306 7.70047 18.201 7.57081C18.1621 7.5323 18.1233 7.4938 18.0833 7.45413C18.0481 7.41883 18.0129 7.38353 17.9767 7.34717C17.946 7.31653 17.9153 7.2859 17.8836 7.25433C17.755 7.10477 17.7496 6.94504 17.7528 6.75293C17.7748 6.58945 17.8458 6.49668 17.9533 6.375C18.115 6.25845 18.2437 6.22211 18.4396 6.22852C18.6082 6.25756 18.7015 6.30378 18.8273 6.41886C18.8598 6.44858 18.8923 6.4783 18.9258 6.50891C19.125 6.69834 19.3205 6.89114 19.515 7.08537C19.5624 7.13254 19.6098 7.1797 19.6572 7.22685C19.7848 7.35389 19.9123 7.48108 20.0398 7.60832C20.1195 7.68794 20.1993 7.76754 20.2791 7.84712C20.5292 8.09655 20.7791 8.34606 21.029 8.59572C21.3167 8.88322 21.6047 9.17042 21.893 9.45736C22.1165 9.67981 22.3397 9.90253 22.5627 10.1255C22.6956 10.2584 22.8287 10.3911 22.962 10.5236C23.0872 10.6481 23.2121 10.7729 23.3368 10.898C23.3825 10.9437 23.4283 10.9893 23.4743 11.0348C23.5371 11.0971 23.5995 11.1598 23.6619 11.2226C23.6969 11.2575 23.7319 11.2924 23.7679 11.3284C23.9425 11.5362 24.0203 11.7267 24.0207 11.9971C24.0216 12.0429 24.0225 12.0888 24.0234 12.136C23.9565 12.5537 23.6166 12.8255 23.3304 13.1099C23.2808 13.1596 23.2313 13.2094 23.1818 13.2592C23.0479 13.3937 22.9136 13.5278 22.7791 13.6618C22.6383 13.8023 22.4977 13.9432 22.3572 14.084C22.1212 14.3202 21.8849 14.5561 21.6485 14.7919C21.3752 15.0644 21.1025 15.3374 20.83 15.6106C20.5958 15.8455 20.3613 16.0801 20.1266 16.3144C19.9865 16.4543 19.8465 16.5942 19.7068 16.7344C19.5755 16.8662 19.4438 16.9975 19.3119 17.1286C19.2636 17.1768 19.2154 17.225 19.1673 17.2734C19.1016 17.3395 19.0355 17.4051 18.9693 17.4706C18.9324 17.5074 18.8956 17.5443 18.8576 17.5822C18.7177 17.699 18.5917 17.7617 18.4089 17.7711C18.1739 17.7455 18.0283 17.7102 17.8596 17.5313C17.7519 17.3877 17.7533 17.2437 17.7488 17.0671C17.7855 16.8548 17.9298 16.6993 18.0782 16.5514C18.1127 16.5167 18.1472 16.4821 18.1827 16.4464C18.2204 16.4091 18.258 16.3718 18.2968 16.3334C18.3565 16.2737 18.3565 16.2737 18.4174 16.2128C18.5261 16.104 18.6351 15.9955 18.7442 15.8871C18.8583 15.7736 18.9721 15.6598 19.086 15.5461C19.3014 15.3309 19.5171 15.116 19.7329 14.9012C19.9786 14.6565 20.2241 14.4116 20.4695 14.1666C20.9742 13.6628 21.4793 13.1594 21.9846 12.6563C21.939 12.6562 21.8935 12.6562 21.8466 12.6561C19.1505 12.6534 16.4543 12.6499 13.7581 12.6455C13.4346 12.645 13.111 12.6445 12.7875 12.6439C12.7553 12.6439 12.7231 12.6438 12.69 12.6438C11.6461 12.6421 10.6022 12.6409 9.55839 12.6399C8.45544 12.6389 7.35249 12.6373 6.24954 12.6352C5.58867 12.634 4.92779 12.6331 4.26691 12.6328C3.81409 12.6326 3.36127 12.6318 2.90844 12.6307C2.64696 12.63 2.38548 12.6296 2.12399 12.6298C1.88475 12.6299 1.64552 12.6294 1.40627 12.6284C1.31959 12.6282 1.2329 12.6282 1.14621 12.6284C1.0286 12.6287 0.911023 12.6282 0.793416 12.6274C0.759561 12.6277 0.725706 12.628 0.690825 12.6283C0.473595 12.6257 0.325843 12.582 0.140809 12.4688C-0.0672218 12.2399 -0.0528687 11.9042 0.0529182 11.6279Z" fill="#A97C5B"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_105_1798">
                                    <rect width="24" height="24" fill="white" transform="matrix(0 -1 1 0 0 24)"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </span>
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