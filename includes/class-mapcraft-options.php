<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://webcraftplugins.com
 * @since      0.1.0
 *
 * @package    Mapcraft
 * @subpackage Mapcraft/includes
 */

/**
 * Generic class to get and set options from a storage.
 *
 * @package    Mapcraft
 * @subpackage Mapcraft/includes
 * @author     Webcraft Plugins Ltd. <hello@webcraftplugins.com>
 */
class Mapcraft_Options {

    protected static $option_name = 'mapcraft';

    public static function set_option_name($option_name)
    {
        self::$option_name = $option_name;
    }

	/**
	 * Get option from the database.
	 *
	 * @since    0.1.0
	 */
	public function get($for_shortcode = false) {
        $options = get_option( self::$option_name );
        return $this->toArray($options, $for_shortcode);
	}

	/**
	 * Set option to the database
	 *
	 * @since    0.1.0
	 * @param    mixed              $value           The value to be stored.
	 */
	public function set( $value ) {
        update_option( self::$option_name, $this->toString($value) );
	}

    /**
     * Turn the data to string.
     *
     * @param $data
     * @return false|string
     */
    protected function toString($data) {
	    return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    /**
     * Turn the data to array.
     *
     * @param $data
     * @return array
     */
    protected function toArray($data, $for_shortcode) {
        if ($for_shortcode == true) {
            $data = str_replace('\n', '<br>', $data);
        }

        $data = str_replace('\\\\', '', $data);
        $data = json_decode($data, true);
        
	    return $data;
    }

}
