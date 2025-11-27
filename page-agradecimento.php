<?php
/**
 * Template Name: Página de Agradecimento
 * Este arquivo será usado automaticamente se a página tiver o slug 'obrigado'
 */

get_header('alt');
?>

<!-- Container Principal (Fundo Off-White) -->
<div class="w-full bg-brand-off-white min-h-[80vh] flex flex-col items-center justify-center px-4 py-20">
    
    <div class="max-w-2xl text-center">
        
        <!-- Ícone de Sucesso Animado -->
        <div class="mb-10 flex justify-center">
            <div class="w-24 h-24 rounded-full bg-brand-marrom/10 flex items-center justify-center animate-bounce">
                <svg class="w-12 h-12 text-brand-marrom" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <!-- Título -->
        <h1 class="font-serif text-4xl md:text-6xl text-brand-azul-escuro uppercase tracking-wide leading-tight mb-6">
            Inscrição Confirmada!
        </h1>
        
        <!-- Linha Decorativa -->
        <div class="w-20 h-1 bg-brand-marrom mx-auto mb-8"></div>

        <!-- Mensagem de Texto -->
        <p class="font-sans text-lg md:text-xl text-brand-azul-escuro/70 leading-relaxed mb-4">
            Obrigado por garantir o seu lugar. Estamos muito felizes em ter você conosco!
        </p>
        
        <p class="font-sans text-base text-brand-azul-escuro/60 mb-12">
            Enviamos um e-mail com todos os detalhes da sua inscrição.<br>
            Caso não encontre, verifique sua caixa de spam.
        </p>

        <!-- Botões de Ação -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            
            <!-- Botão Secundário (Voltar para Eventos) -->
            <a href="<?php echo get_post_type_archive_link('evento'); ?>" 
               class="inline-block px-8 py-4 border border-brand-marrom text-brand-marrom font-sans font-bold uppercase tracking-widest text-xs hover:bg-brand-marrom hover:text-white transition-all duration-300">
               Ver mais eventos
            </a>

            <!-- Botão Primário (Voltar para Home) -->
            <a href="<?php echo home_url('/'); ?>" 
               class="inline-block px-8 py-4 bg-brand-marrom text-white font-sans font-bold uppercase tracking-widest text-xs hover:bg-brand-azul-escuro transition-colors duration-300 shadow-sm">
               Voltar ao Início
            </a>
            
        </div>

    </div>

</div>

<?php get_footer(); ?>