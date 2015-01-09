<?php
/*
Template Name: Full Template
*/
?>

<?php get_header(); ?>

<section id="main">
  <div class="row">
    <div class="large-12 columns">

			<?php // Action hook to place within #main
			squareone_inside_main();
			?>

			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php while ( have_posts() ) : the_post(); // Start the Loop?>
				<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!--.large-12 columns-->
 	</div><!--.row-->
</section><!--#main-->  

<?php get_footer(); ?>
