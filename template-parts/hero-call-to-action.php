<?php 
// Template Part: Call to action
?>
<div class="call-to-action absolute left-0 md:left-40 mt-4 text-wrap md:w-[500px] px-2">
    <h2 class="text-3xl md:text-4xl mb-2 text-brand-azul-escuro"><?php the_field('hero_titulo', 'option'); ?></h2>
    <h3 class="text-brand-azul-escuro font-sans md:w-[400px]"><?php the_field('hero_subtitulo', 'option'); ?></h3>
    <a href="<?php the_field('hero_link', 'option'); ?>" class="block mt-4 bg-brand-marrom text-center p-3 max-w-full mr-0 md:mr-1 md:w-[240px] font-sans hover:bg-brand-off-white hover:text-brand-azul-escuro ease-in duration-300">
        <?php the_field('hero_label_button', 'option'); ?>
    </a>
</div>