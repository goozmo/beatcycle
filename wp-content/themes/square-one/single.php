<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Square One
 */

get_header(); ?>
<div id="content" class="row">
	<section id="main" class="large-8 columns">

		<?php while ( have_posts() ) : the_post(); ?>	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<div class="entry-meta">
					<?php squareone_posted_on(); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'squareone' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->

			<footer class="entry-meta">
				<ul class="inline-list">
				<li>Tags:</li>
				<?php
					if(get_the_tag_list()) {
					    echo get_the_tag_list('<li>','</li><li>','</li>');
					}
				?>
			</ul><!--inline-list-->
			</footer><!-- .entry-meta -->
		</article><!-- #post-## -->

		<?php squareone_content_nav( 'nav-below' ); ?>
		<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() )
								comments_template();
					?>
				<?php endwhile; // end of the loop. ?>

	</section><!-- .large-8 columns --><!--#main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>