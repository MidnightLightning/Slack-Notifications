<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Notifications plugin class.
 *
 * @package   Slack Notifications
 * @since     1.1.0
 * @version   1.1.0
 * @author    Dor Zuberi <me@dorzki.co.il>
 * @link      https://www.dorzki.co.il
 */
if ( ! class_exists( 'SlackNotifications' ) ) {

	/**
	 * Class SlackNotifications
	 *
	 * @since   1.1.0
	 * @version 1.1.0
	 */
	class SlackNotifications {

		/**
		 * Holds the notifications data from the database.
		 *
		 * @since 1.1.0
		 * @var array
		 */
		protected $notifications_data = [];


		/**
		 * SlackNotifications constructor.
		 */
		function __construct() {

			$this->notifications_data = get_option( SlackPlugin::PLUGIN_ID . '_notifications' );

			add_action( 'admin_init', [ $this, 'parse_notifications' ] );
			add_action( 'wp_ajax_dorzki_slack_notif_cat', [ $this, 'ajax_get_notification_types' ] );

		}

		public function parse_notifications() {

			foreach ( $this->notifications_data as $notification ) {

				$notification[ 'type' ] = SlackSettings::FIELD_TYPE_NOTIFICATION;

				SlackAdmin::assign_field_to_tab( SlackAdmin::TAB_NOTIFICATIONS, $notification );

			}

		}

		public static function get_notification_types() {

			$default_statuses = [
				'publish' => __( 'Published', 'dorzki-notifications-to-slack' ),
				'pending' => __( 'Pending Review', 'dorzki-notifications-to-slack' ),
				'update'  => __( 'Updated', 'dorzki-notifications-to-slack' ),
				'future'  => __( 'Future', 'dorzki-notifications-to-slack' ),
			];

			$notifications = [
				'updates' => [
					'name'  => __( 'Updates', 'dorzki-notifications-to-slack' ),
					'types' => [
						'core_update'    => [
							'name' => __( 'New WordPress Update', 'dorzki-notifications-to-slack' )
						],
						'plugins_update' => [
							'name' => __( 'New Plugins Update', 'dorzki-notifications-to-slack' )
						],
						'theme_update'   => [
							'name' => __( 'New Themes Update', 'dorzki-notifications-to-slack' )
						]
					]
				],
				'users'   => [
					'name'  => __( 'Users', 'dorzki-notifications-to-slack' ),
					'types' => [
						'new_user'    => [
							'name' => __( 'New User', 'dorzki-notifications-to-slack' )
						],
						'admin_login' => [
							'name' => __( 'Administrator Login', 'dorzki-notifications-to-slack' )
						]
					]
				],
				'content' => [
					'name'  => __( 'Content', 'dorzki-notifications-to-slack' ),
					'types' => [
						'post' => [
							'name'     => __( 'Post', 'dorzki-notifications-to-slack' ),
							'statuses' => $default_statuses
						],
						'page' => [
							'name'     => __( 'Page', 'dorzki-notifications-to-slack' ),
							'statuses' => $default_statuses
						]
					]
				]
			];

			$post_types = get_post_types( [
				'public'   => true,
				'_builtin' => false,
			], 'objects', 'and' );

			foreach ( $post_types as $post_type ) {

				$notifications[ 'content' ][ 'types' ][ $post_type->name ] = [
					'name'     => $post_type->labels->singular_name,
					'statuses' => $default_statuses
				];

			}

			return $notifications;

		}

	}

}