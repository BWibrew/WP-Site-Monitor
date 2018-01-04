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
	 *
	 * @since 1.0.0
	 */
	public function register_routes() {
		$version   = '1';
		$namespace = 'wp-site-monitor/v' . $version;
		$endpoint  = 'wp-version';

		register_rest_route(
			$namespace, '/' . $endpoint, array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_wp_version' ),
					'permission_callback' => array( $this, 'check_permissions' ),
				),
			)
		);
	}

	/**
	 * Get the current WordPress version number.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_wp_version() {
		global $wp_version;

		return $wp_version;
	}

	/**
	 * Check if the authenticated user has permission to use an endpoint.
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function check_permissions() {
		return current_user_can( 'manage_options' );
	}
}
