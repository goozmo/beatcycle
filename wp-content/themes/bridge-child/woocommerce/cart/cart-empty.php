<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>

<div class="empty-cart-wrapper">
	<p class="cart-empty"><?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></p>

	<?php do_action('woocommerce_cart_is_empty'); ?>
	<ul class="inline-list">
	<li class="return-to-shop"><a class="button tiny" href="/book-a-bike">Book a bike</a></li>
	<li><a class="button tiny" href="/pricing">Purchase Class Credits</a></li>
	</ul>	
</div>