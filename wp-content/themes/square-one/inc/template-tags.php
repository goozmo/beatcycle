<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Square One
 */

if ( ! function_exists( 'squareone_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function squareone_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		
	<?php if ( is_single() ) : // navigation links for single posts ?>
<div class="row">
	<div class="small-6 columns">
		<?php previous_post_link( '<div class="previous text-left">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'squareone' ) . '</span> %title' ); ?>
	</div><!-- small-6 columns-->
	<div class="small-6 columns">
		<?php next_post_link( '<div class="next text-right">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'squareone' ) . '</span>' ); ?>
	</div><!-- small-6 columns-->
</div><!--row-->
	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'squareone' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'squareone' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // squareone_content_nav

if ( ! function_exists( 'squareone_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function squareone_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'squareone' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'squareone' ), '<span class="edit-link">', '<span>' ); ?></p>
	<?php
			break;
		default :
	?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment panel">
				<div class="row">
					<div class="small-2 columns">
						<a><?php echo get_avatar( $comment ); ?></a>
					</div><!-- .small-2 columns -->
					<div class="small-10 columns">
						<h5><?php printf( __( '%s', 'squareone' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h5>
						<div class="comment-meta commentmetadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'squareone' ), get_comment_date(), get_comment_time() ); ?>
							</time></a>
							<?php edit_comment_link( __( 'Edit', 'squareone' ), '<span class="edit-link">', '<span>' ); ?>
						</div><!-- .comment-meta .commentmetadata -->
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php _e( 'Your comment is awaiting moderation.', 'squareone' ); ?></em>
							<br />
						<?php endif; ?>

					</div><!-- .small-10 columns -->
				</div><!-- .row -->
				<div class="row">
					<div class="small-12 columns">
						<div class="comment-content">
							<?php comment_text(); ?>
						</div>
						<div class="reply text-right">
							<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
					</div><!-- .small-12 columns -->
				</div><!-- .row -->
			
		</article><!-- #comment-## -->
	<?php
			break;
	endswitch;
}
endif; // ends check for squareone_comment()

if ( ! function_exists( 'squareone_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function squareone_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> by <a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span>', 'squareone' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'squareone' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;
/**
 * Returns true if a blog has more than 1 category
 */
function squareone_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so squareone_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so squareone_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in squareone_categorized_blog
 */
function squareone_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'squareone_category_transient_flusher' );
add_action( 'save_post', 'squareone_category_transient_flusher' );