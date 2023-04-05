<?php

namespace GT\GtUsers\Controllers\Api;

class GetUsersV1 {
	public function __construct() {
		add_action( "rest_api_init", [ $this, 'register_post_route' ] );
	}

	public function register_post_route() {
		register_rest_route( 'rgbcode/v1', 'users', [
			'methods'             => 'POST',
			'callback'            => [ $this, 'rest_api_callback' ],
			'permission_callback' => function () {
				return true;
			}
		] );
	}


	public function rest_api_callback( $data ) {
		$send_data  = [
			'users' => [],
		];
		$args       = [
			'fields' => [ 'ID' ],
//			'search' => 'john'
		];
		$user_lists = wp_list_pluck( get_users( $args ), 'ID' );;

		if ( $data['users'] === 'all' && ! empty( $data['users_lists'] ) ) {
			$user_lists = wp_list_pluck( $data['users_lists'], 'value' );
		}

		$count_users = count( $user_lists );

		$avatar_size = [ 'size' => $data['avatar_dimension'] ?? '300' ];

		if ( is_array( $user_lists ) && $count_users > 0 ) {

			foreach ( $user_lists as $user ) {
				$user_info = get_user_by( 'id', $user );

				$send_data['users'][] = [
					'id'        => esc_html( $user_info->ID ),
					'name'      => esc_html( $user_info->display_name ),
					'avatar'    => esc_url( get_avatar_url( $user_info->ID, $avatar_size ) ),
					'biography' => get_user_meta( $user_info->ID, 'description', true ),
				];

			}
		} else {
			$send_data['message'] = 'No users found';
		}

		wp_reset_postdata();

		return rest_ensure_response( $send_data );
	}
}
