<?php
/**
 * Ajax Controller class.
 *
 * @package USER_GRID
 */

namespace DOWP\UserGrid\Controllers;

use DOWP\UserGrid\Helpers\Fns;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Ajax Controller class.
 */
class AjaxController {
	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'wp_ajax_dowp_user_biography', [ __CLASS__, 'dowp_user_biography' ] );
		add_action( 'wp_ajax_noprev_dowp_user_biography', [ __CLASS__, 'dowp_user_biography' ] );
	}

	/**
	 * Users biography ajax
	 * @return void
	 */
	public static function dowp_user_biography() {
		if ( Fns::verifyNonce() ) {
			$user_info = get_user_by( 'id', sanitize_text_field( wp_unslash( $_REQUEST['user_id'] ) ) );
			$biography = get_user_meta( $user_info->ID, 'description', true );

			if ( $biography ) {
				$bio = $biography;
			}  else {
				$bio = esc_html__("There is no biography for this user.", "user-grid");
			}
			$return = [
				'biography' => $bio,
				'success' => "ok",
			];
		} else {
			$return = [
				'success' => esc_html__( 'Server Error !!', 'user-grid' )
			];
		}
		wp_send_json( $return );
		wp_die();
	}
}
