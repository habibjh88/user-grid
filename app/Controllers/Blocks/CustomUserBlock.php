<?php

namespace GT\GtUsers\Controllers\Blocks;

use GT\GtUsers\Helpers\Fns;

class CustomUserBlock extends BlockBase {

	private $prefix;
	private $block_type;

	public function __construct() {
		add_action( 'init', [ $this, 'register_blocks' ] );
		$this->prefix     = 'category';
		$this->block_type = 'rttpg/custom-users-block';
	}


	/**
	 * Register Block
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

			'prefix' => [
				'type'    => 'string',
				'default' => 'cat',
			],

			'user_limit' => [
				'type'    => 'string',
				'default' => '12',
			],

			'grid_column' => [
				'type'    => 'object',
				'default' => [
					"lg" => 0,
					"md" => 0,
					"sm" => 0,
				],
			],

			'users_lists'           => [
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
				'default' => '@rgbc.dev',
			],

			'grid_gap' => [
				'type'    => 'object',
				"default" => (object) [
					'lg' => '',
					'md' => '',
					'sm' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .rt-row {margin-left:-{{cat_gap}};margin-right:-{{cat_gap}}}
						{{RTTPG}} .rt-row > .cat-item-col {padding-left:{{cat_gap}};padding-right:{{cat_gap}};padding-bottom:{{cat_gap}}}
						'
					]
				]
			],

			'grid_alignment' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper {text-align: {{grid_alignment}}; }'
					]
				]
			],

			'avatar_visibility' => [
				'type'    => 'string',
				'default' => 'yes',
			],

			'name_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'email_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'bio_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'social_visibility' => [
				'type'    => 'string',
				'default' => false,
			],

			//User Avatar Settings
			'avatar_dimension'  => [
				'type'    => 'number',
				'default' => '300',
			],

			'image_link' => [
				'type'    => 'string',
				'default' => 'yes',
			],

			'avatar_width'  => [
				'type'    => 'object',
				"default" => (object) [
					'lg' => '',
					'md' => '',
					'sm' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-avatar {width: {{avatar_width}}; }'
					]
				]
			],
			'avatar_height' => [
				'type'    => 'object',
				"default" => (object) [
					'lg' => '',
					'md' => '',
					'sm' => '',
				],
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-avatar {height: {{avatar_height}}; }'
					]
				]
			],


			"avatar_border_radius" => [
				"type"    => "object",
				"default" => [
					'lg' => [
						"isLinked" => true,
						"unit"     => "px",
						"value"    => ''
					]
				],
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-avatar a{{avatar_border_radius}}'
					]
				]
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
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-avatar'
					]
				]
			],

			//User Name Settings
			'name_tag'      => [
				'type'    => 'string',
				'default' => 'h3',
			],

			'name_typography' => [
				'type'    => 'object',
				'default' => (object) [
					'openTypography' => 1,
					'size'           => (object) [ 'lg' => '', 'unit' => 'px' ],
					'spacing'        => (object) [ 'lg' => '', 'unit' => 'px' ],
					'height'         => (object) [ 'lg' => '', 'unit' => 'px' ],
					'transform'      => '',
					'weight'         => ''
				],
				'style'   => [
					(object) [ 'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-name' ]
				],
			],

			"name_spacing" => [
				"type"    => "object",
				"default" => [
					'lg' => [
						"isLinked" => false,
						"unit"     => "px",
						"value"    => ''
					]
				],
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-name {{name_spacing}}'
					]
				]
			],

			'name_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-name a {color: {{name_color}}; }'
					]
				]
			],

			'name_color_hover' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-name a:hover {color: {{name_color_hover}}; }'
					]
				]
			],

			//Email Settings
			'email_typography' => [
				'type'    => 'object',
				'default' => (object) [
					'openTypography' => 1,
					'size'           => (object) [ 'lg' => '', 'unit' => 'px' ],
					'spacing'        => (object) [ 'lg' => '', 'unit' => 'px' ],
					'height'         => (object) [ 'lg' => '', 'unit' => 'px' ],
					'transform'      => '',
					'weight'         => ''
				],
				'style'   => [
					(object) [ 'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-email' ]
				],
			],

			"email_spacing" => [
				"type"    => "object",
				"default" => [
					'lg' => [
						"isLinked" => false,
						"unit"     => "px",
						"value"    => ''
					]
				],
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-email {{email_spacing}}'
					]
				]
			],

			'email_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-email a {color: {{email_color}}; }'
					]
				]
			],

			'email_color_hover' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-email a:hover {color: {{email_color_hover}}; }'
					]
				]
			],

			//Bio Settings
			'bio_visible_for'   => [
				'type'    => 'string',
				'default' => 'loggedin',
			],

			'show_message_frontend' => [
				'type'    => 'string',
				'default' => '',
			],

			'bio_typography' => [
				'type'    => 'object',
				'default' => (object) [
					'openTypography' => 1,
					'size'           => (object) [ 'lg' => '', 'unit' => 'px' ],
					'spacing'        => (object) [ 'lg' => '', 'unit' => 'px' ],
					'height'         => (object) [ 'lg' => '', 'unit' => 'px' ],
					'transform'      => '',
					'weight'         => ''
				],
				'style'   => [
					(object) [ 'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-biography' ]
				],
			],

			"bio_spacing" => [
				"type"    => "object",
				"default" => [
					'lg' => [
						"isLinked" => false,
						"unit"     => "px",
						"value"    => ''
					]
				],
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-biography {{bio_spacing}}'
					]
				]
			],

			'bio_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '.cub-users-block-wrapper .user-biography {color: {{bio_color}}; }'
					]
				]
			],

			'icon_font_size' => [
				'type'    => 'object',
				"default" => (object) [
					'lg' => '',
					'md' => '',
					'sm' => '',
				],
				'style'   => [
					(object) [
						'selector' => '.cub-user-social-icons a i {font-size:{{icon_font_size}}}'
					]
				]
			],

			"social_spacing" => [
				"type"    => "object",
				"default" => [
					'lg' => [
						"isLinked" => false,
						"unit"     => "px",
						"value"    => ''
					]
				],
				'style'   => [
					(object) [
						'selector' => '.cub-user-social-icons {{social_spacing}}'
					]
				]
			],

			'social_color' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '.cub-user-social-icons a i {color: {{social_color}}; }'
					]
				]
			],

			'social_color_hover' => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{RTTPG}} .cub-user-social-icons a:hover i {color: {{social_color_hover}}; }'
					]
				]
			],

		];

	}

	/**
	 * @return void
	 */
	public function get_script_depends( $data ) {
		wp_enqueue_style( 'rt-tpg-block' );
		wp_enqueue_script( 'rt-tpg' );
		wp_enqueue_script( 'rt-magnific-popup' );
	}

