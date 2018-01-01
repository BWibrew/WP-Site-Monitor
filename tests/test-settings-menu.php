<?php
/**
 * Class SettingsMenuTest
 *
 * @package WPSiteMonitor
 * @since 1.0.0
 */

use Tests\Test_Case;
use WPSiteMonitor\Settings_Menu;

/**
 * Settings Page test case.
 */
class SettingsMenuTest extends Test_Case {

	protected $settings_menu;

	public function setUp() {
		parent::setUp();

		$this->settings_menu = new Settings_Menu();
		$this->log_in();
	}

	/**
	 * Assert that the settings page is added to the settings menu successfully.
	 */
	public function test_settings_page_is_added_to_settings_menu() {
		global $submenu;
		$this->settings_menu->display_settings_page();

		$this->assertEquals( admin_url() . 'options-general.php?page=' . self::OPTION_GROUP, menu_page_url( self::OPTION_GROUP, false ) );
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
		$this->assertContains(self::OPTION_NAME, $new_whitelist_options[self::OPTION_GROUP] );
		$this->assertEquals( $section_id, $wp_settings_sections[self::OPTION_GROUP][$section_id]['id'] );
		$this->assertEquals( 'Enable/Disable WP Site Monitor', $wp_settings_sections[self::OPTION_GROUP][$section_id]['title'] );
		$this->assertEquals( self::OPTION_NAME, $wp_settings_fields[self::OPTION_GROUP][$section_id][self::OPTION_NAME]['id'] );
		$this->assertEquals( 'Enable WP Site Monitor', $wp_settings_fields[self::OPTION_GROUP][$section_id][self::OPTION_NAME]['title'] );
	}
}
