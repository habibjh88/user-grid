<?php
/**
 * Ajax Controller class.
 *
 * @package USER_GRID
 */

namespace USGR\UserGrid\Controllers;

use USGR\UserGrid\Helpers\Fns;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * ShortcodeController User block plugin.
 */
class ShortcodeController {

	/**
	 * Constructor. Hooks into WordPress actions and filters.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_user_grid_post_type' ] );
		add_filter( 'use_block_editor_for_post_type', [ $this, 'force_gutenberg' ], 10, 2 );
		add_filter( 'use_block_editor_for_post', [ $this, 'force_gutenberg_post' ], 10, 2 );
		add_action( 'add_meta_boxes', [ $this, 'add_shortcode_meta_box' ] );
		add_shortcode( 'user_grid', [ $this, 'render_user_grid_shortcode' ] );
		add_action( 'admin_head', [ $this, 'admin_head_css' ] );

		// User Grid columns modify.
		add_filter( 'manage_user_grid_posts_columns', [ $this, 'add_shortcode_column' ] );
		add_action( 'manage_user_grid_posts_custom_column', [ $this, 'render_shortcode_column' ], 10, 2 );
		add_filter( 'manage_edit-user_grid_sortable_columns', [ $this, 'make_shortcode_column_sortable' ] );
	}

	/**
	 * Registers the custom post type 'user_grid' with Gutenberg support.
	 *
	 * @return void
	 */
	public function register_user_grid_post_type() {
		register_post_type(
			'user_grid',
			[
				'labels'        => [
					'name'                  => __( 'User Grids', 'use-grid' ),
					'singular_name'         => __( 'User Grid', 'use-grid' ),
					'menu_name'             => __( 'User Grids', 'use-grid' ),
					'name_admin_bar'        => __( 'User Grid', 'use-grid' ),
					'add_new'               => __( 'Add New', 'use-grid' ),
					'add_new_item'          => __( 'Add New User Grid', 'use-grid' ),
					'edit_item'             => __( 'Edit User Grid', 'use-grid' ),
					'new_item'              => __( 'New User Grid', 'use-grid' ),
					'view_item'             => __( 'View User Grid', 'use-grid' ),
					'search_items'          => __( 'Search User Grids', 'use-grid' ),
					'not_found'             => __( 'No User Grids found', 'use-grid' ),
					'not_found_in_trash'    => __( 'No User Grids found in Trash', 'use-grid' ),
					'all_items'             => __( 'All User Grids', 'use-grid' ),
					'archives'              => __( 'User Grid Archives', 'use-grid' ),
					'insert_into_item'      => __( 'Insert into User Grid', 'use-grid' ),
					'uploaded_to_this_item' => __( 'Uploaded to this User Grid', 'use-grid' ),
					'filter_items_list'     => __( 'Filter User Grids list', 'use-grid' ),
					'items_list'            => __( 'User Grids list', 'use-grid' ),
					'items_list_navigation' => __( 'User Grids list navigation', 'use-grid' ),
				],
				'public'        => true,
				'has_archive'   => false,
				'rewrite'       => [ 'slug' => 'user-grid' ],
				'show_in_rest'  => true,
				'supports'      => [ 'title', 'editor' ],
				'menu_position' => 20,
				'menu_icon'     => USER_GRID_PLUGIN_URL . '/assets/images/icon-22x22.svg',
			]
		);
	}

	/**
	 * Forces the Gutenberg editor for the 'user_grid' post type even if Classic Editor is enabled.
	 *
	 * @param bool   $use_grid_editor Whether the block editor should be used.
	 * @param string $post_type The current post type.
	 *
	 * @return bool
	 */
	public function force_gutenberg( $use_block_editor, $post_type ) {
		if ( $post_type === 'user_grid' ) {
			return true;
		}
		return $use_block_editor;
	}

