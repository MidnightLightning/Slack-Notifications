<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Admin plugin settings page tabs contents.
 *
 * @package   Slack Notifications
 * @since     1.1.0
 * @version   1.1.0
 * @author    Dor Zuberi <me@dorzki.co.il>
 * @link      https://www.dorzki.co.il
 */
?>
<div class="tabs-wrapper dorzki-tabs-wrapper">
	<?php foreach ( $this->tabs as $idx => $tab ) : ?>

		<!-- <?php echo ucfirst( $tab[ 'label' ] ); ?> Tab -->
		<div id="<?php echo esc_attr( $tab[ 'id' ] ); ?>" class="dorzki-tab <?php echo ( $idx === 0 ) ? 'active' : ''; ?>">
			<h3><?php echo esc_html( $tab[ 'label' ] ); ?></h3>

			<?php include( DS_PLUGIN_ROOT_DIR . DS_TEMPLATES_DIR . 'tabs-body.php' ); ?>

		</div>
		<!-- /<?php echo ucfirst( $tab[ 'label' ] ); ?> Tab -->

	<?php endforeach; ?>
</div>