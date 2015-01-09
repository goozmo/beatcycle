<?php
/*
 Plugin Name: Simple Credits
Author: Edgar Kuskov
Version: 3.2
Plugin URI: http://www.wse-group.eu
Author URI: http://www.wse-group.eu
Description: WooCommerce Credit System plugin, to allow your users to buy credits and use the credits to purchase the products. You are free to use this plugin on your own site. Distribution is prohibited by copyright.
License: Proprietary
*/

include_once "lang.php";
include_once "functions.inc.php";
include_once "admin.inc.php";
include_once "classes/creditsTable.php";

global $translate;
global $jal_db_version;

$translate = new WoocreditTranslate();
$jal_db_version = "1.1";

//Hook to hijack registration
add_action( 'user_register', 'simple_credit_initial', 10, 1 );
function simple_credit_initial($user_id) {
	$option_name = 'simple_credit_initial_amount' ;
    $amount = get_option( $option_name );
	$option_name = 'simple_credit_initial_setup' ;
    $setup = get_option( $option_name );

		if($setup) {
		global $wpdb;
		$user_id = $user_id;
		$amount = $amount;
		$result = $wpdb -> get_row("SELECT credit FROM `" . $wpdb -> prefix . "woocredit_users` WHERE user_id=" . $user_id);
		if ($result) {
			$amount = $result -> credit + $amount;
			$sql = 'UPDATE `' . $wpdb -> prefix . 'woocredit_users` SET `credit` = ' . $amount . ' WHERE `user_id`=' . $user_id . ';';
			$wpdb -> query($sql);
		} else {
			$sql = 'INSERT INTO `' . $wpdb -> prefix . 'woocredit_users` (user_id,credit) VALUES (' . $user_id . ',' . $amount . ');';
			$wpdb -> query($sql);
		}
		$sql = 'INSERT INTO `' . $wpdb -> prefix . 'woocredit_changes` (user_id,amount) VALUES (' . $user_id . ',' . $_POST["amount"] . ');';
		$wpdb -> query($sql);
		}

}

// Hook to remove category
add_action('pre_get_posts', 'custom_pre_get_posts_query' );
add_action('admin_menu','wooCommercemenu');
add_action('wp_head','addScripts');
add_action('woocommerce_thankyou', 'check_thankyou');

// Add custom product fields to woocommerce
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

add_shortcode('creditwoocommerce', 'creditwoocommerceshortcode' );
add_shortcode('usercreditwoocommerce', 'userCreditBalance' );
add_shortcode('user_bought_products', 'show_bought_products' );
add_shortcode('buy_credits_button', 'creditsbuybutton' );

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'credits_plugin_settings_link' );

function wooCommercemenu() {
	global $translate;
	$menu = $translate->wooTranslate('user credit',get_bloginfo('language'));
	add_submenu_page('edit.php?post_type=product', $menu, $menu, 'edit_posts', 'woocommerceCredit', 'woocommerceCredit');
}

// Add settings link on plugin page
function credits_plugin_settings_link($links) {
	$settings_link = '<a href="'.get_site_url().'/wp-admin/edit.php?post_type=product&page=woocommerceCredit">Settings</a>';
	array_unshift($links, $settings_link);
	return $links;
}

function remove_loop_button(){
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

	add_action('woocommerce_single_product_summary', 'single_product_buy_button', 30);
	add_action('woocommerce_in_cart_product_title','product_title', 5);
}
add_action('init','remove_loop_button');

function forbid_credits_page()
{
	if(!is_admin()) {
		$term_list = wp_get_post_terms(get_the_ID(),'product_cat',array('fields'=>'ids'));
		$cat_id = (int)$term_list[0];
		$term = get_term( $cat_id, 'product_cat' );
		$slug = $term->slug;
		if(strcmp($slug,'credit')==0) {
			header('Location: '.get_permalink( woocommerce_get_page_id( 'shop' )).'');
		}
	}
}
add_action( 'wp', 'forbid_credits_page' );

function jal_install() {
	global $wpdb;
	global $jal_db_version;
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	$table_name = $wpdb->prefix."woocredit_orders";
	$sql = "CREATE TABLE $table_name (
	user_id int(11) NOT NULL,
	order_id int(11) NOT NULL,
	`date` timestamp NULL DEFAULT CURRENT_TIMESTAMP);";
	dbDelta( $sql );

	$table_name = $wpdb->prefix."woocredit_users";
	$sql = "CREATE TABLE $table_name (
	user_id int(11) NOT NULL,
	credit DECIMAL(10,2) UNSIGNED NOT NULL,
	UNIQUE KEY `index` (`user_id`));";
	dbDelta( $sql );

	$table_name = $wpdb->prefix."woocredit_changes";
	$sql = "CREATE TABLE $table_name (
	user_id int(11) NOT NULL,
	amount int(11) NOT NULL,
	`date` timestamp NULL DEFAULT CURRENT_TIMESTAMP);";
	dbDelta( $sql );

	$table_name = $wpdb->prefix."woocredit_products";
	$sql = "CREATE TABLE $table_name (
	user_id int(11) NOT NULL,
	product_id int(11) NOT NULL,
	price DECIMAL(10,2) UNSIGNED NOT NULL,
	`date` timestamp NULL DEFAULT CURRENT_TIMESTAMP);";
	dbDelta( $sql );

	$table_name = $wpdb->prefix."terms";

	$exist = $wpdb->get_var("SELECT term_id FROM $table_name WHERE slug = 'credit';");

	if(!$exist) {
		$sql = "INSERT INTO $table_name (name, slug, term_group)
		VALUES ('Credit','credit','0');";
		dbDelta( $sql );

		$table_name = $wpdb->prefix . "term_taxonomy";
		$sql = "INSERT INTO $table_name (term_id, taxonomy)
		VALUES ('".$wpdb->insert_id."','product_cat');";
		dbDelta( $sql );
	}

	add_option( "jal_db_version", $jal_db_version );
}

function jal_uninstall() {
	global $wpdb;

	$table_name = $wpdb->prefix . "woocredit_orders";
	$sql = "DROP TABLE IF EXISTS $table_name;";
	$wpdb->query($sql);

	$table_name = $wpdb->prefix . "woocredit_users";
	$sql = "DROP TABLE IF EXISTS $table_name;";
	$wpdb->query($sql);

	$table_name = $wpdb->prefix . "woocredit_changes";
	$sql = "DROP TABLE IF EXISTS $table_name;";
	$wpdb->query($sql);

	$table_name = $wpdb->prefix . "woocredit_products";
	$sql = "DROP TABLE IF EXISTS $table_name;";
	$wpdb->query($sql);
}

register_activation_hook( __FILE__, 'jal_install' );
register_uninstall_hook( __FILE__, 'jal_uninstall');

// User buys credits
if(isset($_POST['credit_id'])){
	$_SESSION['credit_id'] = $_POST['credit_id'];
	add_action( 'init', 'add_product_to_cart' );
}
?>