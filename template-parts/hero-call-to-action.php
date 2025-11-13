<?php
/**
 * Template Part: Call to Action
 */
?>

<div class="relative z-5 lg:pt-24 px-4 pt-4 md:pt-8 lg:ml-20" data-scroll-reveal>
    
    <?php if ( is_front_page() ) : ?>

        <h1 class="lg:text-4xl text-3xl font-serif text-brand-azul-escuro lg:w-[500px]">
            <?php the_field('titulo_hero_home', 'option'); // Ajuste o nome do campo se necessário ?>
        </h1>
        <p class="text-1xl md:text-2xl text-brand-azul-escuro mt-4 font-sans mb-8 lg:w-[600px]">
            <?php the_field('subtitulo_hero_home', 'option'); // Ajuste o nome do campo se necessário ?>
        </p>
        <a href="<?php the_field('hero_link', 'option'); ?>" class="mt-4 bg-brand-marrom hover:bg-brand-azul-escuro text-dark hover:text-brand-off-white transition-colors px-14 py-4 font-sans">
            <?php the_field('hero_label_button', 'option'); ?>
        </a>

    <?php elseif (is_single('equipe')) : ?>
        <h1 class="text-4xl md:text-6xl font-serif text-white text-center">
            Detalhes da Instrutora
        </h1>

    <?php else : ?>

        <h1 class="text-4xl md:text-6xl font-serif text-white text-center">
            <?php the_title(); ?>
        </h1>

    <?php endif; ?>

</div>