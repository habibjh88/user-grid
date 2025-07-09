<?php
/**
 * Filter Hooks class.
 *
 * @package USER_GRID
 */

namespace USGR\UserGrid\Hooks;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Filter Hooks class.
 *
 * @package USER_GRID
 */
class FilterHooks {
	/**
	 * Class init
	 *
	 * @return void
	 */
	public static function init() {
		add_filter( 'body_class', [ __CLASS__, 'body_classes' ] );
		add_filter( 'admin_body_class', [ __CLASS__, 'admin_body_class' ] );
		add_filter( 'wp_kses_allowed_html', [ __CLASS__, 'usgr_custom_wpkses_post_tags' ], 10, 2 );
		add_filter( 'wp_calculate_image_srcset', [ __CLASS__, 'calculate_image_srcset' ] );
		add_filter( 'get_avatar', [ __CLASS__, 'get_avatar_filter' ], 5, 5 );
		add_filter( 'get_avatar_data', [ __CLASS__, 'get_avater_data_filter' ], 5, 2 );
		add_filter( 'usgr_attachment_id_filter', [ __CLASS__, 'usgr_attachment_id_filter' ] );
	}


	/**
	 * Add body classes
	 *
	 * @param $classes
	 *
	 * @return mixed
	 */
	public static function body_classes( $classes ) {
		$classes[] = 'usgr';
		$classes[] = 'usgr-' . USER_GRID_VERSION;
		$classes[] = 'usgr-body-wrap';

		return $classes;
	}

	/**
	 * Admin body class
	 *
	 * @param string $classes Classes.
	 *
	 * @return string
	 */
	public static function admin_body_class( $classes ) {
		global $pagenow;

		if ( 'post.php' === $pagenow && isset( $_GET['post'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$classes .= ' usgr-body-wrap';
			$classes .= usgrUG()->hasPro() ? ' usgr-has-pro' : ' usgr-has-no-pro';
		}

		return $classes;
	}

	/**
	 * @param $tags
	 * @param $context
	 *
	 * @return mixed
	 */
	public static function usgr_custom_wpkses_post_tags( $tags, $context ) {

		if ( 'post' === $context ) {
			$tags['iframe'] = [
				'src'             => true,
				'height'          => true,
				'width'           => true,
				'frameborder'     => true,
				'allowfullscreen' => true,
			];

			$tags['svg'] = [
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true,
				'stroke'          => true,
				'fill'            => true,
			];

			$tags['g']     = [ 'fill' => true ];
			$tags['title'] = [ 'title' => true ];
			$tags['path']  = [
				'd'               => true,
				'fill'            => true,
				'stroke-width'    => true,
				'stroke-linecap'  => true,
				'stroke-linejoin' => true,
				'fill-rule'       => true,
				'clip-rule'       => true,
				'stroke'          => true,
			];
			$tags['defs']  = [
				'd'               => true,
				'fill'            => true,
				'stroke-width'    => true,
				'stroke-linecap'  => true,
				'stroke-linejoin' => true,
				'fill-rule'       => true,
				'clip-rule'       => true,
				'stroke'          => true,
			];
		}

		return $tags;
	}

	/**
	 * Remove calculate image srcset
	 *
	 * @return array
	 */
	public static function calculate_image_srcset() {
		return [];
	}

	/**
	 * Override of the original WordPress function get_avatar();
	 *
	 * @return string
	 * @since  1.0
	 */
	public static function get_avatar_filter( $avatar, $id_or_email, $size, $default, $alt ) {

		return apply_filters( 'usgr_avatar', $avatar, $id_or_email );

		// Get user ID, if is numeric
		if ( is_numeric( $id_or_email ) ) {

			$user_id = (int) $id_or_email;

			// If is string, maybe the user email
		} elseif ( is_string( $id_or_email ) ) {

			// Find user by email
			$user = get_user_by( 'email', $id_or_email );

			// If user doesn't exists or this is not an ID
			if ( ! isset( $user->ID ) || ! is_numeric( $user->ID ) ) {
				return $avatar;
			}

			$user_id = (int) $user->ID;

			// If is an object
		} elseif ( is_object( $id_or_email ) ) {

			// If is an ID
			if ( isset( $id_or_email->ID ) && is_numeric( $id_or_email->ID ) ) {
				$user_id = (int) $id_or_email->ID;
				// If this is an Comment Object
			} elseif ( isset( $id_or_email->comment_author_email ) ) {
				$user = get_user_by( 'email', $id_or_email->comment_author_email );

				// If user doesn't exists or this is not an ID
				if ( ! isset( $user->ID ) || ! is_numeric( $user->ID ) ) {
					return $avatar;
				}

				$user_id = (int) $user->ID;
			} else {
				return $avatar;
			}
		}

		// Get attachment ID from user meta
		$attachment_id = get_user_meta( $user_id, usgrUG()->avatar_meta_key, true );
		if ( empty( $attachment_id ) || ! is_numeric( $attachment_id ) ) {
			return $avatar;
		}

		// Get attachment image src
		$attachment_src = wp_get_attachment_image_src( $attachment_id, 'medium' );

		// Override WordPress src
		if ( $attachment_src !== false ) {
			$avatar = preg_replace( '/src=("|\').*?("|\')/', "src='{$attachment_src[0]}'", $avatar );
		}

		// Get attachment image srcset
		$attachment_srcset = wp_get_attachment_image_srcset( $attachment_id );

		// Override WordPress srcset
		if ( $attachment_srcset !== false ) {
			$avatar = preg_replace( '/srcset=("|\').*?("|\')/', "srcset='{$attachment_srcset}'", $avatar );
		}

		return $avatar;
	}

	public static function get_avater_data_filter( $args, $id_or_email ) {

		if ( ! empty( $args['force_default'] ) ) {
			return $args;
		}

		$return_args = $args;

		// Determine if we received an ID or string. Then, set the $user_id variable.
		if ( is_numeric( $id_or_email ) && 0 < $id_or_email ) {
			$user_id = (int) $id_or_email;
		} elseif ( is_object( $id_or_email ) && isset( $id_or_email->user_id ) && 0 < $id_or_email->user_id ) {
			$user_id = $id_or_email->user_id;
		} elseif ( is_object( $id_or_email ) && isset( $id_or_email->ID ) && isset( $id_or_email->user_login ) && 0 < $id_or_email->ID ) {
			$user_id = $id_or_email->ID;
		} elseif ( is_string( $id_or_email ) && false !== strpos( $id_or_email, '@' ) ) {
			$_user = get_user_by( 'email', $id_or_email );

			if ( ! empty( $_user ) ) {
				$user_id = $_user->ID;
			}
		}

		if ( empty( $user_id ) ) {
			return $args;
		}

		// Get the user's local avatar from usermeta.
		$avatar_id_local = get_user_meta( $user_id, usgrUG()->avatar_meta_key, true );
		$_avatars_image  = wp_get_attachment_image_src( $avatar_id_local, 'full' );
		if ( ! empty( $_avatars_image[0] ) ) {
			$return_args['url']          = $_avatars_image[0];
			$return_args['found_avatar'] = true;
		}

		return apply_filters( 'usgr_avatar_data', $return_args );
	}

	/**
	 * Classified Listing Compatibility
	 *
	 * @param $key
	 *
	 * @return mixed|string
	 */
	public static function usgr_attachment_id_filter( $key ) {

		if ( defined( 'RTCL_VERSION' ) ) {
			return '_rtcl_pp_id';
		}

		return $key;
	}
}
