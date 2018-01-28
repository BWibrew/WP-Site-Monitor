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

		add_settings_section(
			WP_Site_Monitor::OPTION_NAMES['enable'] . '_section',
			__( 'Enable/Disable WP Site Monitor', 'wp-site-monitor' ),
			array( $this, 'setting_section_html' ),
			WP_Site_Monitor::OPTION_GROUP
		);

		add_settings_field(
			WP_Site_Monitor::OPTION_NAMES['enable'],
			__( 'Enable WP Site Monitor', 'wp-site-monitor' ),
			array( $this, 'setting_input_html' ),
			WP_Site_Monitor::OPTION_GROUP,
			WP_Site_Monitor::OPTION_NAMES['enable'] . '_section'
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
	 * Form text.
	 *
	 * @param array $args Arguments passed into add_settings_section.
	 *
	 * @since 1.0.0
	 */
	public function setting_section_html( $args ) {
		require_once WPSM_PATH . 'templates/setting-section.php';
	}

	/**
	 * Form inputs.
	 *
	 * @since 1.0.0
	 */
	public function setting_input_html() {
		require_once WPSM_PATH . 'templates/setting-input.php';
	}
}
