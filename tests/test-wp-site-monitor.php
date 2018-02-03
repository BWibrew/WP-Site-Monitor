<?php
/**
 * Class WPSiteMonitorTest
 *
 * @package WPSiteMonitor
 * @since 1.0.0
 */

use Tests\Test_Case;
use WPSiteMonitor\Settings_Menu;
use WPSiteMonitor\WP_Site_Monitor;

/**
 * WP Site Monitor test case.
 */
class WPSiteMonitor extends Test_Case {

	public function setUp() {
		parent::setUp();

		new WP_Site_Monitor();
		(new Settings_Menu)->init_settings();
	}

	/**
	 * Assert that the plugin settings are unregistered on plugin deactivation.
	 */
	public function test_settings_unregistered_when_plugin_deactivated() {
		global $wp_registered_settings;

		$this->assertArrayHasKey( self::OPTION_NAMES['enable'], $wp_registered_settings );
		$this->assertArrayHasKey( self::OPTION_NAMES['wp_version'], $wp_registered_settings );
		$this->assertArrayHasKey( self::OPTION_NAMES['plugins'], $wp_registered_settings );

		WP_Site_Monitor::deactivate();

		$this->assertArrayNotHasKey( self::OPTION_NAMES['enable'], $wp_registered_settings );
		$this->assertArrayNotHasKey( self::OPTION_NAMES['wp_version'], $wp_registered_settings );
		$this->assertArrayNotHasKey( self::OPTION_NAMES['plugins'], $wp_registered_settings );
	}

	/**
	 * Assert that the plugin settings are removed on plugin uninstall.
	 */
	public function test_settings_removed_on_plugin_uninstall() {
		global $wpdb;
		update_option( self::OPTION_NAMES['enable'], 1 );
		update_option( self::OPTION_NAMES['wp_version'], 1 );
		update_option( self::OPTION_NAMES['plugins'], 1 );

		WP_Site_Monitor::uninstall();

		$enable     = self::OPTION_NAMES['enable'];
		$wp_version = self::OPTION_NAMES['wp_version'];
		$plugins    = self::OPTION_NAMES['plugins'];

		$enable_row     = $wpdb->get_row(
			$wpdb->prepare( "SELECT autoload FROM $wpdb->options WHERE option_name = %s", $enable )
		);
		$wp_version_row = $wpdb->get_row(
			$wpdb->prepare( "SELECT autoload FROM $wpdb->options WHERE option_name = %s", $wp_version )
		);
		$plugins_row    = $wpdb->get_row(
			$wpdb->prepare( "SELECT autoload FROM $wpdb->options WHERE option_name = %s", $plugins )
		);

		$this->assertNull( $enable_row );
		$this->assertNull( $wp_version_row );
		$this->assertNull( $plugins_row );
	}
}
