<?php
get_header('alt');
?>

<div id="primary">

<?php
if ( have_posts() ) :
    while ( have_posts() ) :
        
        the_post();
        
        the_content();
        
    endwhile;
else:
    echo "Nenhum conteúdo encontrado!";
endif;
?>

</div>

<?php
get_footer();
?>