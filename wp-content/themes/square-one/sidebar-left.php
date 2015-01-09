<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Square One
 */
?>

		<aside id="the-sidebar" class="large-4 medium-4 columns">
				<?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

					<div id="search" class="widget widget_search">
						<?php get_search_form(); ?>
					</div>

					<div id="archives" class="widget">
						<h3 class="widget-title"><?php _e( 'Archives', 'squareone' ); ?></h3>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
						</ul>
					</div>

					<div id="meta" class="widget">
						<h3 class="widget-title"><?php _e( 'Meta', 'squareone' ); ?></h3>
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</div>

				<?php endif; // end sidebar widget area ?>
		</aside><!-- .large-4 columns --><!-- #the-sidebar-->
