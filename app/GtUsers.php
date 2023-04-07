<?php
/**
 * Main initialization class.
 *
 * @package RT_TPG
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

require_once __DIR__ . './../vendor/autoload.php';

use GT\GtUsers\Controllers\Api\RestApi;
use GT\GtUsers\Controllers\AjaxController;
use GT\GtUsers\Controllers\BlocksController;
use GT\GtUsers\Controllers\GutenBergController;
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
			'settings'          => 'rt_the_post_grid_settings',
			'version'           => GT_USERS_VERSION,
			'installed_version' => 'rt_the_post_grid_current_version',
			'slug'              => GT_USERS_PLUGIN_SLUG,
		];

		/**
		 * Defaut Settings
		 *
		 * @var array
		 */
		public $defaultSettings = [
			'tpg_block_type'     => 'default',
			'popup_fields'       => [
				'title',
				'feature_img',
				'content',
				'post_date',
				'author',
				'categories',
				'tags',
				'social_share',
			],
			'social_share_items' => [
				'facebook',
				'twitter',
				'linkedin',
			],
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
			new GutenBergController();
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
			add_filter( 'wp_calculate_image_srcset', [ $this, 'calculate_image_srcset' ] );
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
		 * Remove calculate image srcset
		 * @return array
		 */
		public function calculate_image_srcset() {
			return [];
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
			load_textdomain( 'gutenberg-users', WP_LANG_DIR . '/the-post-grid/the-post-grid-' . $locale . '.mo' );
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
		 * Plugin template path
		 *
		 * @return string
		 */
		public function plugin_template_path() {
			$plugin_template = $this->plugin_path() . '/templates/';

			return apply_filters( 'tlp_tpg_template_path', $plugin_template );
		}

		/**
		 * Default template path
		 *
		 * @return string
		 */
		public function default_template_path() {
			return apply_filters( 'gtusers_default_template_path', untrailingslashit( plugin_dir_path( GT_USERS_PLUGIN_FILE ) ) );
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
		public function tpg_can_be_rtl( $file ) {
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
			return apply_filters( 'gtusers_template_path', 'the-post-grid/' );
		}


		/**
		 * Pro check.
		 *
		 * @return boolean
		 */
		public function hasPro() {
			return class_exists( 'GtUsersPro' );
		}

	}

	/**
	 * Function for external use.
	 *
	 * @return GtUsers
	 */
	function gtUsers() {
		return GtUsers::getInstance();
	}

	// Init app.
	gtUsers();
}
