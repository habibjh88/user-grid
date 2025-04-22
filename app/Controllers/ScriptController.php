<?php
/**
 * Script Controller class.
 *
 * @package USER_GRID
 */

namespace USGR\UserGrid\Controllers;

// Do not allow directly accessing this file.
use USGR\UserGrid\Helpers\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Script Controller class.
 */
class ScriptController {

	/**
	 * Version
	 *
	 * @var string
	 */
	private $version;
	private $avatar_size = 96;

	private $notices_enabled_pages = [ 'users.php', 'profile.php', 'user-new.php', 'user-edit.php' ];

	/**
	 * Settings
	 *
	 * @var array
	 */
	private $settings;

	/**
	 * Class construct
	 */
	public function __construct() {
		global $pagenow;
		$this->version = defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : USER_GRID_VERSION;
		if ( in_array( $pagenow, $this->notices_enabled_pages ) ) {
			// Admin scripts.
			add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		}
		add_action( 'init', [ $this, 'init' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
	}

	/**
	 * Init
	 *
	 * @return void
	 */
	public function init() {
		// register scripts.
		$scripts = [];
		$styles  = [];

		$scripts[] = [
			'handle' => 'usgr-script',
			'src'    => usgrUG()->get_assets_uri( 'js/scripts.js' ),
			'deps'   => [ 'jquery' ],
			'footer' => true,
		];

		// Plugin specific css.

		$styles['usgr-block'] = usgrUG()->usgr_can_be_rtl( 'css/style', true );

		foreach ( $scripts as $script ) {
			wp_register_script( $script['handle'], $script['src'], $script['deps'], $script['version'] ?? $this->version, $script['footer'] );
		}

		foreach ( $styles as $k => $v ) {
			wp_register_style( $k, $v, false, $script['version'] ?? $this->version );
		}
	}

	/**
	 * Enqueue scripts.
	 *
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'usgr-block' );
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_script( 'usgr-script' );

		$nonce = wp_create_nonce( usgrUG()->nonceText() );

		wp_localize_script(
			'usgr-script',
			'usgrParams',
			[
				'nonceID' => esc_attr( usgrUG()->nonceId() ),
				'nonce'   => esc_attr( $nonce ),
				'ajaxurl' => Fns::ajax_url(),
			]
		);
	}

	public static function get_default_avatar_url( $user_email = '', $size = 96 ) {
		// Check the email provided
		if ( empty( $user_email ) || ! filter_var( $user_email, FILTER_VALIDATE_EMAIL ) ) {
			return null;
		}

		// Sanitize email and get md5
		$user_email     = sanitize_email( $user_email );
		$md5_user_email = md5( $user_email );

		// SSL Gravatar URL
		$url = 'https://secure.gravatar.com/avatar/' . $md5_user_email;

		// Add query args
		$url = add_query_arg( 's', $size, $url );
		$url = add_query_arg( 'd', 'mm', $url );
		$url = add_query_arg( 'r', 'g', $url );

		return esc_url( $url );
	}

	public function admin_enqueue_scripts() {
		global $current_user;
		wp_enqueue_media();

		// JavaScript for wp-admin
		wp_enqueue_script( 'user-grid-avatar', usgrUG()->get_assets_uri( 'js/user-avatar.js' ), [ 'jquery' ], USER_GRID_VERSION, true );

		// Get default avatar URL by user_email
		$l10n = [
			'default_avatar_src'    => self::get_default_avatar_url( $current_user->user_email, $this->avatar_size ),
			'default_avatar_srcset' => self::get_default_avatar_url( $current_user->user_email, ( $this->avatar_size * 2 ) ) . ' 2x',
			'input_name'            => usgrUG()->avatar_meta_key,
		];
		wp_localize_script( 'user-grid-avatar', 'userGrid', $l10n );
	}

}
