<tr valign="top">
	<th scope="row">
		<label for="<?php echo esc_attr( $field[ 'id' ] ); ?>"><?php echo esc_html( $field[ 'name' ] ); ?></label>
	</th>
	<td>
		<input type="text" name="<?php echo esc_attr( $field[ 'option_id' ] ); ?>" id="<?php echo esc_attr( $field[ 'id' ] ); ?>" class="regular-text" value="<?php echo esc_html( $field[ 'value' ] ); ?>">

		<?php if ( ! empty( $field[ 'description' ] ) ) : ?>
			<p class="description" id="<?php echo esc_attr( $field[ 'id' ] ); ?>-description"><?php echo $field[ 'description' ]; ?></p>
		<?php endif; ?>
	</td>
</tr>