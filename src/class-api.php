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
	 * API namespace.
	 *
	 * @var string
	 * @since 1.0.0
	 */
	protected $namespace = 'wp-site-monitor/v1';

	/**
	 * Register the routes for the objects of the controller.
	 *
	 * @since 1.0.0
	 */
	public function register_routes() {
		if ( get_option( WP_Site_Monitor::OPTION_NAMES['wp_version'], true ) ) {
			register_rest_route(
				$this->namespace, '/wp-version', array(
					array(
						'methods'             => WP_REST_Server::READABLE,
						'callback'            => array( $this, 'get_wp_version' ),
						'permission_callback' => array( $this, 'check_permissions' ),
					),
				)
			);
		}

		if ( get_option( WP_Site_Monitor::OPTION_NAMES['plugins'], true ) ) {
			register_rest_route(
				$this->namespace, '/plugins', array(
					array(
						'methods'             => WP_REST_Server::READABLE,
						'callback'            => array( $this, 'get_plugins' ),
						'permission_callback' => array( $this, 'check_permissions' ),
					),
				)
			);
		}
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
	 * Get the currently installed plugins.
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function get_plugins() {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$plugins        = get_plugins();
		$active_plugins = get_option( 'active_plugins' );

		foreach ( $plugins as $name => &$data ) {
			$data['Active'] = in_array( $name, $active_plugins, true ) ? true : false;
		}

		return $plugins;
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
