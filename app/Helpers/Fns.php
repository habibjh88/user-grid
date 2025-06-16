<?php
/**
 * Helper class.
 *
 * @package USER_GRID
 */

namespace USGR\UserGrid\Helpers;

// Do not allow directly accessing this file.
use USGR\UserGrid\Utils\SvgIcons;

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
	public static function print_html_all( $html ) {
		if ( ! $html ) {
			return;
		}

		echo wp_kses_post( stripslashes_deep( $html ) );
	}

	/**
	 * Get Ajax URL.
	 *
	 * @return string
	 */
	public static function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}

	/**
	 * @param        $template_name
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return mixed|void
	 */
	public static function locate_template( $template_name, $template_path = '', $default_path = '' ) {
		$template_name = $template_name . '.php';
		if ( ! $template_path ) {
			$template_path = 'user-grid/';
		}

		if ( ! $default_path ) {
			$default_path = untrailingslashit( USER_GRID_PLUGIN_BASE_DIR ) . '/templates/';
		}

		$template_files = trailingslashit( $template_path ) . $template_name;

		$template = locate_template( apply_filters( 'usgr_locate_template_files', $template_files, $template_name, $template_path, $default_path ) );

		// Get default template.
		if ( ! $template ) {
			$template = trailingslashit( $default_path ) . $template_name;
		}

		return apply_filters( 'usgr_locate_template', $template, $template_name );
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
			extract( $args );
		}

		$located = self::locate_template( $template_name, $template_path, $default_path );

		if ( ! file_exists( $located ) ) {
			$default_path = untrailingslashit( USER_GRID_PRO_PLUGIN_BASE_DIR ) . '/templates/';
			$located      = self::locate_template( $template_name, $template_path, $default_path );
		}

		// Allow 3rd party plugin filter template file from their plugin.
		$located = apply_filters( 'usgr_get_template', $located, $template_name, $args );

		do_action( 'usgr_before_template_part', $template_name, $located, $args );

		include $located;

		do_action( 'usgr_after_template_part', $template_name, $located, $args );
	}

	/**
	 * Verify nonce.
	 *
	 * @return bool
	 */
	public static function verifyNonce() {
		$nonce     = isset( $_REQUEST[ usgrUG()->nonceId() ] ) ? sanitize_text_field( wp_unslash( $_REQUEST[ usgrUG()->nonceId() ] ) ) : null;
		$nonceText = usgrUG()->nonceText();

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
	public static function get_user_social_icon( $user_id, $email_visibility, $phone_visibility, $share_icon = false ) {
		$social_list = self::social_list();
		$user_info   = get_user_by( 'id', $user_id );
		$email       = $user_info->user_email;

		if ( $phone_visibility === 'show' ) {
			unset( $social_list['phone'] );
		}

		?>

        <ul class="usgr-social-list">
			<?php if ( $share_icon ) { ?>
            <li>
                <a href="#" class="share-icon"><?php SvgIcons::get_svg( 'share' ); ?></a>
                <ul>
					<?php
					}

					foreach ( $social_list as $icon => $label ) {
						$meta_key   = "usgr_{$icon}";
						$meta_value = get_user_meta( $user_id, $meta_key, true );

						if ( $meta_value ) {
							?>
                            <li>
                                <a class="<?php echo esc_attr( $icon ); ?>"
                                   href="<?php echo esc_url( $meta_value ); ?>">
									<?php SvgIcons::get_svg( $icon ); ?>
                                </a>
                            </li>
							<?php
						}
					}

					if ( $email_visibility !== 'show' ) {
						?>
                        <li>
                            <a class="pinterest"
                               href="mailto:<?php echo esc_attr( $email ); ?>"><?php SvgIcons::get_svg( 'email' ); ?></a>
                        </li>
						<?php
					}
					if ( $phone_visibility !== 'show' ) {
						$phone = get_user_meta( $user_id, 'usgr_phone', true );
						?>
                        <li>
                            <a class="phone"
                               href="call:<?php echo esc_attr( $phone ); ?>"><?php SvgIcons::get_svg( 'phone' ); ?></a>
                        </li>
						<?php
					}
					if ( $share_icon ) {
					?>
                </ul>
            </li>
		<?php
		}
		?>

        </ul>

		<?php
	}

	/**
	 * Social List
	 *
	 * @return mixed|null
	 */
	public static function social_list() {
		return apply_filters(
			'usgr_social_list',
			[
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
			]
		);
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
			case 'slider3':
				$classes = 'usgr-grid2';
				break;
			case 'list3':
				$classes = 'usgr-list2';
				break;
			case 'list6':
				$classes = 'usgr-list3 usgr-list2';
				break;
			case 'grid10':
			case 'slider10':
				$classes = 'need-multiple-bg';
				break;
			case 'grid14':
			case 'slider14':
			case 'grid15':
			case 'slider15':
				$classes = 'usgr-grid13';
				break;
		}

		return $classes;
	}

	/**
	 * Generate Inner Classes
	 *
	 * @param $data
	 *
	 * @return array|string|string[]|null
	 */
	public static function inner_class( $data ) {
		$layout        = esc_html( $data['layout'] );
		$multiple_bg   = $data['multiple_bg'] ?: '';
		$inner_class   = [];
		$inner_class[] = preg_replace( '/[0-9]/', '', $layout ) . '-style';
		$inner_class[] = self::extend_class( $layout );
		$inner_class[] = 'usgr-' . $layout;
		$inner_class[] = $data['grid_height'];
		$inner_class[] = $data['social_style'];
		$inner_class[] = $data['social_show_on'];
		$inner_class[] = $data['social_position'];
		$inner_class[] = $data['pagination_type'];
		$inner_class[] = $data['post_box_style'];
		$inner_class[] = ( $data['show_post_b_b'] ? 'show-p-b' : '' );
		$inner_class[] = $data['lift_box_hover'];
		$inner_class[] = $data['pagination_style'];
		$inner_class[] = $data['enable_order'] ? 'is-order' : 'no-order';
		$inner_class[] = $data['arrow'] ? 'has-arrow' : '';
		$inner_class[] = $data['dots'] ? 'has-dots' : '';
		$inner_class[] = $multiple_bg ? 'has-multi-bg' : 'no-multi-bg';
		$inner_class[] = self::layout_align( $data['grid_alignment'] );

		if ( usgrUG()->hasPro() ) {
			$inner_class[] = $data['dark_mode'] ? 'usgr-dark' : 'usgr-light';
			$inner_class[] = $data['layout_reverse'] ? 'usgr-reverse' : '';
		}

		return preg_replace( '/\s+/', ' ', trim( implode( ' ', $inner_class ) ) );
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
			return '';
		}
		$index = array_search( $item, $data['content_order'] );

		return esc_attr( "order-{$index}" );
	}

	/**
	 * Get Slider Arguments
	 *
	 * @param $data
	 *
	 * @return mixed|null
	 */
	public static function slider_args( $data ) {
		$grid_column         = $data['grid_column'];
		$grid_column_desktop = intval( ( isset( $grid_column['lg'] ) && 0 != $grid_column['lg'] ) ? $grid_column['lg'] : 4 );
		$grid_column_tab     = intval( ( isset( $grid_column['md'] ) && 0 != $grid_column['md'] ) ? $grid_column['md'] : 2 );
		$grid_column_mobile  = intval( ( isset( $grid_column['sm'] ) && 0 != $grid_column['sm'] ) ? $grid_column['sm'] : 1 );

		$dots           = (bool) $data['dots'] ?? true;
		$arrow          = (bool) $data['arrow'] ?? false;
		$fade           = (bool) $data['fade'];
		$autoplay       = (bool) $data['autoplay'];
		$adaptiveHeight = $data['adaptiveHeight'] ? true : false;
		$infinite       = $data['infinite'] ? true : false;
		$speed          = intval( $data['speed'] ?? 700 );
		$autoplaySpeed  = intval( $data['autoplaySpeed'] ?? 3000 );

		return apply_filters(
			'usgr_slider_args',
			[
				'dots'           => $dots,
				'arrows'         => $arrow,
				'fade'           => $fade,
				'autoplay'       => $autoplay,
				'adaptiveHeight' => $adaptiveHeight,
				'infinite'       => $infinite,
				'speed'          => $speed,
				'autoplaySpeed'  => $autoplaySpeed,
				'slidesToShow'   => $grid_column_desktop,
				'slidesToScroll' => $grid_column_desktop,
				'responsive'     => [
					[
						'breakpoint' => 1024,
						'settings'   => [
							'slidesToShow'   => $grid_column_tab,
							'slidesToScroll' => $grid_column_tab,
						],
					],
					[
						'breakpoint' => 600,
						'settings'   => [
							'slidesToShow'   => $grid_column_mobile,
							'slidesToScroll' => $grid_column_mobile,
						],
					],
				],
			]
		);
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
			'layout'           => $data['layout'],
			'grid_column'      => $data['grid_column'],
			'multiple_bg'      => $data['multiple_bg'],
			'user_limit'       => $data['user_limit'] ?? 6,
			'button_args'      => [
				'button_visibility' => $data['button_visibility'],
				'post_type'         => $data['post_type'],
				'button_text'       => $data['button_text'],
				'button_style'      => $data['button_style'],
				'button_order'      => self::content_order( 'button', $data ),
			],
			'social_args'      => [
				'social_visibility' => $data['social_visibility'],
				'social_position'   => usgrUG()->hasPro() ? $data['social_position'] : 'spos-d',
				'email_visibility'  => $data['email_visibility'],
				'phone_visibility'  => $data['phone_visibility'],
				'social_order'      => self::content_order( 'social', $data ),
			],
			'designation_args' => [
				'designation_visibility' => $data['designation_visibility'],
				'designation_order'      => self::content_order( 'designation', $data ),
			],
			'job_role_args'    => [
				'job_role_visibility' => $data['job_role_visibility'],
				'job_role_order'      => self::content_order( 'job_role', $data ),
			],
			'contact_args'     => [
				'email_visibility' => $data['email_visibility'],
				'phone_visibility' => $data['phone_visibility'],
				'contact_order'    => self::content_order( 'contact', $data ),
			],
			'bio_args'         => [
				'bio_visibility'  => $data['bio_visibility'],
				'biography_order' => self::content_order( 'biography', $data ),
			],
			'hr1_args'         => [
				'hr_1_visibility' => $data['hr_1_visibility'],
				'hr_1_order'      => self::content_order( 'hr_1', $data ),
			],
			'hr2_args'         => [
				'hr_2_visibility' => $data['hr_2_visibility'],
				'hr_2_order'      => self::content_order( 'hr_2', $data ),
			],
			'name_args'        => [
				'name_visibility' => $data['name_visibility'],
				'name_tag'        => self::validated_html_tag( $data['name_tag'] ),
				'name_order'      => self::content_order( 'name', $data ),
			],
			'image_args'       => [
				'avatar_visibility' => $data['avatar_visibility'],
				'avatar_dimension'  => $data['avatar_dimension'],
				'default_size'      => 300,
				'social_visibility' => $data['social_visibility'],
				'social_position'   => usgrUG()->hasPro() ? $data['social_position'] : 'spos-d',
				'email_visibility'  => $data['email_visibility'],
				'phone_visibility'  => $data['phone_visibility'],
				'share_icon'        => true,
			],
			'post_args'        => [
				'post_number'     => $data['post_number'],
				'main_title_text' => $data['main_title_text'],
				'post_type'       => $data['post_type'],
				'show_post_img'   => $data['show_post_img'],
				'show_post_cat'   => $data['show_post_cat'],
				'show_post_date'  => $data['show_post_date'],
				'post_visibility' => usgrUG()->hasPro() ? $data['post_visibility'] : false,
			],
			'nav_data'         => [
				'pagination_visibility' => $data['pagination_visibility'],
				'user_limit'            => $data['user_limit'],
				'pagination_type'       => $data['pagination_type'],
				'pagination_url'        => get_pagenum_link(),
				'load_more_label'       => $data['load_more_label'],
				'prev_label'            => $data['prev_label'],
				'next_label'            => $data['next_label'],
			],
		];

		return apply_filters( 'usgr_ug_post_args', $template_data );
	}

	/**
	 * Modify Layout data
	 *
	 * @param $user
	 * @param $layout_data
	 *
	 * @return mixed
	 */
	public static function modify_layout_data( $user, $layout_data ) {
		$user_id                     = $user->ID;
		$layout_data['user_id']      = $user_id;
		$layout_data['display_name'] = $user->display_name;
		$layout_data['email']        = $user->user_email;
		$layout_data['designation']  = get_user_meta( $user_id, 'usgr_designation', true );
		$layout_data['description']  = get_user_meta( $user_id, 'description', true );
		$layout_data['phone']        = get_user_meta( $user_id, 'usgr_phone', true );
		$layout_data['job_role']     = get_user_meta( $user_id, 'usgr_job_role', true );

		return $layout_data;
	}

	/**
	 * Get Layout Image
	 *
	 * @param $user_id
	 * @param $avatar_dimension
	 * @param $default_size
	 * @param $alt_txt
	 *
	 * @return void
	 */
	public static function layout_image( $user_id, $avatar_dimension = '', $default_size = 300, $alt_txt = '' ) {
		$avatar_size = intval( $avatar_dimension ?? $default_size );
		?>
        <a class="user-link" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
			<?php echo get_avatar( $user_id, $avatar_size ); ?>
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

		if ( ! empty( $data['users_role'] ) && is_array( $data['users_role'] ) ) {
			$args['role__in'] = wp_list_pluck( $data['users_role'], 'value' );
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

		return apply_filters( 'usgr_user_query_args', $args, $data );
	}

	/**
	 * Get Post Type List
	 *
	 * @return array
	 */
	public static function get_post_types() {
		$post_types = get_post_types(
			[
				'public' => true,
			],
			'objects'
		);
		$post_types = wp_list_pluck( $post_types, 'label', 'name' );

		$exclude = [ 'attachment', 'revision', 'nav_menu_item', 'elementor_library', 'tpg_builder', 'e-landing-page' ];

		foreach ( $exclude as $ex ) {
			unset( $post_types[ $ex ] );
		}

		$postType = [];
		foreach ( $post_types as $name => $label ) {
			$postType[] = [
				'value' => $name,
				'label' => $label,
			];
		}

		return $postType;
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
		$total_user  = $user_query->total_users;
		$user_limit  = ! empty( $data['user_limit'] ) ? esc_html( $data['user_limit'] ) : 6;
		$total_pages = ceil( $total_user / $user_limit );
		if ( ! empty( $data['current_page'] ) ) {
			$paged = $data['current_page'];
		} else {
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		}

		echo "<div class='usgr-pagination " . esc_attr( $data['pagination_type'] ) . "'>";
		if ( 'load-more-pgn' === $data['pagination_type'] ) {
			?>
            <button
                class="user-loadmore-btn usgrLoadMore"
                data-perPage="<?php echo esc_attr( $user_limit ); ?>"
                data-totalUsers="<?php echo esc_attr( $total_user ); ?>"
                data-totalPage="<?php echo esc_attr( $total_pages ); ?>"
                data-paged="<?php echo esc_attr( $paged ); ?>"
            ><?php echo esc_html( $data['load_more_label'] ); ?>
            </button>
			<?php
		} elseif ( ( 'ajax-pgn' === $data['pagination_type'] ) ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			self::print_html_all(
				paginate_links(
					[
						'base'      => $data['pagination_url'] . '%_%',
						'format'    => '&paged=%#%',
						'current'   => max( 1, $paged ),
						'total'     => $total_pages,
						'prev_text' => $data['prev_label'] ?? __( 'Prev', 'user-grid' ),
						'next_text' => $data['next_label'] ?? __( 'Next', 'user-grid' ),
						'type'      => 'list',
					]
				)
			);
		} else {
			//phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( ! empty( $_GET ) ) {
				$format = '&paged=%#%';
			} else {
				$format = '?paged=%#%';
			}
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			self::print_html_all(
				paginate_links(
					[
						'base'      => get_pagenum_link() . '%_%',
						'format'    => $format,
						'current'   => max( 1, $paged ),
						'total'     => $total_pages,
						'prev_text' => $data['prev_label'] ?? __( 'Prev', 'user-grid' ),
						'next_text' => $data['next_label'] ?? __( 'Next', 'user-grid' ),
						'type'      => 'list',
					]
				)
			);
		}
		echo '</div>';
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

	/**
	 * Get user url
	 *
	 * @param $user_id
	 * @param $display_name
	 *
	 * @return void
	 */
	public static function user_url( $user_id, $first_tag = true ) {
		$user_custm_url = get_user_meta( $user_id, 'usgr_custom_url', true );
		$user_url       = $user_custm_url ?: get_author_posts_url( $user_id );
		if ( $first_tag ) {
			echo '<a href="' . esc_url( $user_url ) . '">';
		}
		if ( ! $first_tag ) {
			echo '</a>';
		}
	}

}
