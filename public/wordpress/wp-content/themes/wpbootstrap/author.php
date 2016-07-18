<!-- Archivo de cabecera global de Wordpress -->
<?php get_header(); ?>
<!-- Autor -->
<p>Posts de <strong><?php echo get_the_author(); ?></strong></p>
<!-- Listado de posts -->
<?php if ( have_posts() ) : ?