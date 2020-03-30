<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://maicol07.it
 * @since      1.0.0
 *
 * @package    Flarum_sso_plugin
 * @subpackage Flarum_sso_plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Flarum_sso_plugin
 * @subpackage Flarum_sso_plugin/includes
 * @author     maicol07 <maicolbattistini@live.it>
 */
class Flarum_sso_plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'flarum_sso_plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
