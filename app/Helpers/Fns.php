<?php
/**
 * Helper class.
 *
 * @package USER_GRID
 */

namespace DOWP\UserGrid\Helpers;

// Do not allow directly accessing this file.
use DOWP\UserGrid\Utils\SvgIcons;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Helper class.
 */
class Fns {

	/**
	 * Allowed HTML for wp_kses.
	 *
	 * @param $html
	 * @param $echo
	 *
	 * @return string
	 */
	public static function print_html( $html, $echo = true, $context = 'basic' ) {
		$allowed_html = [];
		if ( 'basic' == $context ) {
			$allowed_html = [
				'b'      => [
					'class' => [],
					'id'    => [],
				],
				'i'      => [
					'class' => [],
					'id'    => [],
				],
				'u'      => [
					'class' => [],
					'id'    => [],
				],
				'br'     => [
					'class' => [],
					'id'    => [],
				],
				'em'     => [
					'class' => [],
					'id'    => [],
				],
				'span'   => [
					'class' => [],
					'id'    => [],
				],
				'strong' => [
					'class' => [],
					'id'    => [],
				],
				'hr'     => [
					'class' => [],
					'id'    => [],
				],
				'a'      => [
					'href'   => [],
					'title'  => [],
					'class'  => [],
					'id'     => [],
					'target' => [],
				],
				'input'  => [
					'type'  => [],
					'name'  => [],
					'class' => [],
					'value' => [],
				],
				'img'    => [
					'src'      => [],
					'data-src' => [],
					'alt'      => [],
					'height'   => [],
					'width'    => [],
					'class'    => [],
					'id'       => [],
					'style'    => [],
					'srcset'   => [],
					'loading'  => [],
					'sizes'    => [],
				],
				'div'    => [
					'class' => [],
				],
			];
		}

		if ( $echo ) {
			echo wp_kses( $html, $allowed_html );
		} else {
			return wp_kses( $html, $allowed_html );
		}
	}


	/**
	 * Prints HTMl.
	 *
	 * @param $html
	 * @param $allHtml
	 *
	 * @return void
	 */
	public static function print_html_all( $html, $allHtml = false ) {
		if ( ! $html ) {
			return;
		}
		if ( $allHtml ) {
			echo stripslashes_deep( $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			echo wp_kses_post( stripslashes_deep( $html ) );
		}
	}

	/**
	 * Get Ajax URL.
	 *
	 * @return string
	 */
	public static function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}


	public static function doing_it_wrong( $function, $message, $version ) {
		// @codingStandardsIgnoreStart
		$message .= ' Backtrace: ' . wp_debug_backtrace_summary();
		_doing_it_wrong( $function, $message, $version );
	}

	/**
	 * @param        $template_name
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return mixed|void
	 */
	public static function locate_template( $template_name, $template_path = '', $default_path = '' ) {
		$template_name = $template_name . ".php";
		if ( ! $template_path ) {
			$template_path = 'user-grid/';
		}

		if ( ! $default_path ) {
			$default_path = untrailingslashit( USER_GRID_PLUGIN_BASE_DIR ) . '/templates/';
		}

		$template_files = trailingslashit( $template_path ) . $template_name;

		$template = locate_template( apply_filters( 'user_grid_locate_template_files', $template_files, $template_name, $template_path, $default_path ) );

		// Get default template.
		if ( ! $template ) {
			$template = trailingslashit( $default_path ) . $template_name;
		}


		return apply_filters( 'user_grid_locate_template', $template, $template_name );
	}

