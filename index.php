<?php
get_header();
?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		// get_template_part();
	endwhile;
else:
	echo "Nenhum conteudo encontrado!";
endif;
?>

<?php
get_footer();
?>