	/**
	 * Forces Gutenberg editor on individual posts of 'user_grid' post type.
	 *
	 * @param bool    $use_block_editor Whether to use the block editor.
	 * @param WP_Post $post             The current post object.
	 *
	 * @return bool
	 */
	public function force_gutenberg_post( $use_block_editor, $post ) {
		if ( $post instanceof \WP_Post && $post->post_type === 'user_grid' ) {
			return true;
		}
		return $use_block_editor;
	}

	/**
	 * Registers a meta box on the 'user_grid' edit screen.
	 *
	 * @return void
	 */
	public function add_shortcode_meta_box() {
		add_meta_box(
			'user_grid_shortcode',
			'Shortcode',
			[ $this, 'render_shortcode_meta_box' ],
			'user_grid',
			'side',
			'default'
		);
	}

	/**
	 * Displays the shortcode in the meta box for copying.
	 *
	 * @param WP_Post $post The current post object.
	 *
	 * @return void
	 */
	public function render_shortcode_meta_box( $post ) {
		$shortcode = '[user_grid id="' . esc_attr( $post->ID ) . '"]';
		echo '<input type="text" readonly value="' . esc_attr( $shortcode ) . '" style="width:100%;" onclick="this.select();" />';
        echo esc_html__("Copy the shortcode and paste it where you want to display the user grid.", "use-grid");
	}

	/**
	 * Shortcode handler to render the content of a 'user_grid' post.
	 *
	 * @param array $atts Shortcode attributes. Accepts 'id'.
	 *
	 * @return string The post content or empty string.
	 */
	public function render_user_grid_shortcode( $atts ) {
		$atts    = shortcode_atts( [ 'id' => 0 ], $atts );
		$post_id = intval( $atts['id'] );
		$post    = get_post( $post_id );

		if ( $post && $post->post_type === 'user_grid' && $post->post_status === 'publish' ) {
			return apply_filters( 'the_content', $post->post_content );
		}

		return '';
	}

	/**
	 * Adds a custom "Shortcode" column to the admin post list for the "User Builder" post type.
	 *
	 * @param array $columns Existing columns.
	 * @return array Modified columns with the custom shortcode column added after the title.
	 */
	public function add_shortcode_column( $columns ) {
		// Save the 'date' column and remove it temporarily
		$date = $columns['date'];
		unset( $columns['date'] );

		// Inject our custom column right after 'title'
		$new_columns = [];
		foreach ( $columns as $key => $value ) {
			$new_columns[ $key ] = $value;
			if ( 'title' === $key ) {
				$new_columns['user_grid_shortcode'] = __( 'Shortcode', 'user-grid' );
			}
		}

		// Re-add the 'date' column at the end
		$new_columns['date'] = $date;

		return $new_columns;
	}

	/**
	 * Renders the custom shortcode column content in the admin post list.
	 *
	 * @param string $column   Column name.
	 * @param int    $post_id  Post ID.
	 */
	public function render_shortcode_column( $column, $post_id ) {
		if ( 'user_grid_shortcode' === $column ) {
			$shortcode = '[user_grid id="' . esc_attr( $post_id ) . '"]';
			echo '<input style="width:200px;" type="text" readonly value="' . esc_attr( $shortcode ) . '" style="width:100%;" onclick="this.select();" />';
		}
	}

	/**
	 * Makes the custom shortcode column sortable in the admin post list.
	 *
	 * @param array $columns Existing sortable columns.
	 * @return array Modified sortable columns including the shortcode column.
	 */
	public function make_shortcode_column_sortable( $columns ) {
		$columns['user_grid_shortcode'] = 'ID'; // Sorting by ID
		return $columns;
	}

	/**
	 * Outputs custom CSS in the admin head to adjust the menu icon appearance.
	 */
	public function admin_head_css() {
		?>
		<style>
			#adminmenu li.menu-top.menu-icon-user_grid img {
				padding-top: 6px !important;
				opacity: 1;
			}
		</style>
		<?php
	}
}
