<?php
/**
 * Plugin Name: User Grid
 * Plugin URI: https://habibportfolio.com/user-grid
 * Description: Fast & Easy way to display WordPress users in Gutenberg Editor
 * Author: DevOfWP
 * Version: 1.0.0
 * Text Domain: user-grid
 * Domain Path: /languages
 * Author URI: https://habibportfolio.com/
 *
 * @package USER_GRID
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

define( 'USER_GRID_VERSION', '1.0.0' );
define( 'USER_GRID_PLUGIN_FILE', __FILE__ );
define( 'USER_GRID_PLUGIN_ACTIVE_FILE_NAME', plugin_basename( __FILE__ ) );
define( 'USER_GRID_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'USER_GRID_PLUGIN_SLUG', basename( dirname( __FILE__ ) ) );
define( 'USER_GRID_PLUGIN_BASE_DIR', plugin_dir_path( __FILE__ ) );
define( 'USER_GRID_LANGUAGE_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages' );

if ( ! class_exists( 'UserGrid' ) ) {
	require_once 'app/UserGrid.php';
}