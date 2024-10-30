<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webcraftplugins.com
 * @since             0.1.0
 * @package           Mapcraft
 *
 * @wordpress-plugin
 * Plugin Name:       MapCraft
 * Plugin URI:        https://mapcraftpro.com
 * Description:       Craft beautiful Google Maps for your website.
 * Version:           1.4.10
 * Author:            Webcraft Plugins Ltd.
 * Author URI:        https://webcraftplugins.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mapcraft
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.1.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MAPCRAFT_VERSION', '1.4.10' );

/**
 * Include options class
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-mapcraft-options.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mapcraft-activator.php
 */
function activate_mapcraft() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mapcraft-activator.php';
	Mapcraft_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mapcraft-deactivator.php
 */
function deactivate_mapcraft() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mapcraft-deactivator.php';
	Mapcraft_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mapcraft' );
register_deactivation_hook( __FILE__, 'deactivate_mapcraft' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mapcraft.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_mapcraft() {

	$plugin = new Mapcraft();
	$plugin->run();

}
run_mapcraft();