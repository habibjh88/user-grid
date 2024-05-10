<?php
/**
 * Helper class.
 *
 * @package USER_GRID
 */

namespace DOWP\UserGrid\Helpers;

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
		$template_name = '/user-grid/' . $layout . '.php';
		if ( file_exists( get_stylesheet_directory() . $template_name ) ) {
			$file = get_stylesheet_directory() . $template_name;
		} else if ( file_exists( get_template_directory() . $template_name ) ) {
			$file = get_template_directory() . $template_name;
		} else {
			$file = USER_GRID_PLUGIN_PATH . '/templates/' . $layout . '.php';
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
		$nonce     = isset( $_REQUEST[ userGrid()->nonceId() ] ) ? sanitize_text_field( wp_unslash( $_REQUEST[ userGrid()->nonceId() ] ) ) : null;
		$nonceText = userGrid()->nonceText();

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
	public static function get_user_social_icon( $user_id, $data ) {
		$facebook  = get_user_meta( $user_id, 'user_grid_facebook', true );
		$twitter   = get_user_meta( $user_id, 'user_grid_twitter', true );
		$linkedin  = get_user_meta( $user_id, 'user_grid_linkedin', true );
		$gplus     = get_user_meta( $user_id, 'user_grid_gplus', true );
		$pinterest = get_user_meta( $user_id, 'user_grid_pinterest', true );
		$user_info = get_user_by( 'id', $user_id );
		$email     = $user_info->user_email;
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
			if ( $data['email_visibility'] === 'show' ) {
				echo '<a class="pinterest" href="mailto:' . esc_url( $email ) . '"><svg width="14" height="16" viewBox="0 0 60 47" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M59.853 6.3484C59.6037 5.08816 59.0414 3.89707 58.2211 2.8957C58.0545 2.68547 57.8802 2.49844 57.6896 2.30871C56.2302 0.841523 54.2 0 52.1196 0H7.88016C5.77652 0 3.79805 0.820313 2.30918 2.30953C2.12074 2.4975 1.94602 2.68641 1.77305 2.90332C0.95625 3.90047 0.396445 5.08992 0.153047 6.35191C0.0513281 6.8475 0 7.36101 0 7.88051V38.9513C0 40.0322 0.219609 41.0848 0.654961 42.0854C1.03172 42.9741 1.60336 43.8165 2.30871 44.5215C2.48637 44.6984 2.66285 44.8615 2.85129 45.0205C4.26152 46.1884 6.04723 46.8311 7.88016 46.8311H52.1196C53.9644 46.8311 55.7483 46.1859 57.1548 45.0076C57.3428 44.8555 57.517 44.6958 57.6913 44.5215C58.3731 43.8404 58.915 43.0579 59.3045 42.1949L59.3558 42.0718C59.7831 41.0902 60 40.041 60 38.9514V7.88051C60 7.36781 59.9505 6.8509 59.853 6.3484ZM4.08082 5.02922C4.19227 4.86609 4.33453 4.69863 4.51605 4.5157C5.41711 3.61512 6.61207 3.11953 7.88004 3.11953H52.1195C53.3986 3.11953 54.5939 3.61594 55.485 4.51746C55.6389 4.67297 55.7858 4.84559 55.914 5.01809L56.2523 5.47277L32.6391 26.0528C31.9111 26.691 30.9738 27.0422 29.9996 27.0422C29.0351 27.0422 28.0986 26.6918 27.362 26.0536L3.77227 5.47863L4.08082 5.02922ZM3.13535 39.2256C3.12258 39.141 3.11965 39.047 3.11965 38.9513V8.52387L21.4443 24.5095L3.30457 40.3253L3.13535 39.2256ZM54.4804 43.0842C53.7711 43.4934 52.9543 43.7105 52.1196 43.7105H7.88016C7.04496 43.7105 6.22852 43.4934 5.51977 43.0842L4.7782 42.6544L23.5207 26.3209L25.5748 28.1075C26.8069 29.1772 28.3781 29.7669 29.9999 29.7669C31.6276 29.7669 33.2014 29.1772 34.4327 28.1075L36.486 26.3201L55.222 42.6553L54.4804 43.0842ZM56.8795 38.9513C56.8795 39.0454 56.8778 39.1384 56.8659 39.2213L56.7035 40.3313L38.5561 24.5181L56.8795 8.5316V38.9513Z" fill="black"/></svg></a>';
			}
			?>
        </div>
		<?php

		return ob_get_clean();
	}


}