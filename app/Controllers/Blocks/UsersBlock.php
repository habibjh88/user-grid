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
						'selector' => '{{RTTPG}} .csb-users-block-wrapper {text-align: {{grid_alignment}}; }'
					]
				]
			],

			//User Avatar Settings


			'count_visibility' => [
				'type'    => 'string',
				'default' => 'yes',
			],

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
						'selector' => '{{RTTPG}} .csb-users-block-wrapper .user-avatar {width: {{avatar_width}}; }'
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
						'selector' => '{{RTTPG}} .csb-users-block-wrapper .user-avatar {height: {{avatar_height}}; }'
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
						'selector' => '{{RTTPG}} .csb-users-block-wrapper .user-avatar{{avatar_border_radius}}'
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
						'selector' => '{{RTTPG}} .csb-users-block-wrapper .user-avatar'
					]
				]
			],


			'user_tag' => [
				'type'    => 'string',
				'default' => 'h3',
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
		$image_size = ! empty( $data['image_size'] ) ? $data['image_size'] : 'thumbnail';
		$users      = wp_list_pluck( $data['users_lists'], 'value' );


		$default_grid_column_desktop = '24';
		$default_grid_column_tab     = '4';
		$default_grid_column_mobile  = '6';

		$grid_column_desktop = ( isset( $data['grid_column']['lg'] ) && 0 != $data['grid_column']['lg'] ) ? $data['grid_column']['lg'] : $default_grid_column_desktop;
		$grid_column_tab     = ( isset( $data['grid_column']['md'] ) && 0 != $data['grid_column']['md'] ) ? $data['grid_column']['md'] : $default_grid_column_tab;
		$grid_column_mobile  = ( isset( $data['grid_column']['sm'] ) && 0 != $data['grid_column']['sm'] ) ? $data['grid_column']['sm'] : $default_grid_column_mobile;

		$col_class   = "rt-col-md-{$grid_column_desktop} rt-col-sm-{$grid_column_tab} rt-col-xs-{$grid_column_mobile}";
		$uniqueId    = isset( $data['uniqueId'] ) ? $data['uniqueId'] : null;
		$uniqueClass = 'rttpg-block-postgrid rttpg-block-wrapper rttpg-block-' . $uniqueId;
		ob_start();
		?>
        <div class="<?php echo esc_attr( $uniqueClass ) ?>">
            <div class="tpg-user-block-wrapper clearfix">
				<?php if ( is_array( $users ) ) { ?>
                <div class="rt-row">
					<?php
					foreach ( $users

					as $user ) :
					$user_info = get_term( $user );

					?>
                    <div class="cat-item-col <?php echo esc_attr( $col_class ) ?>">

                        <div class="cat-thumb">
                            <a class="cat-link"
                               href="<?php echo esc_url( get_term_link( $user_info ) ) ?>">
								<?php //echo wp_get_attachment_image( $user_thumb, $image_size, null, [ 'class' => 'user-image' ] )
								?>
                            </a>
                        </div>
                        <<?php echo esc_attr( $data['user_tag'] ) ?> class="user-name">
                        <a href="<?php echo esc_url( get_term_link( $user_info ) ) ?>"><?php echo esc_html( $user_info->name ) ?></a>
                    </<?php echo esc_attr( $data['user_tag'] ) ?>>
                </div>
			<?php endforeach; ?>
            </div>
			<?php } else {
				?>
                <p style="padding: 30px;background: #d1ecf1;"><?php echo esc_html__( "Please choose few users from the Users lists.", 'the-post-grid-pro' ); ?></p>
				<?php
			} ?>
        </div>
        </div>
		<?php
		do_action( 'tpg_elementor_script' );

		return ob_get_clean();
	}

}