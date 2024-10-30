<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://webcraftplugins.com
 * @since      0.1.0
 *
 * @package    Mapcraft
 * @subpackage Mapcraft/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      0.1.0
 * @package    Mapcraft
 * @subpackage Mapcraft/includes
 * @author     Webcraft Plugins Ltd. <hello@webcraftplugins.com>
 */
class Mapcraft_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    0.1.0
	 */
	public static function deactivate() {
        // delete_option( MAPCRAFT_CONFIG['database_option_name'] );
	}

}
