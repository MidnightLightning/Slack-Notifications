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

$i = 0;
?>
<div class="nav-tab-wrapper dorzki-tabs-nav">

	<?php foreach ( self::$tabs as $id => $tab ) : $i ++ ?>

		<a class="nav-tab <?php echo ( $i === 1 ) ? 'nav-tab-active' : ''; ?>" id="<?php echo esc_attr( $id ); ?>-tab" href="#<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $tab[ 'name' ] ); ?></a>

	<?php endforeach; ?>

</div>