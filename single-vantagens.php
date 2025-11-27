<?php 
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
    ?>

    <div class="font-sans text-brand-azul-escuro mt-6"><?php the_content(); ?></div>
    <?php get_template_part('template-parts/section-contact'); ?>

    <?php 
    wp_reset_postdata();
    endwhile; 
    endif;
    ?>
    </main>


</div>

<?php 
get_footer();
?>