<?php

namespace GT\GtUsers\Controllers\Blocks;

use GT\GtUsers\Helpers\Fns;

class UsersBlock extends BlockBase {

	private $prefix;
	private $attribute_args;
	private $block_type;

	public function __construct() {
		add_action( 'init', [ $this, 'register_blocks' ] );
		$this->prefix         = 'category';
		$this->block_type     = 'rgbcode/custom-users-block';
		$this->attribute_args = [
			'prefix'         => $this->prefix,
			'default_layout' => 'slider-layout1'
		];
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

			'grid_column' => [
				'type'    => 'object',
				'default' => [
					"lg" => 0,
					"md" => 0,
					"sm" => 0,
				],
			],

			'users_lists' => [
				'type'    => 'array',
				'default' => [],
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

			'bio_visibility'   => [
				'type'    => 'string',
				'default' => 'show',
			],

			//User Avatar Settings
			'avatar_dimension' => [
				'type'    => 'number',
				'default' => '300',
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
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-avatar{{avatar_border_radius}}'
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

			//Bio Settings
			'bio_visible_for'  => [
				'type'    => 'string',
				'default' => 'loggedin',
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
						'selector' => '{{RTTPG}} .cub-users-block-wrapper .user-biography {color: {{bio_color}}; }'
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

        var_dump($data['name_color']);

		$users = wp_list_pluck( $data['users_lists'], 'value' );

		$default_grid_column_desktop = '24';
		$default_grid_column_tab     = '4';
		$default_grid_column_mobile  = '6';

		$grid_column_desktop = ( isset( $data['grid_column']['lg'] ) && 0 != $data['grid_column']['lg'] ) ? $data['grid_column']['lg'] : $default_grid_column_desktop;
		$grid_column_tab     = ( isset( $data['grid_column']['md'] ) && 0 != $data['grid_column']['md'] ) ? $data['grid_column']['md'] : $default_grid_column_tab;
		$grid_column_mobile  = ( isset( $data['grid_column']['sm'] ) && 0 != $data['grid_column']['sm'] ) ? $data['grid_column']['sm'] : $default_grid_column_mobile;

		$col_class   = "cub-col-md-{$grid_column_desktop} cub-col-sm-{$grid_column_tab} cub-col-xs-{$grid_column_mobile}";
		$uniqueId    = isset( $data['uniqueId'] ) ? $data['uniqueId'] : null;
		$uniqueClass = 'rttpg-block-postgrid rttpg-block-wrapper rttpg-block-' . $uniqueId;
		ob_start();
		?>
        <div class="<?php echo esc_attr( $uniqueClass ) ?>">
            <div class="cub-users-block-wrapper clearfix">
				<?php if ( is_array( $users ) && ! empty( $users ) ) { ?>
                <div class="cub-row">
					<?php
					foreach ( $users

					as $user ) :
					$user_info = get_user_by( 'id', $user );
					$avatar_size = [ 'size' => $data['avatar_dimension'] ?? '300' ];
					$avater_image_url = get_avatar_url( $user_info->ID, $avatar_size );
                    $user_bio = get_user_meta( $user_info->ID, 'description', true );

					?>
                    <div class="user-item-col <?php echo esc_attr( $col_class ) ?>">

                        <div class="user-thumb">
                            <a class="user-link" href="<?php echo esc_url( get_author_posts_url( $user_info->ID ) ) ?>">
                                <img width="<?php echo esc_attr($avatar_size['size'])?>px" height="<?php echo esc_attr($avatar_size['size'])?>px" src="<?php echo esc_url($avater_image_url) ?>" alt="<?php echo esc_html( $user_info->display_name ) ?>">
                            </a>
                        </div>
                        <<?php echo esc_attr( $data['name_tag'] ) ?> class="user-name">
                        <a href="<?php echo esc_url( get_author_posts_url( $user_info->ID ) ) ?>"><?php echo esc_html( $user_info->display_name ) ?></a>
                    </<?php echo esc_attr( $data['name_tag'] ) ?>>

                    <p class="user-biography"><?php echo esc_html( $user_bio ) ?></p>
                </div>
			<?php endforeach; ?>
            </div>
			<?php } else {
				?>
                <p style="padding: 30px;background: #d1ecf1;"><?php echo esc_html__( "Please choose few users from the Users lists.", 'the-post-grid' ); ?></p>
				<?php
			} ?>
        </div>
        </div>
		<?php
		do_action( 'tpg_elementor_script' );

		return ob_get_clean();
	}

}