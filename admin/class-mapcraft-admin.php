<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://webcraftplugins.com
 * @since      0.1.0
 *
 * @package    Mapcraft
 * @subpackage Mapcraft/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mapcraft
 * @subpackage Mapcraft/admin
 * @author     Webcraft Plugins Ltd. <hello@webcraftplugins.com>
 */
class Mapcraft_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The name of the menu page
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The name of the menu page
	 */
	private $pagename;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->pagename = 'MapCraft';

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mapcraft_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mapcraft_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// Editor
		wp_enqueue_style( $this->plugin_name . '_fontawesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '_editor', plugin_dir_url( __FILE__ ) . 'css/app.css', array(), $this->version, 'all' );
		
		wp_enqueue_style( $this->plugin_name . '-bootstrap-prefix', plugin_dir_url( __FILE__ ) . 'css/mapcraft-bootstrap-prefix.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mapcraft-admin.css', array(), $this->version, 'all' );


	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts($hook) {
		if ($hook !== 'plugins_page_' . $this->pagename) return;

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mapcraft_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mapcraft_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mapcraft-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '_endpoints', plugin_dir_url( __FILE__ ) . 'js/mapcraft-admin-endpoints.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_media();

		wp_localize_script( $this->plugin_name, $this->plugin_name, array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
				
		// Editor
		wp_enqueue_script( $this->plugin_name . '_editor', plugin_dir_url( __FILE__ ) . 'js/editor/app.js', array(), $this->version, false );

	}

	/**
	 * Register the menu page.
	 *
	 * @since    0.1.0
	 */
	public function add_admin_menu() {

		add_submenu_page("plugins.php", $this->pagename, $this->pagename, "manage_options", $this->pagename, 'print_admin_page');

	}

	/**
	 * Register Gutenberg widget
	 *
	 * @since    0.1.0
	 */
	public function gutenberg_widget() {
		wp_register_script(
				$this->plugin_name,
				plugin_dir_url( __FILE__ ) . 'js/mapcraft-gutenberg.js',
				array( 'wp-blocks', 'wp-element', 'wp-components' )
		);

		register_block_type( $this->plugin_name . '/' . $this->plugin_name, array(
				'editor_script' => $this->plugin_name,
				'attributes' => array(
						'id' => array('type' => 'string')
				),
				// 'render_callback' =>
		) );
	}

	/**
	 * Respond with list of maps
	 */
	public function mapcraft_get_maps()
	{
		$data = (new Mapcraft_Options)->get();
		wp_send_json($data);
	}

	/**
	 * Delete a specific map
	 */
	public function mapcraft_delete_map()
	{
		$id = $_POST['id'];

		$optionsStorage = new Mapcraft_Options;
		$options = $optionsStorage->get();

		if (isset($options[$id])) {
				unset($options[$id]);
		}

		$optionsStorage->set($options);

		wp_send_json(array());
	}

	/**
	 * Delete a specific map
	 */
	public function mapcraft_create_map()
	{
		$optionsStorage = new Mapcraft_Options;
		$options = $optionsStorage->get();

		$ids = array_map(function($option) {
				return $option['id'];
		}, $options);

		$id = 0;

		do {
			$id = str_pad(rand(1,9999), 4, 0, STR_PAD_LEFT);
			$newId = 'map-' . $id;
		}
		while (in_array($newId, $ids));

		$options[$newId] = array( "general" => array( "name" => "Untitled " . $id) );

		$optionsStorage->set($options);

		wp_send_json(array(
				'id' => $newId
		));
	}

	/**
	 * Delete a specific map
	 */
	public function mapcraft_save_map()
	{
		$optionsStorage = new Mapcraft_Options;
		$options = $optionsStorage->get();

		$id = $_POST['id'];
		$settings = json_decode(stripslashes($_POST['settings']));

		$options[$id] = $settings;

		$optionsStorage->set($options);

		wp_send_json(array());
	}

	/**
	 * Set API Key
	 */
	public function mapcraft_set_api_key()
	{
		// $optionsStorage = new Mapcraft_Options;
		$options = get_option('mapcraft_key');

		$key = $_POST['key'];
		
		$options = $key;

		// $optionsStorage->set($options);
		update_option('mapcraft_key', $options);

		wp_send_json(array());
	}

	/**
	 * Get API Key
	 */
	public function mapcraft_get_api_key()
	{
		// $optionsStorage = new Mapcraft_Options;
		// $options = $optionsStorage->get();

		$options = get_option('mapcraft_key');

		wp_send_json(array(
			'key' => $options
		));
	}

	/**
	 * Detect caching plugins
	 */
	public function mapcraft_detect_caching_plugins() 
	{
		$plugin_name = '';
		$plugin_dashboard = '';

		if (defined('W3TC')) {
			$plugin_name = "W3 Total Cache";
			$plugin_dashboard = admin_url("admin.php?page=w3tc_dashboard");
		} else if (function_exists('wpsupercache_activate')) {
			$plugin_name = "WP Super Cache";
			$plugin_dashboard = admin_url('options-general.php?page=wpsupercache');
		} else if (class_exists('WpFastestCache')) {
			$plugin_name = "WP Fastest Cache";
			$plugin_dashboard = admin_url('admin.php?page=wpfastestcacheoptions');
		} else if (in_array('cloudflare/cloudflare.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			$plugin_name = "Cloudflare";
			$plugin_dashboard = admin_url('options-general.php?page=cloudflare#/');
		}

		wp_send_json(array(
			"name" => $plugin_name,
			"dashboard" => $plugin_dashboard
		));
	}

	/**
	 * Returns the plugins_url()
	 */

	public function mapcraft_get_plugins_url()
	{
		wp_send_json(array(
			'url' => plugins_url('mapcraft')
		));
	}
}
