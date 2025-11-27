<?php
/**
 * The template for displaying all single posts
 */

get_header('alt');
?>

<div class="w-full bg-brand-off-white min-h-screen py-12 px-4 sm:px-6 lg:px-8" data-scroll-reveal>
    <main id="main" class="mx-auto"> 
    <!-- Layout de Duas Colunas (Sidebar Esquerda + Conteúdo Direita) -->
    <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">
        
        <!-- COLUNA 1: Sidebar (Importada do sidebar.php) -->
        <?php get_sidebar(); ?>

        <!-- COLUNA 2: Feed de Posts -->
        <div class="w-full lg:w-3/4">
            <!-- Breadcrumb Simples -->
            <?php 
            if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
                rank_math_the_breadcrumbs();
            } elseif ( function_exists( 'yoast_breadcrumb' ) ) {
                yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
            }
            ?>
                
                <div class="flex flex-col gap-16">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <header class="mb-4">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="w-full h-64 md:h-[500px] overflow-hidden shadow-sm mb-4">
                                    <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
                                </div>
                            <?php endif; ?>

                            <div class="mb-4 font-sans text-xs font-bold uppercase tracking-widest text-brand-marrom">
                                <?php echo get_the_date(); ?> • <?php the_category(', '); ?>
                            </div>

                            <h1 class="font-serif text-3xl text-brand-azul-escuro uppercase tracking-wide leading-tight mb-4">
                                <?php the_title(); ?>
                            </h1>
                        </header>

                        <div class="prose prose-lg prose-headings:font-serif prose-headings:text-brand-azul-escuro prose-p:font-sans prose-p:text-brand-azul-escuro/80 prose-a:text-brand-marrom hover:prose-a:text-brand-azul-escuro max-w-none mx-auto">
                            <?php the_content(); ?>
                        </div>

                        <footer class="mt-16 pt-8 border-t border-brand-azul-escuro/10">
                            <?php
                            $tags_list = get_the_tag_list( '', ', ' );
                            if ( $tags_list ) {
                                printf( '<div class="font-sans text-sm text-brand-azul-escuro/60 italic mb-8">Tags: %1$s</div>', $tags_list );
                            }
                            ?>

                            <div class="flex justify-between text-sm font-sans font-bold uppercase tracking-widest text-brand-marrom">
                                <div class="text-left hover:text-brand-azul-escuro transition-colors">
                                    <?php previous_post_link('%link', '← Post Anterior'); ?>
                                </div>
                                <div class="text-right hover:text-brand-azul-escuro transition-colors">
                                    <?php next_post_link('%link', 'Próximo Post →'); ?>
                                </div>
                            </div>
                        </footer>

                    </article>

                <?php endwhile; ?>

                </main>
</div>

<?php get_footer(); ?>