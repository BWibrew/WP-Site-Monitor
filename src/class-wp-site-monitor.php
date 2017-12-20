<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package WPSiteMonitor
 * @link https://github.com/BWibrew/WP-Site-Monitor/
 * @author Benjamin Wibrew <benjamin.wibrew@gmail.com>
 * @since 1.0.0
 */

namespace WPSiteMonitor;

/**
 * Class WP_Site_Monitor
 *
 * @package WPSiteMonitor
 */
class WP_Site_Monitor {
	/**
	 * Define the core functionality of the plugin.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialise plugin files.
	 */
	public static function init() {
	}

	/**
	 * Fired during plugin activation
	 */
	public static function activate() {
	}

	/**
	 * Fired during plugin deactivation
	 */
	public static function deactivate() {
	}

	/**
	 * Fired during plugin deletion
	 */
	public static function uninstall() {
	}

	public function display_settings() {

	}
}
