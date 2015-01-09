<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Square One
 */

get_header(); ?>

<section id="main">
  <div class="row">
    <div class="large-12 columns">
			<article id="post-0" class="post error404 not-found">
				<div class="row">
					<div class="large-8 large-centered columns center">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'squareone' ); ?></h1>
						</header><!-- .entry-header -->

			<div class="entry-content">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'squareone' ); ?></p>
							<?php get_search_form(); ?>
					</div><!--.large-8 .large-centered .columns .center-->
				</div><!-- .row -->
				<div class="row">
					<div class="large-4 columns">
						<div class="widget">
							<h3 class="widgettitle"><?php _e( 'Most Used Categories', 'squareone' ); ?></h3>
							<ul>
							<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
							</ul>
						</div><!-- .widget -->
					</div><!-- .large-4 .columns -->
					<div class="large-4 columns">
						<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'squareone' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "before_title=<h3>", "after_title=</h3>$archive_content" );
						?>
					</div><!-- .large-4 .columns -->
					<div class="large-4 columns">
						<?php the_widget( 'WP_Widget_Tag_Cloud', "before_title=<h3>", "after_title=</h3>" ); ?>
					</div><!-- .large-4 .columns -->
				</div><!-- .row -->
			</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!--.large-12 columns-->
 	</div><!--.row-->
</section><!--#main-->  


<?php get_footer(); ?>