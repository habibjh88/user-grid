<?php
/**
 * Install Helper class.
 *
 * @package USER_GRID
 */

namespace DOWP\UserGrid\Helpers;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Install Helper class.
 */
class Install {
	public static function activate() {
		update_option( userGrid()->options['installed_version'], USER_GRID_VERSION );
	}

	public static function deactivate() {
		update_option( 'dowp_flush_rewrite_rules', 0 );
	}
}
