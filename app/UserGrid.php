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

require_once NSER_GRID_PLUGIN_BASE_DIR . 'vendor/autoload.php';


use DOWP\UserGrid\Controllers\Api\RestApi;
use DOWP\UserGrid\Controllers\AjaxController;
use DOWP\UserGrid\Controllers\BlocksController;
use DOWP\UserGrid\Controllers\ScriptController;
use DOWP\UserGrid\Controllers\Hooks\FilterHooks;
use DOWP\UserGrid\Controllers\Hooks\ActionHooks;
use DOWP\UserGrid\Helpers\Install;


if ( ! class_exists( UserGrid::class ) ) {
	/**
	 * Main initialization class.
	 */
	final class UserGrid {
		/**
		 * Post Type
		 *
		 * @var string
		 */
		public $post_type = 'dowp';

		public $avatar_meta_key = 'user_grid_attachment_id';

		/**
		 * Options
		 *
		 * @var array
		 */
		public $options = [
			'settings'          => 'rt_dowp_settings',
			'version'           => USER_GRID_VERSION,
			'installed_version' => 'rt_dowp_current_version',
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

			//Filter hooks init.
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
			do_action( 'dowp_before_init', $this );

			$this->load_language();
		}

		/**
		 * I18n
		 *
		 * @return void
		 */
		public function load_language() {
			do_action( 'dowp_set_local', null );
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
			do_action( 'dowp_loaded', $this );
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
			return 'dowp_nonce_secret';
		}

		/**
		 * Nonce ID
		 *
		 * @return string
		 */
		public static function nonceId() {
			return 'dowp_nonce';
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
		public function dowp_can_be_rtl( $file ) {
			$file = ltrim( str_replace( '.css', '', $file ), '/' );

			if ( is_rtl() ) {
				$file .= '.rtl';
			}

			return trailingslashit( USER_GRID_PLUGIN_URL . '/assets' ) . $file . '.min.css';
		}

		/**
		 * Get the template path.
		 *
		 * @return string
		 */
		public function get_template_path() {
			return apply_filters( 'dowp_template_path', 'user-grid/' );
		}

	}

	/**
	 * Function for external use.
	 *
	 * @return UserGrid
	 */
	if ( ! function_exists( 'userGrid' ) ) {
		function userGrid() {
			return UserGrid::getInstance();
		}

		// Init app.
		userGrid();
	}
}
