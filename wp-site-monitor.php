<?php
/**
 * Plugin Name:  WP Site Monitor
 * Plugin URI:   https://github.com/BWibrew/WP-Site-Monitor/
 * Description:  Provides extra WP REST API endpoints to help manage sites remotely.
 * Version:      0.1.0
 * Author:       Benjamin Wibrew
 * Author URI:   https://github.com/BWibrew/
 * License:      MIT License
 * License URI:  http://opensource.org/licenses/MIT
 * Text Domain:  wp-site-monitor
 * Domain Path:  /languages
 *
 * @wordpress-plugin
 * @package WPSiteMonitor\Bootstrap
 * @link https://github.com/BWibrew/WP-Site-Monitor/
 * @since 1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'WPSM_FILE' ) ) {
	define( 'WPSM_FILE', __FILE__ );
}

/**
 * Activate WP Site Monitor plugin
 */
function activate_wp_site_monitor() {
	require_once plugin_dir_path( WPSM_FILE ) . 'src/class-activator.php';
	\WPSiteMonitor\Activator::activate();
}

/**
 * Deactivate WP Site Monitor plugin
 */
function deactivate_wp_site_monitor() {
	require_once plugin_dir_path( WPSM_FILE ) . 'src/class-deactivator.php';
	\WPSiteMonitor\Deactivator::deactivate();
}

register_activation_hook( WPSM_FILE, 'activate_wp_site_monitor' );
register_deactivation_hook( WPSM_FILE, 'deactivate_wp_site_monitor' );

require plugin_dir_path( WPSM_FILE ) . 'src/class-wp-site-monitor.php';
