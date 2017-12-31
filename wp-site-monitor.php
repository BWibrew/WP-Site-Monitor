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

if ( ! defined( 'WPSM_PATH' ) ) {
	define( 'WPSM_PATH', plugin_dir_path( WPSM_FILE ) );
}

define( 'WP_SITE_MONITOR_VERSION', '0.1.0' );

require_once WPSM_PATH . 'vendor/autoload.php';

register_deactivation_hook( WPSM_FILE, array( '\WPSiteMonitor\WP_Site_Monitor', 'deactivate' ) );
register_uninstall_hook( WPSM_FILE, array( '\WPSiteMonitor\WP_Site_Monitor', 'uninstall' ) );

new \WPSiteMonitor\WP_Site_Monitor();
