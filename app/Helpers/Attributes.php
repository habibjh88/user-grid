<?php

namespace DOWP\UserGrid\Helpers;

class Attributes {
	public static function layout() {
		return [
			'layout_style'     => [
				'type'    => 'string',
				'default' => 'grid',
			],

			'layout'           => [
				'type'    => 'string',
				'default' => 'grid1',
			],

			'grid_height'      => [
				'type'    => 'string',
				'default' => 'height-auto',
			],

			'user_limit'       => [
				'type'    => 'string',
				'default' => '12',
			],

			'grid_column'      => [
				'type'    => 'object',
				'default' => [
					'lg' => 0,
					'md' => 0,
					'sm' => 0,
				],
			],

			'grid_alignment'   => [
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
		];
	}


	public static function query() {
		return [
			'users_lists'           => [
				'type'    => 'array',
				'default' => [],
			],

			'users_role'            => [
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
			'content_order'         => [
				'type'    => 'array',
				'default' => [ 'title', 'designation', 'short_description', 'contact', 'biography', 'social', 'button' ],
			],
		];
	}

	public static function visibility() {
		return [
			'avatar_visibility'      => [
				'type'    => 'string',
				'default' => 'show',
			],

			'name_visibility'        => [
				'type'    => 'string',
				'default' => 'show',
			],

			'designation_visibility' => [
				'type'    => 'string',
				'default' => 'show',
			],

			'email_visibility'       => [
				'type'    => 'string',
				'default' => 'show',
			],

			'phone_visibility'       => [
				'type'    => 'string',
				'default' => 'show',
			],

			'short_desc_visibility'  => [
				'type'    => 'string',
				'default' => 'show',
			],

			'bio_visibility'         => [
				'type'    => 'string',
				'default' => '',
			],

			'social_visibility'      => [
				'type'    => 'string',
				'default' => 'show',
			],

			'button_visibility'      => [
				'type'    => 'string',
				'default' => 'show',
			],
		];
	}


	public static function image() {
		return [
			'avatar_dimension'     => [
				'type'    => 'number',
				'default' => '360',
			],

			'image_link'           => [
				'type'    => 'string',
				'default' => 'yes',
			],

			'default_image'        => [
				'type'    => 'object',
				'default' => [],
			],

			'avatar_width'         => [
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
			'avatar_height'        => [
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

			'avatar_position'      => [
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

			'avatar_border'        => [
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
		];
	}


	public static function user_name() {
		return [
			'name_tag'         => [
				'type'    => 'string',
				'default' => 'h3',
			],

			'name_typography'  => [
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

			'name_spacing'     => [
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

			'name_color'       => [
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

			'line_color'       => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name::before {background-color: {{line_color}} !important; }',
					],
				],
			],
		];
	}


	public static function phone() {
		return [
			'phone_typography' => [
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
					(object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-phone' ],
				],
			],

			'phone_spacing'    => [
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
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-phone {{phone_spacing}}',
					],
				],
			],

			'phone_color'      => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-phone {color: {{phone_color}}; }',
					],
				],
			],

			'phone_color_hover'      => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-phone {color: {{phone_color_hover}}; }',
					],
				],
			],
		];
	}

	public static function email() {
		return [
			'email_typography' => [
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
					(object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-email' ],
				],
			],

			'email_spacing'    => [
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
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-email {{email_spacing}}',
					],
				],
			],

			'email_color'      => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-email {color: {{email_color}}; }',
					],
				],
			],
			'email_color_hover'      => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-email {color: {{email_color_hover}}; }',
					],
				],
			],
		];
	}
	public static function designation() {
		return [
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

			'designation_spacing'    => [
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

			'designation_color'      => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-designation {color: {{designation_color}}; }',
					],
				],
			],
		];
	}

	public static function biography() {
		return [

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

			'bio_spacing'    => [
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

			'bio_color'      => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-biography {color: {{bio_color}}; }',
					],
				],
			],
		];
	}

	public static function short_desc() {
		return [
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

			'short_desc_spacing'    => [
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

			'short_desc_color'      => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-short-desc {color: {{short_desc_color}}; }',
					],
				],
			],
		];
	}

	public static function social() {
		return [
			'icon_font_size'     => [
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

			'social_spacing'     => [
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

			'social_color'       => [
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
		];
	}

	public static function button() {
		return [
			'read_btn_spacing'       => [
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

			'button_style'           => [
				'type'    => 'string',
				'default' => 'btn-default',
			],

			'read_btn_color'         => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn {color: {{read_btn_color}}; }',
					],
				],
			],

			'read_btn_bg'            => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn {background-color: {{read_btn_bg}}; }',
					],
				],
			],

			'read_btn_color_hover'   => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn:hover {color: {{read_btn_color_hover}}; }',
					],
				],
			],

			'read_btn_bg_hover'      => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn:hover {background-color: {{read_btn_bg_hover}}; }',
					],
				],
			],

			'border_color'           => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn {border: 1px solid {{border_color}}; }',
					],
				],
			],

			'border_color_hover'     => [
				'type'    => 'string',
				'default' => '',
				'style'   => [
					(object) [
						'selector' => '{{UserGrid}} .read-articles-btn a.read-btn:hover {border: 1px solid {{border_color_hover}}; }',
					],
				],
			],
		];
	}

	public static function card() {
		return [
			'card_gap'               => [
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

			'card_box_shadow'        => [
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

			'card_padding'           => [
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

			'content_padding'        => [
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

			'card_border'            => [
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

			'card_radius'            => [
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

			'card_bg'                => [
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
}
