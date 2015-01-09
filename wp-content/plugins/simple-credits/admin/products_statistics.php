<?php 
	global $translate;
?>
<h2 class="nav-tab-wrapper">
	<a class="nav-tab" href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=product&page=woocommerceCredit&tab=1"><?php echo $translate->wooTranslate('User credits', get_bloginfo('language')); ?></a>
	<a class="nav-tab" href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=product&page=woocommerceCredit&tab=2"><?php echo $translate->wooTranslate('User statistics', get_bloginfo('language')); ?></a>
	<a class="nav-tab nav-tab-active" href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=product&page=woocommerceCredit&tab=3"><?php echo $translate->wooTranslate('Products statistics', get_bloginfo('language')); ?></a>
	<a class="nav-tab" href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=product&page=woocommerceCredit&tab=4"><?php echo $translate->wooTranslate('Initial Setup', get_bloginfo('language')); ?></a>

</h2>
<div id="col-container" style="text-align:center;">
	<h2><?php echo $translate->wooTranslate('Yesterday sold products', get_bloginfo('language')); ?></h2>
	<div id="productsChart1" style="text-align:center;width:100%;height:400px;"></div>
</div>
<hr/>
<div id="col-container" style="text-align:center;">
	<h2><?php echo $translate->wooTranslate('Last 30 days', get_bloginfo('language')); ?></h2>
	<div id="productsChart2" style="text-align:center;width:100%;height:400px;"></div>
</div>