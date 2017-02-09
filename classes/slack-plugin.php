<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Main plugin class.
 *
 * @package   Slack Notifications
 * @since     1.1.0
 * @version   1.1.0
 * @author    Dor Zuberi <me@dorzki.co.il>
 * @link      https://www.dorzki.co.il
 */
if ( ! class_exists( 'SlackPlugin' ) ) {

	/**
	 * Class SlackPlugin
	 *
	 * @since   1.1.0
	 * @version 1.1.0
	 */
	class SlackPlugin {

		/**
		 * Plugin instance handler.
		 *
		 * @since 1.1.0
		 * @var object
		 */
		protected static $instance = null;


		/**
		 * Plugin's unique namespace.
		 *
		 * @since 1.1.0
		 * @var string
		 */
		protected static $namespace = 'dorzki_slack';


		/**
		 * SlackPlugin constructor.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		function __construct() {

			add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
			add_action( 'admin_menu', [ $this, 'register_admin_page' ] );

		}


		/**
		 * Returns the plugin instance.
		 * Enables singleton mode.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 * @return object
		 */
		public static function get_instance() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new self;
			}

			return self::$instance;

		}


		/**
		 * Enable plugin i18n & l10n.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		public function load_textdomain() {

			load_plugin_textdomain( 'dorzki-notifications-to-slack' );

		}


		/**
		 * Adds new admin page for the plugin under options menu.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		public function register_admin_page() {

			add_options_page( __( 'Slack Notifications', 'dorzki-notifications-to-slack' ), __( 'Slack Notifications', 'dorzki-notifications-to-slack' ), 'manage_options', $this::$namespace, [
				$this,
				'admin_page_template'
			] );

		}


		/**
		 * Displays the plugin's settings page.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		public function admin_page_template() {

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'Oops... It\'s seems like you don\'t meet the required level of permissions', 'dorzki-notifications-to-slack' ) );
			}

			include_once( DS_PLUGIN_ROOT_DIR . DS_TEMPLATES_DIR . 'admin-settings.php' );

		}


		/**
		 * Register the plugin's css & js files.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		public function register_plugin_assets() {

			wp_register_script( 'dorzki-slack-scripts', PLUGIN_ROOT_URL . 'assets/js/admin-scripts.js' );
			wp_register_style( 'dorzki-slack-settings-css', PLUGIN_ROOT_URL . 'assets/css/admin-styles.css' );

			if ( "settings_page_{$this::$namespace}" === get_current_screen()->id ) {

				wp_enqueue_script( 'jquery' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_script( 'media_upload' );

				wp_enqueue_style( 'thickbox' );
				wp_enqueue_style( 'dorzki-slack-settings-css' );

			}

			wp_enqueue_script( 'dorzki-slack-scripts' );

		}

	}

}