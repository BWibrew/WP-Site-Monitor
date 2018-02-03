<?php
/**
 * Class TestCase
 *
 * @package WPSiteMonitor
 * @since 1.0.0
 */

namespace Tests;

use WP_UnitTestCase;

/**
 * Base test case.
 */
class Test_Case extends WP_UnitTestCase {

	const OPTION_GROUP = 'wp_site_monitor';
	const API_NAMESPACE = 'wp-site-monitor/v1';
	const OPTION_NAMES = array(
		'enable'     => 'wp_site_monitor_enable',
		'wp_version' => 'wp_site_monitor_wp_version',
		'plugins'    => 'wp_site_monitor_plugins',
	);

	/**
	 * Assert that the plugin is being loaded by WordPress.
	 */
	public function test_plugin_is_loaded() {
		$this->assertTrue( defined( 'WP_SITE_MONITOR_VERSION' ) );
		$this->assertTrue( defined( 'WPINC' ) );
		$this->assertTrue( defined( 'WPSM_FILE' ) );
		$this->assertTrue( defined( 'WPSM_PATH' ) );
	}

	/**
	 * Set current WordPress user.
	 *
	 * @param string $role
	 */
	protected function log_in( $role = 'administrator' ) {
		wp_set_current_user( self::factory()->user->create( array( 'role' => $role ) ) );
	}
}
