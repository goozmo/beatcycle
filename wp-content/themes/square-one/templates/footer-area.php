
<?php
/**
 * The template used for displaying page content of footer.php
 *
 * @package Square One
 */
?>
<section id="footer-main">
	<div class="row">
		<footer class="large-12 columns" role="contentinfo">
			<?php do_action( 'squareone_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'squareone' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'squareone' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'squareone' ), 'Square One', '<a href="http://tiltedsquare.com" rel="designer">Dan Northern</a>' ); ?>
		</footer><!-- .large-12 columns -->

	</div><!-- .row -->
</section><!-- #footer-main-->	