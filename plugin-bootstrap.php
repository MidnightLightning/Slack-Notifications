<?php
/**
 * Plugin Name: Slack Notifications
 * Plugin URI: https://www.dorzki.co.il
 * Description: Add Slack integration to a channel and send desired notifications as a slack bot.
 * Version: 1.1.0
 * Author: dorzki
 * Author URI: https://www.dorzki.co.il
 * Text Domain: dorzki-notifications-to-slack
 *
 *
 * @package   Slack Notifications
 * @since     1.0.0
 * @version   1.1.0
 * @author    Dor Zuberi <me@dorzki.co.il>
 * @link      https://www.dorzki.co.il
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


/**
 * Plugin Constants
 */
if ( ! defined( 'DS_PLUGIN_URL' ) ) {
	define( 'DS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'DS_PLUGIN_DIR' ) ) {
	define( 'DS_PLUGIN_ROOT_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'DS_TEMPLATES_DIR' ) ) {
	define( 'DS_TEMPLATES_DIR', DS_PLUGIN_ROOT_DIR . 'templates/' );
}

if ( ! defined( 'DS_CLASSES_DIR' ) ) {
	define( 'DS_CLASSES_DIR', DS_PLUGIN_ROOT_DIR . 'classes/' );
}

if ( ! defined( 'DS_ASSETS_URL' ) ) {
	define( 'DS_ASSETS_URL', DS_PLUGIN_URL . 'assets/' );
}


/**
 * Plugin Classes
 */
include_once( DS_CLASSES_DIR . 'slack-settings.php' );
include_once( DS_CLASSES_DIR . 'slack-admin.php' );
include_once( DS_CLASSES_DIR . 'slack-plugin.php' );


/**
 * Plugin Init
 */
SlackPlugin::get_instance();