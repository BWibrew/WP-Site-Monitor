=== WP Site Monitor ===
Contributors: bwibrew
Tags: rest, api, rest-api, admin
Requires at least: 4.7
Tested up to: 4.9
Requires PHP: 5.6
License: MIT License
License URI: http://opensource.org/licenses/MIT

Provides extra WP REST API endpoints to help manage sites remotely.

== Description ==

All additional endpoints are under the `wp-site-monitor/v1` namespace.

## `/wp-version`
This endpoint returns the current version of wordpress as a string.

## `/plugins`
This endpoint will return a JSON object listing installed plugins.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/wp-site-monitor` directory, or install the plugin through the
WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Settings->WP Site Monitor screen to configure the plugin.


== Frequently Asked Questions ==

= How does authentication work with this plugin? =

Because this plugin just extends the official REST API, you can use any authentication method the REST API supports.
You may want to use a another plugin to add extra authentication methods such as
[WordPress REST API – OAuth 1.0a Server](https://wordpress.org/plugins/rest-api-oauth1/) or
[JWT Authentication for WP REST API](https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/)
