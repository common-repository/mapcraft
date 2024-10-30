<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://webcraftplugins.com
 * @since      0.1.0
 *
 * @package    Mapcraft
 * @subpackage Mapcraft/admin/partials
 */

function print_admin_page()
{

    ?>

    <div class="wrap mapcraft">
        <h1 class="wp-heading-inline">MapCraft</h1>
        <p id="cache-warning" class="notice notice-warning">We've detected that you are using <span id="cache-plugin-name"></span>. We recommend you to <a href="#" id="cache-plugin-link">clear your cache</a> after you are done editing your maps.</p>
        <hr class="wp-header-end">

        <button type="button" class="button" id="mapcraft-create">Create Map</button>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
            <tr>
                <th>ID</th>
                <th width="70%">Shortcode</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody id="mapcraft-list">
            <tr id="mapcraft-list-loading">
                <td colspan="3">Loading...</td>
            </tr>
            </tbody>

            <tfoot>
            <tr>
                <th>ID</th>
                <th width="70%">Shortcode</th>
                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
        
        <label for="input-api-key">Maps API Key: </label>
        <input type="text" placeholder="Your API Key" id="input-api-key" style="width: 200px;">
        <button type="button" class="button" id="mapcraft-set-api-key">Save</button>
        <p class="admin-info">This API key is provided for <strong>demo purposes</strong> only. <br>If you indend to use this plugin in production, please use <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">your own API key</a>.</p>
    </div>

    <div id="mapcraft-modal-wrap">
        <div id="mapcraft-modal-bg"></div>
        <div id="mapcraft-modal-body">
            <div id=app></div>
        </div>
    </div>

    <div id="mapcraft-plugins-url"></div>

    <?php

}