<?php
/**
 * Plugin Name: Gutenberg Users
 * Plugin URI: https://www.radiustheme.com/downloads/the-post-grid-pro-for-wordpress/
 * Description: Fast & Easy way to display WordPress post in Grid, List & Isotope view ( filter by category, tag, author..)  without a single line of coding.
 * Author: RadiusTheme
 * Version: 7.0.2
 * Text Domain: gutenberg-users
 * Domain Path: /languages
 * Author URI: https://radiustheme.com/
 *
 * @package GT_USERS
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

define( 'GT_USERS_VERSION', '7.0.2' );
define( 'GT_USERS_AUTHOR', 'RadiusTheme' );
define( 'GT_USERS_NAME', 'The Post Grid' );
define( 'GT_USERS_PLUGIN_FILE', __FILE__ );
define( 'GT_USERS_PLUGIN_PATH', dirname( __FILE__ ) );
define( 'GT_USERS_PLUGIN_ACTIVE_FILE_NAME', plugin_basename( __FILE__ ) );
define( 'GT_USERS_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'GT_USERS_PLUGIN_SLUG', basename( dirname( __FILE__ ) ) );
define( 'GT_USERS_LANGUAGE_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages' );

if ( ! class_exists( 'GtUsers' ) ) {
	require_once 'app/GtUsers.php';
}