<?php
/**
 * Script Controller class.
 *
 * @package RT_TPG
 */

namespace GT\GtUsers\Controllers;

// Do not allow directly accessing this file.
use GT\GtUsers\Helpers\Fns;

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
		$this->version = defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : GT_USERS_VERSION;
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
		add_action( 'init', [ $this, 'init' ] );
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
			'handle' => 'rt-magnific-popup',
			'src'    => rtTPG()->get_assets_uri( 'vendor/jquery.magnific-popup.min.js' ),
			'deps'   => [ 'jquery' ],
			'footer' => true,
		];

		$scripts[] = [
			'handle' => 'rt-tpg',
			'src'    => rtTPG()->get_assets_uri( 'js/rttpg.js' ),
			'deps'   => [ 'jquery', 'rt-magnific-popup' ],
			'footer' => true,
		];


		// Plugin specific css.
		$styles['rt-tpg-block']     = rtTPG()->tpg_can_be_rtl( 'css/block' );


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
		wp_enqueue_style( 'rt-tpg-block' );

        wp_enqueue_style('dashicons');

        $nonce = wp_create_nonce( rtTPG()->nonceText() );

		wp_localize_script( 'rt-tpg', 'rttpgParams', [
                'nonceID' => esc_attr( rtTPG()->nonceId() ),
                'nonce'   => esc_attr( $nonce ),
				'ajaxurl'         => admin_url( 'admin-ajax.php' ),
			]
		);
	}


}
