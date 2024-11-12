<?php
/**
 * Plugin Name: User Grid
 * Plugin URI: https://github.com/habibjh88/user-grid
 * Description: Fast & Easy way to display WordPress users in a page
 * Author: habibjh88
 * Version: 1.0.0
 * Text Domain: user-grid
 * Domain Path: /languages
 * Author URI: https://habibportfolio.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
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

if ( ! class_exists( 'usgr_UG' ) ) {
	require_once 'app/usgr_UG.php';
}