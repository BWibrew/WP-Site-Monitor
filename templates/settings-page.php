<?php
/**
 * HTML for the settings menu.
 *
 * @package WPSiteMonitor
 * @link https://github.com/BWibrew/WP-Site-Monitor/
 * @author Benjamin Wibrew <benjamin.wibrew@gmail.com>
 * @since 1.0.0
 */

use WPSiteMonitor\WP_Site_Monitor;

?>

<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form action="options.php" method="POST">
		<?php
		settings_fields( WP_Site_Monitor::OPTION_GROUP );
		do_settings_sections( WP_Site_Monitor::OPTION_GROUP );
		submit_button();
		?>
	</form>
</div>
