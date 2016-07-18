<?php 

// function wpbootstrap_scripts_with_jquery()
// {
// 	// Register the script like this for a theme:
// 	// For either a plugin or a theme, you can then enqueue the script:
// 	wp_enqueue_script( 'custom-script' );
// }
// add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );

// if ( function_exists('register_sidebar') )
// 	register_sidebar(array(
// 		'before_widget' => '',
// 		'after_widget' => '',
// 		'before_title' => '<h3>',
// 		'after_title' => '</h3>',
// 	));

/**
 * Crear nuestros menús gestionables desde el
 * administrador de Wordpress.
 */

function mis_menus() {
  register_nav_menus(
    array(
      'navegation' => __( 'Menú de navegación' ),
    )
  );
}
add_action( 'init', 'mis_menus' );
 
?>