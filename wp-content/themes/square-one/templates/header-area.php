<?php
/**
 * The template used for displaying page content of header.php
 *
 * @package Square One
 */
?>

<section id="banner">
	<div class="row">
			<div class="large-4 medium-4 columns">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</div><!--.large-4 columns -->
			<div class="large-8 medium-8 columns">
				<nav class="nav-big right" role="navigation">
			        <?php
			          if (has_nav_menu('primary')) :
			            wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'inline-list'));
			          endif;
			        ?>
				</nav><!-- #nav-main -->

	</div><!--.row-->
</section><!--banner-->