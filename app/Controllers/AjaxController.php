<?php
/**
 * Ajax Controller class.
 *
 * @package USER_GRID
 */

namespace USGR\UserGrid\Controllers;

use USGR\UserGrid\Helpers\Fns;

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
		add_action( 'wp_ajax_usgr_user_biography', [ __CLASS__, 'usgr_user_biography' ] );
		add_action( 'wp_ajax_noprev_usgr_user_biography', [ __CLASS__, 'usgr_user_biography' ] );
	}

	/**
	 * Users biography ajax
	 *
	 * @return void
	 */
	public static function usgr_user_biography() {
		//phpcs:disable WordPress.Security.NonceVerification.Recommended
		if ( Fns::verifyNonce() ) {
			$user_info = ! empty( $_REQUEST['user_id'] ) ? get_user_by( 'id', sanitize_text_field( wp_unslash( $_REQUEST['user_id'] ) ) ) : '';
			$biography = get_user_meta( $user_info->ID, 'description', true );

			if ( $biography ) {
				$bio = $biography;
			} else {
				$bio = esc_html__( 'There is no biography for this user.', 'user-grid' );
			}
			$return = [
				'biography' => $bio,
				'success'   => 'ok',
			];
		} else {
			$return = [
				'success' => esc_html__( 'Server Error !!', 'user-grid' ),
			];
		}
		wp_send_json( $return );
		wp_die();
		//phpcs:enable WordPress.Security.NonceVerification.Recommended
	}
}
