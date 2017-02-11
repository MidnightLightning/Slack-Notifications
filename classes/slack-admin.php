<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Admin plugin class.
 *
 * @package   Slack Notifications
 * @since     1.1.0
 * @version   1.1.0
 * @author    Dor Zuberi <me@dorzki.co.il>
 * @link      https://www.dorzki.co.il
 */
if ( ! class_exists( 'SlackAdmin' ) ) {

	/**
	 * Class SlackAdmin
	 *
	 * @since   1.1.0
	 * @version 1.1.0
	 */
	class SlackAdmin {

		/**
		 * List of tabs to be displayed in admin settings page.
		 *
		 * @since 1.1.0
		 * @var array
		 */
		protected static $tabs = [];

		/**
		 * Integration tab id.
		 *
		 * @since 1.1.0
		 * @var string
		 */
		const TAB_INTEGRATION = 'integration';

		/**
		 * Notifications tab id.
		 *
		 * @since 1.1.0
		 * @var string
		 */
		const TAB_NOTIFICATIONS = 'notifications';


		/**
		 * SlackAdmin constructor.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		function __construct() {

			add_action( 'admin_init', [ $this, 'register_plugin_tabs' ] );
			add_action( 'admin_menu', [ $this, 'register_admin_page' ] );

		}


		/**
		 * Register the plugin's default tabs.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		public function register_plugin_tabs() {

			register_setting( SlackPlugin::PLUGIN_ID, SlackPlugin::PLUGIN_ID . '_options' );
			register_setting( SlackPlugin::PLUGIN_ID, SlackPlugin::PLUGIN_ID . '_notifications' );

			self::add_tab( self::TAB_INTEGRATION, __( 'Integration', 'dorzki-notifications-to-slack' ) );
			self::add_tab( self::TAB_NOTIFICATIONS, __( 'Notifications', 'dorzki-notifications-to-slack' ) );

		}


		/**
		 * Returns the admin tabs array.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 *
		 * @return array
		 */
		public static function get_tabs() {

			return self::$tabs;

		}


		/**
		 * Adds a new tab to the settings screen.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 *
		 * @param $tab_id          tab id string
		 * @param $tab_name        tab name
		 * @param $tab_description tab description
		 *
		 * @return bool
		 */
		public static function add_tab( $tab_id, $tab_name, $tab_description = '' ) {

			if ( empty( $tab_id ) || empty( $tab_name ) ) {
				return false;
			}

			if ( self::tab_exists( $tab_id ) ) {
				return false;
			}

			self::$tabs[ $tab_id ] = [
				'name'        => $tab_name,
				'description' => $tab_description,
				'fields'      => []
			];

			return true;

		}


		/**
		 * Check if the tab_id already exists.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 *
		 * @param $tab_id tab id
		 *
		 * @return bool
		 */
		public static function tab_exists( $tab_id ) {

			if ( empty( $tab_id ) ) {
				return false;
			}

			return array_key_exists( $tab_id, self::$tabs );

		}


		/**
		 * Assign field to a specific tab.
		 *
		 * @param $tab_id tab id
		 * @param $field  array of field meta data
		 *
		 * @return bool
		 */
		public static function assign_field_to_tab( $tab_id, $field ) {

			if ( empty( $tab_id ) || ! is_array( $field ) ) {
				return false;
			}

			self::$tabs[ $tab_id ][ 'fields' ][] = $field;

			return true;

		}


		/**
		 * Adds new admin page for the plugin under options menu.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		public function register_admin_page() {

			add_options_page( __( 'Slack Notifications', 'dorzki-notifications-to-slack' ), __( 'Slack Notifications', 'dorzki-notifications-to-slack' ), 'manage_options', SlackPlugin::PLUGIN_ID, [
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

			include_once( DS_TEMPLATES_DIR . 'admin-settings.php' );

		}

	}

}