<?php 
	global $qode_options_proya;
?>

<?php get_header(); ?>

			<?php get_template_part( 'title' ); ?>
			<div class="container">
				<div class="container_inner">
					<div class="page_not_found">
						<h2><?php if($qode_options_proya['404_subtitle'] != ""): echo $qode_options_proya['404_subtitle']; else: ?> <?php _e('Page you are looking is Not Found', 'qode'); ?> <?php endif;?></h2>
                        <p><?php if($qode_options_proya['404_text'] != ""): echo $qode_options_proya['404_text']; else: ?> <?php _e('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site’s homepage and see if you can find what you are looking for.', 'qode'); ?> <?php endif;?></p>
						<div class="separator  transparent center  " style="margin-top:35px;"></div>
						<p><a class="qbutton with-shadow" href="<?php echo home_url(); ?>/"><?php if($qode_options_proya['404_backlabel'] != ""): echo $qode_options_proya['404_backlabel']; else: ?> <?php _e('Back to homepage', 'qode'); ?> <?php endif;?></a></p>
						<div class="separator  transparent center  " style="margin-top:35px;"></div>
					</div>
				</div>
			</div>
<?php get_footer(); ?>