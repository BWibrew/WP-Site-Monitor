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
	 * The loader that's responsible for registering all hooks and filters.
	 *
	 * @var Hook_Loader
	 * @since 1.0.0
	 */
	protected $loader;

	/**
	 * Settings page slug.
	 *
	 * @var string
	 * @since 1.0.0
	 */
	protected $settings_page;

	/**
	 * Setting options group name.
	 *
	 * @var string
	 * @since 1.0.0
	 */
	protected $option_group;

	/**
	 * Initialise the plugin settings and menus.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->settings_page = 'wp_site_monitor';
		$this->option_group  = $this->settings_page;

		require_once WPSM_PATH . 'src/class-hook-loader.php';
		$this->loader = new Hook_Loader();

		$this->loader->add_action( 'admin_init', $this, 'init_settings' );
		$this->loader->add_action( 'admin_menu', $this, 'display_settings_page' );

		$this->loader->run();
	}

	/**
	 * Initialise plugin settings.
	 *
	 * @since 1.0.0
	 */
	public function init_settings() {
		register_setting( $this->option_group, 'wp_site_monitor_test_option' );

		add_settings_section(
			'wp_site_monitor',
			__( 'Available API data', 'wp-site-monitor' ),
			array( $this, 'setting_section_html' ),
			$this->settings_page
		);

		add_settings_field(
			'wp_site_monitor_test_option',
			__( 'Test Input', 'wp-site-monitor' ),
			array( $this, 'setting_input_html' ),
			$this->settings_page,
			'wp_site_monitor',
			[
				'label_for'         => 'wporg_field_pill',
				'class'             => 'wporg_row',
				'wporg_custom_data' => 'custom',
			]
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
			$this->settings_page,
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
				settings_fields( $this->option_group );
				do_settings_sections( $this->settings_page );
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
	 * @param array $args Element parameters.
	 *
	 * @since 1.0.0
	 */
	public function setting_input_html( $args ) {
		?>
		<input type="text"
			name="wp_site_monitor_test_option"
			id="wp_site_monitor_test_option"
			value="<?php echo get_option( 'wp_site_monitor_test_option' ) ? esc_attr( get_option( 'wp_site_monitor_test_option' ) ) : ''; ?>" />

		<p class="description">
			<?php esc_html_e( 'This is a test setting', 'wp-site-monitor' ); ?>
		</p>
		<?php
	}
}
