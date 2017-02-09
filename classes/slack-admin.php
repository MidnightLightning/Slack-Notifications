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
		protected $tabs = [];


		/**
		 * SlackAdmin constructor.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		function __construct() {

			$this->tabs = [
				[ 'id' => 'integration', 'label' => __( 'Integration', 'dorzki-notifications-to-slack' ) ],
				[ 'id' => 'notifications', 'label' => __( 'Notifications', 'dorzki-notifications-to-slack' ) ],
				[ 'id' => 'slack-log', 'label' => __( 'Slack Log', 'dorzki-notifications-to-slack' ) ]
			];

		}


		/**
		 * Returns the admin tabs array.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 * @return array
		 */
		public function get_tabs() {

			return $this->tabs;

		}


		/**
		 * Adds new admin page for the plugin under options menu.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 */
		public function register_admin_page() {

			add_options_page( __( 'Slack Notifications', 'dorzki-notifications-to-slack' ), __( 'Slack Notifications', 'dorzki-notifications-to-slack' ), 'manage_options', SlackPlugin::get_namespace(), [
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

	}

}