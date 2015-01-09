<?php
/**
 * The default template for displaying pages.
 *
 * @package Square One
 */

get_header(); ?>

<?php echo get_field( "test" ); ?>

<div id="content" class="row">
	<section id="main" class="large-8 medium-8 columns">

			<?php // Action hook to place within #main
			squareone_inside_main();
			?>

			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			<?php endwhile; // end of the loop. ?>
		</section><!-- .large-8 columns --><!--#main-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
