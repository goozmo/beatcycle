<?php
/**
 * The template for displaying search forms in Square One
 *
 * @package Square One
 */
?>
	<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<div class="row collapse">
			<div class="small-9 columns">
				<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'squareone' ); ?>" />
			</div><!--.small-9 columns-->
			<div class="small-3 columns">
				<input type="submit" class="button postfix" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'squareone' ); ?>" />
			</div><!--.small-3 columns-->
		</div><!--.row-->
	</form>
