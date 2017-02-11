<?php $j = 0; ?>
<table class="form-table">
	<tbody>

	<?php foreach ( $tab[ 'fields' ] as $field ) {
		include( DS_TEMPLATES_DIR . "fields/{$field['type']}.php" );
	} ?>

	</tbody>
</table>
