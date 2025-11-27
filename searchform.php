<?php
/**
 * Template personalizado para o formulário de busca (get_search_form)
 */
?>
<form role="search" method="get" class="flex w-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="sr-only">Buscar por:</label>
    
    <input 
        type="search" 
        class="w-full bg-brand-cafe text-white placeholder-white/70 px-4 py-3 text-sm font-sans focus:outline-none focus:ring-1 focus:ring-brand-marrom transition-all" 
        placeholder="Buscar..." 
        value="<?php echo get_search_query(); ?>" 
        name="s" 
    />
    
    <button type="submit" class="bg-brand-marrom text-white px-4 py-3 hover:bg-brand-azul-escuro transition-colors duration-300" aria-label="Pesquisar">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </button>
</form>