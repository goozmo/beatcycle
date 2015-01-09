<?php 
	global $translate;
	global $wpdb;
	$option_name = 'simple_credit_initial_amount' ;
    $amount = get_option( $option_name );
	$option_name = 'simple_credit_initial_setup' ;
    $setup = get_option( $option_name );
?>
<h2 class="nav-tab-wrapper">
	<a class="nav-tab" href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=product&page=woocommerceCredit&tab=1"><?php echo $translate->wooTranslate('User credits', get_bloginfo('language')); ?></a>
	<a class="nav-tab" href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=product&page=woocommerceCredit&tab=2"><?php echo $translate->wooTranslate('User statistics', get_bloginfo('language')); ?></a>
	<a class="nav-tab" href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=product&page=woocommerceCredit&tab=3"><?php echo $translate->wooTranslate('Products statistics', get_bloginfo('language')); ?></a>
	<a class="nav-tab nav-tab-active" href="<?php echo get_site_url(); ?>/wp-admin/edit.php?post_type=product&page=woocommerceCredit&tab=4"><?php echo $translate->wooTranslate('Initial Setup', get_bloginfo('language')); ?></a>

</h2>
<div id="col-container">
	<div class="col-wrap">
	<form style="width: 100%" method="post">
			<table>
				<tbody>
					<tr>
						<td width="150">
						<?php echo $translate->wooTranslate('Enable initial amount :', get_bloginfo('language')); ?>
						</td>
						<td>
							<input type="checkbox" id="enable" name="enable" value="enable" <?php if($setup) echo "checked" ?>/>
							
						</td>
					</tr>
					<tr>
						<td width="150">
						<?php echo $translate->wooTranslate('Please set the initial amount :', get_bloginfo('language')); ?>
						</td>
						<td>
							<input type="text" id="amount" name="amount" value="<?php echo $amount; ?>"/>
							
						</td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: right;">
							<button type="submit" name="action" class="button button-primary" value="set_amount">
								<?php echo $translate->wooTranslate('Save', get_bloginfo('language')); ?>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
