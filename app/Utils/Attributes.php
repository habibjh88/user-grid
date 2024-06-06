<?php

namespace DOWP\UserGrid\Utils;

/**
 * Attributes Class
 */
// phpcs:ignoreFile
class Attributes {
	public static function layout() {
		return [
			'layout_style'     => [ 'type' => 'string', 'default' => 'grid', ],
			'layout'           => [ 'type' => 'string', 'default' => 'grid1', ],
			'grid_height'      => [ 'type' => 'string', 'default' => 'height-auto', ],
			'user_limit'       => [ 'type' => 'string', 'default' => '12', ],
			'grid_column'      => [ 'type' => 'object', 'default' => [ 'lg' => 0, 'md' => 0, 'sm' => 0, ], ],
			'grid_alignment'   => [ 'type' => 'object', 'default' => [], ],
			'primary_color'    => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} {--dowp-primary: {{primary_color}}; }', ], ], ],
			'primary_dark'     => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} {--dowp-primary-dark: {{primary_dark}}; }', ], ], ],
			'grid_v_alignment' => [ 'type' => 'object', 'default' => [], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper {align-items: {{grid_v_alignment}}; }', ], ], ],
		];
	}


	public static function query() {
		return [
			'users_lists'           => [ 'type' => 'array', 'default' => [], ],
			'users_role'            => [ 'type' => 'array', 'default' => [], ],
			'orderby'               => [ 'type' => 'string', 'default' => '', ],
			'order'                 => [ 'type' => 'string', 'default' => '', ],
			'user_filter_by_domain' => [ 'type' => 'string', 'default' => '', ],
			'enable_order'          => [ 'type' => 'string', 'default' => '', ],
			'content_order_default' => [ 'type' => 'array', 'default' => [ 'name', 'hr_1', 'designation', 'job_role', 'contact', 'biography', 'social', 'hr_2', 'button' ], ],
			'content_order'         => [ 'type' => 'array', 'default' => [ 'name', 'hr_1', 'designation', 'job_role', 'contact', 'biography', 'social', 'hr_2', 'button' ], ],
		];
	}

	public static function visibility() {
		return [
			'avatar_visibility'      => [ 'type' => 'string', 'default' => 'show', ],
			'name_visibility'        => [ 'type' => 'string', 'default' => 'show', ],
			'designation_visibility' => [ 'type' => 'string', 'default' => 'show', ],
			'email_visibility'       => [ 'type' => 'string', 'default' => 'show', ],
			'phone_visibility'       => [ 'type' => 'string', 'default' => 'show', ],
			'job_role_visibility'    => [ 'type' => 'string', 'default' => 'show', ],
			'bio_visibility'         => [ 'type' => 'string', 'default' => '', ],
			'social_visibility'      => [ 'type' => 'string', 'default' => 'show', ],
			'button_visibility'      => [ 'type' => 'string', 'default' => '', ],
			'hr_1_visibility'        => [ 'type' => 'string', 'default' => '', ],
			'hr_2_visibility'        => [ 'type' => 'string', 'default' => '', ],
			'should_show_hr1'        => [ 'type' => 'string', 'default' => 'show', ],
			'should_show_btn'        => [ 'type' => 'string', 'default' => 'show', ],
			'pagination_visibility'  => [ 'type' => 'string', 'default' => '', ],
		];
	}


	public static function image() {
		return [
			'avatar_dimension'     => [ 'type' => 'number', 'default' => '360', ],
			'image_link'           => [ 'type' => 'string', 'default' => 'yes', ],
			'default_image'        => [ 'type' => 'object', 'default' => [], ],
			'avatar_width'         => [ 'type' => 'object', 'default' => (object) [ 'lg' => '', 'md' => '', 'sm' => '' ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar {width: {{avatar_width}}; }', ], ], ],
			'avatar_height'        => [ 'type' => 'object', 'default' => (object) [ 'lg' => '', 'md' => '', 'sm' => '' ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar {height: {{avatar_height}}; }', ], ], ],
			'avatar_position'      => [ 'type' => 'object', 'default' => (object) [ 'lg' => [ 'isLinked' => true, 'unit' => '%', 'value' => '', ], 'md' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar img {object-position: 50% {{avatar_position}}; }', ], ], ],
			'avatar_border_radius' => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar a{{avatar_border_radius}}', ], ], ],
			'avatar_margin'        => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar{{avatar_margin}}', ], ], ],
			'avatar_border'        => [ 'type' => 'object', 'default' => (object) [ 'openTpgBorder' => 1, 'color' => '', 'style' => '', 'width' => '', ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-avatar', ], ], ],
		];
	}

	public static function user_name() {
		return [
			'name_tag'         => [ 'type' => 'string', 'default' => 'h3', ],
			'name_typography'  => [ 'type' => 'object', 'default' => (object) [ 'openTypography' => 1, 'size' => (object) [ 'lg' => '', 'unit' => 'px', ], 'spacing' => (object) [ 'lg' => '', 'unit' => 'px', ], 'height' => (object) [ 'lg' => '', 'unit' => 'px', ], 'transform' => '', 'weight' => '', ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name' ], ], ],
			'name_spacing'     => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name {{name_spacing}}', ], ], ],
			'name_color'       => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name a {color: {{name_color}}; }', ], ], ],
			'name_color_hover' => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name a:hover {color: {{name_color_hover}}; }', ], ], ],
			'line_color'       => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-name::before {background-color: {{line_color}} !important; }', ], ], ],
		];
	}

	public static function phone() {
		return [
			'phone_typography'  => [ 'type' => 'object', 'default' => (object) [ 'openTypography' => 1, 'size' => (object) [ 'lg' => '', 'unit' => 'px', ], 'spacing' => (object) [ 'lg' => '', 'unit' => 'px', ], 'height' => (object) [ 'lg' => '', 'unit' => 'px', ], 'transform' => '', 'weight' => '', ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-phone' ], ], ],
			'phone_spacing'     => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-phone {{phone_spacing}}', ], ], ],
			'phone_color'       => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-phone {color: {{phone_color}}; }', ], ], ],
			'phone_color_hover' => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-phone {color: {{phone_color_hover}}; }', ], ], ],
		];
	}

	public static function email() {
		return [
			'email_typography'  => [ 'type' => 'object', 'default' => (object) [ 'openTypography' => 1, 'size' => (object) [ 'lg' => '', 'unit' => 'px', ], 'spacing' => (object) [ 'lg' => '', 'unit' => 'px', ], 'height' => (object) [ 'lg' => '', 'unit' => 'px', ], 'transform' => '', 'weight' => '', ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-email' ], ], ],
			'email_spacing'     => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-email {{email_spacing}}', ], ], ],
			'email_color'       => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-email {color: {{email_color}}; }', ], ], ],
			'email_color_hover' => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-contact .user-email {color: {{email_color_hover}}; }', ], ], ],
		];
	}

	public static function designation() {
		return [
			'designation_typography' => [ 'type' => 'object', 'default' => (object) [ 'openTypography' => 1, 'size' => (object) [ 'lg' => '', 'unit' => 'px', ], 'spacing' => (object) [ 'lg' => '', 'unit' => 'px', ], 'height' => (object) [ 'lg' => '', 'unit' => 'px', ], 'transform' => '', 'weight' => '', ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-designation' ], ], ],
			'designation_spacing'    => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-designation {{designation_spacing}}', ], ], ],
			'designation_color'      => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-designation {color: {{designation_color}}; }', ], ], ],
		];
	}

	public static function biography() {
		return [
			'bio_typography' => [ 'type' => 'object', 'default' => (object) [ 'openTypography' => 1, 'size' => (object) [ 'lg' => '', 'unit' => 'px', ], 'spacing' => (object) [ 'lg' => '', 'unit' => 'px', ], 'height' => (object) [ 'lg' => '', 'unit' => 'px', ], 'transform' => '', 'weight' => '', ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-biography' ], ], ],
			'bio_spacing'    => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-biography {{bio_spacing}}', ], ], ],
			'bio_color'      => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-biography {color: {{bio_color}}; }', ], ], ],
		];
	}

	public static function job_role() {
		return [
			'job_role_typography' => [ 'type' => 'object', 'default' => (object) [ 'openTypography' => 1, 'size' => (object) [ 'lg' => '', 'unit' => 'px', ], 'spacing' => (object) [ 'lg' => '', 'unit' => 'px', ], 'height' => (object) [ 'lg' => '', 'unit' => 'px', ], 'transform' => '', 'weight' => '', ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-short-desc' ], ], ],
			'job_role_spacing'    => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-short-desc {{job_role_spacing}}', ], ], ],
			'job_role_color'      => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-short-desc {color: {{job_role_color}}; }', ], ], ],
		];
	}

	public static function social() {
		return [
			'social_style'              => [ 'type' => 'string', 'default' => 'social-bg-round' ],
			'icon_font_size'            => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-user-social-icons a {font-size:{{icon_font_size}}px}', ], ] ],
			'social_spacing'            => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-user-social-icons {{social_spacing}}', ], ], ],
			'social_color'              => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-user-social-icons a svg {color: {{social_color}}; }', ], ], ],
			'social_color_hover'        => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-user-social-icons a:hover svg {color: {{social_color_hover}}; }', ], ], ],
			'social_bg'                 => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-user-social-icons a {background-color: {{social_bg}}; }', ], ], ],
			'social_bg_hover'           => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-user-social-icons a:hover {background-color: {{social_bg_hover}}; }', ], ], ],
			'social_border_color'       => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-user-social-icons a:hover {border-color: {{social_border_color}}; }', ], ], ],
			'social_border_color_hover' => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-user-social-icons a:hover {border-color: {{social_border_color_hover}}; }', ], ], ],
		];
	}

	public static function button() {
		return [
			'read_btn_spacing'     => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .read-articles-btn {{read_btn_spacing}}', ], ], ],
			'button_style'         => [ 'type' => 'string', 'default' => 'btn-default', ],
			'read_btn_color'       => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .read-articles-btn a.read-btn {color: {{read_btn_color}}; }', ], ], ],
			'read_btn_bg'          => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .read-articles-btn a.read-btn {background-color: {{read_btn_bg}}; }', ], ], ],
			'read_btn_color_hover' => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .read-articles-btn a.read-btn:hover {color: {{read_btn_color_hover}}; }', ], ], ],
			'read_btn_bg_hover'    => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .read-articles-btn a.read-btn:hover {background-color: {{read_btn_bg_hover}}; }', ], ], ],
			'border_color'         => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .read-articles-btn a.read-btn {border: 1px solid {{border_color}}; }', ], ], ],
			'border_color_hover'   => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .read-articles-btn a.read-btn:hover {border: 1px solid {{border_color_hover}}; }', ], ], ],
		];
	}

	public static function card() {
		return [
			'card_gap'        => [ 'type' => 'object', 'default' => (object) [ 'lg' => '', 'md' => '', 'sm' => '', ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-item-col {padding-left:{{card_gap}};padding-right:{{card_gap}};padding-bottom:calc({{card_gap}} * 2)}						{{UserGrid}} .dowp-users-block-wrapper .dowp-row {margin-left:-{{card_gap}};margin-right:-{{card_gap}}}', ], ], ],
			'card_box_shadow' => [ 'type' => 'object', 'default' => (object) [ 'openShadow' => 1, 'width' => (object) [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, ], 'color' => '', 'inset' => false, 'transition' => 0.5, ], 'style' => [ (object) [ 'selector' => '{{dowp}} .dowp-users-block-wrapper .user-item-col .user-inner-wrapper' ], ], ],
			'card_padding'    => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper {{card_padding}}', ], ], ],
			'content_padding' => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper .user-content-wrap {{content_padding}}', ], ], ],
			'card_border'     => [ 'type' => 'object', 'default' => (object) [ 'openTpgBorder' => 1, 'color' => '', 'style' => '', 'width' => '', ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper', ], ], ],
			'card_radius'     => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper{{card_radius}}', ], ], ],
			'card_bg'         => [ 'type' => 'object', 'default' => (object) [ 'openBGColor' => 0, 'type' => 'classic', 'classic' => (object) [ 'color' => '', 'img' => (object) [ 'imgURL' => '', 'imgID' => '', ], 'imgProperty' => (object) [ 'imgPosition' => (object) [ 'lg' => '' ], 'imgAttachment' => (object) [ 'lg' => '' ], 'imgRepeat' => (object) [ 'lg' => '' ], 'imgSize' => (object) [ 'lg' => '' ], ], ], 'gradient' => null, ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .user-inner-wrapper', ], ], ],
			'multiple_bg'     => [ 'type' => 'string', 'default' => '' ],
			'lift_box_hover'  => [ 'type' => 'string', 'default' => '' ],
		];
	}

	public static function horizontal_line() {
		return [
			'hr1_spacing' => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .hr-1 {{hr1_spacing}}' ] ], ],
			'hr2_spacing' => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .hr-2 {{hr2_spacing}}' ] ], ],
			'hr1_color'   => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .hr-1 span {background-color: {{hr1_color}}; }', ], ], ],
			'hr2_color'   => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .hr-2 span {background-color: {{hr2_color}}; }', ], ], ],
			'hr1_width'   => [ 'type' => 'object', 'default' => (object) [ 'lg' => [ 'isLinked' => true, 'unit' => '%', 'value' => '', ], 'md' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .hr-1 span {width: {{hr1_width}}; }', ], ], ],
			'hr1_height'  => [ 'type' => 'object', 'default' => (object) [ 'lg' => [ 'isLinked' => true, 'unit' => '%', 'value' => '', ], 'md' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .hr-1 span {height: {{hr1_height}}; }', ], ], ],
			'hr1_radius'  => [ 'type' => 'object', 'default' => (object) [ 'lg' => [ 'isLinked' => true, 'unit' => '%', 'value' => '', ], 'md' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .hr-1 span {border-radius: {{hr1_radius}}; }', ], ], ],
			'hr2_width'   => [ 'type' => 'object', 'default' => (object) [ 'lg' => [ 'isLinked' => true, 'unit' => '%', 'value' => '', ], 'md' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .hr-2 span {width: {{hr2_width}}; }', ], ], ],
			'hr2_height'  => [ 'type' => 'object', 'default' => (object) [ 'lg' => [ 'isLinked' => true, 'unit' => '%', 'value' => '', ], 'md' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => true, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .hr-2 span {height: {{hr2_height}}; }', ], ], ],
		];
	}

	public static function pagination() {
		return [
			'pagination_style'      => [ 'type' => 'string', 'default' => 'nav-default' ],
			'pagination_typography' => [ 'type' => 'object', 'default' => (object) [ 'openTypography' => 1, 'size' => (object) [ 'lg' => '', 'unit' => 'px', ], 'spacing' => (object) [ 'lg' => '', 'unit' => 'px', ], 'height' => (object) [ 'lg' => '', 'unit' => 'px', ], 'transform' => '', 'weight' => '', ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .dowp-pagination' ], ], ],
			'pagination_spacing'    => [ 'type' => 'object', 'default' => [ 'lg' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'md' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], 'sm' => [ 'isLinked' => false, 'unit' => 'px', 'value' => '', ], ], 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-pagination {{pagination_spacing}}', ], ], ],
			'pagination_color'      => [ 'type' => 'string', 'default' => '', 'style' => [ (object) [ 'selector' => '{{UserGrid}} .dowp-users-block-wrapper .dowp-pagination {color: {{pagination_color}}; }', ], ], ],
		];
	}
}