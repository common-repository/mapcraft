<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://webcraftplugins.com
 * @since      0.1.0
 *
 * @package    Mapcraft
 * @subpackage Mapcraft/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mapcraft
 * @subpackage Mapcraft/public
 * @author     Webcraft Plugins Ltd. <hello@webcraftplugins.com>
 */
class Mapcraft_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function register_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Mapcraft_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mapcraft_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		/* [dev start]
		wp_register_style( $this->plugin_name . '-frontend', plugin_dir_url( __FILE__ ) . 'css/mapcraft.css', array(), $this->version, 'all' );
		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mapcraft-public.css', array(), $this->version, 'all' );
		[dev end] */
		
		// /* [dist start]
		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mapcraft.min.css', array(), $this->version, 'all' );
		// [dist end] */
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function register_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Mapcraft_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mapcraft_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		/* [dev start]
		wp_register_script( $this->plugin_name . '-renderer', plugin_dir_url( __FILE__ ) . 'js/mapcraft-renderer.js', array( 'jquery' ), $this->version, true );
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mapcraft-public.js', array( 'jquery' ), $this->version, true );
		[dev end] */
		
		// /* [dist start]
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mapcraft.min.js', array( 'jquery' ), $this->version, true );
		// [dist end] */
	}

}
