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

require_once WPSM_PATH . 'src/class-hook-loader.php';
require_once WPSM_PATH . 'src/class-settings-menu.php';

/**
 * Class WP_Site_Monitor
 *
 * @package WPSiteMonitor
 */
class WP_Site_Monitor {

	/**
	 * The loader that's responsible for registering all hooks and filters.
	 *
	 * @var Hook_Loader $loader Maintains and registers all hooks for the plugin.
	 * @since 1.0.0
	 */
	protected $loader;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->loader = new Hook_Loader();

		$this->init();
	}

	/**
	 * Initialise plugin files.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		if ( is_admin() ) {
			new Settings_Menu();
		}

		$this->loader->run();
	}

	/**
	 * Fired during plugin activation.
	 *
	 * @since 1.0.0
	 */
	public static function activate() {
	}

	/**
	 * Fired during plugin deactivation,
	 *
	 * @since 1.0.0
	 */
	public static function deactivate() {
	}

	/**
	 * Fired during plugin deletion.
	 *
	 * @since 1.0.0
	 */
	public static function uninstall() {
	}
}
