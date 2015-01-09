<?php
/**
 * Square One functions and definitions
 *
 * @package Square One
 */


/*Load scripts and styles.*/
require( get_template_directory() . '/inc/scripts.php' );
/*Load custom functions.*/
require( get_template_directory() . '/inc/custom.php' );
/*Load shortcodes.*/
require( get_template_directory() . '/inc/shortcodes.php' );
/*Load metabox fields for parent.*/
require( get_template_directory() . '/inc/metabox-parent.php' );

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/theme_options/' );
require_once dirname( __FILE__ ) . '/theme_options/options-framework.php';

/*Load file for CMB file.*/
add_action('init', 'include_init_file');
function include_init_file() {
    // use correct path here
    require_once get_template_directory() . '/inc/metabox/init.php';
}

/* custom admin head stylesheet */
    function squareone_admin_head_styles() {
        echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/assets/css/admin-style.css" />';
    }
    add_action('admin_head', 'squareone_admin_head_styles');

if ( ! function_exists( 'squareone_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function squareone_setup() {

	/* Custom template tags for this theme. */
	require( get_template_directory() . '/inc/template-tags.php' );

	/* Make theme available for translation
	 * Translations can be filed in the /languages/ directory */
	load_theme_textdomain( 'squareone', get_template_directory() . '/languages' );

	/* Add default posts and comments RSS feed links to head*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails (register sizes in child theme custom functions).*/
	add_theme_support( 'post-thumbnails' );

	/* This theme uses wp_nav_menu() in one location.*/
	register_nav_menus( array(
		'primary' => 'Primary Menu', 
		'footer' => 'Footer Menu'
	) );

	/* Enable support for Post Formats*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // squareone_setup
add_action( 'after_setup_theme', 'squareone_setup' );
