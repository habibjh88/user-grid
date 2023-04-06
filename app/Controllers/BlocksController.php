<?php

namespace GT\GtUsers\Controllers;

use GT\GtUsers\Controllers\Blocks\GridLayout;
use GT\GtUsers\Controllers\Blocks\CustomUserBlock;
use GT\GtUsers\Helpers\Fns;

class BlocksController {

	/**
	 * Css Handler to generate dynamic ss for guten blocks
	 */
	private $version;

	public function __construct() {

		//Layout initialize
		new GridLayout();
		new CustomUserBlock();

		$this->version = defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : GT_USERS_VERSION;
		add_action( 'enqueue_block_editor_assets', [ $this, 'editor_assets' ] );

		//All css/js file load in back-end and front-end
		add_action( 'wp_enqueue_scripts', [ $this, 'tpg_block_enqueue' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'tpg_block_enqueue' ] );

		if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
			add_filter( 'block_categories_all', [ $this, 'rttpg_block_categories' ], 1, 2 );
		} else {
			add_filter( 'block_categories', [ $this, 'rttpg_block_categories' ], 1, 2 );
		}

		add_action( 'wp_ajax_rttpg_block_css_save', [ $this, 'save_block_css' ] );
		add_action( 'wp_ajax_rttpg_block_css_get_posts', [ $this, 'get_posts_call' ] );
		add_action( 'wp_ajax_rttpg_block_css_appended', [ $this, 'appended' ] );


		// Decide how css file will be loaded. default filesystem eg: filesystem or at header
		$option_data = get_option( 'rttpg_options' );
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
	public function rttpg_block_categories( $categories, $post ) {
		return array_merge(
			[
				[
					'slug'  => 'rttpg',
					'title' => __( 'RGB Code', 'the-post-grid' ),
				],
			],
			$categories
		);
	}


	/**
	 * Add Block files foe css
	 *
	 * @return void
	 */
	public function add_block_css_file() {

		$post_id          = get_the_ID();
		$rttpg_upload_dir = wp_upload_dir()['basedir'] . '/rttpg/';
		$rttpg_upload_url = wp_upload_dir()['baseurl'] . '/rttpg/';
		// phpcs:ignore
		if ( isset( $_GET['preview'] ) && ! empty( $_GET['preview'] ) ) {
			$css_path = $rttpg_upload_dir . 'rttpg-block-preview.css';

			if ( file_exists( $css_path ) ) {
				if ( ! $this->is_editor_screen() ) {
					wp_enqueue_style( 'rttpg-block-post-preview', $rttpg_upload_url . 'rttpg-block-preview.css', false, $this->version );
				}
			}
		} else if ( $post_id ) {
			$css_dir_path = $rttpg_upload_dir . "rttpg-block-$post_id.css";
			$css_dir_url  = $rttpg_upload_dir . "rttpg-block-$post_id.css";

			if ( file_exists( $css_dir_path ) ) {
				if ( ! $this->is_editor_screen() ) {
					wp_enqueue_style( "rttpg-block-post-{$post_id}", $css_dir_url, false, $this->version );
				}
				$this->add_reusable_css();
			} else {
				// phpcs: ignore
				wp_register_style( 'rttpg-post-data', false );
				wp_enqueue_style( 'rttpg-post-data' );
				wp_add_inline_style( 'rttpg-post-data', get_post_meta( get_the_ID(), '_rttpg_block_css', true ) );
			}
		}
	}

	/**
	 * Common css load
	 * @return void
	 */
	public function tpg_block_enqueue() {

		if ( ! is_admin() ) {
			return;
		}

		wp_enqueue_style( 'rt-fontawsome' );
		wp_enqueue_style( 'rt-flaticon' );
		wp_enqueue_style( 'rt-tpg-block' );

		//Custom CSS From Settings
		$css = isset( $settings['custom_css'] ) ? stripslashes( $settings['custom_css'] ) : null;
		if ( $css ) {
			wp_add_inline_style( 'rt-tpg-block', $css );
		}
	}


	/**
	 * Determine if wppb editor is open
	 *
	 * @return bool
	 *
	 * @since V.1.0.0
	 * @since v.1.0.0
	 */
	private function is_editor_screen() {
		if ( ! empty( $_GET['action'] ) && 'wppb_editor' === $_GET['action'] ) {
			return true;
		}

		return false;
	}