	/**
	 * @param array $data
	 *
	 * @return false|string
	 */
	public function render_block( $data ) {
		$this->get_script_depends( $data );
//		$data       = $this->get_settings();
		//$image_size = ! empty( $data['image_size'] ) ? $data['image_size'] : 'thumbnail';


		$users = wp_list_pluck( $data['users_lists'], 'value' );

		$default_grid_column_desktop = '24';
		$default_grid_column_tab     = '4';
		$default_grid_column_mobile  = '6';

		$grid_column_desktop = ( isset( $data['grid_column']['lg'] ) && 0 != $data['grid_column']['lg'] ) ? $data['grid_column']['lg'] : $default_grid_column_desktop;
		$grid_column_tab     = ( isset( $data['grid_column']['md'] ) && 0 != $data['grid_column']['md'] ) ? $data['grid_column']['md'] : $default_grid_column_tab;
		$grid_column_mobile  = ( isset( $data['grid_column']['sm'] ) && 0 != $data['grid_column']['sm'] ) ? $data['grid_column']['sm'] : $default_grid_column_mobile;

		$col_class     = "cub-col-md-{$grid_column_desktop} cub-col-sm-{$grid_column_tab} cub-col-xs-{$grid_column_mobile}";
		$uniqueId      = isset( $data['uniqueId'] ) ? $data['uniqueId'] : null;
		$wrapper_class = 'rttpg-block-postgrid rttpg-block-wrapper rttpg-block-' . $uniqueId;
		$wrapper_class .= $data['image_link'] == 'yes' ? '' : ' no-image-link';
		ob_start();
		?>
        <div class="<?php echo esc_attr( $wrapper_class ) ?>">
            <div class="cub-users-block-wrapper clearfix">
				<?php if ( is_array( $users ) && ! empty( $users ) ) { ?>
                <div class="cub-row">
					<?php
					foreach ( $users

					as $user ) :
					$user_info        = get_user_by( 'id', $user );
					$avatar_size      = [ 'size' => $data['avatar_dimension'] ?? '300' ];
					$avater_image_url = get_avatar_url( $user_info->ID, $avatar_size );
					$user_bio         = get_user_meta( $user_info->ID, 'description', true );

					?>
                    <div class="user-item-col <?php echo esc_attr( $col_class ) ?>">

                        <div class="user-avatar">
                            <a class="user-link" href="<?php echo esc_url( get_author_posts_url( $user_info->ID ) ) ?>">
                                <img width="<?php echo esc_attr( $avatar_size['size'] ) ?>px"
                                     height="<?php echo esc_attr( $avatar_size['size'] ) ?>px"
                                     src="<?php echo esc_url( $avater_image_url ) ?>"
                                     alt="<?php echo esc_html( $user_info->display_name ) ?>">
                            </a>
                        </div>
                        <<?php echo esc_attr( $data['name_tag'] ) ?> class="user-name">
                        <a href="<?php echo esc_url( get_author_posts_url( $user_info->ID ) ) ?>"><?php echo esc_html( $user_info->display_name ) ?></a>
                    </<?php echo esc_attr( $data['name_tag'] ) ?>>

					<?php if ( $data['email_visibility'] ) : ?>
                        <div class="user-email">
                            <a href="mailto:<?php echo esc_url( $user_info->user_email ) ?>"><?php echo esc_html( $user_info->user_email ) ?></a>
                        </div>
					<?php endif; ?>


                    <div class="cub-user-social-icons">
                        <a class="load-user-button" href="#usermodal">
							<?php echo esc_html( "Load users's biography" ); ?>
                        </a>


                        <div id="usermodal" class="zoom-anim-dialog mfp-hide">
                            <h1>Lorem.</h1>
                            <p>Lorem, ipsum.</p>
                        </div>
                    </div>

					<?php if ( ! is_user_logged_in() && $data['bio_visible_for'] === 'loggedin' ) : ?>
						<?php if ( ! empty( $data['show_message_frontend'] ) ) : ?>
                            <p class="user-biography"><?php echo esc_html( $data['show_message_frontend'] ) ?></p>
						<?php endif; ?>
					<?php else : ?>
                        <p class="user-biography"><?php echo esc_html( $user_bio ) ?></p>
					<?php endif; ?>


                </div>
			<?php endforeach; ?>
            </div>
			<?php } else {
				?>
                <div
                        style="padding: 30px;background: #d1ecf1;"><?php echo esc_html__( "User not found", 'the-post-grid' ); ?></div>
				<?php
			} ?>
        </div>
        </div>
		<?php
		do_action( 'tpg_elementor_script' );

		return ob_get_clean();
	}

}