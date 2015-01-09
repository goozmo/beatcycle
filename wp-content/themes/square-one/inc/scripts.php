<?php
/**
 * Enqueue scripts and styles
 *
 * @package Squareone
 * @since Squareone 1.0
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/normalize.css
 * 2. /theme/assets/css/foundation.min.css
 * 3. /child-theme/style.css (if a child theme is activated)
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.9.1.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr-2.6.2.min.js
 * 3. /theme/assets/js/plugins.js (in footer)
 * 4. /theme/assets/js/main.js    (in footer)
 */

function squareone_scripts() {
  wp_enqueue_style('squareone_normalize', get_template_directory_uri() . '/assets/css/normalize.css', false, null);
  wp_enqueue_style('squareone_foundation', get_template_directory_uri() . '/assets/css/foundation.min.css', false, null);

  // Load style.css from child theme
  if (is_child_theme()) {
    wp_enqueue_style('squareone_child', get_stylesheet_uri(), false, null);

    wp_enqueue_style('ie7-style', get_stylesheet_directory_uri() . '/assets/css/ie8-and-down.css', false, null);
 
global $wp_styles;
$wp_styles->add_data('ie7-style', 'conditional', 'lte IE 8');

  }


  // jQuery is loaded using the same method from HTML5 Boilerplate:
  // Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/assets/js/vendor/jquery.js', false, null, false);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

    wp_register_script('squareone_modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr.js', false, null, false);
     wp_register_script('squareone_fastclick', get_template_directory_uri() . '/assets/js/vendor/fastclick.js', false, null, false);
  wp_register_script('squareone_foundation_js', get_template_directory_uri() . '/assets/js/foundation.min.js','','',true);

   wp_enqueue_script('jquery');
   wp_enqueue_script('squareone_modernizr');
   wp_enqueue_script('squareone_fastclick');
  wp_enqueue_script('squareone_foundation_js');
}
add_action('wp_enqueue_scripts', 'squareone_scripts', 100);




