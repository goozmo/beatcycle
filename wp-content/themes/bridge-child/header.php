<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $qode_options_proya;
global $wp_query;
$disable_qode_seo = "";
$seo_title = "";
if (isset($qode_options_proya['disable_qode_seo'])) $disable_qode_seo = $qode_options_proya['disable_qode_seo'];
if ($disable_qode_seo != "yes") {
	$seo_title = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_title", true);
	$seo_description = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_description", true);
	$seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_keywords", true);
}
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php
	if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
	echo('<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">');
	
	$responsiveness = "yes";
	if (isset($qode_options_proya['responsiveness'])) $responsiveness = $qode_options_proya['responsiveness'];
	if($responsiveness != "no"){
	?>
	<meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no">
	<?php 
	}else{
	?>
	<meta name=viewport content="width=1200,user-scalable=no">
	<?php } ?>
	<title><?php if($seo_title) { ?><?php bloginfo('name'); ?> | <?php echo $seo_title; ?><?php } else {?><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?><?php } ?></title>
	
	<?php if ($disable_qode_seo != "yes") { ?>
		<?php if($seo_description) { ?>
			
		<?php } else if($qode_options_proya['meta_description']){ ?>
			<meta name="description" content="<?php echo $qode_options_proya['meta_description'] ?>">
		<?php } ?>

		<?php if($seo_keywords) { ?>
			<meta name="keywords" content="<?php echo $seo_keywords; ?>">
		<?php } else if($qode_options_proya['meta_keywords']){ ?>
			<meta name="keywords" content="<?php echo $qode_options_proya['meta_keywords'] ?>">
		<?php } ?>
	<?php } ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $qode_options_proya['favicon_image']; ?>">
	<link rel="apple-touch-icon" href="<?php echo $qode_options_proya['favicon_image']; ?>"/>
	<!--[if gte IE 9]>
		<style type="text/css">
			.gradient {
				 filter: none;
			}
		</style>
	<![endif]-->

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	
	<?php
		$loading_animation = true;
		if (isset($qode_options_proya['loading_animation'])){ if($qode_options_proya['loading_animation'] == "off") { $loading_animation = false; }};
	
		if (isset($qode_options_proya['loading_image']) && $qode_options_proya['loading_image'] != ""){ $loading_image = $qode_options_proya['loading_image'];}else{ $loading_image =  ""; }
	?>
	<?php if($loading_animation){ ?>
		<div class="ajax_loader"><div class="ajax_loader_1"><?php if($loading_image != ""){ ?><div class="ajax_loader_2"><img src="<?php echo $loading_image; ?>" alt="" /></div><?php } else{ ?><div class="ajax_loader_html"></div><?php } ?></div></div>
	<?php } ?>
	<?php 
		$enable_side_area = "yes";
		if (isset($qode_options_proya['enable_side_area'])){ if($qode_options_proya['enable_side_area'] == "no") { $enable_side_area = "no"; }};
	?>
	<?php if($enable_side_area != "no") { ?>
		<section class="side_menu right">
            <?php if(isset($qode_options_proya['side_area_title']) && $qode_options_proya['side_area_title'] != "") { ?>
                <div class="side_menu_title">
                    <h5><?php echo $qode_options_proya['side_area_title'] ?></h5>
                </div>
            <?php } ?>
            <a href="#" target="_self" class="close_side_menu"></a>
			<?php dynamic_sidebar('sidearea'); ?>
		</section>
	<?php } ?>
	<div class="wrapper">
	<div class="wrapper_inner">
	<!-- Google Analytics start -->
	<?php if (isset($qode_options_proya['google_analytics_code'])){
				if($qode_options_proya['google_analytics_code'] != "") {
	?>
		<script>
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo $qode_options_proya['google_analytics_code']; ?>']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	<?php }
		}
	?>
	<!-- Google Analytics end -->
	
<?php
	$header_in_grid = true;
	if(isset($qode_options_proya['header_in_grid'])){if ($qode_options_proya['header_in_grid'] == "no") $header_in_grid = false;}
	
	$menu_position = "";
	if(isset($qode_options_proya['menu_position'])){$menu_position = $qode_options_proya['menu_position']; }
	
	$centered_logo = false;
	if (isset($qode_options_proya['center_logo_image'])){ if($qode_options_proya['center_logo_image'] == "yes") { $centered_logo = true; }};

	$display_header_top = "yes";
	if(isset($qode_options_proya['header_top_area'])){
		$display_header_top = $qode_options_proya['header_top_area'];
	}
	if (!empty($_SESSION['qode_proya_header_top'])){
		$display_header_top = $_SESSION['qode_proya_header_top'];
	}
	$header_top_area_scroll = "no";
	if(isset($qode_options_proya['header_top_area_scroll']))
		$header_top_area_scroll = $qode_options_proya['header_top_area_scroll'];
	if (!empty($_SESSION['qode_header_top'])) {
		if ($_SESSION['qode_header_top'] == "no")
			$header_top_area_scroll = "no";
		if ($_SESSION['qode_header_top'] == "yes")
			$header_top_area_scroll = "yes";
	}
	global $wp_query;
	$id = $wp_query->get_queried_object_id();
	$is_woocommerce=false;
	if(function_exists("is_woocommerce")) {
		$is_woocommerce = is_woocommerce();
		if($is_woocommerce){
			$id = get_option('woocommerce_shop_page_id');
		}
	}
	$header_style = "";
	if(get_post_meta($id, "qode_header-style", true) != ""){
		$header_style = get_post_meta($id, "qode_header-style", true);
	}else if(isset($qode_options_proya['header_style'])){
		$header_style = $qode_options_proya['header_style'];
	}
	
	$header_color_transparency_per_page = "";
	if($qode_options_proya['header_background_transparency_initial'] != "") {
		$header_color_transparency_per_page = $qode_options_proya['header_background_transparency_initial'];
	}
	if(get_post_meta($id, "qode_header_color_transparency_per_page", true) != ""){
		$header_color_transparency_per_page = get_post_meta($id, "qode_header_color_transparency_per_page", true);
	}

	$header_color_per_page = "style='";
	if(get_post_meta($id, "qode_header_color_per_page", true) != ""){
		if($header_color_transparency_per_page != ""){
			$header_background_color = qode_hex2rgb(get_post_meta($id, "qode_header_color_per_page", true));
			$header_color_per_page .= " background-color:rgba(" . $header_background_color[0] . ", " . $header_background_color[1] . ", " . $header_background_color[2] . ", " . $header_color_transparency_per_page . ");";
		}else{
			$header_color_per_page .= " background-color:" . get_post_meta($id, "qode_header_color_per_page", true) . ";";
		}
	} else if($header_color_transparency_per_page != "" && get_post_meta($id, "qode_header_color_per_page", true) == ""){
		$header_background_color = qode_hex2rgb("#ffffff");
		$header_color_per_page .= " background-color:rgba(" . $header_background_color[0] . ", " . $header_background_color[1] . ", " . $header_background_color[2] . ", " . $header_color_transparency_per_page . ");";
	}

//var_dump(get_post_meta($id, "qode_header_color_transparency_per_page", true)); exit;

	$header_top_color_per_page = "style='";
	if(get_post_meta($id, "qode_header_color_per_page", true) != ""){
		if($header_color_transparency_per_page != ""){
			$header_background_color = qode_hex2rgb(get_post_meta($id, "qode_header_color_per_page", true));
			$header_top_color_per_page .= "background-color:rgba(" . $header_background_color[0] . ", " . $header_background_color[1] . ", " . $header_background_color[2] . ", " . $header_color_transparency_per_page . ");";
		}else{
			$header_top_color_per_page .= "background-color:" . get_post_meta($id, "qode_header_color_per_page", true) . ";";
		}
	} else if($header_color_transparency_per_page != "" && get_post_meta($id, "qode_header_color_per_page", true) == ""){
		$header_background_color = qode_hex2rgb("#ffffff");
		$header_top_color_per_page .= "background-color:rgba(" . $header_background_color[0] . ", " . $header_background_color[1] . ", " . $header_background_color[2] . ", " . $header_color_transparency_per_page . ");";
	}
	$header_separator = qode_hex2rgb("#eaeaea");
	if(isset($qode_options_proya['header_separator_color']) && $qode_options_proya['header_separator_color'] != ""){
		$header_separator = qode_hex2rgb($qode_options_proya['header_separator_color']);
	}

	$header_color_per_page .="'";
	$header_top_color_per_page .="'";

    //generate header classes based on qode options
    $header_classes = '';
    if(is_active_sidebar('woocommerce_dropdown')) {
        $header_classes .= 'has_woocommerce_dropdown ';
    }

    if($display_header_top == "yes") {
        $header_classes .= ' has_top';
    }

    if($header_top_area_scroll == "yes") {
        $header_classes .= ' scroll_top';
    }

    if($centered_logo) {
        $header_classes .= ' centered_logo';
    }

    if(is_active_sidebar('header_fixed_right')) {
        $header_classes .= ' has_header_fixed_right';
    }

    if($qode_options_proya['header_top_area_scroll'] == 'no') {
        $header_classes .= ' scroll_header_top_area';
    }

    if(get_post_meta($id, "qode_header-style", true) != ""){
        $header_classes .= ' '.get_post_meta($id, "qode_header-style", true);
    } else if(isset($qode_options_proya['header_style'])){
        $header_classes .= ' '.$qode_options_proya['header_style'];
    }

    $header_bottom_appearance = 'fixed';
    if(isset($qode_options_proya['header_bottom_appearance'])){
        $header_classes .= ' '.$qode_options_proya['header_bottom_appearance'];
        $header_bottom_appearance = $qode_options_proya['header_bottom_appearance'];
    } else {
        $header_classes .= ' fixed';
    }

    $per_page_header_transparency = get_post_meta($id, 'qode_header_color_transparency_per_page', true);
    $transparent_header = ($per_page_header_transparency != "" && $per_page_header_transparency <= '0.01') || ($qode_options_proya['header_background_transparency_initial'] != "" && $qode_options_proya['header_background_transparency_initial'] <= '0.01');
    if($transparent_header) {
        $header_classes .= ' transparent';
    }

?>

<header class="<?php echo $header_classes; ?> page_header">
	<div class="header_inner clearfix">
	<?php if(isset($qode_options_proya['enable_search']) && $qode_options_proya['enable_search'] == "yes"){ ?>
	<form role="search" action="<?php echo home_url(); ?>/" class="qode_search_form" method="get">
		<?php if($header_in_grid){ ?>
            <div class="container">
            <div class="container_inner clearfix">
        <?php } ?>

		<i class="fa fa-search"></i>
		<input type="text" placeholder="<?php _e('Search', 'qode'); ?>" name="s" class="qode_search_field" autocomplete="off" />
		<input type="submit" value="Search" />

		<div class="qode_search_close">
            <a href="#">
                <i class="fa fa-times"></i>
            </a>
        </div>
		<?php if($header_in_grid){ ?>
                </div>
            </div>
        <?php } ?>
	</form>
	<div class="login-container">
		          <div class="container">
            <div class="container_inner clearfix">

		  
<div id="login-toggle">

<?php
	if (is_user_logged_in()){  ?>
   	 <?php echo 'Test Message Here';
   	 ?>


<? } else { ?>

<div class="row">
	<div class="large-7 medium-12 columns">
		<h3 class="sign-in-title">Let's Get Started</h3>
	</div>
	<div class="large-5 columns medium-12">
			<p class="lost-pass"><a href="<?php echo wp_registration_url(); ?>" title="Register">Need an Account?</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password">Lost Your Password?</a></p>
	</div>
</div>
			<div class="separator-full"></div>
<?
	/// Defualt Wordpress Login Form
 $args = array(
        'echo' => true,
        'form_id' => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log In' ),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => NULL,
        'value_remember' => false );
wp_login_form($args); 
}; 

?>



        </div>
    </div>
</div>
</div>

	<?php } ?>
	<div class="header_top_bottom_holder">
	<?php if($display_header_top == "yes"){ ?>
		<div class="header_top clearfix" <?php echo $header_top_color_per_page; ?> >
			<?php if($header_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix">
			<?php } ?>
					<div class="left">
						<div class="inner">
						<?php	
							dynamic_sidebar('header_left'); 
						?>
						</div>
					</div>
					<div class="right">
						<div class="inner">
						<?php if(is_user_logged_in()): ?>
						<ul class="inline-list">
							<li class="your-profile"><a href="/your-profile">Your Account</a></li>
	<li><a class="qbutton small login" href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Log Out</a></li></ul>
	<?php endif; ?>
	<?php if(!is_user_logged_in()): ?>
	<div id="login-click" class="qbutton small login">Log In</div>
	<?php endif; ?>
						</div>
					</div>
				<?php if($header_in_grid){ ?>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<div class="header_bottom clearfix" <?php echo $header_color_per_page; ?> >
		<?php if($header_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix">
			<?php } ?>
					<div class="header_inner_left">
						<div class="mobile_menu_button"><span><i class="fa fa-bars"></i></span></div>
						<div class="logo_wrapper">
							<?php
							if (isset($qode_options_proya['logo_image']) && $qode_options_proya['logo_image'] != ""){ $logo_image = $qode_options_proya['logo_image'];}else{ $logo_image =  get_template_directory_uri().'/img/logo.png'; };
							if (isset($qode_options_proya['logo_image_light']) && $qode_options_proya['logo_image_light'] != ""){ $logo_image_light = $qode_options_proya['logo_image_light'];}else{ $logo_image_light =  get_template_directory_uri().'/img/logo.png'; };
							if (isset($qode_options_proya['logo_image_dark']) && $qode_options_proya['logo_image_dark'] != ""){ $logo_image_dark = $qode_options_proya['logo_image_dark'];}else{ $logo_image_dark =  get_template_directory_uri().'/img/logo_black.png'; };
							if (isset($qode_options_proya['logo_image_sticky']) && $qode_options_proya['logo_image_sticky'] != ""){ $logo_image_sticky = $qode_options_proya['logo_image_sticky'];}else{ $logo_image_sticky =  get_template_directory_uri().'/img/logo_black.png'; };
							?>
							<div class="q_logo"><a href="<?php echo home_url(); ?>/"><img class="normal" src="<?php echo $logo_image; ?>" alt="Logo"/><img class="light" src="<?php echo $logo_image_light; ?>" alt="Logo"/><img class="dark" src="<?php echo $logo_image_dark; ?>" alt="Logo"/><img class="sticky" src="<?php echo $logo_image_sticky; ?>" alt="Logo"/></a></div>
							
						</div>
                        <?php if($header_bottom_appearance == "stick menu_bottom" && is_active_sidebar('header_fixed_right')){ ?>
                            <div class="header_fixed_right_area">
                                <?php dynamic_sidebar('header_fixed_right'); ?>
                            </div>
                        <?php } ?>
					</div>
					<?php if($header_bottom_appearance != "stick menu_bottom"){ ?>
						<?php if(!$centered_logo) { ?>
							<div class="header_inner_right">
                                <div class="side_menu_button_wrapper right">
									<?php if(is_active_sidebar('woocommerce_dropdown')) {
										dynamic_sidebar('woocommerce_dropdown');
									} ?>
                                    <div class="side_menu_button">
                                        <?php if(isset($qode_options_proya['enable_search']) && $qode_options_proya['enable_search'] == "yes"){ ?>
                                            <a class="search_button" href="javascript:void(0)">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        <?php } ?>

                                        <?php if($enable_side_area != "no"){ ?>
                                            <a class="side_menu_button_link" href="javascript:void(0)">
                                                <i class="fa fa-bars"></i>
                                            </a><?php } ?>
                                    </div>
                                </div>
							</div>
						<?php } ?>
						<nav class="main_menu drop_down <?php if($menu_position == "" && $header_bottom_appearance != "stick menu_bottom"){ echo 'right';} ?>">
						<?php
							
							wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																	'container'  => '', 
																	'container_class' => '', 
																	'menu_class' => '', 
																	'menu_id' => '',
																	'fallback_cb' => 'top_navigation_fallback',
																	'link_before' => '<span>',
																	'link_after' => '</span>',
																	'walker' => new qode_type1_walker_nav_menu()
						 ));
						?>
						</nav>
						<?php if($centered_logo) { ?>
							<div class="header_inner_right">
                                <div class="side_menu_button_wrapper right">
									<?php if(is_active_sidebar('woocommerce_dropdown')) {
										dynamic_sidebar('woocommerce_dropdown');
									} ?>
									<div class="side_menu_button">

                                        <?php if(isset($qode_options_proya['enable_search']) && $qode_options_proya['enable_search'] == "yes"){ ?>
                                            <a class="search_button" href="javascript:void(0)">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        <?php } ?>

                                        <?php if($enable_side_area != "no"){ ?>
                                            <a class="side_menu_button_link" href="javascript:void(0)">
                                                <i class="fa fa-bars"></i>
                                            </a>
                                        <?php } ?>

                                    </div>
                                </div>
							</div>
						<?php } ?>
					<?php }else{ ?>
						<div class="header_menu_bottom">
						    <div class="header_menu_bottom_inner">
								<?php if($centered_logo) { ?>
									<div class="main_menu_header_inner_right_holder with_center_logo">
								<?php } else { ?>
									<div class="main_menu_header_inner_right_holder">
								<?php } ?>
									<nav class="main_menu drop_down">
									something ehere
									<?php
										wp_nav_menu( array(
											'theme_location' => 'top-navigation' ,
											'container'  => '',
											'container_class' => '',
											'menu_class' => 'clearfix',
											'menu_id' => '',
											'fallback_cb' => 'top_navigation_fallback',
											'link_before' => '<span>',
											'link_after' => '</span>',
											'walker' => new qode_type1_walker_nav_menu()
									 ));
									?>
									</nav>
									<div class="header_inner_right">
										<div class="side_menu_button_wrapper right">
											<?php if(is_active_sidebar('woocommerce_dropdown')) {
												dynamic_sidebar('woocommerce_dropdown');
											} ?>
											<div class="side_menu_button">

												<?php if(isset($qode_options_proya['enable_search']) && $qode_options_proya['enable_search'] == "yes"){ ?>
													<a class="search_button" href="javascript:void(0)">
														<i class="fa fa-search"></i>
													</a>
												<?php } ?>

												<?php if($enable_side_area != "no"){ ?>
													<a class="side_menu_button_link" href="javascript:void(0)">
														<i class="fa fa-bars"></i>
													</a>
												<?php } ?>

											</div>
										</div>
									</div>
                                </div>
                        </div>
                    </div>
					<?php } ?>
					<nav class="mobile_menu">
						<?php			
							wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																	'container'  => '', 
																	'container_class' => '', 
																	'menu_class' => '', 
																	'menu_id' => '',
																	'fallback_cb' => 'top_navigation_fallback',
																	'link_before' => '<span>',
																	'link_after' => '</span>',
																	'walker' => new qode_type2_walker_nav_menu()
						 ));
						?>
					</nav>
			<?php if($header_in_grid){ ?>
					</div>
				</div>
			<?php } ?>
	</div>
	</div>
	</div>
	<?php
		global $qode_toolbar;
		if(isset($qode_toolbar)) include("toolbar.php")
	?>
