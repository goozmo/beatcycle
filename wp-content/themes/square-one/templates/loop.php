<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called post-___.php (where ___ is the Post Format name) in a 'formats' folder and that will be used instead.
						 */
						get_template_part( 'formats/post', get_post_format() );
					?>

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

				<?php get_template_part( 'templates/no-results', 'index' ); ?>

			<?php endif; ?>