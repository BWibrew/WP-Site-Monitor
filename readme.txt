=== WP Site Monitor ===
Contributors: bwibrew
Tags: rest, api, rest-api, admin, remote administration
Requires at least: 4.7
Tested up to: 4.9
Requires PHP: 5.6
Stable tag: 1.0.0
License: MIT License
License URI: http://opensource.org/licenses/MIT

Extends official WP REST API to provide extra endpoints to help manage sites remotely.

== Description ==

### WP REST API endpoints to help manage sites remotely

All additional endpoints are under the `wp-site-monitor/v1/` namespace.
e.g. `https://example.com/wp-json/wp-site-monitor/v1/wp-version`

#### Additional endpoints
- `wp-version` returns the current version of wordpress as a string.

  Example output: `"4.9.2"`
- `plugins` returns a JSON object listing installed plugins with the plugin details.

  Example output:
  ```json
  {
      "wp-super-cache/wp-cache.php": {
          "Name": "WP Super Cache",
          "PluginURI": "https://wordpress.org/plugins/wp-super-cache/",
          "Version": "1.5.9",
          "Description": "Very fast caching plugin for WordPress.",
          "Author": "Automattic",
          "AuthorURI": "https://automattic.com/",
          "TextDomain": "wp-super-cache",
          "DomainPath": "",
          "Network": false,
          "Title": "WP Super Cache",
          "AuthorName": "Automattic",
          "Active": true
      },
      "wordpress-seo/wp-seo.php": {
          "Name": "Yoast SEO",
          "PluginURI": "https://yoa.st/1uj",
          "Version": "6.1.1",
          "Description": "The first true all-in-one SEO solution for WordPress, including on-page content analysis, XML sitemaps and much more.",
          "Author": "Team Yoast",
          "AuthorURI": "https://yoa.st/1uk",
          "TextDomain": "wordpress-seo",
          "DomainPath": "/languages/",
          "Network": false,
          "Title": "Yoast SEO",
          "AuthorName": "Team Yoast",
          "Active": true
      }
  }
  ```

Options are provided in the WP Site Monitor settings menu to toggle individual endpoints.

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
