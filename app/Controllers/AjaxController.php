<?php
/**
 * Ajax Controller class.
 *
 * @package GT_USERS
 */

namespace GT\GtUsers\Controllers;

use GT\GtUsers\Helpers\Fns;

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
		add_action( 'wp_ajax_gtusers_user_biography', [ __CLASS__, 'gtusers_user_biography' ] );
		add_action( 'wp_ajax_noprev_gtusers_user_biography', [ __CLASS__, 'gtusers_user_biography' ] );
	}

	/**
	 * Users biography ajax
	 * @return void
	 */
	public static function gtusers_user_biography() {
		if ( Fns::verifyNonce() ) {
			$user_info = get_user_by( 'id', sanitize_text_field( wp_unslash( $_REQUEST['user_id'] ) ) );
			$biography = get_user_meta( $user_info->ID, 'description', true );

			if ( ! empty( $biography ) ) {
				$return = [
					'success'   => "ok",
					'biography' => $biography
				];
			} else {
				$return = [
					'success' => "error",
				];
			}
		} else {
			$return = [
				'success' => esc_html__( 'Server Error !!', 'gutenberg-users' )
			];
		}
		wp_send_json( $return );
		wp_die();
	}
}
