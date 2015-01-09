<?php
require_once "../../../wp-config.php";

function encode($string,$key) {
	$key = sha1($key);
	$strLen = strlen($string);
	$keyLen = strlen($key);
	for ($i = 0; $i < $strLen; $i++) {
		$ordStr = ord(substr($string,$i,1));
		if ($j == $keyLen) {
			$j = 0;
		}
		$ordKey = ord(substr($key,$j,1));
		$j++;
		$hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
	}
	return $hash;
}

if(isset($_POST['productid'])) {
	global $wpdb;
	global $current_user;
	global $translate;
	global $woocommerce;

	$product_id = $_POST['productid'];
	if($product_id == 'undefined')
		$product_id ='';

	$variation_id = $_POST['variationid'];
	if($variation_id == 'undefined')
		$variation_id='';

	$getUserCredit = getUserCredit(get_current_user_id());

	if(!empty($product_id)) {
		$product = new WC_Product( $product_id );
		
		$productPrice =  $product->get_price();
	}
	if(!empty($variation_id)) {
		$variation = new WC_Product_Variation($variation_id);
		$productPrice = $variation->get_price();
	}

	if($getUserCredit >= $productPrice) {
		get_currentuserinfo();


		$sql = $wpdb->query("UPDATE `".$wpdb->prefix."postmeta` SET meta_value = 0 where post_id=".$variation_id." AND meta_key='_stock'");
		
		$sql = $wpdb->query("UPDATE `".$wpdb->prefix."woocredit_users` SET credit = '".($getUserCredit-$productPrice)."' where user_id=".get_current_user_id());
		$sql = $wpdb->query("INSERT INTO `".$wpdb->prefix."woocredit_products` (user_id, product_id, price) VALUES (".get_current_user_id().",".$_POST['productid'].",".$productPrice.")");

//Configure to insert order
//echo get_current_user_id();
$order_data = array(
    'post_name'     => 'order-' . date_format(time(), 'M-d-Y-hi-a'), //'order-jun-19-2014-0648-pm'
    'post_type'     => 'shop_order',
    'post_title'    => 'Order &ndash; ' . date_format(time(), 'F d, Y @ h:i A'), //'June 19, 2014 @ 07:19 PM'
    'post_status'   => 'publish',
    'ping_status'   => 'closed',
    'post_excerpt'  => 'Bike',
    'post_author'   => get_current_user_id(),
    'post_password' => uniqid( 'order_' ),   // Protects the post just in case
    'post_date'     => date_format(time(), 'Y-m-d H:i:s e'), //'order-jun-19-2014-0648-pm'
    'comment_status' => 'open'
);

$order_id = wp_insert_post( $order_data, true );

if ( is_wp_error( $order_id ) ) {

    $order->errors = $order_id;

} else {

    $order->imported = true;
	
	//add_post_meta($order_id, 'transaction_id', $order->transaction_id, true); 
    add_post_meta($order_id, '_payment_method_title', 'Simple Credit', true);
    add_post_meta($order_id, '_order_total', $productPrice, true);
    add_post_meta($order_id, '_customer_user', get_current_user_id(), true);
    add_post_meta($order_id, '_completed_date', date_format( date(), 'Y-m-d H:i:s e'), true);
    //add_post_meta($order_id, '_order_currency', $order->currency, true);
    add_post_meta($order_id, '_paid_date', date_format( date(), 'Y-m-d H:i:s e'), true);
	wp_set_object_terms( $order_id, 'completed', 'shop_order_status' );
	
	$item_id = wc_add_order_item( $order_id, array(
            'order_item_name'       => $product->get_title() . " Bike " . $variation->variation_data['attribute_pa_bike'] . " Date " . $variation->variation_data['attribute_date'] 
        ) );
		
	 wc_add_order_item_meta( $item_id, '_qty', 1 ); 
     //wc_add_order_item_meta( $item_id, '_tax_class', $product->get_tax_class() );
     wc_add_order_item_meta( $item_id, '_product_id', $_POST['productid']);
     wc_add_order_item_meta( $item_id, '_variation_id', $variation_id);
}


//email usres with booked bike info
 
 $blog_email = get_bloginfo('admin_email'); 
	 $blog_title = 'Beat Cycle';
	 $bike_no = $variation->variation_data['attribute_pa_bike'];
	 $date =  $variation->variation_data['attribute_date'];
	 $message = "<p>Thank you for booking a class! You have booked Bike number " . $bike_no . " on " . $date . "</p><p>Please contact us with any questions.</p><p>Thanks,</p><p>Beat Cycle Team</p>";  
	 $headers = "MIME-Version: 1.0" . "\r\n";
	 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	 $headers .= 'From: ' . $blog_email . "\r\n";
	 wp_mail( $current_user->user_email , 'Beat Cycle', $message, $headers );


		if(($product && $product->is_downloadable()) || ($variation && $variation->is_downloadable())) {
			if($product && $product->is_downloadable()) {
				$files = $product->get_files();
				$file = array_shift($files);
				$file = $file["file"];
			}
			if($variation && $variation->is_downloadable()) {
				$files = $variation->get_files();
				$file = array_shift($files);
				$file = $file["file"];
			}
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$codingKey = $translate->getCodingKey();
			$filedownload = get_site_url()."/wp-content/plugins/simple-credits/download.php?action=email&time=".encode(time(),$codingKey)."&filename=".encode($file,$codingKey);
			$email_text = str_replace("[filedownload]", $filedownload, $translate->wooTranslate('email', get_bloginfo('language')));
			$message = '
			<html>
			<head>
			    <title>'.get_bloginfo('name').'</title>
			</head>

			<body>
			    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
			        <tbody>
			            <tr>
			                <td valign="top" align="center">
			                    <table width="600" cellspacing="0" cellpadding="0" border="0" style="border-radius:6px!important;background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:6px!important">
			                        <tbody>
			                            <tr>
			                                <td valign="top" align="center">
			                                    <table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#557DA1" style="background-color:#557da1;color:#ffffff;border-top-left-radius:6px!important;border-top-right-radius:6px!important;border-bottom:0;font-family:Arial;font-weight:bold;line-height:100%;vertical-align:middle">
			                                        <tbody>
			                                            <tr>
			                                                <td>
			                                                    <h1 style="color:#ffffff;margin:0;padding:28px 24px;display:block;font-family:Arial;font-size:30px;font-weight:bold;text-align:left;line-height:150%">'.get_bloginfo('name').'</h1>
			                                                </td>
			                                            </tr>
			                                        </tbody>
			                                    </table>
			                                </td>
			                            </tr>

			                            <tr>
			                                <td valign="top" align="center">
			                                    <table width="600" cellspacing="0" cellpadding="0" border="0">
			                                        <tbody>
			                                            <tr>
			                                                <td valign="top" style="background-color:#fdfdfd;border-radius:6px!important">
			                                                    <table width="100%" cellspacing="0" cellpadding="20" border="0">
			                                                        <tbody>
			                                                            <tr>
			                                                                <td valign="top">
			                                                                    <div style="color:#737373;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
			                                         								'.$email_text.'
			                                                                    </div>
			                                                                </td>
			                                                            </tr>
			                                                        </tbody>
			                                                    </table>
			                                                </td>
			                                            </tr>
			                                        </tbody>
			                                    </table>
			                                </td>
			                            </tr>
			                        </tbody>
			                    </table>
			                </td>
			            </tr>
			        </tbody>
			    </table>
			</body>
			</html>';

			// More headers
			$headers .= 'From: '.get_option('blogname').' <"'.get_option('admin_email').'">' . "\r\n";
			wp_mail( $current_user->user_email , get_bloginfo('name').$translate->wooTranslate('info_download', get_bloginfo('language')), $message, $headers );
			echo $filedownload;
		}

		// Inform admin about bought product
		$adminEmail = $wpdb->get_row("SELECT option_value as email FROM `".$wpdb->prefix."options` WHERE option_name='mail_from'");
		$message = '
		<html>
		<head>
		<title>'.get_bloginfo('name').' - Product purchased</title>
		</head>
		<body>
		User ID: '.get_current_user_id().'<br/>
		Product: '.get_the_title($_POST['productid']).'
		</body>';
		wp_mail($adminEmail->email,get_bloginfo('name').$translate->wooTranslate('info_download', get_bloginfo('language')), $message, $headers );

	echo 1;
	} else {
		echo 0;
	}
}
?>