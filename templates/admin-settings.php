<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Admin plugin settings page.
 *
 * @package   Slack Notifications
 * @since     1.1.0
 * @version   1.1.0
 * @author    Dor Zuberi <me@dorzki.co.il>
 * @link      https://www.dorzki.co.il
 */
?>
<div class="wrap">
	<h2><?php esc_html_e( 'Slack Notifications', 'dorzki-notifications-to-slack' ); ?>
		<small><?php esc_html_e( 'by', 'dorzki-notifications-to-slack' ); ?>
			<a href="https://www.dorzki.co.il" target="_blank"><?php esc_html_e( 'dorzki', 'dorzki-notifications-to-slack' ); ?></a>
		</small>
	</h2>
	<form action="options.php" method="post">
		<?php settings_fields( 'dorzki-slack' ); ?>

		<!-- Navigation Tabs -->
		<?php include_once( DS_PLUGIN_ROOT_DIR . DS_TEMPLATES_DIR . 'tabs-navigation.php' ); ?>
		<!-- /Navigation Tabs -->

		<!-- Tabs Contents -->
		<?php include_once( DS_PLUGIN_ROOT_DIR . DS_TEMPLATES_DIR . 'tabs-contents.php' ); ?>
		<!-- /Tabs Contents -->

		<?php submit_button(); ?>
	</form>
</div>
