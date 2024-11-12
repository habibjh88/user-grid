<?php
/**
 * Install Helper class.
 *
 * @package USER_GRID
 */

namespace USGR\UserGrid\Helpers;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Install Helper class.
 */
class Install {

	/**
	 * Plugin activated hook
	 *
	 * @return void
	 */
	public static function activate() {
		if ( ! get_option( 'usgr_ug_time' ) ) {
			update_option( 'usgr_ug_time', time() );
		}
		update_option( 'usgr_ug_version', USER_GRID_VERSION );
	}

	/**
	 * Plugin Deactivated hook
	 *
	 * @return void
	 */
	public static function deactivate() {

	}
}
