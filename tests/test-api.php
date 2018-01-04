<?php
/**
 * Class APITest
 *
 * @package WPSiteMonitor
 * @since 1.0.0
 */

use Tests\Test_Case;

/**
 * API test case.
 */
class APITest extends Test_Case {

	/**
	 * @var WP_REST_Server;
	 */
	protected $server;

	public function setUp() {
		parent::setUp();

		$this->server = rest_get_server();
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
}
