<?php
/**
 * Plugin Name: Gutenberg Users
 * Plugin URI: http://habibportfolio.com/
 * Description: Fast & Easy way to display WordPress users in Gutenberg Editor
 * Author: gtusers
 * Version: 1.0.0
 * Text Domain: gutenberg-users
 * Domain Path: /languages
 * Author URI: http://habibportfolio.com/
 *
 * @package GT_USERS
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

define( 'GT_USERS_VERSION', '1.0.0' );
define( 'GT_USERS_PLUGIN_FILE', __FILE__ );
define( 'GT_USERS_PLUGIN_PATH', dirname( __FILE__ ) );
define( 'GT_USERS_PLUGIN_ACTIVE_FILE_NAME', plugin_basename( __FILE__ ) );
define( 'GT_USERS_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'GT_USERS_PLUGIN_SLUG', basename( dirname( __FILE__ ) ) );
define( 'GT_USER_META_KEY', 'gt_users_attachment_id' );
define( 'GT_USERS_LANGUAGE_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages' );

if ( ! class_exists( 'GtUsers' ) ) {
	require_once 'app/GtUsers.php';
}