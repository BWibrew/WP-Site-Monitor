<?php
/**
 * Class APITest
 *
 * @package WPSiteMonitor
 * @since 1.0.0
 */

use WPSiteMonitor\API;

/**
 * API test case.
 */
class APITest extends WP_UnitTestCase {

	protected $api;
	protected $server;

	public function setUp() {
		parent::setUp();

		$this->api = new API();
		$this->server = rest_get_server();
	}

	/**
	 * Assert that REST API route for the plugin exist.
	 */
	public function test_rest_api_plugin_route_exists() {
		$routes = $this->server->get_routes();
		$this->assertArrayHasKey( '/wp-site-monitor/v1', $routes );
	}
}
