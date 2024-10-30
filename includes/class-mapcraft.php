<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://webcraftplugins.com
 * @since      0.1.0
 *
 * @package    Mapcraft
 * @subpackage Mapcraft/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.1.0
 * @package    Mapcraft
 * @subpackage Mapcraft/includes
 * @author     Webcraft Plugins Ltd. <hello@webcraftplugins.com>
 */
class Mapcraft {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      Mapcraft_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		if ( defined( 'MAPCRAFT_VERSION' ) ) {
			$this->version = MAPCRAFT_VERSION;
		} else {
			$this->version = '0.1.0';
		}
		$this->plugin_name = 'mapcraft';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_shortcodes();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Mapcraft_Loader. Orchestrates the hooks of the plugin.
	 * - Mapcraft_i18n. Defines internationalization functionality.
	 * - Mapcraft_Admin. Defines all hooks for the admin area.
	 * - Mapcraft_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function load_dependencies() {

        /**
         * Set the options name for the database
         */
	    Mapcraft_Options::set_option_name($this->plugin_name);

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mapcraft-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mapcraft-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/mapcraft-admin-display.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mapcraft-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mapcraft-public.php';

		/**
		 * The class responsible for the shortcode.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mapcraft-shortcode.php';

		$this->loader = new Mapcraft_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Mapcraft_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Mapcraft_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Mapcraft_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Plugin specific hooks here
		// add_action is a loader function, not a WP API function
		// ( 'api_action_group', $Mapcraft_Admin_Class_Instance, 'mapcraft_admin_function_name' )
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_menu' );

		$this->loader->add_action( 'enqueue_block_editor_assets', $plugin_admin, 'gutenberg_widget' );

        /**
         * Ajax handlers
         */
		$this->loader->add_action( 'wp_ajax_mapcraft_get_maps', $plugin_admin, 'mapcraft_get_maps' );
		$this->loader->add_action( 'wp_ajax_mapcraft_delete_map', $plugin_admin, 'mapcraft_delete_map' );
		$this->loader->add_action( 'wp_ajax_mapcraft_create_map', $plugin_admin, 'mapcraft_create_map' );
		$this->loader->add_action( 'wp_ajax_mapcraft_save_map', $plugin_admin, 'mapcraft_save_map' );
		$this->loader->add_action( 'wp_ajax_mapcraft_set_api_key', $plugin_admin, 'mapcraft_set_api_key' );
		$this->loader->add_action( 'wp_ajax_mapcraft_get_api_key', $plugin_admin, 'mapcraft_get_api_key' );
		$this->loader->add_action( 'wp_ajax_mapcraft_detect_caching_plugins', $plugin_admin, 'mapcraft_detect_caching_plugins' );
		$this->loader->add_action( 'wp_ajax_mapcraft_get_plugins_url', $plugin_admin, 'mapcraft_get_plugins_url' );

    }

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Mapcraft_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'register_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'register_scripts' );

	}

	/**
	 * Register all of the shortcodes
	 * of the plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function define_shortcodes() {

	    $shortcode = new Mapcraft_Shortcode;
        add_shortcode('mapcraft', array($shortcode, 'handle'));

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     0.1.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.1.0
	 * @return    Mapcraft_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     0.1.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
