<?php
/**
 * Class APITest
 *
 * @package WPSiteMonitor
 * @since 1.0.0
 */

use Tests\Test_Case;
use WPSiteMonitor\API;

/**
 * API test case.
 */
class APITest extends Test_Case {

	/**
	 * @var WP_REST_Server;
	 */
	protected $server;

	protected $api;

	public function setUp() {
		parent::setUp();

		$this->server = rest_get_server();
		$this->api = new API();
	}

	/**
	 * Assert that REST API namespace for the plugin exists.
	 */
	public function test_rest_api_plugin_namespace_exists() {
		$namespaces = $this->server->get_namespaces();

		$this->assertContains( self::API_NAMESPACE, $namespaces );
	}

	/**
	 * Assert that WordPress version endpoint exists.
	 */
	public function test_wp_version_endpoint_exists() {
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
}
