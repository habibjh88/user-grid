<?php

namespace DOWP\UserGrid\Controllers\Api;

use DOWP\UserGrid\Helpers\Fns;

class GetUsersAPI {
	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'register_post_route' ] );
	}

	/**
	 * Register API Route
	 *
	 * @return void
	 */
	public function register_post_route() {
		register_rest_route(
			'dowp/v1',
			'users',
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'get_all_users' ],
				'permission_callback' => function () {
					return true;
				},
			]
		);

		register_rest_route(
			'dowp/v1',
			'users-select',
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'get_all_users_for_inspector' ],
				'permission_callback' => function () {
					return true;
				},
			]
		);
	}


	/**
	 * Get all users for gutenberg editors
	 *
	 * @param $data
	 *
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public function get_all_users( $data ) {
		$send_data = [
			'users'   => [],
			'message' => '',
		];

		$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$user_limit = $data['user_limit'] ?? 6;
		if ( $paged == 1 ) {
			$offset = 0;
		} else {
			$offset = ( $paged - 1 ) * $user_limit;
		}

		$args = [
			'number' => $user_limit,
			'offset' => $offset
		];

		if ( ! empty( $data['users_role'] ) ) {
			$args['role__in'] = wp_list_pluck( $data['users_role'], 'value' );
		}

		if ( ! empty( $data['orderby'] ) ) {
			$args['orderby'] = $data['orderby'];
		}

		if ( ! empty( $data['order'] ) ) {
			$args['order'] = $data['order'];
		}

		if ( ! empty( $data['user_filter_by_domain'] ) ) {
			$args['search']         = '*' . $data['user_filter_by_domain'] . '*';
			$args['search_columns'] = [ 'user_email' ];
		}

		if ( ! empty( $data['users_lists'] ) ) {
			$args['include'] = wp_list_pluck( $data['users_lists'], 'value' );
			$args['orderby'] = 'include';
		}


		$user_query    = new \WP_User_Query( $args );  // get_users( $args );
		$uniqueId      = $data['uniqueId'] ?? null;
		$wrapper_class = 'dowp-block-usergrid dowp-block-wrapper dowp-block-' . $uniqueId;
		$wrapper_class .= 'yes' == $data['image_link'] ? '' : ' no-image-link';

		$inner_class = preg_replace( '/[0-9]/', '', $data['layout'] ) . '-style';
		$inner_class .= Fns::extendClass( $data['layout'] );
		$inner_class .= ' dowp-' . $data['layout'];
		$inner_class .= ' ' . $data['grid_height'];
		$inner_class .= ' ' . Fns::layout_align( $data['grid_alignment'] );
		$layout_data = Fns::get_post_args( $data );
		ob_start();
		?>
        <div class="<?php echo esc_attr( $wrapper_class ); ?>">
            <div class="dowp-users-block-wrapper clearfix <?php echo esc_attr( $inner_class ); ?>">
				<?php if ( ! empty( $user_query->results ) ) { ?>
                    <div class="dowp-row">
						<?php
						foreach ( $user_query->results as $user ) {
							$user_id                     = $user->ID;
							$layout_data['user_id']      = $user_id;
							$layout_data['display_name'] = $user->display_name;
							$layout_data['email']        = $user->user_email;
							$layout_data['designation']  = get_user_meta( $user_id, 'user_grid_designation', true );
							$layout_data['description']  = get_user_meta( $user_id, 'description', true );
							$layout_data['phone']        = get_user_meta( $user_id, 'user_grid_phone', true );
							$layout_data['short_desc']   = get_user_meta( $user_id, 'user_grid_short_desc', true );
							Fns::get_template( $data['layout'], $layout_data );
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

			<?php

			$total_user  = $user_query->total_users;
			$total_pages = ceil( $total_user / $user_limit );

			echo paginate_links( [
				'base'      => get_pagenum_link( 1 ) . '%_%',
				'format'    => '?paged=%#%',
				'current'   => $paged,
				'total'     => $total_pages,
				'prev_text' => 'Previous',
				'next_text' => 'Next',
				'type'      => 'list',
			] );
			?>
        </div>
		<?php

		$markup              = ob_get_clean();
		$send_data['markup'] = $markup;

		return rest_ensure_response( $send_data );
	}

	/**
	 * Get users for inspector select users
	 *
	 * @param $data
	 *
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public function get_all_users_for_inspector( $data ) {
		$send_data  = [
			'users'   => [],
			'roles'   => [],
			'message' => 'success',
		];
		$args       = [
			'number' => - 1,
		];
		$user_lists = get_users( $args );

		if ( ! empty( $user_lists ) ) {
			foreach ( $user_lists as $user ) {
				$send_data['users'][] = [
					'id'    => esc_html( $user->ID ),
					'name'  => esc_html( $user->display_name ),
					'email' => esc_html( $user->user_email ),
				];
			}
		} else {
			$send_data['message'] = 'No users found';
		}

		global $wp_roles;

		$all_roles      = $wp_roles->roles;
		$editable_roles = apply_filters( 'editable_roles', $all_roles );

		if ( ! empty( $editable_roles ) ) {
			foreach ( $editable_roles as $role => $user ) {
				$send_data['roles'][] = [
					'id'   => $role,
					'name' => $user['name'],
				];
			}
		}
		wp_reset_postdata();

		return rest_ensure_response( $send_data );
	}
}
