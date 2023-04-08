<?php
/**
 * Main initialization class.
 *
 * @package GT_USERS
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

require_once __DIR__ . './../vendor/autoload.php';

use GT\GtUsers\Controllers\Api\RestApi;
use GT\GtUsers\Controllers\AjaxController;
use GT\GtUsers\Controllers\BlocksController;
use GT\GtUsers\Controllers\ScriptController;
use GT\GtUsers\Controllers\Hooks\FilterHooks;
use GT\GtUsers\Controllers\Hooks\ActionHooks;
use GT\GtUsers\Helpers\Install;


if ( ! class_exists( GtUsers::class ) ) {
	/**
	 * Main initialization class.
	 */
	final class GtUsers {
		/**
		 * Post Type
		 *
		 * @var string
		 */
		public $post_type = 'gtusers';

		/**
		 * Options
		 *
		 * @var array
		 */
		public $options = [
			'settings'          => 'rt_gtusers_settings',
			'version'           => GT_USERS_VERSION,
			'installed_version' => 'rt_gtusers_current_version',
			'slug'              => GT_USERS_PLUGIN_SLUG,
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

			//Filter hooks init
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
			register_activation_hook( GT_USERS_PLUGIN_FILE, [ Install::class, 'activate' ] );
			register_deactivation_hook( GT_USERS_PLUGIN_FILE, [ Install::class, 'deactivate' ] );

			add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ], - 1 );
			add_action( 'init', [ $this, 'init_hooks' ], 0 );
		}

		/**
		 * Init hooks
		 *
		 * @return void
		 */
		public function init_hooks() {
			do_action( 'gtusers_before_init', $this );

			$this->load_language();
		}

		/**
		 * I18n
		 *
		 * @return void
		 */
		public function load_language() {
			do_action( 'gtusers_set_local', null );
			$locale = determine_locale();
			$locale = apply_filters( 'plugin_locale', $locale, 'gutenberg-users' );
			unload_textdomain( 'gutenberg-users' );
			load_textdomain( 'gutenberg-users', WP_LANG_DIR . '/gutenberg-users/gutenberg-users-' . $locale . '.mo' );
			load_plugin_textdomain( 'gutenberg-users', false, plugin_basename( dirname( GT_USERS_PLUGIN_FILE ) ) . '/languages' );
		}

		/**
		 * Plugin loaded action
		 *
		 * @return void
		 */
		public function on_plugins_loaded() {
			do_action( 'gtusers_loaded', $this );
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( GT_USERS_PLUGIN_FILE ) );
		}


		/**
		 * Nonce text
		 *
		 * @return string
		 */
		public static function nonceText() {
			return 'gtusers_nonce_secret';
		}

		/**
		 * Nonce ID
		 *
		 * @return string
		 */
		public static function nonceId() {
			return 'gtusers_nonce';
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

			return trailingslashit( GT_USERS_PLUGIN_URL . '/assets' ) . $file;
		}

		/**
		 * RTL check.
		 *
		 * @param string $file File.
		 *
		 * @return string
		 */
		public function gtusers_can_be_rtl( $file ) {
			$file = ltrim( str_replace( '.css', '', $file ), '/' );

			if ( is_rtl() ) {
				$file .= '.rtl';
			}

			return trailingslashit( GT_USERS_PLUGIN_URL . '/assets' ) . $file . '.min.css';
		}

		/**
		 * Get the template path.
		 *
		 * @return string
		 */
		public function get_template_path() {
			return apply_filters( 'gtusers_template_path', 'gutenberg-users/' );
		}

	}

	/**
	 * Function for external use.
	 *
	 * @return GtUsers
	 */
	if ( ! function_exists( 'gtUsers' ) ) {
		function gtUsers() {
			return GtUsers::getInstance();
		}

		// Init app.
		gtUsers();
	}
}
