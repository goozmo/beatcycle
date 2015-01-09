<?php
/**
 * The Header for the theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Square One
 */
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>


	<!--[if lte IE 8]>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/square-one/assets/css/ie8-and-down.css" />
<![endif]-->

  <meta charset="utf-8">
  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
<?php wp_head(); ?>

<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>.com/favicon.ico" type="image/x-icon" />

<meta name="google-site-verification" content="oaUCof7nThSsDIo7btYLT8ptC3rT5nx5ZEi-3IaOmIQ" />

</head>

<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>
	<section id="the-container">
		<?php get_template_part( 'templates/header-area', '2' );  // Navigation bar and Logo (header-area.php) ?>

	<?php // Action hook to place content before opening #content
	squareone_before_opening_content();
	?>
