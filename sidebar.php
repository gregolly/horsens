<?php
/**
 * A barra lateral contendo a área de widgets principal.
 */
?>

<aside id="secondary" class="widget-area w-full lg:w-1/4 flex flex-col gap-12">

    <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
        
        <?php dynamic_sidebar( 'sidebar-blog' ); ?>

    <?php else : ?>

    <!-- 1. Widget de Busca -->
    <div class="widget widget_search">
        <form role="search" method="get" class="flex w-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <label class="sr-only">Buscar por:</label>
            <input type="search" class="w-full bg-brand-cafe text-white placeholder-white/70 px-4 py-3 text-sm font-sans focus:outline-none" placeholder="Buscar" value="<?php echo get_search_query(); ?>" name="s" />
            <button type="submit" class="bg-brand-marrom text-white px-4 py-3 hover:bg-brand-azul-escuro transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>
    </div>

    <!-- 2. Widget de Categorias -->
    <div class="widget widget_categories">
        <h3 class="font-serif text-2xl text-brand-azul-escuro mb-6 flex items-center after:content-[''] after:h-px after:flex-1 after:bg-brand-marrom/40 after:ml-4">
            Categorias
        </h3>
        <ul class="space-y-3 font-sans text-sm text-brand-azul-escuro/80">
            <?php
            $categories = get_categories();
            foreach($categories as $category) {
                echo '<li class="flex justify-between items-center">';
                echo '<a href="' . get_category_link($category->term_id) . '" class="hover:text-brand-marrom transition-colors">' . $category->name . '</a>';
                echo '<span class="text-brand-azul-escuro/50">(' . $category->count . ')</span>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>

    <!-- 3. Widget de Últimas Postagens (Com Miniatura) -->
    <div class="widget widget_recent_entries">
        <h3 class="font-serif text-2xl text-brand-azul-escuro mb-6 flex items-center after:content-[''] after:h-px after:flex-1 after:bg-brand-marrom/40 after:ml-4">
            Últimas postagens
        </h3>
        <div class="flex flex-col gap-6">
            <?php
            // Query secundária para os posts recentes na sidebar
            $recent_posts = new WP_Query( array( 'posts_per_page' => 3, 'ignore_sticky_posts' => 1 ) );
            
            if ( $recent_posts->have_posts() ) :
                while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                    <div class="flex gap-4 group">
                        <!-- Miniatura Quadrada -->
                        <a href="<?php the_permalink(); ?>" class="shrink-0 w-20 h-20 bg-brand-cafe overflow-hidden block">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110']); ?>
                            <?php endif; ?>
                        </a>
                        <!-- Texto -->
                        <div class="flex flex-col justify-center">
                            <h4 class="font-sans text-sm font-medium leading-snug mb-1 text-brand-azul-escuro">
                                <a href="<?php the_permalink(); ?>" class="hover:text-brand-marrom transition-colors">
                                    <?php echo wp_trim_words( get_the_title(), 8, '...' ); ?>
                                </a>
                            </h4>
                            <span class="text-xs font-sans text-brand-azul-escuro/50 uppercase tracking-wider">
                                <?php echo get_the_date('d \d\e F, Y'); ?>
                            </span>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>

    <!-- 4. Widget de Redes Sociais (Estático) -->
    <div class="widget widget_social">
        <h3 class="font-serif text-2xl text-brand-azul-escuro mb-6 flex items-center after:content-[''] after:h-px after:flex-1 after:bg-brand-marrom/40 after:ml-4">
            Redes Sociais
        </h3>
        <div class="flex gap-3">
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
    </div>

    <!-- 5. Widget de Tags -->
    <div class="widget widget_tag_cloud">
        <h3 class="font-serif text-2xl text-brand-azul-escuro mb-6 flex items-center after:content-[''] after:h-px after:flex-1 after:bg-brand-marrom/40 after:ml-4">
            Tags
        </h3>
        <div class="flex flex-wrap gap-x-4 gap-y-2 text-xs font-sans font-bold uppercase tracking-widest text-brand-azul-escuro/60">
            <?php
            $tags = get_tags(array('orderby' => 'count', 'order' => 'DESC', 'number' => 15));
            foreach ( $tags as $tag ) {
                echo '<a href="' . get_tag_link( $tag->term_id ) . '" class="hover:text-brand-marrom transition-colors">' . $tag->name . '</a>';
            }
            ?>
        </div>
    </div>

    <?php endif; ?>

</aside>