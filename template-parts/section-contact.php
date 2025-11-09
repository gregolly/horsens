<?php 
// Template Part: Contact
$title = get_field('contato_titulo', 'option');
?>
<section id="contact" class="py-24" data-scroll-reveal>
    <div class="container mx-auto px-4">
        
        <div class="flex flex-col lg:flex-row lg:gap-16">

            <div class="lg:w-1/2 mb-12 lg:mb-0">
                <?php 
                echo do_shortcode('[contact-form-7 id="aa1e53c" title="Contact form 1"]'); 
                ?>
            </div>

            <div id="right-faq" class="lg:w-1/2 flex flex-col lg:items-start lg:text-right lg:items-end">
                
                <?php if ($title) : ?>
                    <h2 class="flex text-4xl font-serif text-brand-azul-escuro">
                        <?php echo esc_html($title) ?>
                    </h2>
                    <div class="w-16 h-0.5 bg-brand-marrom my-6"></div>
                <?php endif; ?>
                
                <?php the_field('contato_texto', 'option'); ?>
                

                <h3 class="text-2xl font-serif text-brand-azul-escuro mt-12 mb-4">
                    <?php the_field('contato_social_titulo', 'option'); ?>
                </h3>
                
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

            </div> </div> </div>
</section>