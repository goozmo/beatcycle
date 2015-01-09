<?php
/**
 * The default template for displaying pages.
 *
 * @package Square One
 */

get_header(); ?>

<section id="main">
  <div class="row">
    <div class="large-12 columns">

			<?php // Action hook to place within #main
			squareone_inside_main();
			?>
			<?php woocommerce_content(); ?>
			
		</div><!--.large-12 columns-->
 	</div><!--.row-->
</section><!--#main-->  

<?php get_footer(); ?>
