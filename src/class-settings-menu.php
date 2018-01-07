<?php
/**
 * Register all settings and menus for the plugin.
 *
 * @package WPSiteMonitor
 * @link https://github.com/BWibrew/WP-Site-Monitor/
 * @author Benjamin Wibrew <benjamin.wibrew@gmail.com>
 * @since 1.0.0
 */

namespace WPSiteMonitor;

/**
 * Class Settings_Menu
 *
 * @package WPSiteMonitor
 */
class Settings_Menu {

	/**
	 * Initialise plugin settings.
	 *
	 * @since 1.0.0
	 */
	public function init_settings() {
		register_setting( WP_Site_Monitor::OPTION_GROUP, WP_Site_Monitor::OPTION_NAME );

		add_settings_section(
			WP_Site_Monitor::OPTION_NAME . '_section',
			__( 'Enable/Disable WP Site Monitor', 'wp-site-monitor' ),
			array( $this, 'setting_section_html' ),
			WP_Site_Monitor::OPTION_GROUP
		);

		add_settings_field(
			WP_Site_Monitor::OPTION_NAME,
			__( 'Enable WP Site Monitor', 'wp-site-monitor' ),
			array( $this, 'setting_input_html' ),
			WP_Site_Monitor::OPTION_GROUP,
			WP_Site_Monitor::OPTION_NAME . '_section'
		);
	}

	/**
	 * Display the admin settings page.
	 *
	 * @since 1.0.0
	 */
	public function display_settings_page() {
		add_options_page(
			__( 'WP Site Monitor Settings', 'wp-site-monitor' ),
			__( 'WP Site Monitor', 'wp-site-monitor' ),
			'manage_options',
			WP_Site_Monitor::OPTION_GROUP,
			array( $this, 'settings_page_html' )
		);
	}

	/**
	 * Settings page template.
	 *
	 * @since 1.0.0
	 */
	public function settings_page_html() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
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
		<?php
	}

	/**
	 * Form text.
	 *
	 * @param array $args Arguments passed into add_settings_section.
	 *
	 * @since 1.0.0
	 */
	public function setting_section_html( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Use these options to control which extra data is available over the REST API.', 'wp-site-monitor' ); ?></p>
		<?php
	}

	/**
	 * Form inputs.
	 *
	 * @since 1.0.0
	 */
	public function setting_input_html() {
		?>
		<input type="checkbox"
			id="<?php echo esc_attr( WP_Site_Monitor::OPTION_NAME ); ?>"
			name="<?php echo esc_attr( WP_Site_Monitor::OPTION_NAME ); ?>"
			<?php checked( get_option( WP_Site_Monitor::OPTION_NAME, true ), 1 ); ?> value="1">

		<p class="description">
			<?php esc_html_e( 'This checkbox enables/disables all plugin functionality.', 'wp-site-monitor' ); ?>
		</p>
		<?php
	}
}