	/**
	 * Template Content
	 *
	 * @param string $template_name Template name.
	 * @param array $args Arguments. (default: array).
	 * @param string $template_path Template path. (default: '').
	 * @param string $default_path Default path. (default: '').
	 */
	public static function get_template( $template_name, $args = null, $template_path = '', $default_path = '' ) {

		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args ); // @codingStandardsIgnoreLine
		}

		$located = self::locate_template( $template_name, $template_path, $default_path );

		if ( ! file_exists( $located ) ) {
			$default_path = untrailingslashit( USER_GRID_PRO_PLUGIN_BASE_DIR ) . '/templates/';
			$located      = self::locate_template( $template_name, $template_path, $default_path );
		}

		// Allow 3rd party plugin filter template file from their plugin.
		$located = apply_filters( 'user_grid_get_template', $located, $template_name, $args );

		do_action( 'user_grid_before_template_part', $template_name, $located, $args );

		include $located;

		do_action( 'user_grid_after_template_part', $template_name, $located, $args );
	}

	/**
	 * Verify nonce.
	 *
	 * @return bool
	 */
	public static function verifyNonce() {
		$nonce     = isset( $_REQUEST[ userGrid()->nonceId() ] ) ? sanitize_text_field( wp_unslash( $_REQUEST[ userGrid()->nonceId() ] ) ) : null;
		$nonceText = userGrid()->nonceText();

		if ( ! wp_verify_nonce( $nonce, $nonceText ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Get user social icon
	 *
	 * @param $user_id
	 *
	 * @return false|string
	 */
	public static function get_user_social_icon( $user_id, $email_visibility, $phone_visibility ) {

		$social_list = self::social_list();
		$user_info   = get_user_by( 'id', $user_id );
		$email       = $user_info->user_email;

		if ( $phone_visibility === 'show' ) {
			unset($social_list['phone']);
		}

		foreach ( $social_list as $icon => $label ) {
			$meta_key   = "user_grid_{$icon}";
			$meta_value = get_user_meta( $user_id, $meta_key, true );

			if ( $meta_value ) {
				?>
				<a class="<?php echo esc_attr( $icon ) ?>"
				   href="<?php echo esc_url( $meta_value ) ?>">
					<?php SvgIcons::get_svg( $icon ); ?>
				</a>
				<?php
			}
		}

		if ( $email_visibility !== 'show' ) {
			?>
			<a class="pinterest"
			   href="mailto:<?php echo esc_attr( $email ) ?>"><?php SvgIcons::get_svg( 'email' ); ?></a>
			<?php
		}
		if ( $phone_visibility !== 'show' ) {
			$phone = get_user_meta( $user_id, 'user_grid_phone', true );
			?>
			<a class="phone"
			   href="call:<?php echo esc_attr( $phone ) ?>"><?php SvgIcons::get_svg( 'phone' ); ?></a>
			<?php
		}
		?>

		<?php
	}

	/**
	 * Social List
	 * @return mixed|null
	 */
	public static function social_list() {
		return apply_filters( 'user_grid_social_list', [
			'phone'      => esc_html__( 'Phone', 'user-grid' ),
			'twitter'    => esc_html__( 'Twitter', 'user-grid' ),
			'facebook'   => esc_html__( 'Facebook', 'user-grid' ),
			'linkedin'   => esc_html__( 'LinkedIn', 'user-grid' ),
			'googleplus' => esc_html__( 'Google+', 'user-grid' ),
			'pinterest'  => esc_html__( 'Pinterest', 'user-grid' ),
			'instagram'  => esc_html__( 'Instagram', 'user-grid' ),
			'whatsapp'   => esc_html__( 'WhatsApp', 'user-grid' ),
			'skype'      => esc_html__( 'Skype', 'user-grid' ),
			'tiktok'     => esc_html__( 'TikTok', 'user-grid' ),
			'youtube'    => esc_html__( 'YouTube', 'user-grid' ),
			'reddit'     => esc_html__( 'Reddit', 'user-grid' ),
		] );
	}

	/**
	 * Get Dynamic columns for each block
	 *
	 * @param $grid_column
	 * @param $default_grid_columns
	 *
	 * @return string
	 */
	public static function get_dynamic_cols( $grid_column, $default_grid_columns = [] ) {
		if ( ! $default_grid_columns ) {
			$default_grid_columns = [
				'lg' => '3',
				'md' => '6',
				'sm' => '12',
			];
		}
		$grid_column_desktop = ( isset( $grid_column['lg'] ) && 0 != $grid_column['lg'] ) ? $grid_column['lg'] : $default_grid_columns['lg'];
		$grid_column_tab     = ( isset( $grid_column['md'] ) && 0 != $grid_column['md'] ) ? $grid_column['md'] : $default_grid_columns['md'];
		$grid_column_mobile  = ( isset( $grid_column['sm'] ) && 0 != $grid_column['sm'] ) ? $grid_column['sm'] : $default_grid_columns['sm'];

		return "dowp-col-md-{$grid_column_desktop} dowp-col-sm-{$grid_column_tab} dowp-col-xs-{$grid_column_mobile}";
	}

	/**
	 * Extended class
	 *
	 * @param $layout
	 *
	 * @return string
	 */
	public static function extendClass( $layout ) {
		$classes = '';
		$classes .= $layout === 'grid3' ? ' dowp-grid2' : '';
		$classes .= $layout === 'list3' ? ' dowp-list2' : '';

		return $classes;
	}

	/**
	 * Order Class
	 *
	 * @param $item
	 * @param $content_order
	 *
	 * @return string|null
	 */
	public static function content_order( $item, $data ) {

		if ( 'show' !== $data['enable_order'] ) {
			return "";
		}
		$index = array_search( $item, $data['content_order'] );

		return esc_attr( "order-{$index}" );
	}

	public static function layout_align( $alignment ) {
		$align_class = '';
		foreach ( $alignment as $device => $value ) {
			if ( ! $value ) {
				continue;
			}
			$align_class .= $device . '-' . $value . ' ';
		}

		return $align_class;
	}


	/**
	 * Get Post Arguments
	 *
	 * @param $data
	 *
	 * @return mixed|null
	 */
	public static function get_post_args( $data ) {
		$template_data = [
			'layout'                 => $data['layout'],
			'name_tag'               => $data['name_tag'],
			'users_lists'            => $data['users_lists'],
			'grid_column'            => $data['grid_column'],
			'user_limit'             => $data['user_limit'],
			'users_role'             => $data['users_role'],
			'avatar_dimension'       => $data['avatar_dimension'],
			'user_filter_by_domain'  => $data['user_filter_by_domain'],
			'orderby'                => $data['orderby'],
			'order'                  => $data['order'],
			'avatar_visibility'      => $data['avatar_visibility'],
			'name_visibility'        => $data['name_visibility'],
			'email_visibility'       => $data['email_visibility'],
			'phone_visibility'       => $data['phone_visibility'],
			'designation_visibility' => $data['designation_visibility'],
			'job_role_visibility'    => $data['job_role_visibility'],
			'bio_visibility'         => $data['bio_visibility'],
			'social_visibility'      => $data['social_visibility'],
			'button_visibility'      => $data['button_visibility'],
			'button_style'           => $data['button_style'],
			'hr_1_visibility'        => $data['hr_1_visibility'],
			'hr_2_visibility'        => $data['hr_2_visibility'],
			'should_show_hr1'        => $data['should_show_hr1'],
			'name_order'             => self::content_order( 'name', $data ),
			'designation_order'      => self::content_order( 'designation', $data ),
			'job_role_order'         => self::content_order( 'job_role', $data ),
			'contact_order'          => self::content_order( 'contact', $data ),
			'biography_order'        => self::content_order( 'biography', $data ),
			'social_order'           => self::content_order( 'social', $data ),
			'button_order'           => self::content_order( 'button', $data ),
			'hr_1_order'             => self::content_order( 'hr_1', $data ),
			'hr_2_order'             => self::content_order( 'hr_2', $data ),
		];

		return apply_filters( 'dowp_ug_post_args', $template_data );

	}

	public static function layout_image( $user_id, $avatar_dimension = '', $default_size = 300, $alt = '' ) {
		$avatar_size      = [ 'size' => $avatar_dimension ?? $default_size ];
		$avater_image_url = get_avatar_url( $user_id, $avatar_size );
		?>
		<a class="user-link" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
			<img width="<?php echo esc_attr( $avatar_size['size'] ); ?>px"
			     height="<?php echo esc_attr( $avatar_size['size'] ); ?>px"
			     src="<?php echo esc_url( $avater_image_url ); ?>"
			     alt="<?php echo esc_html( $alt ); ?>"/>
		</a>
		<?php

	}

}