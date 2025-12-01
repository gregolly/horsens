<?php
    /**
     * Template Part: Call to Action
     */
    $image_banner = get_field('imagem_banner', 113);
    $image_banner_url = $image_banner ? $image_banner['url'] : '';
    
    $titulo_banner = get_field('titulo_banner', 113);
    $link_whatsapp = get_field('link_whatsapp', 113);
    $icone = get_field('icone_whatsapp', 113);
    $texto_botao = get_field('texto_botao_whatsapp', 113);

    if (is_single('equipe')) : 
?>

<div class="banner-equipe relative overflow-hidden bg-cover bg-center min-h-[300px] flex items-center mb-20 lg:pl-0 pl-4" style="background-image: url('<?php echo esc_url($image_banner_url); ?>')">
    <div class="absolute inset-0 bg-brand-marrom diagonal-overlay"></div>
    <div class="container mx-auto relative z-10">
        <?php if ($titulo_banner) : ?>
            <h3 class="text-3xl text-brand-off-white w-[400px] mb-3"><?php echo esc_html($titulo_banner); ?></h3>
        <?php endif; ?>
        
        <?php if ($link_whatsapp && $texto_botao) : ?>
            <a href="<?php echo esc_url($link_whatsapp); ?>" class="inline-flex items-center gap-2 bg-brand-off-white text-brand-azul-escuro px-6 py-3 hover:opacity-75 transition-colors font-sans">
                <?php if ($icone) : ?>
                    <img src="<?php echo esc_url($icone['url']); ?>" alt="<?php echo esc_attr($icone['alt']); ?>">
                <?php endif; ?>
                <span><?php echo esc_html($texto_botao); ?></span>
            </a>
        <?php endif; ?>
    </div>
</div>

<?php else: ?>

<div class="banner-equipe relative overflow-hidden bg-cover bg-center min-h-[300px] flex items-center lg:pl-0 pl-4" style="background-image: url('<?php echo esc_url($image_banner_url); ?>')">
    <div class="absolute inset-0 bg-brand-marrom diagonal-overlay"></div>
    <div class="container mx-auto relative z-10">
        <?php if ($titulo_banner) : ?>
            <h3 class="text-3xl text-brand-off-white w-[400px] mb-3"><?php echo esc_html($titulo_banner); ?></h3>
        <?php endif; ?>
        
        <?php if ($link_whatsapp && $texto_botao) : ?>
            <a href="<?php echo esc_url($link_whatsapp); ?>" class="inline-flex items-center gap-2 bg-brand-off-white text-brand-azul-escuro px-6 py-3 hover:opacity-75 transition-colors font-sans">
                <?php if ($icone) : ?>
                    <img src="<?php echo esc_url($icone['url']); ?>" alt="<?php echo esc_attr($icone['alt']); ?>">
                <?php endif; ?>
                <span><?php echo esc_html($texto_botao); ?></span>
            </a>
        <?php endif; ?>
    </div>
</div>

<?php endif; ?>