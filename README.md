# WP REST API endpoints to help manage sites remotely

[![Build Status](https://img.shields.io/travis/BWibrew/WP-Site-Monitor.svg?branch=master&style=flat-square)](https://travis-ci.org/BWibrew/WP-Site-Monitor)
[![StyleCI](https://styleci.io/repos/100482455/shield?branch=master)](https://styleci.io/repos/100482455)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/BWibrew/WP-Site-Monitor.svg?style=flat-square)](https://scrutinizer-ci.com/g/BWibrew/WP-Site-Monitor)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/BWibrew/WP-Site-Monitor.svg?style=flat-square)](https://scrutinizer-ci.com/g/BWibrew/WP-Site-Monitor)

## Additional endpoints
All additional endpoints are under the `wp-site-monitor/v1` namespace.

### `/wp-version`
This endpoint returns the current version of wordpress as a string.

### `/plugins`
This endpoint will return a JSON object listing installed plugins.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/wp-site-monitor` directory, or install the plugin through the
WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Settings->WP Site Monitor screen to configure the plugin.


## Frequently Asked Questions
### How does authentication work with this plugin?
Because this plugin just extends the official REST API, you can use any authentication method the REST API supports.
You may want to use a another plugin to add extra authentication methods such as 
[WordPress REST API – OAuth 1.0a Server](https://wordpress.org/plugins/rest-api-oauth1/) or 
[JWT Authentication for WP REST API](https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/)
