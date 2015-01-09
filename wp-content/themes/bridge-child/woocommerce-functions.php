
<?php


if ( ! defined( 'WC_MAX_LINKED_VARIATIONS' ) ) {
    define( 'WC_MAX_LINKED_VARIATIONS', 399 );
}

/*
* replace read more buttons for out of stock items
**/
if (!function_exists('woocommerce_variable_add_to_cart')) {
function woocommerce_variable_add_to_cart() {
global $product;
if (!$product->is_in_stock()) {
    echo 'Out of stock';
} 
}
}

//Make Product Pages display Bikes in columns
function woocommerce_variable_add_to_cart() {
		global $product, $post;
		echo '<ul class="" id="bike-layout">';
		$data = $_GET['date'];
		$newdate = new DateTime($data);
		$result = strtolower($newdate->format('j-M-Y-hi-a'));
		
		$variations = $product->get_available_variations();
		$postid = get_the_ID();
		foreach ($variations as $key => $value) {
			if($result == $value['attributes']['attribute_date']) {
			$variation = new WC_Product_Variation($value['variation_id']);
			$productPrice = $variation->get_price();
			
			if($value[is_in_stock] != "") {
			//Value in Stock. normal Color
			if(!$value['attributes']['attribute_bike']) { ?>			
			<li class="center border-box-fix bike-number-<?php echo $value['attributes']['attribute_pa_bike']; ?>"><button href="javascript:void(0);" onclick="creditdeduct(<?php echo $postid; ?>,<?php echo $productPrice; ?>,<?php echo $value['variation_id']; ?>)" type="button" class="button alt"><?php echo apply_filters('single_add_to_cart_text', __('', 'woocommerce'), $product->product_type); echo $value['attributes']['attribute_pa_bike'];?></button></li>
			<?php } else { ?>
			<li class="center border-box-fix bike-number-<?php echo $value['attributes']['attribute_bike']; ?>"><button href="javascript:void(0);" onclick="creditdeduct(<?php echo $postid; ?>,<?php echo $productPrice; ?>,<?php echo $value['variation_id']; ?>)" type="button" class="button alt"><?php echo apply_filters('single_add_to_cart_text', __('', 'woocommerce'), $product->product_type); echo $value['attributes']['attribute_bike'];?></button></li>
			<?php }
			} else {
			//Value not Stock. normal grey			
			if(!$value['attributes']['attribute_bike']) { ?>			
			<li class="center border-box-fix bike-number-<?php echo $value['attributes']['attribute_pa_bike']; ?>"><button type="button" class="button alt out"><?php echo apply_filters('single_add_to_cart_text', __('', 'woocommerce'), $product->product_type); echo $value['attributes']['attribute_pa_bike'];?></button></li>
			<?php } else { ?>
			<li class="center border-box-fix bike-number-<?php echo $value['attributes']['attribute_bike']; ?>"><button type="button" class="button alt out"><?php echo apply_filters('single_add_to_cart_text', __('', 'woocommerce'), $product->product_type); echo $value['attributes']['attribute_bike'];?></button></li>
			<?php }		
				
			}
			  
			}
		}
		echo '</ul>';

		echo '<div class="hide-form">';
		// Enqueue variation scripts
		wp_enqueue_script( 'wc-add-to-cart-variation' );

		// Load the template
		wc_get_template( 'single-product/add-to-cart/variable.php', array(
				'available_variations'  => $product->get_available_variations(),
				'attributes'   			=> $product->get_variation_attributes(),
				'selected_attributes' 	=> $product->get_variation_default_attributes()
			) );
		
		echo '</div><!--.hide-form-->';
		?>
		<?php if (isset($_GET['date'])) {
		$date = strtolower(date('j-M-Y-hi-a', strtotime($_GET['date']))); ?>
		<script>
			jQuery(document).ready(function($) {
				
				<?php echo '$(\'[name=attribute_date]\').val( \''.$date.'\' );'; ?>
				$('button[name=bike]').click(function(){
					$('[name=attribute_pa_bike]').val( $(this).attr('value') ).trigger('change');
					$('[name=attribute_bike]').val( $(this).attr('value') ).trigger('change');
					$( 'form.variations_form' ).submit();
				});
			});
		  </script>
		<?php
		}else{
			echo '<h1 id="no-date">No date has been selected please choose a date <a href="'.get_page_link(14939).'">here</a></h1>';
		}
}

add_shortcode( 'custom_events_calendar', 'custom_events_calendar' );

function custom_events_calendar( $attr = array() ) {

	extract( shortcode_atts( array(
		'type' => 'both',
		'cat' => 'all'
	), $attr ) );

	ob_start();

	custom_render_calendar( $type, $cat ); 

	$out = ob_get_contents();

	ob_end_clean();

	return $out;
		
}

