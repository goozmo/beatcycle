<?php
//$qode_toolbar = true;

load_theme_textdomain( 'qode', get_template_directory().'/languages' );

if(isset($qode_toolbar)):

add_action('after_setup_theme', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

/* Start session */
if (!function_exists('myStartSession')) {
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
		if (!empty($_GET['animation']))
			$_SESSION['qode_animation'] = $_GET['animation'];
		if (isset($_SESSION['qode_animation']))
		if ($_SESSION['qode_animation'] == "off")
			$_SESSION['qode_animation'] = "";
}}

/* End session */

if (!function_exists('myEndSession')) {
function myEndSession() {
    session_destroy ();
}
}

endif;

add_filter('widget_text', 'do_shortcode');
//add_filter( 'the_excerpt', 'do_shortcode');

define('QODE_ROOT', get_template_directory_uri());
define('QODE_VAR_PREFIX', 'qode_');
include_once('includes/shortcodes/shortcodes.php');
include_once('includes/qode-options.php');
include_once('includes/import/qode-import.php');
//include_once('export/qode-export.php');
include_once('includes/custom-fields.php');
include_once('includes/custom-fields-post-formats.php');
include_once('includes/qode-breadcrumbs.php');
include_once('includes/nav_menu/qode-menu.php');
include_once('includes/sidebar/qode-custom-sidebar.php');
include_once('includes/qode-custom-post-types.php');
include_once('includes/qode-like.php' );
include_once('includes/qode-custom-taxonomy-field.php');
/* Include comment functionality */
include_once('includes/comment/comment.php');
/* Include sidebar functionality */
include_once('includes/sidebar/sidebar.php');
/* Include pagination functionality */
include_once('includes/pagination/pagination.php');
/* Include qode carousel select box for visual composer */
include_once('includes/qode_carousel/qode-carousel.php');
/* Include font awesome icons list */
include_once('includes/font_awesome/font-awesome.php');
/** Include the TGM_Plugin_Activation class. */
require_once dirname( __FILE__ ) . '/includes/plugins/class-tgm-plugin-activation.php';
/* Include visual composer initialization */
include_once('includes/plugins/visual-composer.php');
/* Include activation for layer slider */
include_once('includes/plugins/layer-slider.php');
include_once('widgets/relate_posts_widget.php');
include_once('widgets/latest_posts_menu.php');
include_once('widgets/call_to_action_widget.php');


//does woocommerce function exists?
if(function_exists("is_woocommerce")){
		//include woocommerce configuration
		require_once( 'woocommerce/woocommerce_configuration.php' );
    //include cart dropdown widget
    include_once('widgets/woocommerce-dropdown-cart.php');
}

add_filter( 'call_to_action_widget', 'do_shortcode');

/* Add css */

