<?php
/**
 * Child Theme of
 *
 * @package Square One
 */

/*Load custom functions file.*/
require( get_stylesheet_directory() . '/inc/custom-child-functions.php' );

/*Load meta-box feilds for child theme file (metabox folder is in parent theme.*/
require( get_stylesheet_directory() . '/inc/metabox-child.php' );

/*Load custom post types.*/
require( get_stylesheet_directory() . '/inc/custom-post-types.php' );




function squarechild_scripts() {
  wp_register_script('squarechild_plugins', get_stylesheet_directory_uri() . '/assets/js/plugins.js', false, null, false);

  wp_enqueue_script('squarechild_plugins');
}
add_action('wp_enqueue_scripts', 'squarechild_scripts', 110);

