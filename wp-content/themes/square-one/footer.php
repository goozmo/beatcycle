<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of #content .row #container.
 *
 *
 * @package Square One
 */
?>


<?php // Action hook to place content after closing #content
	squareone_after_closing_content();
	?>

</section><!--#container-->
		<footer id="the-footer">

			<?php get_template_part( 'templates/footer-area', '2' );  // Loads Footer template file (footer-area.php) ?>

		</footer><!-- #the-footer-->
<script>
 	jQuery(document).ready(function($) {

		$(document).foundation();

	});</script>


<?php wp_footer(); ?>
</body>
</html>