if (!function_exists('qode_styles')) {
    function qode_styles() {
        global $qode_options_proya;
        global $wp_styles;
        global $is_chrome;
        global $is_safari;
        global $qode_toolbar;
        global $woocommerce;

        wp_enqueue_style("default_style", QODE_ROOT . "/style.css");
        wp_enqueue_style("font-awesome", QODE_ROOT . "/css/font-awesome/css/font-awesome.min.css");
        wp_enqueue_style("stylesheet", QODE_ROOT . "/css/stylesheet.min.css");

        if ($woocommerce) {
            wp_enqueue_style("woocommerce", QODE_ROOT . "/css/woocommerce.min.css");
            if(!empty($qode_options_proya['responsiveness']) && $qode_options_proya['responsiveness'] == 'yes') {
                wp_enqueue_style("woocommerce_responsive", QODE_ROOT . "/css/woocommerce_responsive.min.css");
            }
        }

        preg_match( "#Chrome/(.+?)\.#", $_SERVER['HTTP_USER_AGENT'], $match );
        if(!empty($match)){ $version = $match[1];}else{ $version = 0; }
        $mac_os = strpos($_SERVER['HTTP_USER_AGENT'], "Macintosh; Intel Mac OS X");

        if($is_chrome && ($mac_os !== false) && ($version > 21)) {
            wp_enqueue_style("mac_stylesheet", QODE_ROOT . "/css/mac_stylesheet.css");
        }

        if($is_chrome || $is_safari) {
            wp_enqueue_style("webkit", QODE_ROOT . "/css/webkit_stylesheet.css");
        }

        wp_enqueue_style("style_dynamic", QODE_ROOT . "/css/style_dynamic.php");

        $responsiveness = "yes";
        if (isset($qode_options_proya['responsiveness']))
            $responsiveness = $qode_options_proya['responsiveness'];
        if ($responsiveness != "no"):
            wp_enqueue_style("responsive", QODE_ROOT . "/css/responsive.min.css");
            wp_enqueue_style("style_dynamic_responsive", QODE_ROOT . "/css/style_dynamic_responsive.php");
        endif;

		$vertical_area = "no";
		if (isset($qode_options_proya['vertical_area'])){
			$vertical_area = $qode_options_proya['vertical_area'];
		}
		if($vertical_area == "yes" && $responsiveness != "no"){
			wp_enqueue_style("vertical_responsive", QODE_ROOT . "/css/vertical_responsive.css");
		}

        if (isset($qode_toolbar)):
            wp_enqueue_style("toolbar", QODE_ROOT . "/css/toolbar.css");
        endif;
            wp_enqueue_style( 'js_composer_front' );
        wp_enqueue_style("custom_css", QODE_ROOT . "/css/custom_css.php");

        $fonts_array  = array(
            $qode_options_proya['google_fonts'].':200,300,400,600,800',
            $qode_options_proya['page_title_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['h1_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['h2_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['h3_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['h4_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['h5_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['h6_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['text_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['menu_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['dropdown_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['dropdown_google_fonts_thirdlvl'].':200,300,400,600,700,800',
            $qode_options_proya['fixed_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['sticky_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['mobile_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['button_title_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['message_title_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['popup_menu_google_fonts'].':200,300,400,600,700,800',
            $qode_options_proya['popup_menu_google_fonts_2nd'].':200,300,400,600,700,800',
            $qode_options_proya['top_header_text_font_family'].':200,300,400,600,700,800',
            $qode_options_proya['portfolio_filter_font_family'].':200,300,400,600,700,800'
        );
		$args = array( 'post_type' => 'slides', 'posts_per_page' => -1);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			if(get_post_meta(get_the_ID(), "qode_slide-title-font-family", true) != ""){
				array_push($fonts_array, get_post_meta(get_the_ID(), "qode_slide-title-font-family", true) . ":200,300,400,600,700,800");
			}
			if(get_post_meta(get_the_ID(), "qode_slide-text-font-family", true) != ""){
				array_push($fonts_array, get_post_meta(get_the_ID(), "qode_slide-text-font-family", true) . ":200,300,400,600,700,800");
			}
		endwhile;
		wp_reset_query();
        $fonts_array=array_diff($fonts_array, array("-1:200,300,400,600,700,800"));
        $google_fonts_string = implode( '|', $fonts_array);
        if(count($fonts_array) > 0) :
            printf("<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,600,700,500,200|%s&subset=latin,latin-ext' rel='stylesheet' type='text/css'>\r\n", str_replace(' ', '+', $google_fonts_string));
        else :
            printf("<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,600,700,500,200' rel='stylesheet' type='text/css'>\r\n");
        endif;
    }
}

/* Add js */

if (!function_exists('qode_scripts')) {
    function qode_scripts() {
        global $qode_options_proya;
        global $is_chrome;
        global $is_opera;
        global $is_IE;
        global $qode_toolbar;
        global $woocommerce;

        $smooth_scroll = true;
        if(isset($qode_options_proya['smooth_scroll']) && $qode_options_proya['smooth_scroll'] == "no"){
            $smooth_scroll = false;
        }

        wp_enqueue_script("jquery");
        wp_enqueue_script("plugins", QODE_ROOT."/js/plugins.js",array(),false,true);

        wp_enqueue_script("carouFredSel", QODE_ROOT."/js/jquery.carouFredSel-6.2.1.js",array(),false,true);
        wp_enqueue_script("mousewheel", QODE_ROOT."/js/jquery.mousewheel.min.js",array(),false,true);
        wp_enqueue_script("touchSwipe", QODE_ROOT."/js/jquery.touchSwipe.min.js",array(),false,true);
        wp_enqueue_script("isotope", QODE_ROOT."/js/jquery.isotope.min.js",array(),false,true);

        if(($is_chrome || $is_opera) && $smooth_scroll){
            wp_enqueue_script("smoothScroll", QODE_ROOT."/js/SmoothScroll.js",array(),false,true);
        }

        if ( $is_IE ) {
            wp_enqueue_script("html5", QODE_ROOT."/js/html5.js",array(),false,false);
        }
        if($qode_options_proya['enable_google_map'] == "yes") :
            wp_enqueue_script("google_map_api", "https://maps.googleapis.com/maps/api/js?sensor=false",array(),false,true);
        endif;
        wp_enqueue_script("default_dynamic", QODE_ROOT."/js/default_dynamic.php",array(),false,true);
        wp_enqueue_script("default", QODE_ROOT."/js/default.min.js",array(),false,true);
        wp_enqueue_script("custom_js", QODE_ROOT."/js/custom_js.php",array(),false,true);
        global $wp_scripts;
        $wp_scripts->add_data('comment-reply', 'group', 1 );
        if ( is_singular() ) wp_enqueue_script( "comment-reply");

        $has_ajax = false;
        $qode_animation = "";
        if (isset($_SESSION['qode_animation']))
            $qode_animation = $_SESSION['qode_animation'];
        if (($qode_options_proya['page_transitions'] != "0") && (empty($qode_animation) || ($qode_animation != "no")))
            $has_ajax = true;
        elseif (!empty($qode_animation) && ($qode_animation != "no"))
            $has_ajax = true;

        if ($has_ajax) :
            wp_enqueue_script("ajax", QODE_ROOT."/js/ajax.min.js",array(),false,true);
        endif;
        wp_enqueue_script( 'wpb_composer_front_js' );

        if($qode_options_proya['use_recaptcha'] == "yes") :
        wp_enqueue_script("recaptcha_ajax", "http://www.google.com/recaptcha/api/js/recaptcha_ajax.js",array(),false,true);
        endif;

        if(isset($qode_toolbar)):
            wp_enqueue_script("toolbar", QODE_ROOT."/js/toolbar.js",array(),false,true);
        endif;

        if($woocommerce) {
            wp_enqueue_script("woocommerce-qode", QODE_ROOT."/js/woocommerce.js",array(),false,true);
            wp_enqueue_script("select2", QODE_ROOT."/js/select2.min.js",array(),false,true);
        }
    }
}

add_action('wp_enqueue_scripts', 'qode_styles');
add_action('wp_enqueue_scripts', 'qode_scripts');

/* Page ID */

if(!function_exists('qode_init_page_id')) {
	function qode_init_page_id() {
		global $wp_query;
		global $qode_page_id;

		$qode_page_id = $wp_query->get_queried_object_id();
	}
}

add_action('get_header', 'qode_init_page_id');

/* Add admin js and css */

if (!function_exists('qode_admin_jquery')) {
function qode_admin_jquery() {
	wp_enqueue_script('jquery');
	wp_enqueue_style('style', QODE_ROOT.'/css/admin/admin-style.css', false, '1.0', 'screen');
	wp_enqueue_style('colorstyle', QODE_ROOT.'/css/admin/colorpicker.css', false, '1.0', 'screen');
	wp_register_script('colorpickerss', QODE_ROOT.'/js/admin/colorpicker.js', array('jquery'), '1.0.0', false );
	wp_enqueue_script('colorpickerss');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-accordion');
	wp_register_script('default', QODE_ROOT.'/js/admin/default.js', array('jquery'), '1.0.0', false );
	wp_enqueue_script('default');
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
}
}
add_action('admin_enqueue_scripts', 'qode_admin_jquery');

if (!isset( $content_width )) $content_width = 1060;

/* Register Menus */

if (!function_exists('qode_register_menus')) {
function qode_register_menus() {
    register_nav_menus(
        array('top-navigation' => __( 'Top Navigation', 'qode')
		)
    );

    register_nav_menus(
        array('popup-navigation' => __( 'Fullscreen Navigation', 'qode')
        )
    );
}
}
add_action( 'after_setup_theme', 'qode_register_menus' );

/* Add post thumbnails */

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );

    add_image_size( 'portfolio-square', 570, 570, true );
    add_image_size( 'menu-featured-post', 345, 198, true );
    add_image_size( 'qode-carousel_slider', 400, 260, true );
    add_image_size( 'portfolio_slider', 480, 320, true );
    add_image_size( 'portfolio_masonry_regular', 500, 500, true );
    add_image_size( 'portfolio_masonry_wide', 1000, 500, true );
    add_image_size( 'portfolio_masonry_tall', 500, 1000, true );
    add_image_size( 'portfolio_masonry_large', 1000, 1000, true );
    add_image_size( 'latest_post_boxes', 539, 303, true );
}

/* Add post formats */

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));
}

/* Add feedlinks */

add_theme_support( 'automatic-feed-links' );

/* Add class on body for ajax */

if (!function_exists('ajax_classes')) {
function ajax_classes($classes) {
	global $qode_options_proya;
	$qode_animation="";
	if (isset($_SESSION['qode_animation'])) $qode_animation = $_SESSION['qode_animation'];
	if(($qode_options_proya['page_transitions'] === "0") && ($qode_animation == "no")) :
		$classes[] = '';
	elseif($qode_options_proya['page_transitions'] === "1" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_updown';
		$classes[] = 'page_not_loaded';
	elseif($qode_options_proya['page_transitions'] === "2" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_fade';
		$classes[] = 'page_not_loaded';
	elseif($qode_options_proya['page_transitions'] === "3" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_updown_fade';
		$classes[] = 'page_not_loaded';
	elseif($qode_options_proya['page_transitions'] === "4" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_leftright';
		$classes[] = 'page_not_loaded';
	elseif(!empty($qode_animation) && $qode_animation != "no") :
		$classes[] = 'page_not_loaded';
	else:
	$classes[] ="";
	endif;

	return $classes;
}
}
add_filter('body_class','ajax_classes');

/* Add class on body boxed layout */

if (!function_exists('boxed_class')) {
function boxed_class($classes) {
	global $qode_options_proya;

	if(isset($qode_options_proya['boxed']) && $qode_options_proya['boxed'] == "yes") :
		$classes[] = 'boxed';
	else:
	$classes[] ="";
	endif;

	return $classes;
}
}
add_filter('body_class','boxed_class');

/* Add class on body for vertical menu */

if (!function_exists('vertical_menu_class')) {
	function vertical_menu_class($classes) {
		global $qode_options_proya;
        global $wp_query;

		if(isset($qode_options_proya['vertical_area']) && $qode_options_proya['vertical_area'] =='yes') :
			$classes[] = 'vertical_menu_enabled';
        endif;

        $id = $wp_query->get_queried_object_id();
        if(isset($qode_options_proya['vertical_area_transparency']) && $qode_options_proya['vertical_area_transparency'] =='yes' && get_post_meta($id, "qode_page_vertical_area_transparency", true) != "no"){
            $classes[] = ' vertical_menu_transparency vertical_menu_transparency_on';
        }else if(get_post_meta($id, "qode_page_vertical_area_transparency", true) == "yes"){
            $classes[] = ' vertical_menu_transparency vertical_menu_transparency_on';
        }
		return $classes;
    }
}
add_filter('body_class','vertical_menu_class');

/* Add class on body for no elements animation on touch devices */

if (!function_exists('elements_animation_on_touch_class')) {
function elements_animation_on_touch_class($classes) {
	global $qode_options_proya;

	$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
									'|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
									'|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

	if(isset($qode_options_proya['elements_animation_on_touch']) && $qode_options_proya['elements_animation_on_touch'] == "no" && $isMobile == true) :
		$classes[] = 'no_animation_on_touch';
	else:
	$classes[] ="";
	endif;

	return $classes;
}
}
add_filter('body_class','elements_animation_on_touch_class');

/* Excerpt more */

if (!function_exists('qode_excerpt_more')) {
function qode_excerpt_more( $more ) {
    return '...';
}
}
add_filter('excerpt_more', 'qode_excerpt_more');

/* Excerpt lenght */

if (!function_exists('qode_excerpt_length')) {
function qode_excerpt_length( $length ) {
	global $qode_options_proya;
	if($qode_options_proya['number_of_chars']){
		 return $qode_options_proya['number_of_chars'];
	} else {
		return 45;
	}
}
}
add_filter( 'excerpt_length', 'qode_excerpt_length', 999 );

/* Social excerpt lenght */

if (!function_exists('the_excerpt_max_charlength')) {
function the_excerpt_max_charlength($charlength) {
	global $qode_options_proya;
	if(isset($qode_options_proya['twitter_via']) && !empty($qode_options_proya['twitter_via'])) {
		$via = " via " . $qode_options_proya['twitter_via'] . " ";
	} else {
		$via = 	"";
	}
	$excerpt = get_the_excerpt();
	$charlength = 140 - (mb_strlen($via) + $charlength);

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength);
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			return mb_substr( $subex, 0, $excut );
		} else {
			return $subex;
		}
	} else {
		return $excerpt;
	}
}
}

if(!function_exists('qode_excerpt')) {
	/**
	* Function that cuts post excerpt to the number of word based on previosly set global
	* variable $word_count, which is defined in qode_set_blog_word_count function
	*/
	function qode_excerpt() {
		global $qode_options_proya, $word_count, $post;

        if($word_count != '0') {
            $word_count = isset($word_count) && $word_count !== "" ? $word_count : $qode_options_proya['number_of_chars'];
            $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);
            $clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

            $excerpt_word_array = explode (' ', $clean_excerpt);
            $excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
            $excerpt = implode (' ', $excerpt_word_array).'...';

            echo '<p>'.$excerpt.'</p>';
        }
	}
}

if(!function_exists('qode_set_blog_word_count')) {
	/**
	* Function that sets global blog word count variable used by qode_excerpt function
	*/
	function qode_set_blog_word_count($word_count_param) {
		global $word_count;

		$word_count = $word_count_param;
	}
}

/* Use slider instead of image for post */

if (!function_exists('slider_blog')) {
function slider_blog($post_id) {
	$sliders = get_post_meta($post_id, "qode_sliders", true);
	$slider = $sliders[1];
	if($slider) {
        $html = "";
        $html .= '<div class="flexslider"><ul class="slides">';
		$i=0;
		while (isset($slider[$i])){
			$slide = $slider[$i];

			$href = $slide[link];
			$baseurl = home_url();
			$baseurl = str_replace('http://', '', $baseurl);
			$baseurl = str_replace('www', '', $baseurl);
			$host = parse_url($href, PHP_URL_HOST);
			if($host != $baseurl) {
				$target = 'target="_blank"';
			}
			else {
				$target = 'target="_self"';
			}

			$html .= '<li class="slide ' . $slide[imgsize] . '">';
			$html .= '<div class="image"><img src="' . $slide[img] . '" alt="' . $slide[title] . '" /></div>';

			$html .= '</li>';
			$i++;
		}
		$html .= '</ul></div>';
	}
	return $html;
}
}


if (!function_exists('compareSlides')) {
function compareSlides($a, $b){
	if (isset($a['ordernumber']) && isset($b['ordernumber'])) {
    if ($a['ordernumber'] == $b['ordernumber']) {
        return 0;
    }
    return ($a['ordernumber'] < $b['ordernumber']) ? -1 : 1;
  }
  return 0;
}
}

if (!function_exists('comparePortfolioImages')) {
function comparePortfolioImages($a, $b){
	if (isset($a['portfolioimgordernumber']) && isset($b['portfolioimgordernumber'])) {
    if ($a['portfolioimgordernumber'] == $b['portfolioimgordernumber']) {
        return 0;
    }
    return ($a['portfolioimgordernumber'] < $b['portfolioimgordernumber']) ? -1 : 1;
  }
  return 0;
}
}

if (!function_exists('comparePortfolioOptions')){
function comparePortfolioOptions($a, $b){
	if (isset($a['optionlabelordernumber']) && isset($b['optionlabelordernumber'])) {
    if ($a['optionlabelordernumber'] == $b['optionlabelordernumber']) {
        return 0;
    }
    return ($a['optionlabelordernumber'] < $b['optionlabelordernumber']) ? -1 : 1;
  }
  return 0;
}
}

if (!function_exists('qode_hex2rgb')) {
function qode_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
}

if(!function_exists('qode_addslashes')) {
	/**
	 * Function that checks if magic quotes are turned on (for older versions of php) and returns escaped string
	 * @param $str string string to be escaped
	 * @return string escaped string
	 */
	function qode_addslashes($str) {
		if(!get_magic_quotes_gpc()) {
			$str = addslashes($str);
		}

		return $str;
	}
}

function rewrite_rules_on_theme_activation() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'rewrite_rules_on_theme_activation' );
?>
