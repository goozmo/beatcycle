<?php
if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}
class Qode_Export {

	public $export_values = "";
	function Qode_Export() {
		add_action('admin_menu', array(&$this, 'qode_admin_export'));
		add_action('admin_init', array(&$this, 'register_qode_theme_settings'));
	}
	function register_qode_theme_settings() {
	    register_setting( 'qode_options_export_page', 'qode_options_export');
	}
	function init_qode_export() {
		if(isset($_REQUEST['export_option'])) {
			$export_option = $_REQUEST['export_option'];
		} else {
			$export_option="";
		}
		if($export_option == 'widgets') {
			$this->export_widgets_sidebars();
		} elseif($export_option == 'custom_sidebars') {
			$this->export_custom_sidebars();
		} elseif($export_option == 'qode_options'){
			$this->export_options();
		}elseif($export_option == 'qode_menus'){
			$this->export_qode_menus();
		}elseif($export_option == 'setting_pages'){
			$this->export_settings_pages();
		}
		
	}
	
	public function export_custom_sidebars(){
		$custom_sidebars = get_option("qode_sidebars");
		$this->export_values = base64_encode(serialize($custom_sidebars));
	}
	public function export_options(){
		$qode_options = get_option("qode_options_proya");
		$this->export_values = base64_encode(serialize($qode_options));
	}
	
	public function export_widgets_sidebars(){
		$this->data = array();
		$this->data['sidebars'] = $this->export_sidebars(); 
		$this->data['widgets'] 	= $this->export_widgets(); 
		$this->export_values = base64_encode(serialize($this->data));
	}
	public function export_widgets(){
		
		global $wp_registered_widgets;
		$all_qode_widgets = array();
		
		foreach ($wp_registered_widgets as $qode_widget_id => $widget_params) 
			$all_qode_widgets[] = $widget_params['callback'][0]->id_base; 

		foreach ($all_qode_widgets as $qode_widget_id) {
			$qode_widget_data = get_option( 'widget_' . $qode_widget_id ); 
			if ( !empty($qode_widget_data) )
				$widget_datas[ $qode_widget_id ] = $qode_widget_data;
		}
		unset($all_qode_widgets);
		return $widget_datas;
	
	}
	public function export_sidebars(){
		$qode_sidebars = get_option("sidebars_widgets");
		$qode_sidebars = $this->exclude_sidebar_keys($qode_sidebars); 
		return $qode_sidebars;
	}
	private function exclude_sidebar_keys( $keys = array() ){
		if ( ! is_array($keys) )
			return $keys;

		unset($keys['wp_inactive_widgets']);
		unset($keys['array_version']);
		return $keys;
	}
	
	public function export_qode_menus(){
		global $wpdb;
		
		$this->data = array();
		$locations = get_nav_menu_locations();

		$terms_table = $wpdb->prefix . "terms";
		foreach ((array)$locations as $location => $menu_id) {
			$menu_slug = $wpdb->get_results("SELECT * FROM $terms_table where term_id={$menu_id}", ARRAY_A);
			$this->data[ $location ] = $menu_slug[0]['slug'];
			
		}
		$this->export_values = base64_encode(serialize( $this->data ));
	}
	public function export_settings_pages(){
		$qode_static_page = get_option("page_on_front");
		$qode_post_page = get_option("page_for_posts");
		$qode_show_on_front = get_option("show_on_front");
		$qode_settings_pages = array(
			'show_on_front' => $qode_show_on_front,
			'page_on_front' => $qode_static_page,
			'page_for_posts' => $qode_post_page
		);
		$this->export_values = base64_encode(serialize($qode_settings_pages));
		
	}
	function qode_admin_export() {
		if(isset($_REQUEST['export'])){
			$this->init_qode_export();
		}
		//Add the Qode options page to the Themes' menu
		$this->pagehook = add_menu_page('Qode Theme', esc_html__('Qode Export', 'qode'), 'manage_options', 'qode_options_export_page', array(&$this, 'qode_generate_export_page'));
		add_action('load-'.$this->pagehook, array(&$this, 'on_load_page'));
	}
	

	
	function on_load_page() {
		
		// load javascripts to allow drag/drop, expand/collapse and hide/show of boxes
		add_meta_box('qode-export-options-metabox', esc_html__('Export', 'qode'), array(&$this, 'general_export_contentbox'), $this->pagehook, 'normal', 'core');
	
	}

	function qode_generate_export_page() {

		?>
		<div id="qode-metaboxes-general" class="wrap">
		    <form method="post" action="">
				<div id="poststuff" class="metabox-holder">
					<div id="post-body" class="has-sidebar">
						<div id="post-body-content" class="has-sidebar-content">
							<table class="form-table">
								<tbody>
									<tr valign="middle">
										<td scope="row" width="150"><?php esc_html_e('Export', 'qode'); ?></td>
										<td>
											<select name="export_option">
												<option value="widgets">Widgets</option>
												<option value="custom_sidebars">Custom Sidebars</option>
												<option value="qode_options">Options</option>
												<option value="qode_menus">Menus</option>
												<option value="setting_pages">Setting Pages</option>
											</select>
											<input type="submit" value="Export" name="export" />
										</td>
									</tr>
									<tr><td></td><td><?php echo $this->export_values; ?></td></tr>
								</tbody>
							</table>
						</div>
					</div>
					<br class="clear"/>
				</div>
		    </form>

		</div>

<?php	}

	/**************************************************************************************/
	/**** Below you will find the callback method for each of the registered metaboxes ****/
	/**************************************************************************************/

	function general_export_contentbox( $options ) {
	
	?>
		

		
<?php	}

}
$my_Qode_Export = new Qode_Export();


