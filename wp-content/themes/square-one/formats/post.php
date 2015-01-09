<?php
/**The standard post-format.
 * @package Square One
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="row">
			<div class="small-9 columns">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'squareone' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</div><!--small-9 columns-->
			<div class="small-3 columns">
				<span class="comments-link vcard right"><?php comments_popup_link( __( '0', 'squareone' ), __( '1', 'squareone' ), __( '%', 'squareone' ) ); ?></span>
			</div><!--small-3 columns-->
		</div><!--.row-->
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php squareone_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content horizontal-line">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'squareone' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'squareone' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content .horizontal-line -->
	<?php endif; ?>
</article><!--  #post-## -->
