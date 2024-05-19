<?php
/**
 * Helper class.
 *
 * @package USER_GRID
 */

namespace DOWP\UserGrid\Helpers;

// Do not allow directly accessing this file.
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
			$default_path = untrailingslashit( NSER_GRID_PLUGIN_BASE_DIR ) . '/templates/';
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
			// translators: %s template
			self::doing_it_wrong( __FUNCTION__, sprintf( __( '%s does not exist.', 'classified-listing' ), '<code>' . $located . '</code>' ), '1.0' );

			return;
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
	public static function get_user_social_icon( $user_id, $email_visibility ) {

		$social_list = self::social_list();
//		$facebook  = get_user_meta( $user_id, 'user_grid_facebook', true );
//		$twitter   = get_user_meta( $user_id, 'user_grid_twitter', true );
//		$linkedin  = get_user_meta( $user_id, 'user_grid_linkedin', true );
//		$gplus     = get_user_meta( $user_id, 'user_grid_gplus', true );
//		$pinterest = get_user_meta( $user_id, 'user_grid_pinterest', true );
		$user_info = get_user_by( 'id', $user_id );
		$email     = $user_info->user_email;

		?>
		<div class="dwp-user-social-icons">
			<?php
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
			if ( $email_visibility === 'show' ) {
				?>
				<a class="pinterest" href="mailto:<?php echo esc_attr( $email ) ?>"><?php SvgIcons::get_svg( 'email' ); ?></a>
				<?php
			}
			?>
		</div>
		<?php
	}

	/**
	 * Social List
	 * @return mixed|null
	 */
	public static function social_list() {
		return apply_filters( 'user_grid_social_list', [
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
				'lg' => '4',
				'md' => '6',
				'sm' => '12',
			];
		}
		$grid_column_desktop = ( isset( $grid_column['lg'] ) && 0 != $grid_column['lg'] ) ? $grid_column['lg'] : $default_grid_columns['lg'];
		$grid_column_tab     = ( isset( $grid_column['md'] ) && 0 != $grid_column['md'] ) ? $grid_column['md'] : $default_grid_columns['md'];
		$grid_column_mobile  = ( isset( $grid_column['sm'] ) && 0 != $grid_column['sm'] ) ? $grid_column['sm'] : $default_grid_columns['sm'];

		return "dwp-col-md-{$grid_column_desktop} dwp-col-sm-{$grid_column_tab} dwp-col-xs-{$grid_column_mobile}";
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


}