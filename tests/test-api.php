<?php
/**
 * Class APITest
 *
 * @package WPSiteMonitor
 * @since 1.0.0
 */

use Tests\Test_Case;
use WPSiteMonitor\API;
use WPSiteMonitor\WP_Site_Monitor;

/**
 * API test case.
 */
class APITest extends Test_Case {

	/**
	 * @var WP_REST_Server
	 */
	protected $server;

	/**
	 * @var API
	 */
	protected $api;

	public function setUp() {
		parent::setUp();

		$this->api = new API();

		// Reset REST server to ensure only our routes are registered
		$GLOBALS['wp_rest_server'] = null;
		add_filter( 'wp_rest_server_class', array( $this, 'filter_wp_rest_server_class' ) );
		$this->server = rest_get_server();
		remove_filter( 'wp_rest_server_class', array( $this, 'filter_wp_rest_server_class' ) );
	}

	function tearDown() {
		// Remove our temporary spy server
		$GLOBALS['wp_rest_server'] = null;
		unset( $_REQUEST['_wpnonce'] );

		parent::tearDown();
	}

	/**
	 * Assert that the register_routes method is registered to the rest_api_init hook when API is enabled.
	 */
	public function test_register_routes_is_registered_to_rest_api_init_hook() {
		update_option( self::OPTION_NAME, true );

		$plugin = new WP_Site_Monitor();

		$this->assertNotFalse( has_action( 'rest_api_init', array( $plugin->api, 'register_routes' ) ) );
	}

	/**
	 * Assert that the register_routes method is not registered to the rest_api_init hook when API is disabled.
	 */
	public function test_register_routes_is_not_registered_to_rest_api_init_hook_when_api_disabled() {
		update_option( self::OPTION_NAME, false );

		$plugin = new WP_Site_Monitor();

		$this->assertFalse( has_action( 'rest_api_init', array( $plugin->api, 'register_routes' ) ) );
	}

	/**
	 * Assert that REST API namespace for the plugin exists.
	 */
	public function test_rest_api_plugin_namespace_exists() {
		$this->api->register_routes();

		$namespaces = $this->server->get_namespaces();

		$this->assertContains( self::API_NAMESPACE, $namespaces );
	}

	/**
	 * Assert that WordPress version endpoint exists.
	 */
	public function test_wp_version_endpoint_exists() {
		$this->api->register_routes();

		$routes = $this->server->get_routes();

		$this->assertArrayHasKey( '/' . self::API_NAMESPACE . '/wp-version', $routes );
	}

	/**
	 * Assert that 'wp-version' endpoint returns the version number.
	 */
	public function test_wp_version_is_returned() {
		global $wp_version;
		$returned_version = $this->api->get_wp_version();

		$this->assertEquals( $wp_version, $returned_version );
	}

	/**
	 * Assert that 'wp-version' endpoint requires authentication.
	 */
	public function test_wp_version_requires_authentication() {
		$this->assertFalse( $this->api->check_permissions() );
	}

	/**
	 * Mock REST Server class name.
	 *
	 * @return string
	 */
	public function filter_wp_rest_server_class() {
		return 'Spy_REST_Server';
	}
}
