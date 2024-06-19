<?php

namespace DOWP\UserGrid\Controllers;

use DOWP\UserGrid\Blocks\UserBlock;
use DOWP\UserGrid\Helpers\Fns;

class BlocksController {

	/**
	 * Css Handler to generate dynamic ss for guten blocks
	 */
	private $version;

	public function __construct() {

		// Layout initialize
		new UserBlock();

		$this->version = defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : USER_GRID_VERSION;
		add_action( 'enqueue_block_editor_assets', [ $this, 'editor_assets' ] );

		// All css/js file load in back-end and front-end
		add_action( 'wp_enqueue_scripts', [ $this, 'dowp_block_enqueue' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'dowp_block_enqueue' ] );

		if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
			add_filter( 'block_categories_all', [ $this, 'dowp_block_categories' ], 1, 2 );
		} else {
			add_filter( 'block_categories', [ $this, 'dowp_block_categories' ], 1, 2 );
		}

		add_action( 'wp_ajax_dowp_block_css_save', [ $this, 'save_block_css' ] );
		add_action( 'wp_ajax_dowp_block_css_get_posts', [ $this, 'get_posts_call' ] );
		add_action( 'wp_ajax_dowp_block_css_appended', [ $this, 'appended' ] );

		// Decide how css file will be loaded. default filesystem eg: filesystem or at header
		$option_data = get_option( 'dowp_options' );
		if ( isset( $option_data['css_save_as'] ) && 'filesystem' === $option_data['css_save_as'] ) {
			add_action( 'wp_enqueue_scripts', [ $this, 'add_block_css_file' ] );
		} else {
			add_action( 'wp_head', [ $this, 'add_block_inline_css' ], 100 );
		}
	}


	/**
	 * Block Category Add
	 *
	 * @param $categories
	 * @param $post
	 *
	 * @return array|\string[][]|\void[][]
	 */
	public function dowp_block_categories( $categories, $post ) {
		return array_merge(
			[
				[
					'slug'  => 'dowp',
					'title' => __( 'RGB Code', 'user-grid' ),
				],
			],
			$categories
		);
	}


	/**
	 * Add Block File CSS
	 *
	 * @return void
	 */
	public function add_block_css_file() {

		$post_id         = get_the_ID();
		$dowp_upload_dir = wp_upload_dir()['basedir'] . '/dowp/';
		$dowp_upload_url = wp_upload_dir()['baseurl'] . '/dowp/';
		// phpcs:ignore
		if ( isset( $_GET['preview'] ) && ! empty( $_GET['preview'] ) ) {
			$css_path = $dowp_upload_dir . 'dowp-block-preview.css';

			if ( file_exists( $css_path ) ) {
				if ( ! $this->is_editor_screen() ) {
					wp_enqueue_style( 'dowp-block-post-preview', $dowp_upload_url . 'dowp-block-preview.css', false, $this->version );
				}
			}
		} elseif ( $post_id ) {
			$css_dir_path = $dowp_upload_dir . "dowp-block-$post_id.css";
			$css_dir_url  = $dowp_upload_dir . "dowp-block-$post_id.css";

			if ( file_exists( $css_dir_path ) ) {
				if ( ! $this->is_editor_screen() ) {
					wp_enqueue_style( "dowp-block-post-{$post_id}", $css_dir_url, false, $this->version );
				}
				$this->add_reusable_css();
			} else {
				// phpcs:ignore
				wp_register_style( 'dowp-post-data', false );
				wp_enqueue_style( 'dowp-post-data' );
				wp_add_inline_style( 'dowp-post-data', get_post_meta( get_the_ID(), '_dowp_block_css', true ) );
			}
		}
	}

	/**
	 * Admin editor css load
	 *
	 * @return void
	 */
	public function dowp_block_enqueue() {
		if ( ! is_admin() ) {
			return;
		}

		wp_enqueue_style( 'dowp-block' );
		wp_enqueue_script( 'dowp-script' );
	}


	/**
	 * Determine if wppb editor is open
	 *
	 * @return bool
	 */
	private function is_editor_screen() {
		if ( ! empty( $_GET['action'] ) && 'wppb_editor' === $_GET['action'] ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return true;
		}

		return false;
	}


	/**
	 * Load Editor Assets
	 *
	 * @return void
	 */
	public function editor_assets() {

		// Block editor css.
		wp_enqueue_style( 'dowp-block-admin', userGrid()->dowp_can_be_rtl( 'css/block-admin' ), '', $this->version );

		// Main compile css and js file.
		wp_enqueue_style( 'dowp-blocks-css', userGrid()->get_assets_uri( 'blocks/main.css' ), '', $this->version );
		wp_enqueue_script(
			'dowp-blocks-js',
			userGrid()->get_assets_uri( 'blocks/main.js' ),
			[
				'wp-block-editor',
				'wp-blocks',
				'wp-components',
				'wp-element',
				'wp-i18n',
			],
			$this->version,
			true
		);

		global $pagenow;
		$editor_type = 'edit-post';

		if ( 'site-editor.php' === $pagenow ) {
			$editor_type = 'edit-site';
		}

		wp_localize_script(
			'dowp-blocks-js',
			'dowpParams',
			[
				'editor_type' => $editor_type,
				'nonce'       => wp_create_nonce( 'dowp_nonce' ),
				'ajaxurl'     => Fns::ajax_url(),
				'site_url'    => site_url(),
				'admin_url'   => admin_url(),
				'plugin_url'  => USER_GRID_PLUGIN_URL,
				'hasPro'      => userGrid()->hasPro(),
			]
		);
	}


	/**
	 * Add inLine css for page or post
	 *
	 * @return void
	 */
	public function add_block_inline_css() {

		$post_id = get_the_ID();
		if ( $post_id ) {
			$dowp_upload_dir = wp_upload_dir()['basedir'] . '/dowp/';
			$css_dir_path    = $dowp_upload_dir . "dowp-block-$post_id.css";
			if ( file_exists( $css_dir_path ) ) {
				$blockCss = file_get_contents( $css_dir_path ); //phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
				echo '<style>' . sanitize_textarea_field( $blockCss ) . '</style>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} elseif ( $metaCss = get_post_meta( $post_id, '_dowp_block_css', true ) ) {
				echo '<style>' . sanitize_textarea_field( $metaCss ) . '</style>';  //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		$this->add_reusable_css();
	}


	/**
	 * Add reusable css
	 *
	 * @return void
	 */
	public function add_reusable_css() {
		$post_id         = get_the_ID();
		$dowp_upload_dir = wp_upload_dir()['basedir'] . '/dowp/';
		$dowp_upload_url = wp_upload_dir()['baseurl'] . '/dowp/';
		if ( $post_id ) {
			$content_post = get_post( $post_id );
			if ( isset( $content_post->post_content ) ) {
				$content      = $content_post->post_content;
				$parse_blocks = parse_blocks( $content );
				$css_id       = $this->reference_id( $parse_blocks );
				if ( is_array( $css_id ) ) {
					if ( ! empty( $css_id ) ) {
						$css_id = array_unique( $css_id );
						foreach ( $css_id as $value ) {
							$css_dir_path = $dowp_upload_dir . "dowp-block-$value.css";
							if ( file_exists( $css_dir_path ) ) {
								wp_enqueue_style( "dowp-block-{$value}", $dowp_upload_url . "dowp-block-{$value}.css", false, UserGrid_VERSION );
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Save Import CSS in the top of the File
	 *
	 * @return void
	 */
	public function save_block_css() {

		try {
			if ( ! current_user_can( 'edit_posts' ) ) {
				throw new Exception( __( 'User permission error', 'user-grid' ) );
			}

			check_ajax_referer( 'dowp_nonce', 'nonce' );

			global $wp_filesystem;
			if ( ! $wp_filesystem ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
			}

			$post_id  = ! empty( $_POST['post_id'] ) ? sanitize_text_field( $_POST['post_id'] ) : '';
			$blockCss = ! empty( $_POST['block_css'] ) ? sanitize_text_field( $_POST['block_css'] ) : '';

			if ( $post_id == 'dowp-widget' && isset( $_POST['has_block'] ) ) {
				update_option( $post_id, $blockCss );
				wp_send_json_success( [ 'message' => __( 'Widget CSS Saved', 'user-grid' ) ] );
			}

			$filename       = "dowp-block-css-{$post_id}.css";
			$upload_dir_url = wp_upload_dir();
			$dir            = trailingslashit( $upload_dir_url['basedir'] ) . 'dowp/';

			if ( ! empty( $_POST['has_block'] ) ) {

				update_post_meta( $post_id, '_dowp_block_active', 1 );
				$block_css = $this->set_top_css( $blockCss );

				WP_Filesystem( false, $upload_dir_url['basedir'], true );
				if ( ! $wp_filesystem->is_dir( $dir ) ) {
					$wp_filesystem->mkdir( $dir );

				}
				if ( ! $wp_filesystem->put_contents( $dir . $filename, $block_css ) ) {
					wp_send_json_error( [ 'message' => __( 'CSS can not be saved due to permission!!!', 'user-grid' ) ] );
				}
				update_post_meta( $post_id, '_dowp_block_css', $block_css );
				wp_send_json_success( [ 'message' => __( 'Css file has been updated', 'user-grid' ) ] );
			} else {
				delete_post_meta( $post_id, '_dowp_block_active' );
				if ( file_exists( $dir . $filename ) ) {
					wp_delete_file( $dir . $filename );
				}
				delete_post_meta( $post_id, '_dowp_block_css' );
				wp_send_json_success( [ 'message' => __( 'Data Delete Done', 'user-grid' ) ] );
			}
		} catch ( Exception $e ) {
			wp_send_json_error( [ 'message' => $e->getMessage() ] );
		}
	}

	/**
	 * Save Import CSS in the top of the File
	 *
	 * @param $get_css
	 *
	 * @return mixed|string
	 */
	public function set_top_css( $get_css = '' ) {
		$css_url     = "@import url('https://fonts.googleapis.com/css?family=";
		$font_exists = substr_count( $get_css, $css_url );
		if ( $font_exists ) {
			$pattern = sprintf( '/%s(.+?)%s/ims', preg_quote( $css_url, '/' ), preg_quote( "');", '/' ) );
			if ( preg_match_all( $pattern, $get_css, $matches ) ) {
				$fonts   = $matches[0];
				$get_css = str_replace( $fonts, '', $get_css );
				if ( preg_match_all( '/font-weight[ ]?:[ ]?[\d]{3}[ ]?;/', $get_css, $matche_weight ) ) {
					$weight = array_map(
						function ( $val ) {
							$process = trim( str_replace( [ 'font-weight', ':', ';' ], '', $val ) );
							if ( is_numeric( $process ) ) {
								  return $process;
							}
						},
						$matche_weight[0]
					);
					foreach ( $fonts as $key => $val ) {
						$fonts[ $key ] = str_replace( "');", '', $val ) . ':' . implode( ',', $weight ) . "');";
					}
				}
				$fonts   = array_unique( $fonts );
				$get_css = implode( '', $fonts ) . $get_css;
			}
		}

		return $get_css;
	}

	/**
	 * Save Import CSS in the top of the File
	 *
	 * @return void
	 */
	public function get_posts_call() {
		check_ajax_referer( 'dowp_nonce', 'nonce' );
		$post_id = isset( $_POST['postId'] ) ? absint( $_POST['postId'] ) : '';
		if ( $post_id ) {
			wp_send_json_success( get_post( $post_id )->post_content );
		} else {
			wp_send_json_error( new WP_Error( 'dowp_block_data_not_found', __( 'Data not found!!', 'user-grid' ) ) );
		}
	}

	/**
	 * Save Import CSS in the top of the File
	 *
	 * @param $server
	 *
	 * @return void
	 */
	public function appended( $server ) {
		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_success( new WP_Error( 'dowp_block_user_permission', __( 'User permission error', 'user-grid' ) ) );
		}
		global $wp_filesystem;
		if ( ! $wp_filesystem ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}
		$post    = $server->get_params();
		$css     = $post['inner_css'];
		$post_id = (int) sanitize_text_field( $post['post_id'] );

		if ( $post_id ) {
			$upload_dir_url = wp_upload_dir();
			$filename       = "dowp-block-css-$post_id.css";
			$dir            = trailingslashit( $upload_dir_url['basedir'] ) . 'dowp/';
			WP_Filesystem( false, $upload_dir_url['basedir'], true );
			if ( ! $wp_filesystem->is_dir( $dir ) ) {
				$wp_filesystem->mkdir( $dir );
			}
			if ( ! $wp_filesystem->put_contents( $dir . $filename, $css ) ) {
				wp_send_json_error( [ 'message' => __( 'CSS can not be saved due to permission!!!', 'user-grid' ) ] );
			}
			wp_send_json_success( [ 'message' => __( 'Data retrieve done', 'user-grid' ) ] );
		} else {
			wp_send_json_error( [ 'message' => __( 'Data not found!!', 'user-grid' ) ] );
		}
	}

	/**
	 * Return reference id
	 *
	 * @param $parse_blocks
	 *
	 * @return array
	 */
	public function reference_id( $parse_blocks ) {
		$extra_id = [];
		if ( ! empty( $parse_blocks ) ) {
			foreach ( $parse_blocks as $key => $block ) {
				if ( $block['blockName'] == 'core/block' ) {
					$extra_id[] = $block['attrs']['ref'];
				}
				if ( count( $block['innerBlocks'] ) > 0 ) {
					$extra_id = array_merge( $this->reference_id( $block['innerBlocks'] ), $extra_id );
				}
			}
		}

		return $extra_id;
	}
}
