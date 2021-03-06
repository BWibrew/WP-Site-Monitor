<?php
/**
 * Class SettingsMenuTest
 *
 * @package WPSiteMonitor
 * @since 1.0.0
 */

use Tests\Test_Case;
use WPSiteMonitor\Settings_Menu;
use WPSiteMonitor\WP_Site_Monitor;

/**
 * Settings Page test case.
 */
class SettingsMenuTest extends Test_Case {

	/**
	 * @var Settings_Menu
	 */
	protected $settings_menu;

	public function setUp() {
		parent::setUp();

		$this->settings_menu = new Settings_Menu();
		$this->settings_menu->init_settings();
		$this->log_in();
	}

	/**
	 * Assert that the init_settings method is registered to the admin_init hook.
	 */
	public function test_init_settings_is_registered_to_admin_init_hook() {
		// Make sure is_admin() returns true.
		set_current_screen('index.php');

		$plugin = new WP_Site_Monitor();

		$this->assertNotFalse( has_action( 'admin_init', array( $plugin->settings_menu, 'init_settings' ) ) );
	}

	/**
	 * Assert that the display_settings_page method is registered to the admin_menu hook.
	 */
	public function test_display_settings_page_is_registered_to_admin_menu_hook() {
		// Make sure is_admin() returns true.
		set_current_screen('index.php');

		$plugin = new WP_Site_Monitor();

		$this->assertNotFalse( has_action( 'admin_menu', array( $plugin->settings_menu, 'display_settings_page' ) ) );
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
	 * Assert that the settings menu HTML template is included.
	 */
	public function test_settings_menu_template_is_included() {
		// Hide template output
		$this->setOutputCallback(function() {});

		$this->settings_menu->settings_page_html();

		$included_files = get_included_files();
		$this->assertContains( WPSM_PATH . 'templates/settings-page.php', $included_files );
	}

	/**
	 * Assert that the enable setting section HTML template is included.
	 */
	public function test_enable_setting_section_template_is_included() {
		// Hide template output
		$this->setOutputCallback(function() {});

		$this->settings_menu->settings_page_html();
		$this->settings_menu->setting_section_enable_html( array() );

		$included_files = get_included_files();
		$this->assertContains( WPSM_PATH . 'templates/setting-section-enable.php', $included_files );
	}

	/**
	 * Assert that the endpoints setting section HTML template is included.
	 */
	public function test_endpoints_setting_section_template_is_included() {
		// Hide template output
		$this->setOutputCallback(function() {});

		$this->settings_menu->settings_page_html();
		$this->settings_menu->setting_section_endpoints_html( array() );

		$included_files = get_included_files();
		$this->assertContains( WPSM_PATH . 'templates/setting-section-endpoints.php', $included_files );
	}

	/**
	 * Assert that the enable setting input HTML template is included.
	 */
	public function test_enable_setting_input_template_is_included() {
		// Hide template output
		$this->setOutputCallback(function() {});

		$this->settings_menu->setting_enable_input_html();

		$included_files = get_included_files();
		$this->assertContains( WPSM_PATH . 'templates/setting-input-enable.php', $included_files );
	}

	/**
	 * Assert that the wp_version setting input HTML template is included.
	 */
	public function test_wp_version_setting_input_template_is_included() {
		// Hide template output
		$this->setOutputCallback(function() {});

		$this->settings_menu->setting_wp_version_input_html();

		$included_files = get_included_files();
		$this->assertContains( WPSM_PATH . 'templates/setting-input-wp-version.php', $included_files );
	}

	/**
	 * Assert that the plugins setting input HTML template is included.
	 */
	public function test_plugins_setting_input_template_is_included() {
		// Hide template output
		$this->setOutputCallback(function() {});

		$this->settings_menu->setting_plugins_input_html();

		$included_files = get_included_files();
		$this->assertContains( WPSM_PATH . 'templates/setting-input-plugins.php', $included_files );
	}

	/**
	 * Assert that the enable/disable toggle is registered with the settings API.
	 */
	public function test_enable_option_is_created() {
		global $new_whitelist_options, $wp_settings_sections, $wp_settings_fields;

		$section_id = self::OPTION_NAMES['enable'] . '_section';
		$this->assertContains( self::OPTION_NAMES['enable'], $new_whitelist_options[self::OPTION_GROUP] );
		$this->assertEquals( $section_id, $wp_settings_sections[self::OPTION_GROUP][$section_id]['id'] );
		$this->assertEquals( 'Enable/Disable WP Site Monitor', $wp_settings_sections[self::OPTION_GROUP][$section_id]['title'] );
		$this->assertEquals( self::OPTION_NAMES['enable'], $wp_settings_fields[self::OPTION_GROUP][$section_id][self::OPTION_NAMES['enable']]['id'] );
		$this->assertEquals( 'Enable WP Site Monitor', $wp_settings_fields[self::OPTION_GROUP][$section_id][self::OPTION_NAMES['enable']]['title'] );
	}

	/**
	 * Assert that wp_version option is registered with the settings API.
	 */
	public function test_wp_version_option_is_created() {
		global $new_whitelist_options, $wp_settings_sections, $wp_settings_fields;

		$section_id = self::OPTION_GROUP . '_endpoints_section';
		$this->assertContains( self::OPTION_NAMES['wp_version'], $new_whitelist_options[self::OPTION_GROUP] );
		$this->assertEquals( $section_id, $wp_settings_sections[self::OPTION_GROUP][$section_id]['id'] );
		$this->assertEquals( 'API endpoints', $wp_settings_sections[self::OPTION_GROUP][$section_id]['title'] );
		$this->assertEquals( self::OPTION_NAMES['wp_version'], $wp_settings_fields[self::OPTION_GROUP][$section_id][self::OPTION_NAMES['wp_version']]['id'] );
		$this->assertEquals( 'Enable wp_version endpoint', $wp_settings_fields[self::OPTION_GROUP][$section_id][self::OPTION_NAMES['wp_version']]['title'] );
	}

	/**
	 * Assert that plugins option is registered with the settings API.
	 */
	public function test_plugins_option_is_created() {
		global $new_whitelist_options, $wp_settings_sections, $wp_settings_fields;

		$section_id = self::OPTION_GROUP . '_endpoints_section';
		$this->assertContains( self::OPTION_NAMES['plugins'], $new_whitelist_options[self::OPTION_GROUP] );
		$this->assertEquals( $section_id, $wp_settings_sections[self::OPTION_GROUP][$section_id]['id'] );
		$this->assertEquals( 'API endpoints', $wp_settings_sections[self::OPTION_GROUP][$section_id]['title'] );
		$this->assertEquals( self::OPTION_NAMES['plugins'], $wp_settings_fields[self::OPTION_GROUP][$section_id][self::OPTION_NAMES['plugins']]['id'] );
		$this->assertEquals( 'Enable plugins endpoint', $wp_settings_fields[self::OPTION_GROUP][$section_id][self::OPTION_NAMES['plugins']]['title'] );
	}
}
