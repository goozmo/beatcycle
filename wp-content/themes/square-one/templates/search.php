<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Square One
 */

get_header(); ?>

	<section id="main" class="large-8 medium-8 columns">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'squareone' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'templates/content', 'search' ); ?>

				<?php endwhile; ?>

				<div class="row">
    <div class="small-12 columns">
      <div class="center"><?php
    if(function_exists('wp_pagenavi')): wp_pagenavi();
    else : posts_nav_link();
    endif;
  ?></div>
    </div><!-- .small-9 centered columns -->

			<?php else : ?>

				<?php get_template_part( 'templates/no-results', 'search' ); ?>

			<?php endif; ?>
	</section><!-- .large-8 columns --><!-- #main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>