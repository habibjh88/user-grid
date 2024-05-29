<?php

namespace DOWP\UserGrid\Controllers\Blocks;

use DOWP\UserGrid\Helpers\Fns;

/**
 * UserBlock Class
 */
class UserBlock extends BlockBase {

	private $prefix;
	private $block_type;

	/**
	 * Class Constructor
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_blocks' ] );
		$this->block_type = 'dowp/user-grid';
	}

	/**
	 * Register Block
	 *
	 * @return void
	 */
	public function register_blocks() {
		register_block_type(
			$this->block_type,
			[
				'render_callback' => [ $this, 'render_block' ],
				'attributes'      => $this->get_attributes(),
			]
		);
	}

	/**
	 * Get attributes
	 *
	 * @param bool $default
	 *
	 * @return array
	 */
	public function get_attributes() {

		return [
			'uniqueId' => [
				'type'    => 'string',
				'default' => '',
			],

			'preview' => [
				'type'    => 'boolean',
				'default' => false,
			],

			'layout_style' => [
				'type'    => 'string',
				'default' => 'grid',
			],

			'layout' => [
				'type'    => 'string',
				'default' => 'grid1',
			],

			'grid_height' => [
				'type'    => 'string',
				'default' => 'height-auto',
			],

			'user_limit' => [
				'type'    => 'string',
				'default' => '12',
			],

			'grid_column' => [
				'type'    => 'object',
				'default' => [
					'lg' => 0,
					'md' => 0,
					'sm' => 0,
				],
			],

			'users_lists' => [
				'type'    => 'array',
				'default' => [],
			],

			'content_order' => [
				'type'    => 'array',
				'default' => [ 'title', 'designation', 'short_description', 'biography', 'social', 'button' ],
			],

			'users_role' => [
				'type'    => 'array',
				'default' => [],
			],

			'orderby'               => [
				'type'    => 'string',
				'default' => '',
			],
			'order'                 => [
				'type'    => 'string',
				'default' => '',
			],
			'user_filter_by_domain' => [
				'type'    => 'string',
				'default' => '',
			],

			'grid_gap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'md' => '',
					'sm' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .rt-row {margin-left:-{{cat_gap}};margin-right:-{{cat_gap}}}
						{{UserGrid}} .rt-row > .cat-item-col {padding-left:{{cat_gap}};padding-right:{{cat_gap}};padding-bottom:{{cat_gap}}}
						',
					],
				],
			],

			'grid_alignment' => [
				'type'    => 'object',
				'default' => [],
			],

			'grid_v_alignment' => [
				'type'    => 'object',
				'default' => [],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper {align-items: {{grid_v_alignment}}; }',
					],
				],
			],

			'avatar_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'name_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'designation_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'email_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'phone_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'short_desc_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'bio_visibility' => [
				'type'    => 'string',
				'default' => '',
			],

			'social_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'button_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			// User Avatar Settings.
			'avatar_dimension'  => [
				'type'    => 'number',
				'default' => '360',
			],

			'image_link' => [
				'type'    => 'string',
				'default' => 'yes',
			],

			'default_image' => [
				'type'    => 'object',
				'default' => [],
			],

			'avatar_width'  => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'md' => '',
					'sm' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar {width: {{avatar_width}}; }',
					],
				],
			],
			'avatar_height' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'md' => '',
					'sm' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar {height: {{avatar_height}}; }',
					],
				],
			],

			'avatar_position' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => [
						'isLinked' => true,
						'unit'     => '%',
						'value'    => '',
					],
					'md' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar img {object-position: 50% {{avatar_position}}; }',
					],
				],
			],

			'avatar_border_radius' => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar a{{avatar_border_radius}}',
					],
				],
			],
			'avatar_margin'        => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar{{avatar_margin}}',
					],
				],
			],

			'avatar_border' => [
				'type'    => 'object',
				'default' => (object) [
					'openTpgBorder' => 1,
					'color'         => '',
					'style'         => '',
					'width'         => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar',
					],
				],
			],

			// User Name Settings
			'name_tag'      => [
				'type'    => 'string',
				'default' => 'h3',
			],

			'name_typography' => [
				'type'    => 'object',
				'default' => (object) [
					'openTypography' => 1,
					'size'           => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'spacing'        => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'height'         => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'transform'      => '',
					'weight'         => '',
				],
				'style'   => [
					(object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name' ],
				],
			],

			'name_spacing' => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name {{name_spacing}}',
					],
				],
			],

			'name_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name a {color: {{name_color}}; }',
					],
				],
			],

			'name_color_hover' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name a:hover {color: {{name_color_hover}}; }',
					],
				],
			],

			'line_color'             => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name::before {background-color: {{line_color}} !important; }',
					],
				],
			],

			// Email Settings
			'designation_typography' => [
				'type'    => 'object',
				'default' => (object) [
					'openTypography' => 1,
					'size'           => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'spacing'        => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'height'         => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'transform'      => '',
					'weight'         => '',
				],
				'style'   => [
					(object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-designation' ],
				],
			],

			'designation_spacing' => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-designation {{designation_spacing}}',
					],
				],
			],

			'designation_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-designation {color: {{designation_color}}; }',
					],
				],
			],

			// Bio Settings

			'bio_typography' => [
				'type'    => 'object',
				'default' => (object) [
					'openTypography' => 1,
					'size'           => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'spacing'        => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'height'         => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'transform'      => '',
					'weight'         => '',
				],
				'style'   => [
					(object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-biography' ],
				],
			],

			'bio_spacing' => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-biography {{bio_spacing}}',
					],
				],
			],

			'bio_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-biography {color: {{bio_color}}; }',
					],
				],
			],

			// Short Description.

			'short_desc_typography' => [
				'type'    => 'object',
				'default' => (object) [
					'openTypography' => 1,
					'size'           => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'spacing'        => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'height'         => (object) [
						'lg'   => '',
						'unit' => 'px',
					],
					'transform'      => '',
					'weight'         => '',
				],
				'style'   => [
					(object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-short-desc' ],
				],
			],

			'short_desc_spacing' => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-short-desc {{short_desc_spacing}}',
					],
				],
			],

			'short_desc_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-short-desc {color: {{short_desc_color}}; }',
					],
				],
			],

			// Social Style
			'icon_font_size'   => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'md' => '',
					'sm' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-user-social-icons a i {font-size:{{icon_font_size}}}
						{{UserGrid}} .dowp-user-social-icons a svg {width:calc({{icon_font_size}} - 2px); height: {{icon_font_size}}}',
					],
				],
			],

			'social_spacing' => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-user-social-icons {{social_spacing}}',
					],
				],
			],

			'social_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-user-social-icons a i {color: {{social_color}}; }
						{{UserGrid}} .dowp-user-social-icons a svg path {fill: {{social_color}}; }',
					],
				],
			],

			'social_color_hover' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-user-social-icons a:hover i {color: {{social_color_hover}}; }',
					],
				],
			],

			'read_btn_spacing' => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => false,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn {{read_btn_spacing}}',
					],
				],
			],

			'button_style' => [
				'type'    => 'string',
				'default' => 'btn-default',
			],

			'read_btn_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn {color: {{read_btn_color}}; }',
					],
				],
			],

			'read_btn_bg' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn {background-color: {{read_btn_bg}}; }',
					],
				],
			],

			'read_btn_color_hover' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn:hover {color: {{read_btn_color_hover}}; }',
					],
				],
			],

			'read_btn_bg_hover' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn:hover {background-color: {{read_btn_bg_hover}}; }',
					],
				],
			],

			'border_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn {border: 1px solid {{border_color}}; }',
					],
				],
			],

			'border_color_hover' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn:hover {border: 1px solid {{border_color_hover}}; }',
					],
				],
			],

			'card_gap' => [
				'type'    => 'object',
				'default' => (object) [
					'lg' => '',
					'md' => '',
					'sm' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-item-col {padding-left:{{card_gap}};padding-right:{{card_gap}};padding-bottom:calc({{card_gap}} * 2)}
						{{UserGrid}} .dowp-users-block-wrapper .dowp-row {margin-left:-{{card_gap}};margin-right:-{{card_gap}}}',
					],
				],
			],

			'card_box_shadow' => [
				'type'    => 'object',
				'default' => (object) [
					'openShadow' => 1,
					'width'      => (object) [
						'top'    => 0,
						'right'  => 0,
						'bottom' => 0,
						'left'   => 0,
					],
					'color'      => '',
					'inset'      => false,
					'transition' => 0.5,
				],
				'style'   => [
					(object) [ 'selector' => '{{dowp}} .dowp-users-block-wrapper .user-item-col .user-inner-wrapper' ],
				],
			],

			'card_padding' => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper {{card_padding}}',
					],
				],
			],

			'content_padding' => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper .user-content-wrap {{content_padding}}',
					],
				],
			],

			'card_border' => [
				'type'    => 'object',
				'default' => (object) [
					'openTpgBorder' => 1,
					'color'         => '',
					'style'         => '',
					'width'         => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper',
					],
				],
			],

			'card_radius' => [
				'type'    => 'object',
				'default' => [
					'lg' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
					'md' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
					'sm' => [
						'isLinked' => true,
						'unit'     => 'px',
						'value'    => '',
					],
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper{{card_radius}}',
					],
				],
			],

			'card_bg' => [
				'type'    => 'object',
				'default' => (object) [
					'openBGColor' => 0,
					'type'        => 'classic',
					'classic'     => (object) [
						'color'       => '',
						'img'         => (object) [
							'imgURL' => '',
							'imgID'  => '',
						],
						'imgProperty' => (object) [
							'imgPosition'   => (object) [ 'lg' => '' ],
							'imgAttachment' => (object) [ 'lg' => '' ],
							'imgRepeat'     => (object) [ 'lg' => '' ],
							'imgSize'       => (object) [ 'lg' => '' ],
						],
					],
					'gradient'    => null,
				],
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper',
					],
				],
			],

		];
	}


	/**
	 * @param array $data
	 *
	 * @return false|string
	 */
	public function render_block( $data ) {

		ob_start();

		$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$user_limit = $data['user_limit'] ?? 6;
		if ( $paged == 1 ) {
			$offset = 0;
		} else {
			$offset = ( $paged - 1 ) * $user_limit;
		}

		$args = [
			'number' => $user_limit,
			'offset' => $offset
		];

		if ( ! empty( $data['users_role'] ) ) {
			$args['role__in'] = wp_list_pluck( $data['users_role'], 'value' );
		}

		if ( ! empty( $data['orderby'] ) ) {
			$args['orderby'] = $data['orderby'];
		}

		if ( ! empty( $data['order'] ) ) {
			$args['order'] = $data['order'];
		}

		if ( ! empty( $data['user_filter_by_domain'] ) ) {
			$args['search']         = '*' . $data['user_filter_by_domain'] . '*';
			$args['search_columns'] = [ 'user_email' ];
		}

		if ( ! empty( $data['users_lists'] ) ) {
			$args['include'] = wp_list_pluck( $data['users_lists'], 'value' );
			$args['orderby'] = 'include';
		}


		$user_query    = new \WP_User_Query( $args );  // get_users( $args );
		$uniqueId      = $data['uniqueId'] ?? null;
		$wrapper_class = 'dowp-block-usergrid dowp-block-wrapper dowp-block-' . $uniqueId;
		$wrapper_class .= 'yes' == $data['image_link'] ? '' : ' no-image-link';

		$inner_class = preg_replace( '/[0-9]/', '', $data['layout'] ) . '-style';
		$inner_class .= Fns::extendClass( $data['layout'] );
		$inner_class .= ' dowp-' . $data['layout'];
		$inner_class .= ' ' . $data['grid_height'];
		$inner_class .= ' ' . Fns::layout_align( $data['grid_alignment'] );
		$layout_data = Fns::get_post_args( $data );
		?>

        <div class="<?php echo esc_attr( $wrapper_class ); ?>">
            <div class="dowp-users-block-wrapper clearfix <?php echo esc_attr( $inner_class ); ?>">
				<?php if ( ! empty( $user_query->results ) ) { ?>
                    <div class="dowp-row">
						<?php
						foreach ( $user_query->results as $user ) {
							$user_id                     = $user->ID;
							$layout_data['user_id']      = $user_id;
							$layout_data['display_name'] = $user->display_name;
							$layout_data['email']        = $user->user_email;
							$layout_data['designation']  = get_user_meta( $user_id, 'user_grid_designation', true );
							$layout_data['description']  = get_user_meta( $user_id, 'description', true );
							$layout_data['phone']        = get_user_meta( $user_id, 'user_grid_phone', true );
							$layout_data['short_desc']   = get_user_meta( $user_id, 'user_grid_short_desc', true );
							Fns::get_template( $data['layout'], $layout_data );
						}
						?>
                    </div>
					<?php
				} else {
					?>
                    <div class="not-found-wrap">
						<?php echo esc_html__( "Sorry! No user's found.", 'user-grid' ); ?>
                    </div>
					<?php
				}
				?>
            </div>

			<?php

			$total_user  = $user_query->total_users;
			$total_pages = ceil( $total_user / $user_limit );

			echo paginate_links( [
				'base'      => get_pagenum_link( 1 ) . '%_%',
				'format'    => '?paged=%#%',
				'current'   => $paged,
				'total'     => $total_pages,
				'prev_text' => 'Previous',
				'next_text' => 'Next',
				'type'      => 'list',
			] );
			?>
        </div>
		<?php

		do_action( 'dowp_elementor_script' );

		return ob_get_clean();
	}
}
