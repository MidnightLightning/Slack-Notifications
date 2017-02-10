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
if ( ! class_exists( 'SlackSettings' ) ) {

	/**
	 * Class SlackSettings
	 *
	 * @since   1.1.0
	 * @version 1.1.0
	 */
	class SlackSettings {

		/**
		 * Text input field type.
		 *
		 * @since 1.1.0
		 * @var string
		 */
		const FIELD_TYPE_TEXT = 'input-text';

		/**
		 * Image upload field type.
		 *
		 * @since 1.1.0
		 * @var string
		 */
		const FIELD_TYPE_IMAGE = 'image-upload';

		/**
		 * checkbox field type.
		 *
		 * @since 1.1.0
		 * @var string
		 */
		const FIELD_TYPE_CHECKBOX = 'input-checkbox';

		/**
		 * Notification field type.
		 *
		 * @since 1.1.0
		 * @var string
		 */
		const FIELD_TYPE_NOTIFICATION = 'notification';


		/**
		 * SlackSettings constructor.
		 */
		function __construct() {

			add_action( 'admin_init', [ $this, 'register_plugin_fields' ] );

		}


		public function register_plugin_fields() {

			$default_fields = [
				[
					'tab_id'            => 'integration',
					'field_id'          => 'webhook_url',
					'field_name'        => __( 'Webhook URL', 'dorzki-notifications-to-slack' ),
					'field_type'        => self::FIELD_TYPE_TEXT,
					'field_description' => sprintf( __( 'Add %sSlack Incoming Webhooks%s to your Slack Account and paste the Webhook URL here.', 'dorzki-notifications-to-slack' ), '<a href="https://my.slack.com/services/new/incoming-webhook/" target="_blank">', '</a>' )
				],
				[
					'tab_id'            => 'integration',
					'field_id'          => 'channel_name',
					'field_name'        => __( 'Webhook Name', 'dorzki-notifications-to-slack' ),
					'field_type'        => self::FIELD_TYPE_TEXT,
					'field_description' => __( 'Write here the desired channel name to receive notifications, you may write more than one by separating with a comma.', 'dorzki-notifications-to-slack' )
				],
				[
					'tab_id'            => 'integration',
					'field_id'          => 'bot_name',
					'field_name'        => __( 'Bot Name', 'dorzki-notifications-to-slack' ),
					'field_type'        => self::FIELD_TYPE_TEXT,
					'field_description' => __( 'The Slack Bot name to be displayed in notifications.', 'dorzki-notifications-to-slack' )
				],
				[
					'tab_id'            => 'integration',
					'field_id'          => 'bot_icon',
					'field_name'        => __( 'Bot Icon', 'dorzki-notifications-to-slack' ),
					'field_type'        => self::FIELD_TYPE_IMAGE,
					'field_description' => __( 'Slack Bot image to be displayed in Slack.', 'dorzki-notifications-to-slack' )
				]
			];

			foreach ( $default_fields as $field ) {

				self::create_setting_field( $field[ 'tab_id' ], $field[ 'field_id' ], $field[ 'field_name' ], $field[ 'field_type' ], $field[ 'field_description' ] );

			}

		}


		/**
		 * Creates a new field in a tab.
		 *
		 * @since   1.1.0
		 * @version 1.1.0
		 *
		 * @param $tab_id            tab id
		 * @param $field_id          field id
		 * @param $field_name        field name
		 * @param $field_type        field type
		 * @param $field_description field description
		 *
		 * @return bool
		 */
		public static function create_setting_field( $tab_id, $field_id, $field_name, $field_type = '', $field_description = '' ) {

			if ( empty( $tab_id ) || empty( $field_id ) || empty( $field_name ) ) {
				return false;
			}

			if ( ! SlackAdmin::tab_exists( $tab_id ) ) {
				return false;
			}

			if ( empty( $field_type ) ) {
				$field_type = self::FIELD_TYPE_TEXT;
			}

			return SlackAdmin::assign_field_to_tab( $tab_id, [
				'id'          => $field_id,
				'name'        => $field_name,
				'type'        => $field_type,
				'description' => $field_description,
				'value'       => ''
			] );

		}

	}

}