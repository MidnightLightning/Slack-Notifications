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

$i = 0;
?>
<div class="tabs-wrapper dorzki-tabs-wrapper">
	<?php foreach ( self::$tabs as $id => $tab ) : $i ++ ?>

		<!-- <?php echo ucfirst( $tab[ 'name' ] ); ?> Tab -->
		<div id="<?php echo esc_attr( $id ); ?>" class="dorzki-tab <?php echo ( $i === 1 ) ? 'active' : ''; ?>">
			<h3 class="wp-heading-inline"><?php echo esc_html( $tab[ 'name' ] ); ?></h3>

			<?php if ( SlackAdmin::TAB_NOTIFICATIONS === $id ) : ?>
				<a href="#create-notification" class="dorzki-create-notification page-title-action"><?php esc_html_e( 'Add New Notification', 'dorzki-notifications-to-slack' ); ?></a>
			<?php endif; ?>

			<?php include( DS_TEMPLATES_DIR . 'tabs/tab-body.php' ); ?>

		</div>
		<!-- /<?php echo ucfirst( $tab[ 'name' ] ); ?> Tab -->

	<?php endforeach; ?>
</div>