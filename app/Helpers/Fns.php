<?php
/**
 * Helper class.
 *
 * @package GT_USERS
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
		$template_name = '/gutenberg-users/' . $layout . '.php';
		if ( file_exists( get_stylesheet_directory() . $template_name ) ) {
			$file = get_stylesheet_directory() . $template_name;
		} else if ( file_exists( get_template_directory() . $template_name ) ) {
			$file = get_template_directory() . $template_name;
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

	/**
	 * Get user social icon
	 *
	 * @param $user_id
	 *
	 * @return false|string
	 */
	public static function get_user_social_icon( $user_id ) {
		$facebook  = get_user_meta( $user_id, 'cub_facebook', true );
		$twitter   = get_user_meta( $user_id, 'cub_twitter', true );
		$linkedin  = get_user_meta( $user_id, 'cub_linkedin', true );
		$gplus     = get_user_meta( $user_id, 'cub_gplus', true );
		$pinterest = get_user_meta( $user_id, 'cub_pinterest', true );

		ob_start();
		?>
		<div class="cub-user-social-icons">
			<?php

			if ( $facebook ) {
				echo '<a class="facebook" href="' . esc_url( $facebook ) . '"><i class="dashicons dashicons-facebook-alt"></i></a>';
			}
			if ( $twitter ) {
				echo '<a class="twitter" href="' . esc_url( $twitter ) . '"><i class="dashicons dashicons-twitter"></i></a>';
			}
			if ( $linkedin ) {
				echo '<a class="linkedin" href="' . esc_url( $linkedin ) . '"><i class="dashicons dashicons-linkedin"></i></a>';
			}
			if ( $gplus ) {
				echo '<a class="google" href="' . esc_url( $gplus ) . '"><i class="dashicons dashicons-google"></i></a>';
			}
			if ( $pinterest ) {
				echo '<a class="pinterest" href="' . esc_url( $pinterest ) . '"><i class="dashicons dashicons-pinterest"></i></a>';
			}

			?>
		</div>
		<?php

		return ob_get_clean();
	}


}