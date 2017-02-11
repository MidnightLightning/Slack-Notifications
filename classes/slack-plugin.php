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
		const PLUGIN_ID = 'dorzki_slack';


		/**
		 * SlackPlugin constructor.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		function __construct() {

			new SlackAdmin();
			new SlackSettings();

			add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'register_plugin_assets' ] );

		}


		/**
		 * Returns the plugin instance.
		 * Enables singleton mode.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 *
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
		 * Register the plugin's css & js files.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		public function register_plugin_assets() {

			wp_register_script( $this::PLUGIN_ID . '_scripts', DS_ASSETS_URL . 'js/admin-scripts.js' );
			wp_register_style( $this::PLUGIN_ID . '_settings-css', DS_ASSETS_URL . 'css/admin-styles.css' );

			if ( 'settings_page_' . $this::PLUGIN_ID === get_current_screen()->id ) {

				wp_enqueue_script( 'jquery' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_script( 'media_upload' );

				wp_enqueue_style( 'thickbox' );
				wp_enqueue_style( $this::PLUGIN_ID . '_settings-css' );

			}

			wp_enqueue_script( $this::PLUGIN_ID . '_scripts' );

		}

	}

}