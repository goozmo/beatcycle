<?php
/**The quote post-format.
 * @package Square One
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php squareone_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	
	<div class="entry-content panel">
		<blockquote><h3><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'squareone' ) ); ?></h3></blockquote>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'squareone' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content .horizontal-line -->
	
</article><!--  #post-## -->
