<?php
/**
 * Class SettingsMenuTest
 *
 * @package WPSiteMonitor
 * @since 1.0.0
 */

use WPSiteMonitor\Settings_Menu;

/**
 * Settings Page test case.
 */
class SettingsMenuTest extends WP_UnitTestCase {

	const OPTION_NAME = 'wp_site_monitor_enable';

	protected $settings_menu;
	protected $menu_slug;

	public function setUp() {
		parent::setUp();

		$this->settings_menu = new Settings_Menu();
		$this->menu_slug = 'wp_site_monitor';
		wp_set_current_user( self::factory()->user->create( array( 'role' => 'administrator' ) ) );
	}

	/**
	 * Assert that the settings page is added to the settings menu successfully.
	 */
	public function test_settings_page_is_added_to_settings_menu() {
		global $submenu;
		$this->settings_menu->display_settings_page();

		$this->assertEquals( admin_url() . 'options-general.php?page=' . $this->menu_slug, menu_page_url( $this->menu_slug, false ) );
		$this->assertEquals( 'WP Site Monitor Settings', $submenu['options-general.php'][0][3] );
		$this->assertEquals( 'WP Site Monitor', $submenu['options-general.php'][0][0] );
	}

	/**
	 * Assert that the enable/disable toggle is registered with the settings API.
	 */
	public function test_enable_option_is_created() {
		global $new_whitelist_options, $wp_settings_sections, $wp_settings_fields;
		$this->settings_menu->init_settings();

		$section_id = self::OPTION_NAME . '_section';
		$this->assertContains(self::OPTION_NAME, $new_whitelist_options[$this->menu_slug] );
		$this->assertEquals( $section_id, $wp_settings_sections[$this->menu_slug][$section_id]['id'] );
		$this->assertEquals( 'Enable/Disable WP Site Monitor', $wp_settings_sections[$this->menu_slug][$section_id]['title'] );
		$this->assertEquals( self::OPTION_NAME, $wp_settings_fields[$this->menu_slug][$section_id][self::OPTION_NAME]['id'] );
		$this->assertEquals( 'Enable WP Site Monitor', $wp_settings_fields[$this->menu_slug][$section_id][self::OPTION_NAME]['title'] );
	}
}
