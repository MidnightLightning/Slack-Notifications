<tr valign="top">
	<th scope="row">
		<label for="<?php echo esc_attr( $field[ 'id' ] ); ?>"><?php echo esc_html( $field[ 'name' ] ); ?></label>
	</th>
	<td>
		<input type="text" id="<?php echo esc_attr( $field[ 'id' ] ); ?>" name="<?php echo esc_attr( $field[ 'option_id' ] ); ?>" class="dorzki_image_src regular-text" value="<?php echo esc_url( $field[ 'value' ] ); ?>"/>
		<input id="<?php echo esc_attr( $field[ 'id' ] ); ?>_button" type="button" class="dorzki_image_upload button" value="<?php esc_html_e( 'Upload', 'dorzki-notifications-to-slack' ); ?>"/>

		<?php if ( ! empty( $field[ 'description' ] ) ) : ?>
			<p class="description" id="<?php echo esc_attr( $field[ 'id' ] ); ?>-description"><?php echo $field[ 'description' ]; ?></p>
		<?php endif; ?>

		<div id="<?php echo esc_attr( $field[ 'id' ] ); ?>_preview" class="dorzki_image_preview">
			<?php if ( '' !== $field[ 'value' ] ) : ?>
				<img src="<?php echo esc_url( $field[ 'value' ] ); ?>">
			<?php endif; ?>
		</div>
	</td>
</tr>