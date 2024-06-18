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
class RenderContent {

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

		$layout_data = Fns::get_post_args( $data );
		$inner_class = Fns::inner_class( $data );
		$nav_data    = [
			'pagination_visibility' => $data['pagination_visibility'],
			'user_limit'            => $data['user_limit'],
			'pagination_type'       => $data['pagination_type'],
			'load_more_label'       => $data['load_more_label'],
		];
		?>

		<div class="<?php echo esc_attr( $wrapper_class ); ?>">
			<div class="dowp-users-block-wrapper clearfix <?php echo esc_attr( $inner_class ); ?>"
				 data-layout-args='<?php echo esc_attr( htmlspecialchars( wp_json_encode( $layout_data ), true ) ); ?>'
				 data-post-args='<?php echo esc_attr( htmlspecialchars( wp_json_encode( $post_query_args ), true ) ); ?>'
				 data-nav-args='<?php echo esc_attr( htmlspecialchars( wp_json_encode( $nav_data ), true ) ); ?>'
			>
				<?php if ( ! empty( $user_query->results ) ) { ?>
					<div class="dowp-row">
						<?php
						$count_bg = 0;
						foreach ( $user_query->results as $user ) {
							if ( $count_bg >= $total_card_bg ) {
								$count_bg = 0;
							}
							$user_id                     = $user->ID;
							$layout_data['user_id']      = $user_id;
							$layout_data['display_name'] = $user->display_name;
							$layout_data['email']        = $user->user_email;
							$layout_data['designation']  = get_user_meta( $user_id, 'user_grid_designation', true );
							$layout_data['description']  = get_user_meta( $user_id, 'description', true );
							$layout_data['phone']        = get_user_meta( $user_id, 'user_grid_phone', true );
							$layout_data['job_role']     = get_user_meta( $user_id, 'user_grid_job_role', true );
							$layout_data['card_bg']      = $differen_card_bg[ $count_bg ] ?? '';
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
				<?php Fns::pagination( $user_query, $nav_data ); ?>
			</div>
		</div>
		<?php
	}
}
