<?php
/**
 * Register all settings and menus for the plugin.
 *
 * @package WPSiteMonitor
 * @link https://github.com/BWibrew/WP-Site-Monitor/
 * @author Benjamin Wibrew <benjamin.wibrew@gmail.com>
 * @since 1.0.0
 */

namespace WPSiteMonitor;

/**
 * Class Settings_Menu
 *
 * @package WPSiteMonitor
 */
class Settings_Menu {

	/**
	 * Initialise plugin settings.
	 *
	 * @since 1.0.0
	 */
	public function init_settings() {
		register_setting( WP_Site_Monitor::OPTION_GROUP, WP_Site_Monitor::OPTION_NAMES['enable'] );
		register_setting( WP_Site_Monitor::OPTION_GROUP, WP_Site_Monitor::OPTION_NAMES['wp_version'] );
		register_setting( WP_Site_Monitor::OPTION_GROUP, WP_Site_Monitor::OPTION_NAMES['plugins'] );

		add_settings_section(
			WP_Site_Monitor::OPTION_NAMES['enable'] . '_section',
			__( 'Enable/Disable WP Site Monitor', 'wp-site-monitor' ),
			array( $this, 'setting_section_enable_html' ),
			WP_Site_Monitor::OPTION_GROUP
		);

		add_settings_section(
			WP_Site_Monitor::OPTION_GROUP . '_endpoints_section',
			__( 'API endpoints', 'wp-site-monitor' ),
			array( $this, 'setting_section_endpoints_html' ),
			WP_Site_Monitor::OPTION_GROUP
		);

		add_settings_field(
			WP_Site_Monitor::OPTION_NAMES['enable'],
			__( 'Enable WP Site Monitor', 'wp-site-monitor' ),
			array( $this, 'setting_enable_input_html' ),
			WP_Site_Monitor::OPTION_GROUP,
			WP_Site_Monitor::OPTION_NAMES['enable'] . '_section'
		);

		add_settings_field(
			WP_Site_Monitor::OPTION_NAMES['wp_version'],
			__( 'Enable wp_version endpoint', 'wp-site-monitor' ),
			array( $this, 'setting_wp_version_input_html' ),
			WP_Site_Monitor::OPTION_GROUP,
			WP_Site_Monitor::OPTION_GROUP . '_endpoints_section'
		);

		add_settings_field(
			WP_Site_Monitor::OPTION_NAMES['plugins'],
			__( 'Enable plugins endpoint', 'wp-site-monitor' ),
			array( $this, 'setting_plugins_input_html' ),
			WP_Site_Monitor::OPTION_GROUP,
			WP_Site_Monitor::OPTION_GROUP . '_endpoints_section'
		);
	}

	/**
	 * Display the admin settings page.
	 *
	 * @since 1.0.0
	 */
	public function display_settings_page() {
		add_options_page(
			__( 'WP Site Monitor Settings', 'wp-site-monitor' ),
			__( 'WP Site Monitor', 'wp-site-monitor' ),
			'manage_options',
			WP_Site_Monitor::OPTION_GROUP,
			array( $this, 'settings_page_html' )
		);
	}

	/**
	 * Settings page template.
	 *
	 * @since 1.0.0
	 */
	public function settings_page_html() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		require_once WPSM_PATH . 'templates/settings-page.php';
	}

	/**
	 * Enable setting form text.
	 *
	 * @param array $args Arguments passed into add_settings_section.
	 *
	 * @since 1.0.0
	 */
	public function setting_section_enable_html( $args ) {
		require_once WPSM_PATH . 'templates/setting-section-enable.php';
	}

	/**
	 * Endpoints setting form text.
	 *
	 * @param array $args Arguments passed into add_settings_section.
	 *
	 * @since 1.0.0
	 */
	public function setting_section_endpoints_html( $args ) {
		require_once WPSM_PATH . 'templates/setting-section-endpoints.php';
	}

	/**
	 * Enable setting form input.
	 *
	 * @since 1.0.0
	 */
	public function setting_enable_input_html() {
		require_once WPSM_PATH . 'templates/setting-input-enable.php';
	}

	/**
	 * WP_version setting form input.
	 *
	 * @since 1.0.0
	 */
	public function setting_wp_version_input_html() {
		require_once WPSM_PATH . 'templates/setting-input-wp-version.php';
	}

	/**
	 * Plugins setting form input.
	 *
	 * @since 1.0.0
	 */
	public function setting_plugins_input_html() {
		require_once WPSM_PATH . 'templates/setting-input-plugins.php';
	}
}
