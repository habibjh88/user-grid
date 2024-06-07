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
			unset( $social_list['phone'] );
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
	 * Layout Alignment Class
	 *
	 * @param $alignment
	 *
	 * @return string
	 */
	public static function layout_align( $alignment ) {
		$align_class = '';
		foreach ( $alignment as $device => $value ) {
			if ( ! $value ) {
				continue;
			}
			$align_class .= $device . '-' . $value . ' ';
		}

		return trim( $align_class );
	}

	/**
	 * Extended class
	 *
	 * @param $layout
	 *
	 * @return string
	 */

	public static function extend_class( $layout ) {
		$classes = '';

		switch ( $layout ) {
			case 'grid3':
				$classes = 'dowp-grid2';
				break;
			case 'list3':
				$classes = 'dowp-list2';
				break;
			case 'list6':
				$classes = 'dowp-list3 dowp-list2';
				break;
			case 'grid10':
				$classes = 'need-multiple-bg';
				break;
//			case 'grid12':
//				$classes = ' dowp-grid3';
//				break;
		}

		return $classes;
	}

	public static function inner_class( $data ) {
		$layout        = esc_html( $data['layout'] );
		$multiple_bg   = $data['multiple_bg'] ? $data['multiple_bg'] : '';
		$inner_class   = [];
		$inner_class[] = preg_replace( '/[0-9]/', '', $layout ) . '-style';
		$inner_class[] = self::extend_class( $layout );
		$inner_class[] = 'dowp-' . $layout;
		$inner_class[] = $data['grid_height'];
		$inner_class[] = $data['social_style'];
		$inner_class[] = $data['lift_box_hover'];
		$inner_class[] = $data['pagination_style'];
		$inner_class[] = $data['enable_order'] ? 'is-order' : 'no-order';
		$inner_class[] = $multiple_bg ? 'has-multi-bg' : 'no-multi-bg';
		$inner_class[] = self::layout_align( $data['grid_alignment'] );

		return trim( implode( ' ', $inner_class ) );
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
			'name_tag'               => self::validated_html_tag( $data['name_tag'] ),
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
			'should_show_btn'        => $data['should_show_btn'],
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

	/**
	 * Make User Query Arguments
	 *
	 * @param $data
	 *
	 * @return mixed|null
	 */
	public static function user_query_args( $data ) {
		$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$user_limit = $data['user_limit'] ? esc_html( $data['user_limit'] ) : 6;
		if ( 1 == $paged ) {
			$offset = 0;
		} else {
			$offset = ( $paged - 1 ) * $user_limit;
		}

		$args = [
			'number' => $user_limit,
			'offset' => $offset,
		];

		if ( ! empty( $data['users_role'] ) ) {
			$args['role__in'] = wp_list_pluck( esc_html( $data['users_role'] ), 'value' );
		}

		if ( ! empty( $data['orderby'] ) ) {
			$args['orderby'] = esc_html( $data['orderby'] );
		}

		if ( ! empty( $data['order'] ) ) {
			$args['order'] = esc_html( $data['order'] );
		}

		if ( ! empty( $data['user_filter_by_domain'] ) ) {
			$args['search']         = '*' . esc_html( $data['user_filter_by_domain'] ) . '*';
			$args['search_columns'] = [ 'user_email' ];
		}

		if ( ! empty( $data['users_lists'] ) ) {
			$args['include'] = wp_list_pluck( $data['users_lists'], 'value' );
			$args['orderby'] = 'include';
		}

		return apply_filters( 'dowp_user_query_args', $args, $data );
	}

	/**
	 * Pagination
	 *
	 * @param $total_user
	 * @param $user_limit
	 *
	 * @return void
	 */
	public static function pagination( $user_query, $data ) {

		if ( ! isset( $user_query->total_users ) && 'show' !== $data['pagination_visibility'] ) {
			return;
		}
        $total_user = $user_query->total_users;
		$user_limit  = ! empty( $data['user_limit'] ) ? esc_html( $data['user_limit'] ) : 6;
		$total_pages = ceil( $total_user / $user_limit );
		$paged       = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		if ( ! empty( $_GET ) ) {
			$format = '&paged=%#%';
		} else {
			$format = '?paged=%#%';
		}
		echo "<div class='dowp-pagination'>";
		echo paginate_links( [
			'base'      => get_pagenum_link() . '%_%',
			'format'    => $format,
			'current'   => $paged,
			'total'     => $total_pages,
			'prev_text' => __( 'Prev', 'user-grid' ),
			'next_text' => __( 'Next', 'user-grid' ),
			'type'      => 'list',
		] );
		echo "</div>";

		/*echo paginate_links(
			[
				'base'      => get_pagenum_link( 1 ) . '%_%',
				'format'    => '&paged=%#%',
				'current'   => $paged,
				'total'     => $total_pages,
				'prev_text' => 'Previous',
				'next_text' => 'Next',
				'type'      => 'list',
			]
		);*/
	}

	/**
	 * Print Validated html tags
	 *
	 * @param $tag
	 *
	 * @return string|null
	 */
	public static function validated_html_tag( $tag ) {
		$allowed_html_wrapper_tags = [
			'h1',
			'h2',
			'h3',
			'h4',
			'h5',
			'h6',
			'p',
			'div',
		];

		return in_array( strtolower( $tag ), $allowed_html_wrapper_tags, true ) ? $tag : 'div';
	}
}