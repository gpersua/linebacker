<?php 
/**
 * Template Name: Blog template
 *
 *
 * Template general para el home
 */
 get_header(); ?>


<div class="row">
  <div class="span8">
    <h1>Blog</h1>


    <?php  

     $query = new WP_Query( 'cat=1' );

     if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p><em><?php the_time('l, F jS, Y'); ?></em></p>
    <hr>

    <?php endwhile; else: ?>
      <p><?php _e('Sorry, there are no posts.'); ?></p>
    <?php endif; ?>





  </div>
  <div class="span4">

    <?php get_sidebar(); ?>   

  </div>
</div>

<?php get_footer(); ?>