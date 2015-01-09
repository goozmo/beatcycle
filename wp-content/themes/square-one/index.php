<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Square One
 */

get_header(); ?>

<div id="content" class="row">
	<section id="main" class="large-8 medium-8 columns">

		<?php // Action hook to place within #main
		squareone_inside_main();
		?>
				<?php
				/* Run the loop to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-index.php and that will be used instead.
				 */
				 get_template_part( 'templates/loop', 'index' );
				?>


	</section><!--#main-->  


<?php get_sidebar(); ?>
<?php get_footer(); ?>