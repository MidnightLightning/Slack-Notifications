<?php $notification_types = SlackNotifications::get_notification_types(); ?>
<tr valign="top">
	<td scope="row" class="notification-row" colspan="2">
		<div class="dorzki-collapse">
			<div class="dorzki-collapse-header">
				<div class="dorzki-collapse-action">
					<a href="#this"></a>
				</div>
				<h3><?php echo ( isset( $field[ 'name' ] ) ) ? $field[ 'name' ] : sprintf( __( 'Notification #%d', 'dorzki-notifications-to-slack' ), $j ); ?></h3>
			</div>
			<div class="dorzki-collapse-body">
				<p>
					<input class="regular-text" id="<?php printf( '%s_notifications[%d][name]', SlackPlugin::PLUGIN_ID, $j ); ?>" name="<?php printf( '%s_notifications[%d][name]', SlackPlugin::PLUGIN_ID, $j ); ?>" type="hidden" value="<?php echo esc_attr( ( isset( $field[ 'name' ] ) ) ? $field[ 'name' ] : sprintf( __( 'Notification #%d', 'dorzki-notifications-to-slack' ), $j ) ); ?>">
				</p>
				<p>
					<label for="<?php printf( '%s_notifications[%d][notif_category]', SlackPlugin::PLUGIN_ID, $j ); ?>"><?php esc_html_e( 'Notification Type:', 'dorzki-notifications-to-slack' ); ?></label>
					<select id="<?php printf( '%s_notifications[%d][notif_category]', SlackPlugin::PLUGIN_ID, $j ); ?>" name="<?php printf( '%s_notifications[%d][notif_category]', SlackPlugin::PLUGIN_ID, $j ); ?>" class="notification-cat">
						<option value=""><?php esc_html_e( '- Select -', 'dorzki-notifications-to-slack' ); ?></option>

						<?php foreach ( $notification_types as $type_id => $notification_type ) : ?>
							<option value="<?php echo esc_attr( $type_id ); ?>" <?php selected( $field[ 'notif_category' ], $type_id ); ?>><?php echo esc_html( $notification_type[ 'name' ] ); ?></option>
						<?php endforeach; ?>

					</select>

					<select id="<?php printf( '%s_notifications[%d][notif_type]', SlackPlugin::PLUGIN_ID, $j ); ?>" name="<?php printf( '%s_notifications[%d][notif_type]', SlackPlugin::PLUGIN_ID, $j ); ?>" class="notification-type" style="display: <?php echo ( isset( $field[ 'notif_type' ] ) ) ? 'inline-block' : 'none'; ?>">

						<?php if ( isset( $field[ 'notif_type' ] ) && ! empty( $field[ 'notif_type' ] ) ) : ?>
							<?php foreach ( $notification_types[ $field[ 'notif_category' ] ][ 'types' ] as $type_hook => $type_name ) : ?>
								<option value="<?php echo esc_attr( $type_hook ); ?>" <?php selected( $field[ 'notif_type' ], $type_hook ); ?>><?php echo esc_html( $type_name[ 'name' ] ); ?></option>
							<?php endforeach; ?>
						<?php endif; ?>

					</select>

					<select id="<?php printf( '%s_notifications[%d][notif_status]', SlackPlugin::PLUGIN_ID, $j ); ?>" name="<?php printf( '%s_notifications[%d][notif_status]', SlackPlugin::PLUGIN_ID, $j ); ?>" class="notification-status" style="display: <?php echo ( isset( $field[ 'notif_status' ] ) && isset( $notification_types[ $field[ 'notif_category' ] ][ 'types' ][ $field[ 'notif_type' ] ][ 'statuses' ] ) ) ? 'inline-block' : 'none'; ?>">

						<?php if ( isset( $field[ 'notif_status' ] ) && isset( $notification_types[ $field[ 'notif_category' ] ][ 'types' ][ $field[ 'notif_type' ] ][ 'statuses' ] ) ) : ?>
							<?php foreach ( $notification_types[ $field[ 'notif_category' ] ][ 'types' ][ $field[ 'notif_type' ] ][ 'statuses' ] as $status_id => $status_name ) : ?>
								<option value="<?php echo esc_attr( $status_id ); ?>" <?php selected( $field[ 'notif_status' ], $status_id ); ?>><?php echo esc_html( $status_name ); ?></option>
							<?php endforeach; ?>
						<?php endif; ?>

					</select>
				</p>
				<p>
					<label for="<?php printf( '%s_notifications[%d][notif_channel]', SlackPlugin::PLUGIN_ID, $j ); ?>"><?php esc_html_e( 'Channel:', 'dorzki-notifications-to-slack' ); ?></label>
					<input class="regular-text" id="<?php printf( '%s_notifications[%d][notif_channel]', SlackPlugin::PLUGIN_ID, $j ); ?>" name="<?php printf( '%s_notifications[%d][notif_channel]', SlackPlugin::PLUGIN_ID, $j ); ?>" type="text" value="<?php echo esc_attr( ( isset( $field[ 'notif_channel' ] ) ) ? $field[ 'notif_channel' ] : '' ); ?>">
				</p>
				<p>
					<label for="<?php printf( '%s_notifications[%d][notif_bot_name]', SlackPlugin::PLUGIN_ID, $j ); ?>"><?php esc_html_e( 'Bot Name:', 'dorzki-notifications-to-slack' ); ?></label>
					<input class="regular-text" id="<?php printf( '%s_notifications[%d][notif_bot_name]', SlackPlugin::PLUGIN_ID, $j ); ?>" name="<?php printf( '%s_notifications[%d][notif_bot_name]', SlackPlugin::PLUGIN_ID, $j ); ?>" type="text" value="<?php echo esc_attr( ( isset( $field[ 'notif_bot_name' ] ) ) ? $field[ 'notif_bot_name' ] : '' ); ?>">
				</p>
			</div>
		</div>
	</td>
</tr>