<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Admin plugin settings page tabs navigation.
 *
 * @package   Slack Notifications
 * @since     1.1.0
 * @version   1.1.0
 * @author    Dor Zuberi <me@dorzki.co.il>
 * @link      https://www.dorzki.co.il
 */
?>
<div class="nav-tab-wrapper dorzki-tabs-nav">

	<?php foreach ( $this->tabs as $idx => $tab ) : ?>

		<a class="nav-tab <?php echo ( $idx === 0 ) ? 'nav-tab-active' : ''; ?>" id="<?php echo esc_attr( $tab[ 'id' ] ); ?>-tab" href="#<?php echo esc_attr( $tab[ 'id' ] ); ?>"><?php echo esc_html( $tab[ 'label' ] ); ?></a>

	<?php endforeach; ?>

</div>