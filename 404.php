<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header('alt');
?>

<div class="w-full bg-brand-off-white min-h-[70vh] flex flex-col items-center justify-center px-4 py-20" data-scroll-reveal>
    
    <div class="max-w-3xl text-center">
        
        <div class="font-serif text-9xl md:text-[12rem] text-brand-azul-escuro/10 font-bold leading-none select-none">
            404
        </div>

        <div class="relative -mt-8 md:-mt-16">
            <h1 class="font-serif text-4xl md:text-5xl text-brand-azul-escuro uppercase tracking-wide mb-6">
                Página não encontrada
            </h1>
            
            <div class="w-16 h-1 bg-brand-marrom mx-auto mb-8"></div>

            <p class="font-sans text-lg text-brand-azul-escuro/70 leading-relaxed mb-10 max-w-lg mx-auto">
                Parece que você saiu da trilha. O conteúdo que você está procurando não existe, foi movido ou o link está incorreto.
            </p>

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
               class="inline-block bg-brand-marrom text-white font-sans font-medium uppercase tracking-widest py-4 px-12 hover:bg-brand-azul-escuro transition-colors duration-300 shadow-sm">
                Voltar ao Início
            </a>
        </div>

    </div>

</div>

<?php
get_footer();