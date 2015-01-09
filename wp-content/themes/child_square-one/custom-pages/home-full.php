<?php
/*
Template Name: Home Template
*/
?>

<?php get_header(); ?>

<section id="main">
  <div class="row">
    <div class="large-10 large-centered columns">
			<h1 class="logo-1"><img src="http://beatcycle.com/wordpress/wp-content/uploads/2014/05/BeatCycle_Logo_250.png" alt="Beat Cycle Indoor Cycling Boulder"</h1>
<h4 class="center subhead">Coming Soon</h4>
<div class="sep">&nbsp;</div>
<h1 class="center">Boulder's Premier Indoor Cycling Studio</h1>
<!--<div class="center"><?php echo do_shortcode('[ujicountdown id="style 1" expire="2014/06/12 06:22"]'); ?></div>-->
<div class="panel">
<h5>Enter your email to get notified</h5>
<div class="row">
<div class="large-8 center large-centered">
	<?php echo do_shortcode('[gravityform id="1" name="signup" title="false" description="false" ajax="false"]'); ?>
</div>
</div>
<!--<ul id="social-list">
	<li><a href="https://www.facebook.com/TheLegacyMusicGroup"><img alt="" src="http://legacymusicgroup.com/wordpress/wp-content/uploads/2014/03/fb-icon1.png" /></a></li>
	<li><a href="https://twitter.com/LegacyMusicGrp"><img alt="" src="http://legacymusicgroup.com/wordpress/wp-content/uploads/2014/03/tw-icon.png" /></a></li>
	<li><a href="http://www.linkedin.com/profile/view?id=166569934&amp;locale=en_US&amp;trk=tyah&amp;trkInfo=tas%3Amatthew%20med%2Cidx%3A1-1-1"><img alt="" src="http://legacymusicgroup.com/wordpress/wp-content/uploads/2014/03/li-icon.png" /></a></li>
	<li><a href="http://instagram.com/legacymusicgroup"><img alt="" src="http://legacymusicgroup.com/wordpress/wp-content/uploads/2014/03/ig-icon.png" /></a></li>
</ul>-->

		</div><!--.large-12 columns-->
 	</div><!--.row-->
</section><!--#main-->  

<?php get_footer(); ?>
