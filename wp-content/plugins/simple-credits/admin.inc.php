<?php
function woocommerceCredit() {
	if (isset($_GET["tab"]) && $_GET["tab"] != 1) {
		if ($_GET["tab"] == 2) {
			woocommerceCredit_users();
			return;
		} else if ($_GET["tab"] == 4) {
			woocommerceCredit_initial();
			return;
		} else {
			woocommerceCredit_products();
			return;
		}
	}

	if (isset($_POST['action']) && $_POST['action'] == 'addCredits') {
		global $wpdb;
		$user_id = $_POST["user"];
		$amount = $_POST["amount"];
		$result = $wpdb -> get_row("SELECT credit FROM `" . $wpdb -> prefix . "woocredit_users` WHERE user_id=" . $user_id);
		if ($result) {
			$amount = $result -> credit + $amount;
			$sql = 'UPDATE `' . $wpdb -> prefix . 'woocredit_users` SET `credit` = ' . $amount . ' WHERE `user_id`=' . $user_id . ';';
			$wpdb -> query($sql);
		} else {
			$sql = 'INSERT INTO `' . $wpdb -> prefix . 'woocredit_users` (user_id,credit) VALUES (' . $user_id . ',' . $amount . ');';
			$wpdb -> query($sql);
		}
		$sql = 'INSERT INTO `' . $wpdb -> prefix . 'woocredit_changes` (user_id,amount) VALUES (' . $user_id . ',' . $_POST["amount"] . ');';
		$wpdb -> query($sql);
	}

	if (isset($_POST['action']) && $_POST['action'] == 'delete') {
		global $wpdb;
		$user_id = $_POST["user"];
		$sql = 'DELETE FROM `' . $wpdb -> prefix . 'woocredit_users` WHERE `user_id`="' . $user_id . '";';
		$wpdb -> query($sql);
	}

	include_once ('admin/management.php');
}

function woocommerceCredit_initial() {

	global $translate;
	global $wpdb;
	$amount = $_POST["amount"];
	$enable = $_POST["enable"];

	$option_name = 'simple_credit_initial_amount';
	$new_value = $amount;
	if (isset($_POST['action']) && $_POST['action'] == 'set_amount') {
		if (get_option($option_name) !== false) {
			update_option($option_name, $new_value);
		} else {
			// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
			$deprecated = null;
			$autoload = 'yes';
			add_option($option_name, $new_value, $deprecated, $autoload);
		}

	}
	$option_name = 'simple_credit_initial_setup';
	$new_value = $enable;
	if (isset($_POST['action']) && $_POST['action'] == 'set_amount') {
		if (get_option($option_name) !== false) {

			// The option already exists, so we just update it.
			update_option($option_name, $new_value);

		} else {

			// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
			$deprecated = null;
			$autoload = 'yes';
			add_option($option_name, $new_value, $deprecated, $autoload);
		}

	}

	include_once ('admin/initial_setup.php');
}

function woocommerceCredit_users() {
	global $translate;
	global $wpdb;
	$user = $_POST["user"];
	$date = $_POST["date"];
	if ($user) {
		$where = ' AND cp.user_id=' . $user . ' ';
		$where2 = ' AND user_id=' . $user . ' ';
	}
	if ($date) {
		$where .= ' AND DATE(cp.date)="' . date("Y-m-d", strtotime($date)) . '" ';
		$where2 .= ' AND DATE(date)="' . date("Y-m-d", strtotime($date)) . '" ';
	}

	if ($where) {
		$sql = 'SELECT cp.user_id as user, DATE(date) as date, cp.product_id as id, p.post_title as title
		FROM `' . $wpdb -> prefix . 'woocredit_products` as cp LEFT JOIN ' . $wpdb -> prefix . 'posts  as p ON cp.product_id=p.ID
		WHERE 1 ' . $where . ' ORDER BY date DESC';
		$sql2 = 'SELECT user_id as user, amount, DATE(date) as date
		FROM `' . $wpdb -> prefix . 'woocredit_changes` WHERE 1 ' . $where2 . ' ORDER BY date DESC';
	} else {
		$sql = 'SELECT cp.user_id as user, DATE(date) as date, cp.product_id as id, p.post_title as title
		FROM `' . $wpdb -> prefix . 'woocredit_products` as cp LEFT JOIN ' . $wpdb -> prefix . 'posts  as p ON cp.product_id=p.ID ORDER BY date DESC';
		$sql2 = 'SELECT user_id as user, amount, DATE(date) as date
		FROM `' . $wpdb -> prefix . 'woocredit_changes` ORDER BY date DESC';
	}
	$result = $wpdb -> get_results($sql);
	$result2 = $wpdb -> get_results($sql2);

	wp_enqueue_script('jquery-ui-datepicker');
	include_once ('admin/users_statistics.php');
}

function woocommerceCredit_products() {
	global $translate;
	wp_enqueue_script('creditsNumeric', plugins_url('js/jquery.numeric.js', __FILE__));
	wp_enqueue_script('creditsCharts', plugins_url('js/chart.min.js', __FILE__));

	$data1 = getBoughtProducts();
	$data2 = getBoughtProducts(30);
	$lang = array("credits" => $translate -> wooTranslate('Credits amount', get_bloginfo('language')), "count" => $translate -> wooTranslate('Quantity of products sold', get_bloginfo('language')));
	$params = json_encode(array('data1' => $data1, 'data2' => $data2, 'lang' => $lang, 'siteurl' => get_site_url()));

	wp_register_script('creditsAdmin', plugins_url('js/creditsAdmin.js', __FILE__));
	wp_localize_script('creditsAdmin', 'params', $params);
	//pass any php settings to javascript
	wp_enqueue_script('creditsAdmin');
	//load the JavaScript file
	include_once ('admin/products_statistics.php');
}
?>