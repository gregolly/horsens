<?php
/**
 * Template para exibir um Evento único (CPT: evento)
 */

get_header(); 
?>

<div id="primary" class="content-area container" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <main id="main" class="site-main">

    <?php
    // INÍCIO DO LOOP PRINCIPAL
    if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        // Recuperar os meta dados
        $event_id = get_the_ID();
        $data = get_post_meta($event_id, '_horsens_data', true);
        $local = get_post_meta($event_id, '_horsens_local', true);
        $duracao = get_post_meta($event_id, '_horsens_duracao', true);
        
        // Consulta de inscritos
        $inscritos_query = new WP_Query(array(
            'post_type' => 'horsens_inscricao',
            'meta_key' => '_horsens_evento_id',
            'meta_value' => $event_id,
            'fields' => 'ids',
            'posts_per_page' => -1
        ));
        $num_inscritos = $inscritos_query->found_posts;
        wp_reset_postdata(); 
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <header class="entry-header" style="text-align: center; margin-bottom: 40px;">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="evento-imagem" style="margin-bottom: 20px;">
                        <?php the_post_thumbnail('large', ['style' => 'max-width:100%; height:auto; border-radius:8px;']); ?>
                    </div>
                <?php endif; ?>
                
                <h1 class="entry-title" style="font-size: 2.5rem;"><?php the_title(); ?></h1>
                
                <div class="evento-resumo" style="font-size: 1.2rem; color: #666; margin-top: 10px;">
                    <?php the_excerpt(); ?>
                </div>
            </header>

            <div class="evento-grid" style="display: flex; gap: 40px; flex-wrap: wrap;">
                
                <div class="evento-conteudo" style="flex: 2; min-width: 300px;">
                    <h2>Sobre o Evento</h2>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    
                    <div class="evento-footer" style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
                        <p><strong>Categorias:</strong> <?php the_category(', '); ?></p>
                        <p><?php the_tags('<strong>Tags:</strong> ', ', ', ''); ?></p>
                    </div>
                </div>

                <aside class="evento-sidebar" style="flex: 1; min-width: 250px;">
                    <div class="card-detalhes" style="background: #f4f4f4; padding: 25px; border-radius: 8px; position: sticky; top: 20px;">
                        <h3 style="margin-top: 0;">Ficha Técnica</h3>
                        <ul style="list-style: none; padding: 0; margin-bottom: 20px;">
                            <li style="margin-bottom: 10px;">
                                <strong>📅 Data:</strong><br>
                                <?php echo date_i18n(get_option('date_format'), strtotime($data)); ?>
                            </li>
                            <li style="margin-bottom: 10px;">
                                <strong>📍 Local:</strong><br>
                                <?php echo esc_html($local); ?>
                            </li>
                            <li style="margin-bottom: 10px;">
                                <strong>⏱ Duração:</strong><br>
                                <?php echo esc_html($duracao); ?>
                            </li>
                            <li style="margin-bottom: 10px;">
                                <strong>👥 Participantes:</strong><br>
                                <?php echo $num_inscritos; ?> confirmados
                            </li>
                        </ul>

                        <a href="<?php echo site_url('/inscricao?event_id=' . $event_id); ?>" 
                           class="button" 
                           style="display: block; text-align: center; background: #28a745; color: white; padding: 15px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                           Quero me Inscrever
                        </a>
                    </div>
                </aside>

            </div>

        </article>

    <?php 
    endwhile; // Fim do loop principal 
    endif;
    ?>

    </main>
</div>

<?php get_footer(); ?>