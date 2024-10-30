=== MapCraft - Google Maps Plugin ===
Contributors: webcraftplugins
Donate link: https://webcraftplugins.com
Tags: google maps, map builder, map
Requires at least: 3.0.1
Tested up to: 6.0.1
Stable tag: 1.4.10
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Free plugin to create beautiful Google Maps for your WordPress website. Features a powerful editor with great customization and 100% custom animated pins.

== Description ==

[MapCraft](https://mapcraftpro.com) is a free plugin to create beautiful Google Maps for your WordPress website. Features a powerful editor with great customization and 100% custom animated pins.

== Features ==

= Custom Made Markers =

Stunning, animated and customizable markers. As if it was made in 2021.

= Map Style Editor =

Make the map feel like it belongs in your site. Customize the colors to match your design.

= Store Locator =

Let your customers search for the most convenient location. One click away in the editor.

= Polygons, Polylines, Rectangles and Circles =

Advanced functionality like drawing custom shapes is also available for your project needs.

= Import from CSV =

It's super easy to import locations in bulk from a CSV file. The editor can even fetch coordinates, title and description!

= Map Customization = 

Full customization of the map itself, such as terrain, gesture handling and more.

= Modern Visual Editor =

MapCraft Pro has been developed with a modern front-end framework and feels/performs like a fully featured application. Try it for yourself on [our website](https://mapcraftpro.com).

= And Much More... =

Add markers in bulk, change colors and animation. Precise starting location for the map. The world (map) is at your fingertips.

Premium version is under development. All current features will remain free, forever.

== Installation ==

There are a few ways to install MapCraft™ in your WordPress website.

= From the Dashboard =

The easiest way is directly from your Dashboard.

1. From your Dashboard go to Plugins -> Add New.
2. In the search box on the right enter "MapCraft".
3. Find the plugin and click Install Now.

= From wordpress.org =

If you wish to manually install the plugin:

1. Download the plugin from this page.
2. Upload and extract the ZIP in /wp-content/plugins/ or from your Dashboard go to Plugins -> Add New -> Upload Plugin and upload the zip.

== Frequently Asked Questions ==

== Screenshots ==

1. 
2. Drawing markers, settings
3. Custom map styles
4. Drawing polygons, polylines, circles, rectangles
5. Store locator
6. Importing markers from CSV
7. Map customization

== Changelog ==

= 1.4.10 =

Bug Fixes:
* Minor bug fixes.

= 1.4.9 =

Bug Fixes:
* Fixed a bug where a map with a lot of markers could not be saved.

= 1.4.8 =

Bug Fixes:
* Minor bug fixes

= 1.4.7 =

Bug Fixes:
* Fixed a major issue where having more than 10 markers on the map triggered the Maps API limit. This only occurred if you created markers by typing an address.

= 1.4.6 =

Bug Fixes:
* Minor bug fixes

= 1.4.5 =

Bug Fixes:
* Fixed an issue where quotes we not being escaped properly when loading a map from the database

= 1.4.4 =

Bug Fixes:
* Fixed an issue where markers created by using an address would not work in the front-end

= 1.4.3 =

Bug Fixes:
* Fixed an issue where the demo API key would not work in the front-end without saving it first in the plugin admin panel

= 1.4.2 =

Bug Fixes:
* Fixed an issue where a newly created map would sometimes fail to load
* The demo API key now properly loads

= 1.4 =

Features:
* Import markers from CSV
* Minor UI improvements for the Store Locator

= 1.3 =

Features:
* Draw Rectangles
* Draw Circles
* Draw Polylines
* Draw Polygons
* Minor UI improvements

= 1.2 =

Features:
* Info Windows can now have a full-width header image
* Improved the content editing UX of the info windows. You can now edit the title and content separately, without touching HTML.

Bug Fixes:
* Fixed a few bugs related to the undo/redo functionality
* The space below the floating windows did not register mouse clicks

= 1.1 =

Features:
* Minor UI improvements
* Large internal overhaul

Bug Fixes:
* Text inputs no work on Safari

= 1.0 = 

Features:
* Added Hue and Color options in the map styles
* Improved the Save/Close UI flow
* Import/Export functionality
* Error reporting

Bug Fixes:
* Some map styles were not being imported properly
* Fixed a z-index conflict for color pickers and checkboxes

= 0.9 = 

Features:
* New skin for the editor

Bug fixes:
* Some checkboxes didn't work

= 0.8 = 

Features:
* Added autocomplete when creating a marker by address
* Added autocomplete when setting a map location
* Added an option to select a language for the map
* UTF-8 character support
* Caching plugins and Cloudflare support

Bug fixes:
* Fixed an issue where the Maps API didn't load in the editor after you open a second map
* Store Locator's UI is now responsive
* Store Locator bug fixes
* Buttons to switch to Satellite/Terrain no longer show in the frontend
* Save/Undo/Redo buttons no longer hide when sizing down the browser

= 0.7 =

* Store Locator functionality
* Autocomplete when adding a marker by address
* Minor bug fixes

= 0.6 =

* New editor for map styles
* Import map style functionality
* 10 map style presets
* Option for responsive map
* Option to specify width and height for the map
* Fullscreen map functionality

= 0.5 =
* Under the hood changes and optimizations.

= 0.4 =
Features:
* Custom markers. We no longer use the built-in markers, but a completely custom overlay. This will allow great opportunities for customization and cool stuff in the future.
* Custom info windows. Same as above!
* Added options to set a custom color for a marker.
* Added options to set background color, text color, open animation, drop shadow and vertical offset for info windows.
* Added a button to apply the styles of a marker or an info window to all markers.

Bug Fixes:
* Fixed a bug that would prevent Undo/Redo from working properly after loading a saved map.
* When placing markers the info box and the modal will no longer overlap on smaller screens.

= 0.3 =

Features:
* Added option to place a marker by entering an address.
* Added option to place a marker by entering coordinates.
* Added option to place markers in bulk using either addresses or coordinates.
* Markers can now be repositioned.

= 0.2 =

Features:
* The style of the map can now be customized. This can be done from the **Style** tab of the editor.
* Support for precise starting location and zoom of the map.
* From the **General** tab you can now set a name for the map.

Other Improvements:
* Moved the **Starting Location** setting in a new **Location** tab.
* Numerous improvements under the hood.

Bug fixes:
* Fixed many CSS conflics with Bootstrap and the WP dashboard styles
* Added FontAwesome to the editor, so icons don't appear empty.
* Other minor bug fixes

= 0.1 =

* Initial Alpha release
* Create/edit/delete multiple google maps
* Publish a map on your site
* Gutenberg support
* [Editor] Set starting location
* [Editor] Place markers on the map
* [Editor] Edit info window content
* [Editor] Enable/disable info windows
* [Editor] Undo/Redo functionality