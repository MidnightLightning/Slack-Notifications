<div class="nav-tab-wrapper dorzki-tabs-nav">

	<?php foreach ( $this->tabs as $idx => $tab ) : ?>

		<a class="nav-tab <?php echo ( $idx === 0 ) ? 'nav-tab-active' : ''; ?>" id="<?php echo esc_attr( $tab[ 'id' ] ); ?>-tab" href="#<?php echo esc_attr( $tab[ 'id' ] ); ?>"><?php echo esc_html( $tab[ 'label' ] ); ?></a>

	<?php endforeach; ?>

</div>