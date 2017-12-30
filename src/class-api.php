<?php
/**
 * Custom routes and endpoints for the plugin.
 *
 * @package WPSiteMonitor
 * @link https://github.com/BWibrew/WP-Site-Monitor/
 * @author Benjamin Wibrew <benjamin.wibrew@gmail.com>
 * @since 1.0.0
 */

namespace WPSiteMonitor;

use WP_REST_Controller;
use WP_REST_Server;

/**
 * Class API
 *
 * @package WPSiteMonitor
 */
class API extends WP_REST_Controller {

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		$version   = '1';
		$namespace = 'wp-site-monitor/v' . $version;
		$base      = 'wp-version';

		register_rest_route(
			$namespace, '/' . $base, array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_wp_version' ),
					'permission_callback' => array( $this, 'check_permission' ),
					'args'                => array(),
				),
			)
		);
	}
}
