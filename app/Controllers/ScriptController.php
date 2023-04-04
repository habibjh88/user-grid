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

		$current_page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';

		if ( 'rttpg_settings' === $current_page ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
		}

		// register scripts.
		$scripts = [];
		$styles  = [];

		$scripts[] = [
			'handle' => 'rt-tpg',
			'src'    => rtTPG()->get_assets_uri( 'js/rttpg.js' ),
			'deps'   => [ 'jquery' ],
			'footer' => true,
		];

		// register acf styles.
		$styles['rt-fontawsome'] = rtTPG()->get_assets_uri( 'vendor/font-awesome/css/font-awesome.min.css' );

		if ( Fns::tpg_option('tpg_icon_font') === 'flaticon' ) {
			$styles['rt-flaticon'] = rtTPG()->get_assets_uri( 'vendor/flaticon/flaticon_tpg.css' );
		}

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
		$block_type = isset( $this->settings['tpg_block_type'] ) ? $this->settings['tpg_block_type'] : 'default';
		wp_enqueue_script( 'jquery' );

		if ( ! isset( $this->settings['tpg_load_script'] ) ) {
			wp_enqueue_style( 'rt-fontawsome' );
			wp_enqueue_style( 'rt-flaticon' );

			if ( 'default' === $block_type ) {
				wp_enqueue_style( 'rt-tpg' );
			}

			if ( 'elementor' === $block_type ) {
				wp_enqueue_style( 'rt-tpg-block' );
			}

			if ( 'shortcode' === $block_type ) {
				wp_enqueue_style( 'rt-tpg-shortcode' );
			}
		}

		$scriptBefore = isset( $this->settings['script_before_item_load'] ) ? stripslashes( $this->settings['script_before_item_load'] ) : null;
		$scriptAfter  = isset( $this->settings['script_after_item_load'] ) ? stripslashes( $this->settings['script_after_item_load'] ) : null;
		$scriptLoaded = isset( $this->settings['script_loaded'] ) ? stripslashes( $this->settings['script_loaded'] ) : null;

		$script = "(function($){
						$('.rt-tpg-container').on('tpg_item_before_load', function(){{$scriptBefore}});
						$('.rt-tpg-container').on('tpg_item_after_load', function(){{$scriptAfter}});
						$('.rt-tpg-container').on('tpg_loaded', function(){{$scriptLoaded}});
					})(jQuery);";
		wp_add_inline_script( 'rt-tpg', $script );
	}


}
