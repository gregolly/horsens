<?php
// Pagina de posts
get_header(); 
?>

<!-- Container Principal -->
<div id="blog-feed" class="w-full bg-brand-off-white min-h-screen py-16 px-4 sm:px-6 lg:px-8" data-scroll-reveal>
    <main class="max-w-7xl mx-auto">

        <!-- Layout de Duas Colunas (Sidebar Esquerda + Conteúdo Direita) -->
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">
            
            <!-- COLUNA 1: Sidebar (Importada do sidebar.php) -->
            <?php get_sidebar(); ?>

            <!-- COLUNA 2: Feed de Posts -->
            <div class="w-full lg:w-3/4 order-1 lg:order-2">
                <!-- Breadcrumb Simples -->
                <?php 
                if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
                    rank_math_the_breadcrumbs();
                } elseif ( function_exists( 'yoast_breadcrumb' ) ) {
                    yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
                }
                ?>
                
                <?php if ( have_posts() ) : ?>
                    
                    <div class="flex flex-col gap-16">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('flex flex-col group'); ?>>
                            
                            <!-- Imagem Grande -->
                            <a href="<?php the_permalink(); ?>" class="block w-full h-64 md:h-[450px] bg-brand-cafe overflow-hidden mb-8 shadow-sm">
                                <?php 
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('large', ['class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-105']);
                                } else {
                                    // Placeholder
                                    echo '<div class="w-full h-full flex items-center justify-center text-brand-bege-claro/30 font-sans uppercase tracking-widest">Sem imagem</div>';
                                }
                                ?>
                            </a>

                            <!-- Conteúdo -->
                            <div class="flex flex-col items-start">
                                
                                <!-- Data -->
                                <div class="text-xs font-sans font-bold text-brand-azul-escuro/60 uppercase tracking-widest mb-3">
                                    <?php echo get_the_date('d \d\e F, Y'); ?>
                                </div>

                                <!-- Título -->
                                <h2 class="font-serif text-3xl md:text-4xl text-brand-azul-escuro mb-4 leading-tight">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-brand-marrom transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <!-- Resumo -->
                                <div class="font-sans text-brand-azul-escuro/70 text-base md:text-lg leading-relaxed mb-6 line-clamp-3">
                                    <?php echo wp_trim_words(get_the_excerpt(), 35, '...'); ?>
                                </div>

                                <!-- Botão Saiba Mais -->
                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center font-sans text-xs font-bold uppercase tracking-widest text-brand-marrom hover:text-brand-azul-escuro transition-colors group/btn">
                                    Saiba mais
                                    <span class="ml-2 text-xl leading-none transition-transform duration-300 group-hover:translate-x-1">→</span>
                                </a>
                            </div>

                        </article>

                    <?php endwhile; ?>
                    </div>

                    <!-- Paginação -->
                    <div class="mt-20 pt-10 text-center font-serif text-lg">
                        <div class="inline-flex items-center gap-4 [&>.page-numbers]:text-brand-azul-escuro/50 [&>.page-numbers.current]:text-brand-azul-escuro [&>.page-numbers.current]:font-bold [&>.page-numbers:hover]:text-brand-marrom">
                            <?php
                            echo paginate_links( array(
                                'prev_text' => '<span class="text-2xl">‹</span>',
                                'next_text' => '<span class="text-2xl">›</span>',
                                'type' => 'plain',
                            ) );
                            ?>
                        </div>
                    </div>

                <?php else : ?>
                    <p class="text-center font-serif text-xl text-brand-azul-escuro/60 py-20">Nenhum post encontrado.</p>
                <?php endif; ?>

            </div> <!-- Fim da Coluna de Conteúdo -->

        </div> <!-- Fim do Flex Container -->

    </main>
</div>

<?php get_footer(); ?>