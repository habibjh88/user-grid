<?php
/**
 * RenderContent
 *
 * @package USER_GRID
 */

namespace DOWP\UserGrid\Utils;

// Do not allow directly accessing this file.
use DOWP\UserGrid\Helpers\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * RenderContent Class
 */
class RenderSlider {

	public static function get_render_content( $data ) {

		$post_query_args = Fns::user_query_args( $data );
		$user_query      = new \WP_User_Query( $post_query_args );
		$uniqueId        = $data['uniqueId'] ?? null;
		$wrapper_class   = 'dowp-block-usergrid dowp-block-' . $uniqueId;
		$wrapper_class  .= 'yes' == $data['image_link'] ? '' : ' no-image-link';

		// Multiple Background.
		$multiple_bg      = $data['multiple_bg'] ? esc_attr( $data['multiple_bg'] ) : '';
		$differen_card_bg = explode( ',', $multiple_bg );
		$total_card_bg    = count( $differen_card_bg );

		$layout_data  = Fns::get_post_args( $data );
		$inner_class  = Fns::inner_class( $data );
		$dataSlick    = Fns::slider_args( $data );
		$inner_class .= ' dowp-' . preg_replace( '/slider/', 'grid', $data['layout'] );
		?>

		<div class="<?php echo esc_attr( $wrapper_class ); ?>">
			<div class="dowp-users-block-wrapper clearfix grid-style <?php echo esc_attr( $inner_class ); ?>">
				<?php if ( ! empty( $user_query->results ) ) { ?>
					<div class="dowp-row dowp-carousel" data-slick="<?php echo esc_attr( htmlspecialchars( wp_json_encode( $dataSlick ) ) ); ?>">
						<?php
						$count_bg = 0;
						foreach ( $user_query->results as $user ) {
							$count_bg               = ( $count_bg >= $total_card_bg ) ? 0 : $count_bg;
							$layout_data            = Fns::modify_layout_data( $user, $layout_data );
							$layout_data['card_bg'] = $differen_card_bg[ $count_bg ] ?? '';
							Fns::get_template( $data['layout'], $layout_data );
							$count_bg++;
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
		</div>
		<?php
	}
}
