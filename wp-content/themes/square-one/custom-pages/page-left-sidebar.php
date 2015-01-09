<?php
/**
 * Template Name: Left Sidebar Template
 */

get_header(); ?>

<div id="content" class="row">
	<div class="hide-for-small"><?php get_sidebar('left'); ?></div>
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

				</section><!--#main--> 


			<div class="show-for-small"><?php get_sidebar(); ?></div>
		</div><!--End of .content .row -->
		
<?php get_footer(); ?>
