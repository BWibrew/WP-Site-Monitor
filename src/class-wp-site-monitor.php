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
	 * Setting options group name.
	 *
	 * @var string
	 * @since 1.0.0
	 */
	const OPTION_GROUP = 'wp_site_monitor';

	/**
	 * The setting option name.
	 *
	 * @var string
	 * @since 1.0.0
	 */
	const OPTION_NAME = self::OPTION_GROUP . '_enable';

	/**
	 * Instance of Settings_Menu class.
	 *
	 * @var Settings_Menu
	 */
	public $settings_menu;

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
			$this->settings_menu = new Settings_Menu();

			$this->loader->add_action( 'admin_init', $this->settings_menu, 'init_settings' );
			$this->loader->add_action( 'admin_menu', $this->settings_menu, 'display_settings_page' );
		}

		if ( get_option( self::OPTION_NAME ) ) {
			$api = new API();

			$this->loader->add_action( 'rest_api_init', $api, 'register_routes' );
		}

		$this->loader->run();
	}

	/**
	 * Fired during plugin deactivation,
	 *
	 * @since 1.0.0
	 */
	public static function deactivate() {
		unregister_setting( 'wp_site_monitor', 'wp_site_monitor_enable' );
	}

	/**
	 * Fired during plugin deletion.
	 *
	 * @since 1.0.0
	 */
	public static function uninstall() {
		delete_option( 'wp_site_monitor_enable' );
	}
}