	/**
	 * Load Editor Assets
	 * @return void
	 */
	public function editor_assets() {

		//Block editor css
		wp_enqueue_style( 'rttpg-block-admin-css', rtTPG()->get_assets_uri( 'css/admin/block-admin.css' ), '', $this->version );

		//Main compile css and js file
		wp_enqueue_style( 'rttpg-blocks-css', rtTPG()->get_assets_uri( 'blocks/main.css' ), '', $this->version );
		wp_enqueue_script( 'rttpg-blocks-js', rtTPG()->get_assets_uri( 'blocks/main.js' ), [
			'wp-block-editor',
			'wp-blocks',
			'wp-components',
			'wp-element',
			'wp-i18n',
		], $this->version, true );
		$all_dependencies = [
			'lodash',
			'wp-i18n',
			'wp-element',
			'wp-hooks',
			'wp-util',
			'wp-components',
			'wp-blocks',
			'wp-data',
			'wp-editor',
			'wp-block-editor',
		];
		global $pagenow;
		$editor_type = 'edit-post';

		if ( 'post-new.php' === $pagenow || 'post.php' === $pagenow ) {
			$all_dependencies[] = 'wp-edit-post';
		}

		if ( 'site-editor.php' === $pagenow ) {
			$all_dependencies[] = 'wp-edit-site';
			$editor_type        = 'edit-site';
		}

		$get_tax_object = get_taxonomies( [], 'objects' );
		$exclude_tax    = Fns::get_excluded_taxonomy();
		foreach ( $exclude_tax as $_tax ) {
			unset( $get_tax_object[ $_tax ] );
		}

		wp_localize_script( 'rttpg-blocks-js', 'rttpgParams', [
				'editor_type'     => $editor_type,
				'nonce'           => wp_create_nonce( 'rttpg_nonce' ),
				'ajaxurl'         => admin_url( 'admin-ajax.php' ),
				'site_url'        => site_url(),
				'admin_url'       => admin_url(),
				'plugin_url'      => GT_USERS_PLUGIN_URL,
				'plugin_pro_url'  => rtTPG()->getProPath(),
				'post_type'       => Fns::get_post_types(),
				'all_term_list'   => Fns::get_all_taxonomy_guten(),
				'get_taxonomies'  => $get_tax_object,
				'get_users'       => Fns::rt_get_users(),
				'hasPro'          => rtTPG()->hasPro(),
				'pageTitle'       => get_the_title(),
				'hasWoo'          => Fns::is_woocommerce(),
				'hasAcf'          => Fns::is_acf(),
				'current_user_id' => get_current_user_id(),
				'disableImportButton'    => apply_filters('rttpg_disable_gutenberg_import_button', 'no'), //Send 'yes' if you would like to remove the button for gutenberg
				'iconFont' => Fns::tpg_option('tpg_icon_font')
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
			$rttpg_upload_dir = wp_upload_dir()['basedir'] . '/rttpg/';
			$css_dir_path     = $rttpg_upload_dir . "rttpg-block-$post_id.css";
			if ( file_exists( $css_dir_path ) ) {
				$blockCss = file_get_contents( $css_dir_path );
				echo '<style>' . sanitize_textarea_field( $blockCss ) . '</style>';
			} else if ( $metaCss = get_post_meta( $post_id, '_rttpg_block_css', true ) ) {
				echo '<style>' . sanitize_textarea_field( $metaCss ) . '</style>';
			}
		}

		$this->add_reusable_css();

	}


	/**
	 * Add reusable css
	 */
	public function add_reusable_css() {
		$post_id          = get_the_ID();
		$rttpg_upload_dir = wp_upload_dir()['basedir'] . '/rttpg/';
		$rttpg_upload_url = wp_upload_dir()['baseurl'] . '/rttpg/';
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
							$css_dir_path = $rttpg_upload_dir . "rttpg-block-$value.css";
							if ( file_exists( $css_dir_path ) ) {
								wp_enqueue_style( "rttpg-block-{$value}", $rttpg_upload_url . "rttpg-block-{$value}.css", false, RTTPG_VERSION );
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
	 * @return void Array of the Custom Message
	 */
	public function save_block_css() {

		try {
			if ( ! current_user_can( 'edit_posts' ) ) {
				throw new Exception( __( 'User permission error', 'the-post-grid' ) );
			}
			global $wp_filesystem;
			if ( ! $wp_filesystem ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}

			$post_id  = ! empty( $_POST['post_id'] ) ? sanitize_text_field( $_POST['post_id'] ) : '';
			$blockCss = ! empty( $_POST['block_css'] ) ? sanitize_text_field( $_POST['block_css'] ) : '';

			if ( $post_id == 'rttpg-widget' && isset( $_POST['has_block'] ) ) {
				update_option( $post_id, $blockCss );
				wp_send_json_success( [ 'message' => __( 'Widget CSS Saved', 'the-post-grid' ) ] );
			}

			$filename       = "rttpg-block-css-{$post_id}.css";
			$upload_dir_url = wp_upload_dir();
			$dir            = trailingslashit( $upload_dir_url['basedir'] ) . 'rttpg/';

			if ( ! empty( $_POST['has_block'] ) ) {

				update_post_meta( $post_id, '_rttpg_block_active', 1 );
				$block_css = $this->set_top_css( $blockCss );

				WP_Filesystem( false, $upload_dir_url['basedir'], true );
				if ( ! $wp_filesystem->is_dir( $dir ) ) {
					$wp_filesystem->mkdir( $dir );

				}
				if ( ! $wp_filesystem->put_contents( $dir . $filename, $block_css ) ) {
					wp_send_json_error( [ 'message' => __( 'CSS can not be saved due to permission!!!', 'the-post-grid' ) ] );
				}
				update_post_meta( $post_id, '_rttpg_block_css', $block_css );
				wp_send_json_success( [ 'message' => __( 'Css file has been updated', 'the-post-grid' ) ] );
			} else {
				delete_post_meta( $post_id, '_rttpg_block_active' );
				if ( file_exists( $dir . $filename ) ) {
					unlink( $dir . $filename );
				}
				delete_post_meta( $post_id, '_rttpg_block_css' );
				wp_send_json_success( [ 'message' => __( 'Data Delete Done', 'the-post-grid' ) ] );
			}
		} catch ( Exception $e ) {
			wp_send_json_error( [ 'message' => $e->getMessage() ] );
		}
	}

	/**
	 * Save Import CSS in the top of the File
	 *
	 * @param STRING
	 *
	 * @return STRING
	 * @since v.1.0.0
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
					$weight = array_map( function ( $val ) {
						$process = trim( str_replace( [ 'font-weight', ':', ';' ], '', $val ) );
						if ( is_numeric( $process ) ) {
							return $process;
						}
					}, $matche_weight[0] );
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
		$post_id = absint( $_POST['postId'] );
		if ( $post_id ) {
			wp_send_json_success( get_post( $post_id )->post_content );
		} else {
			wp_send_json_error( new WP_Error( 'rttpg_block_data_not_found', __( 'Data not found!!', 'the-post-grid' ) ) );
		}
	}

	/**
	 * Save Import CSS in the top of the File
	 *
	 *
	 * @return void
	 * @throws Exception
	 * @since v.1.0.0
	 */
	public function appended( $server ) {
		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_success( new WP_Error( 'rttpg_block_user_permission', __( 'User permission error', 'the-post-grid' ) ) );
		}
		global $wp_filesystem;
		if ( ! $wp_filesystem ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}
		$post    = $server->get_params();
		$css     = $post['inner_css'];
		$post_id = (int) sanitize_text_field( $post['post_id'] );

		if ( $post_id ) {
			$upload_dir_url = wp_upload_dir();
			$filename       = "rttpg-block-css-$post_id.css";
			$dir            = trailingslashit( $upload_dir_url['basedir'] ) . 'rttpg/';
			WP_Filesystem( false, $upload_dir_url['basedir'], true );
			if ( ! $wp_filesystem->is_dir( $dir ) ) {
				$wp_filesystem->mkdir( $dir );
			}
			if ( ! $wp_filesystem->put_contents( $dir . $filename, $css ) ) {
				wp_send_json_error( [ 'message' => __( 'CSS can not be saved due to permission!!!', 'the-post-grid' ) ] );
			}
			wp_send_json_success( [ 'message' => __( 'Data retrieve done', 'the-post-grid' ) ] );
		} else {
			wp_send_json_error( [ 'message' => __( 'Data not found!!', 'the-post-grid' ) ] );
		}
	}

	/**
	 * Return reference id
	 *
	 * @param array $parse_blocks
	 *
	 * @return bool
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