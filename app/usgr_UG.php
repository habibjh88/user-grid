<?php
/**
 * Main initialization class.
 *
 * @package USER_GRID
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

require_once USER_GRID_PLUGIN_BASE_DIR . 'vendor/autoload.php';

use USGR\UserGrid\Controllers\AjaxController;
use USGR\UserGrid\Controllers\BlocksController;
use USGR\UserGrid\Controllers\ScriptController;
use USGR\UserGrid\Hooks\ActionHooks;
use USGR\UserGrid\Hooks\FilterHooks;
use USGR\UserGrid\Helpers\Install;
use USGR\UserGrid\Api\RestApi;

if ( ! class_exists( usgr_UG::class ) ) {
	/**
	 * Main initialization class.
	 */
	final class usgr_UG {

		/**
		 * Avatar meta key
		 *
		 * @var string
		 */
		public $avatar_meta_key = 'usgr_attachment_id';

		/**
		 * Options
		 *
		 * @var array
		 */
		public $options = [
			'settings'          => 'usgr_settings',
			'version'           => USER_GRID_VERSION,
			'installed_version' => 'usgr_version',
			'slug'              => USER_GRID_PLUGIN_SLUG,
		];

		/**
		 * Store the singleton object.
		 *
		 * @var boolean
		 */
		private static $singleton = false;

		/**
		 * Create an inaccessible constructor.
		 */
		private function __construct() {
			$this->__init();
		}

		/**
		 * Fetch an instance of the class.
		 */
		public static function getInstance() {
			if ( false === self::$singleton ) {
				self::$singleton = new self();
			}

			return self::$singleton;
		}

		/**
		 * Class init
		 *
		 * @return void
		 */
		protected function __init() {
			new RestApi();
			new AjaxController();
			new ScriptController();
			new BlocksController();

			// Filter hooks init.
			FilterHooks::init();
			ActionHooks::init();

			$this->load_hooks();
		}

		/**
		 * Load hooks
		 *
		 * @return void
		 */
		private function load_hooks() {
			register_activation_hook( USER_GRID_PLUGIN_FILE, [ Install::class, 'activate' ] );
			register_deactivation_hook( USER_GRID_PLUGIN_FILE, [ Install::class, 'deactivate' ] );

			add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ], - 1 );
			add_action( 'init', [ $this, 'init_hooks' ], 0 );
		}

		/**
		 * Init hooks
		 *
		 * @return void
		 */
		public function init_hooks() {
			do_action( 'usgr_before_init', $this );

			$this->load_language();
		}

		/**
		 * I18n
		 *
		 * @return void
		 */
		public function load_language() {
			do_action( 'usgr_set_local', null );
			$locale = determine_locale();
			$locale = apply_filters( 'plugin_locale', $locale, 'user-grid' );
			unload_textdomain( 'user-grid' );
			load_textdomain( 'user-grid', WP_LANG_DIR . '/user-grid/user-grid-' . $locale . '.mo' );
			load_plugin_textdomain( 'user-grid', false, plugin_basename( dirname( USER_GRID_PLUGIN_FILE ) ) . '/languages' );
		}

		/**
		 * Plugin loaded action
		 *
		 * @return void
		 */
		public function on_plugins_loaded() {
			do_action( 'usgr_ug_loaded', $this );
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( USER_GRID_PLUGIN_FILE ) );
		}


		/**
		 * Nonce text
		 *
		 * @return string
		 */
		public static function nonceText() {
			return 'usgr_nonce_secret';
		}

		/**
		 * Nonce ID
		 *
		 * @return string
		 */
		public static function nonceId() {
			return 'usgr_nonce';
		}

		/**
		 * Get assets URI
		 *
		 * @param string $file File.
		 *
		 * @return string
		 */
		public function get_assets_uri( $file ) {
			$file = ltrim( $file, '/' );

			return trailingslashit( USER_GRID_PLUGIN_URL . '/assets' ) . $file;
		}

		/**
		 * RTL check.
		 *
		 * @param string $file File.
		 *
		 * @return string
		 */
		public function usgr_can_be_rtl( $file, $checkPro = '' ) {

			if ( is_rtl() ) {
				$file .= '.rtl';
			}

			if ( $checkPro && usgrUG()->hasPro() ) {
				return trailingslashit( USER_GRID_PRO_PLUGIN_URL . '/assets/' ) . $file . '.css';
			}

			return trailingslashit( USER_GRID_PLUGIN_URL . '/assets/' ) . $file . '.css';
		}

		/**
		 * Check Pro Plugin
		 *
		 * @return boolean
		 */
		public function hasPro() {
			return class_exists( 'usgr_UG_Pro' );
		}
	}


	if ( ! function_exists( 'usgrUG' ) ) {
		/**
		 * Function for external use.
		 *
		 * @return usgr_UG
		 */
		function usgrUG() {
			return usgr_UG::getInstance();
		}

		// Init app.
		usgrUG();
	}
}
