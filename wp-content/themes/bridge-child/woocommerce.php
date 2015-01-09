<?php 
/*
Template Name: Woocommerce
*/ 
?>
<?php 
global $woocommerce;
$id = get_option('woocommerce_shop_page_id');
$shop= get_post($id);
$shop= get_post($id);
$sidebar = get_post_meta($id, "qode_show-sidebar", true);

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

?>
	<?php 
		get_header(); 
		$id = get_option('woocommerce_shop_page_id');
	?>
		<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
			<script>
			var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
			</script>
		<?php } ?>
		<?php $date = strtolower(date('M/d/Y h:i a', strtotime($_GET['date']))); ?>
       <div class="title_outer title_without_animation" data-height="350">
		<div class="title title_size_medium  position_center has_background" style="background-size:1732px auto;background-image:url(/wp-content/uploads/2014/04/indoor-header.jpg);height:350px;background-color:#ffffff;">
			<div class="image not_responsive"><img src="http://beatcycle.net/wordpress/wp-content/uploads/2014/04/indoor-header.jpg" alt="&nbsp;"> </div>
										<div class="title_holder" style="padding-top:163px;height:187px;">
					<div class="container">
						<div class="container_inner clearfix">
								<div class="title_subtitle_holder">
																	<div class="title_subtitle_holder_inner">
																	<h1 style="color:#ffffff"><span><?php echo $date; ?></span></h1>
																			<span class="separator small center"></span>
																	
																										</div>
																	</div>
														</div>
					</div>
				</div>
					</div>
	</div>
		
		<?php if($qode_options_proya['show_back_button'] == "yes") { ?>
			<a id='back_to_top' href='#'>
				<span class="fa-stack">
					<i class="fa fa-angle-up " style=""></i>
				</span>
			</a>
		<?php } ?>
		
		<?php
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){ ?>
			<div class="q_slider"><div class="q_slider_inner">
			<?php echo do_shortcode($revslider); ?>
			</div></div>
		<?php
		}
		?>
		<div class="container">
			<div class="container_inner clearfix">
				<?php if(!is_singular('product')) { ?>
					<?php if(($sidebar == "default")||($sidebar == "")) : ?>
						<?php woocommerce_content(); ?>
					<?php elseif($sidebar == "1" || $sidebar == "2"): ?>		
					<?php global $woocommerce_loop;
			        	$woocommerce_loop['columns'] = 3;
			        ?>
					<?php if($sidebar == "1") : ?>
						<div class="two_columns_66_33 grid2 clearfix">
							<div class="column1">
					<?php elseif($sidebar == "2") : ?>
						<div class="two_columns_75_25 grid2 clearfix">
							<div class="column1">
					<?php endif; ?>
								<div class="column_inner">
									<?php woocommerce_content(); ?>
								</div>
							</div>
							<div class="column2"><?php get_sidebar();?></div>
						</div>
					<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
						<?php global $woocommerce_loop;
				        	$woocommerce_loop['columns'] = 3;
				        ?>
						<?php if($sidebar == "3") : ?>
							<div class="two_columns_33_66 grid2 clearfix">
								<div class="column1"><?php get_sidebar();?></div>
								<div class="column2">
						<?php elseif($sidebar == "4") : ?>
							<div class="two_columns_25_75 grid2 clearfix">
								<div class="column1"><?php get_sidebar();?></div>
								<div class="column2">
						<?php endif; ?>
									<div class="column_inner">
										<?php woocommerce_content(); ?>
									</div>
								</div>
							</div>
					<?php endif; ?>
                <?php } else { 
                      woocommerce_content();                                  
                } ?>
			</div>
		</div>
	<?php get_footer(); ?>