</header>
	<?php if($qode_options_proya['show_back_button'] == "yes") { ?>
		<a id='back_to_top' href='#'>
			<span class="fa-stack">
				<i class="fa fa-arrow-up" style=""></i>
			</span>
		</a>
	<?php } ?>
		<?php 
			$content_class = "";
			if(get_post_meta($id, "qode_revolution-slider", true) == "" && get_post_meta($id, "qode_show-page-title", true)){
                if($qode_options_proya['header_bottom_appearance'] == "fixed"){
				    $content_class = "content_top_margin";
                }else {
                    $content_class = "content_top_margin_none";
                }
			}
		?>
	<div class="content <?php echo $content_class; ?>">
<?php 
$animation = get_post_meta($id, "qode_show-animation", true);
if (!empty($_SESSION['qode_animation']) && $animation == "")
	$animation = $_SESSION['qode_animation'];

?>
			<?php if($qode_options_proya['page_transitions'] == "1" || $qode_options_proya['page_transitions'] == "2" || $qode_options_proya['page_transitions'] == "3" || $qode_options_proya['page_transitions'] == "4" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade") || ($animation == "leftright")){ ?>
				<div class="meta">				
					<?php if($seo_title){ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php echo $seo_title; ?></div>
					<?php } else{ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></div>
					<?php } ?>
					<?php if($seo_description){ ?>
						<div class="seo_description"><?php echo $seo_description; ?></div>
					<?php } else if($qode_options_proya['meta_description']){?>
						<div class="seo_description"><?php echo $qode_options_proya['meta_description']; ?></div>
					<?php } ?>
					<?php if($seo_keywords){ ?>
						<div class="seo_keywords"><?php echo $seo_keywords; ?></div>
					<?php }else if($qode_options_proya['meta_keywords']){?>
						<div class="seo_keywords"><?php echo $qode_options_proya['meta_keywords']; ?></div>
					<?php }?>
					<span id="qode_page_id"><?php echo $wp_query->get_queried_object_id(); ?></span>
					<div class="body_classes"><?php echo implode( ',', get_body_class()); ?></div>
				</div>
			<?php } ?>
			<div class="content_inner <?php echo $animation;?> ">