function custom_render_calendar( $type = '', $cat = 'all' ) { 
	global $wpdb;

	$error_setting = @ini_get( 'display_errors' );
	
	@ini_set( 'display_errors', 0 );
	
	$settings = get_option( 'ignitewoo_events_main_settings', false ); 

	if ( !$settings ) { 
		$settings = array();
		$settings['tooltip_color'] = 'blue';
	}

	if ( empty( $settings['calendar_start_day'] ) ) 
		$settings['calendar_start_day'] = 0;

	?>
	<div>
		<div id="calendar_loading"><?php _e( 'Loading...', 'ignitewoo_events' ) ?></div>
		<div id="ignitewoo_events_calendar_wrap">
		</div>
	</div>

	<script type='text/javascript'>

		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

		jQuery(document).ready( function( $ ) {
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();

			jQuery( "#ignitewoo_events_calendar_wrap" ).fullCalendar({
				firstDay: '<?php echo $settings['calendar_start_day'] ?>',
				loading: function( bool ) {
					if (bool) {
						var offset_top = jQuery( ".fc-border-separate" ).offset().top;
						var offset_left = jQuery( ".fc-border-separate" ).offset().left;
						var div_width = jQuery( ".fc-border-separate" ).width();
						var notice_width = jQuery( "#calendar_loading" ).width()
						var offset_side = ( ( div_width / 2 ) - ( notice_width / 2 ) ) + offset_left ;
						var offset = parseInt( offset_top ) + "px";

						jQuery( "#calendar_loading" ).css( { "top" : offset, "left" : offset_side } );
						jQuery( "#ignitewoo_events_calendar_wrap" ).css( "opacity", "0.2" );
						jQuery( "#calendar_loading").css( "display", "block" );
					} else {
						jQuery( "#calendar_loading").css( "display", "none" );
						jQuery( "#ignitewoo_events_calendar_wrap" ).css( "opacity", "1" );
					}
				},
				events: function(start, end, callback) {
					jQuery.ajax({
						type: "post",
						cache: true,
						url: ajaxurl,
						dataType: "json",
						data: {
							action: "ignitewoo_get_events",
							n: "<?php echo wp_create_nonce( 'ignitewoo_get_events' ) ?>",
							// our hypothetical feed requires UNIX timestamps
							start: Math.round( start.getTime() / 1000 ),
							end: Math.round( end.getTime() / 1000 ),
							type: "<?php echo $type ?>",
							cat: "<?php echo $cat ?>"
							},
					}).done( function( data ) {
							var events = [];
							
							if ( null != data && data.length > 0 )
							jQuery.each( data, function( i, item ) {

								events.push({
									title: item.title,
									start: item.start,
									end: item.end,
									url: item.url+'?date='+item.start,
									description: item.description,
									allDay: item.allDay,
									className: item.classes
								});
							});
							callback( events );
					});
					
				},
				eventRender: function(event, element) {
					element.qtip({
						content: {    
							title: { text: event.title },
							text: '<span class="title">Start: </span>' + ($.fullCalendar.formatDate(event.start, 'hh:mmtt')) + '<br><span class="title">Description: </span>' + event.description       
						},
						position: { 
							  my: 'bottom center',
							  at: 'top center',
						},
						show: { solo: true },
						style: { 
							classes: 'ui-tooltip-shadow ui-tooltip-<?php echo !empty( $settings['tooltip_color'] ) ? $settings['tooltip_color'] : '' ?>'
						},
					});
				},
				error: function() {
					alert( " <?php _e( 'There was an error while fetching events.', 'ignitewoo_events' )?> ");
					},
				header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
				editable: false,
				eventBackgroundColor: "<?php echo !empty( $settings['event_bg_color'] ) ? $settings['event_bg_color'] : '' ?>",
				eventTextColor: "<?php echo !empty( $settings['event_fg_color'] ) ? $settings['event_fg_color'] : ''?>",
			});
			
		});

	</script>
	<style type='text/css'>
		#calendar {
			width: 100%;
			margin: 0 auto;
			}

	</style>

<?php

	@ini_set( 'error_reporting', $error_setting );
}
//remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

//Remove product Image from Products Page + .single-product .product .summary { width: auto; } in css file
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

//Remove Product Tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
 
function woo_remove_product_tabs( $tabs ) {
 
    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
 
    return $tabs;
}

//Add description above bikes. This should include The Instructor's image and info.
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 20 );
function woocommerce_template_product_description() {
	echo '<div class="row"><div class="large-4 medium-4 small-12 small-centered columns"><div class="class-info">';
woocommerce_get_template( 'single-product/tabs/description.php' ); echo do_shortcode("[event_details]"); 
echo '</div> </div> </div>';
}

function wpse_131562_redirect() {
    if (! is_user_logged_in() && (is_cart() || is_checkout())
    ) {
        // feel free to customize the following line to suit your needs
        wp_redirect("/pricing");
        exit;
    }
}
//add_action('template_redirect', 'wpse_131562_redirect');

/*<button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?></button>*/

remove_action('init','remove_loop_button');