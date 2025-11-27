<?php
/**
 * Template Name: Search Results
 * Template para exibir resultados de busca
 */

get_header('alt'); 
?>

<div id="primary" class="w-full bg-brand-off-white min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <main id="main" class="max-w-7xl mx-auto">

        <header class="text-center mb-12">
            <p class="font-sans text-brand-azul-escuro/60 uppercase tracking-widest text-xs font-bold mb-2">
                Resultados da pesquisa por:
            </p>
            <h1 class="font-serif text-3xl md:text-5xl text-brand-azul-escuro uppercase tracking-wide">
                "<?php echo get_search_query(); ?>"
            </h1>
            
            <div class="w-16 h-1 bg-brand-marrom mx-auto mt-6"></div>
        </header>

        <?php if ( have_posts() ) : ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">

            <?php
            while ( have_posts() ) :
                the_post();
                
                // Verifica se é um Evento para pegar os dados específicos
                $is_event = get_post_type() === 'evento';
                $data_formatada = '';
                
                if ($is_event) {
                    $event_id = get_the_ID();
                    $data = get_post_meta($event_id, '_horsens_data', true);
                    $data_formatada = $data ? date_i18n('d/m/Y', strtotime($data)) : '';
                }
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('group flex flex-col bg-brand-off-white border-2 border-transparent hover:border-blue-500 transition-colors duration-300'); ?>>
                    
                    <div class="relative h-60 w-full bg-brand-cafe overflow-hidden">
                        <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                            <?php 
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105']);
                            } else {
                                echo '<div class="w-full h-full flex items-center justify-center text-brand-bege-claro/50 font-sans text-sm tracking-widest uppercase">Ver Detalhes</div>';
                            }
                            ?>
                        </a>
                        
                        <?php if ($is_event && $data_formatada) : ?>
                        <div class="absolute top-4 right-4 bg-white/90 text-brand-azul-escuro px-3 py-2 font-sans text-xs font-bold uppercase tracking-wider shadow-sm">
                            📅 <?php echo $data_formatada; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col flex-grow p-6 pt-8">
                        
                        <div class="mb-2 font-sans text-xs font-bold uppercase tracking-widest text-brand-azul-escuro/50">
                            <?php echo get_post_type_object(get_post_type())->labels->singular_name; ?>
                        </div>

                        <h2 class="font-serif text-2xl text-brand-azul-escuro uppercase leading-tight mb-3">
                            <a href="<?php the_permalink(); ?>" class="hover:text-brand-marrom transition-colors">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div class="font-sans text-brand-azul-escuro/80 text-sm leading-relaxed mb-6 line-clamp-3 flex-grow">
                            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="mt-auto inline-flex items-center font-sans text-xs font-bold uppercase tracking-widest text-brand-marrom hover:text-brand-azul-escuro transition-colors group/btn">
                            Ver <?php echo $is_event ? 'Evento' : 'Mais'; ?>
                            <span class="ml-2 text-lg leading-none transition-transform duration-300 group-hover:translate-x-1">→</span>
                        </a>
                    </div>

                </article>

            <?php endwhile; ?>
            
            </div>

            <div class="mt-16 text-center font-serif text-lg">
                <div class="inline-flex gap-4 [&>.page-numbers]:text-brand-azul-escuro/50 [&>.page-numbers.current]:text-brand-azul-escuro [&>.page-numbers.current]:font-bold [&>.page-numbers:hover]:text-brand-marrom">
                    <?php
                    echo paginate_links( array(
                        'prev_text' => '«',
                        'next_text' => '»',
                        'type' => 'plain',
                    ) );
                    ?>
                </div>
            </div>

        <?php else : ?>

            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="font-serif text-6xl text-brand-azul-escuro/10 mb-4">?</div>
                <h2 class="font-serif text-2xl text-brand-azul-escuro mb-4">Nenhum resultado encontrado</h2>
                <p class="font-sans text-brand-azul-escuro/70 max-w-md mx-auto mb-8">
                    Não encontramos nada correspondente a "<?php echo get_search_query(); ?>". Tente usar palavras-chave diferentes.
                </p>
                
                <a href="<?php echo home_url('/'); ?>" class="bg-brand-marrom text-white px-8 py-3 font-sans uppercase tracking-wider hover:bg-brand-azul-escuro transition-colors">
                    Voltar ao Início
                </a>
            </div>

        <?php endif; ?>

    </main>
</div>

<?php get_footer(); ?>