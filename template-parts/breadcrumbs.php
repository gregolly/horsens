<?php 
// Breadcrumb com fallback
if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
    rank_math_the_breadcrumbs();
} elseif ( function_exists( 'yoast_breadcrumb' ) ) {
    yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
}
?>