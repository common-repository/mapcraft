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
 * Shortcode class
 *
 * @package    Mapcraft
 * @subpackage Mapcraft/includes
 * @author     Webcraft Plugins Ltd. <hello@webcraftplugins.com>
 */
class Mapcraft_Shortcode {

    public static function handle($params)
    {
        /**
         * Do nothing in the admin panel
         */
        if (is_admin()) {
            return;
        }

        $maps = (new Mapcraft_Options)->get(true);
        $key = get_option('mapcraft_key');

        $id = $params['id'];

        if (!isset($maps[$id])) {
            return;
        }

        $settings = $maps[$id];

        if ($id == 'map-3852') {
            print_r($settings);
            die();
        }

        wp_enqueue_style( 'mapcraft-frontend' );
        wp_enqueue_style( 'mapcraft' );
        

        /* [dev start]
        wp_enqueue_script( 'mapcraft-renderer' );
        wp_enqueue_script( 'mapcraft' );
		[dev end] */
		
		// /* [dist start]
		wp_enqueue_script( 'mapcraft' );
		// [dist end] */

        wp_add_inline_script( 'mapcraft', "window.MapCraftInit('" . $id . "', " . json_encode($settings, JSON_UNESCAPED_SLASHES) . ", '" . $key . "')" );

        return '<div class="map-craft" id="' . $id . '"></div>';
    }
}
