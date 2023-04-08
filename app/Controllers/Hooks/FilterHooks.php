<?php
/**
 * Filter Hooks class.
 *
 * @package RT_TPG
 */

namespace GT\GtUsers\Controllers\Hooks;

use Cassandra\Varint;
use GT\GtUsers\Helpers\Fns;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Filter Hooks class.
 *
 * @package RT_TPG
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
		add_filter( 'wp_kses_allowed_html', [ __CLASS__, 'tpg_custom_wpkses_post_tags' ], 10, 2 );
	}

	/**
	 * Add body classes
	 *
	 * @param $classes
	 *
	 * @return mixed
	 */
	public static function body_classes( $classes ) {
		$classes[] = 'gtusers';
		$classes[] = 'gtusers-' . GT_USERS_VERSION;
		$classes[] = 'gtusers-body-wrap';

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
		//check if the current page is post.php and if the post parameteris set
		if ( $pagenow === 'post.php' && isset( $_GET['post'] ) ) {
			$classes .= ' gtusers';
			$classes .= ' gtusers-body-wrap';
		}

		return $classes;
	}

	/**
	 * @param $tags
	 * @param $context
	 *
	 * @return mixed
	 */
	public static function tpg_custom_wpkses_post_tags( $tags, $context ) {

		if ( 'post' === $context ) {
			$tags['iframe'] = [
				'src'             => true,
				'height'          => true,
				'width'           => true,
				'frameborder'     => true,
				'allowfullscreen' => true,
			];
			$tags['input']  = [
				'type'        => true,
				'class'       => true,
				'placeholder' => true,
			];
			$tags['style']  = [
				'src' => true,
			];
		}

		return $tags;
	}

}
