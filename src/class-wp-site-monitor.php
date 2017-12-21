<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package WPSiteMonitor
 * @link https://github.com/BWibrew/WP-Site-Monitor/
 * @author Benjamin Wibrew <benjamin.wibrew@gmail.com>
 * @since 1.0.0
 */

namespace WPSiteMonitor;

/**
 * Class WP_Site_Monitor
 *
 * @package WPSiteMonitor
 */
class WP_Site_Monitor {

	/**
	 * The loader that's responsible for registering all hooks and filters.
	 *
	 * @var Hook_Loader $loader Maintains and registers all hooks for the plugin.
	 * @since 1.0.0
	 */
	protected $loader;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialise plugin files.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		require_once WPSM_PATH . 'src/class-hook-loader.php';
		$this->loader = new Hook_Loader();

		if ( is_admin() ) {
			$this->loader->add_action( 'admin_menu', $this, 'display_settings_page' );
			$this->loader->add_action( 'admin_init', $this, 'init_settings' );
		}

		$this->loader->run();
	}

	/**
	 * Fired during plugin activation.
	 *
	 * @since 1.0.0
	 */
	public static function activate() {
	}

	/**
	 * Fired during plugin deactivation,
	 *
	 * @since 1.0.0
	 */
	public static function deactivate() {
	}

	/**
	 * Fired during plugin deletion.
	 *
	 * @since 1.0.0
	 */
	public static function uninstall() {
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
			'wp_site_monitor',
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
				settings_fields( 'wp_site_monitor_group' );
				do_settings_sections( 'wp_site_monitor' );
				submit_button( 'Save Settings' );
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Initialise plugin settings.
	 *
	 * @since 1.0.0
	 */
	public function init_settings() {
		register_setting( 'wp_site_monitor_group', 'wp_site_monitor_option', 'string' );

		add_settings_section(
			'wp_site_monitor_section_id',
			__( 'WP Site Monitor Settings', 'wp-site-monitor' ),
			array( $this, 'setting_section_html' ),
			'wp_site_monitor'
		);

		add_settings_field(
			'wp_site_monitor_option_id',
			__( 'Some Input', 'wp-site-monitor' ),
			array( $this, 'setting_input_html' ),
			'wp_site_monitor',
			'wp_site_monitor_section_id',
			[
				'label_for'         => 'wporg_field_pill',
				'class'             => 'wporg_row',
				'wporg_custom_data' => 'custom',
			]
		);
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
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'WP Site Monitor settings text', 'wp-site-monitor' ); ?></p>
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
		$options = get_option( 'wp_site_monitor' );
		?>
		<select id="<?php echo esc_attr( $args['label_for'] ); ?>"
				data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
				name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
		>
			<option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
				<?php esc_html_e( 'red pill', 'wporg' ); ?>
			</option>
			<option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
				<?php esc_html_e( 'blue pill', 'wporg' ); ?>
			</option>
		</select>
		<p class="description">
			<?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wporg' ); ?>
		</p>
		<p class="description">
			<?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wporg' ); ?>
		</p>
		<?php
	}
}
