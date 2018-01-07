<?php
/**
 * HTML for the setting inputs.
 *
 * @package WPSiteMonitor
 * @link https://github.com/BWibrew/WP-Site-Monitor/
 * @author Benjamin Wibrew <benjamin.wibrew@gmail.com>
 * @since 1.0.0
 */

use WPSiteMonitor\WP_Site_Monitor;
?>
<input type="checkbox"
	id="<?php echo esc_attr( WP_Site_Monitor::OPTION_NAME ); ?>"
	name="<?php echo esc_attr( WP_Site_Monitor::OPTION_NAME ); ?>"
	<?php checked( get_option( WP_Site_Monitor::OPTION_NAME, true ), 1 ); ?> value="1">

<p class="description">
	<?php esc_html_e( 'This checkbox enables/disables all plugin functionality.', 'wp-site-monitor' ); ?>
</p>
