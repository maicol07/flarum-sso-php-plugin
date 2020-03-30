<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://maicol07.it
 * @since             1.0.0
 * @package           Flarum_sso_plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Flarum SSO plugin
 * Plugin URI:        https://github.com/maicol07/flarum-sso-plugin
 * Description:       Plugin for your PHP website to get the SSO extension working
 * Version:           1.0.0
 * Author:            maicol07
 * Author URI:        https://maicol07.it
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       flarum_sso_plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'FLARUM_SSO_PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 */
function activate_flarum_sso_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flarum_sso_plugin-activator.php';
	Flarum_sso_plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_flarum_sso_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flarum_sso_plugin-deactivator.php';
	Flarum_sso_plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_flarum_sso_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_flarum_sso_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-flarum_sso_plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_flarum_sso_plugin() {
	$plugin = new Flarum_sso_plugin();
	$plugin->run();
}

run_flarum_sso_plugin();

/**
 * Adds settings and donate links to plugins page
 *
 * @param $links
 *
 * @return mixed
 */
function flarum_sso_plugin_add_links_to_admin_plugins_page( $links ) {
	$donate_url  = esc_url( 'https://www.paypal.me/maicol072001/10eur' );
	$donate_link = '<a href="' . $donate_url . '">' . __( "Donate", 'flarum_sso_plugin' ) . '</a>'; //DONATE

	// Prepend donate link to links array
	array_unshift( $links, $donate_link );

	$url           = esc_url( get_admin_url() . 'options-general.php?page=flarum_sso_plugin' );
	$settings_link = '<a href="' . $url . '">' . __( "Settings", 'flarum_sso_plugin' ) . '</a>';

	// Prepend settings link to links array
	array_unshift( $links, $settings_link );

	return $links;
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'flarum_sso_plugin_add_links_to_admin_plugins_page' );

/**
 * Adds settings and donate links to plugin meta data in plugins page
 *
 * @param $links
 * @param $file
 *
 * @return array
 */
function flarum_sso_plugin_add_meta_to_admin_plugins_page( $links, $file ) {
	if ( strpos( $file, plugin_basename( __FILE__ ) ) !== false ) {
		$donate_url = esc_url('https://www.paypal.me/maicol072001/10eur');

		$url = esc_url(get_admin_url() . 'options-general.php?page=flarum_sso_plugin');

		$review_url = esc_url("https://wordpress.org/support/plugin/flarum_sso_plugin/reviews/#new-post");
		$new_links  = [
			'<a href="' . $url . '"><span class="dashicons dashicons-admin-generic"></span> ' . __("Settings", 'flarum_sso_plugin') . '</a>',
			'<a href="' . $review_url . '"><span class="dashicons dashicons-star-filled"></span> ' . __("Leave a review", 'flarum_sso_plugin') . '</a>',
			'<a href="' . $donate_url . '"><span class="dashicons dashicons-heart"></span> ' . __("Donate", 'flarum_sso_plugin') . '</a>'
		];
		// Add new links to existing links
		$links = array_merge( $links, $new_links );
	}
	return $links;
}

add_filter( 'plugin_row_meta', 'flarum_sso_plugin_add_meta_to_admin_plugins_page', 10, 2 );

/*
 * SSO
 */
require_once plugin_dir_path( __FILE__ ) . "/vendor/autoload.php";

use Maicol07\SSO\Flarum;

if ( get_option( 'flarum_sso_plugin_active' ) ) {
	$flarum = new Flarum(
		get_option( 'flarum_sso_plugin_flarum_url' ),
		get_option( 'flarum_sso_plugin_root_domain' ),
		get_option( 'flarum_sso_plugin_api_key' ),
		get_option( 'flarum_sso_plugin_password_token' ),
		get_option( 'flarum_sso_plugin_lifetime', 14 )
	);

	/**
	 * Redirect user to Flarum
	 *
	 * @param $redirect_to
	 * @param $request
	 * @param $user
	 *
	 * @return string
	 */
	function flarum_sso_login_redirect( $redirect_to, $request, $user ) {
		global $flarum;

		if ( $redirect_to === 'forum' && $user instanceof WP_User ) {
			$flarum->redirectToForum();
		}

		return $redirect_to;
	}

	add_filter( 'login_redirect', 'flarum_sso_login_redirect', 10, 3 );

	/**
	 * Login to flarum
	 *
	 * @param $user_login
	 * @param $user
	 */
	function flarum_sso_login( $user_login, $user ) {
		global $flarum;

		$flarum->login( $user->user_login, $user->user_email );
	}

	add_action( 'wp_login', 'flarum_sso_login', 10, 2 );

	/**
	 * Logout from Flarum
	 */
	function flarum_sso_logout() {
		global $flarum;

		$flarum->logout();
	}

	add_action( 'wp_logout', 'flarum_sso_logout' );
}
