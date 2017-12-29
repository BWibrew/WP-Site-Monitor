<?php
/**
 * Class SettingsMenuTest
 *
 * @package WPSiteMonitor
 * @since 1.0.0
 */

/**
 * Settings Page test case.
 */
class SettingsMenuTest extends WP_UnitTestCase {

	function setUp() {
		parent::setUp();

		wp_set_current_user( self::factory()->user->create( array( 'role' => 'administrator' ) ) );
	}

	/**
	 * Assert that the settings page is added to the settings menu successfully.
	 */
	function test_settings_page_is_added_to_settings_menu() {
		$settings_menu = new \WPSiteMonitor\Settings_Menu();
		$settings_menu->display_settings_page();

		$this->assertEquals( admin_url() . 'options-general.php?page=wp_site_monitor', menu_page_url( 'wp_site_monitor', false ) );
	}
}
