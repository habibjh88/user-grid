<?php
/**
 * Helper class.
 *
 * @package RT_TPG
 */

namespace GT\GtUsers\Helpers;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Helper class.
 */
class Fns {

	/**
	 * Get Ajax URL.
	 *
	 * @return string
	 */
	public static function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}


	/**
	 * @param $data
	 *
	 * @return void
	 */
	public static function get_template( $data ) {
		$layout        = $data['layout'];
		$template_name = '/the-post-grid/' . $layout . '.php';
		if ( file_exists( STYLESHEETPATH . $template_name ) ) {
			$file = STYLESHEETPATH . $template_name;
		} else if ( file_exists( TEMPLATEPATH . $template_name ) ) {
			$file = TEMPLATEPATH . $template_name;
		} else {
			$file = GT_USERS_PLUGIN_PATH . '/templates/' . $layout . '.php';
		}

		ob_start();
		include $file;
		echo ob_get_clean();
	}

	/**
	 * Verify nonce.
	 *
	 * @return bool
	 */
	public static function verifyNonce() {
		$nonce     = isset( $_REQUEST[ gtUsers()->nonceId() ] ) ? sanitize_text_field( wp_unslash( $_REQUEST[ gtUsers()->nonceId() ] ) ) : null;
		$nonceText = gtUsers()->nonceText();

		if ( ! wp_verify_nonce( $nonce, $nonceText ) ) {
			return false;
		}

		return true;
	}


	/**
	 * Custom wp_kses
	 *
	 * @param $string
	 *
	 * @return string
	 */
	public static function wp_kses( $string ) {
		$allowed_html = [
			'a'      => [
				'href'    => [],
				'title'   => [],
				'data-id' => [],
				'target'  => [],
				'class'   => [],
			],
			'strong' => [],
			'b'      => [],
			'br'     => [ [] ],
		];

		return wp_kses( $string, $allowed_html );
	}

}