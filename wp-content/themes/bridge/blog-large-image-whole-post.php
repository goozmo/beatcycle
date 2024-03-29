<?php 
/*
Template Name: Blog Large Image Whole Post 
*/ 
?>
<?php get_header(); ?>
<?php 
global $wp_query;
global $qode_template_name;
$id = $wp_query->get_queried_object_id();
$qode_template_name = get_page_template_slug($id);
$category = get_post_meta($id, "qode_choose-blog-category", true);
$post_number = get_post_meta($id, "qode_show-posts-per-page", true);
if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

$sidebar = get_post_meta($id, "qode_show-sidebar", true); 

$blog_hide_comments = "";
if (isset($qode_options_proya['blog_hide_comments']))
	$blog_hide_comments = $qode_options_proya['blog_hide_comments'];

?>
	<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
		<script>
		var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
		</script>
	<?php } ?>
		<?php get_template_part( 'title' ); ?>
	<?php
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){ ?>
			<div class="q_slider"><div class="q_slider_inner">
			<?php echo do_shortcode($revslider); ?>
			</div></div>
		<?php
		}
		?>
	<?php query_posts('post_type=post&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $post_number );
			if(isset($qode_options_proya['blog_page_range']) && $qode_options_proya['blog_page_range'] != ""){
				$blog_page_range = $qode_options_proya['blog_page_range'];
			} else{
				$blog_page_range = $wp_query->max_num_pages;
			}
	?>
	<div class="container">
		<div class="container_inner">
				<?php if(($sidebar == "default")||($sidebar == "")) : ?>
					<?php 
						get_template_part('templates/blog', 'structure');
					?>				
				<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
					<div class="<?php if($sidebar == "1"):?>two_columns_66_33<?php elseif($sidebar == "2") : ?>two_columns_75_25<?php endif; ?> background_color_sidebar grid2 clearfix">
						<div class="column1">
							<div class="column_inner">
								<?php 
									get_template_part('templates/blog', 'structure');
								?>						
							</div>
						</div>
						<div class="column2">
							<?php get_sidebar(); ?>	
						</div>
					</div>
				<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
						<div class="<?php if($sidebar == "3"):?>two_columns_33_66<?php elseif($sidebar == "4") : ?>two_columns_25_75<?php endif; ?> background_color_sidebar grid2 clearfix">
							<div class="column1">
								<?php get_sidebar(); ?>	
							</div>
							<div class="column2">
								<div class="column_inner">
									<?php 
										get_template_part('templates/blog', 'structure');
									?>			
								</div>
							</div>
							
						</div>
				<?php endif; ?>
	</div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>