<?php

namespace GT\GtUsers\Controllers\Api;

class GetUsersV1 {
	public function __construct() {
		add_action( "rest_api_init", [ $this, 'register_post_route' ] );
	}

	public function register_post_route() {
		register_rest_route( 'rgbcode/v1', 'users', [
			'methods'             => 'POST',
			'callback'            => [ $this, 'get_all_users' ],
			'permission_callback' => function () {
				return true;
			}
		] );

		register_rest_route( 'rgbcode/v1', 'users-select', [
			'methods'             => 'POST',
			'callback'            => [ $this, 'get_all_users_for_inspector' ],
			'permission_callback' => function () {
				return true;
			}
		] );
	}


	public function get_all_users( $data ) {
		$send_data = [
			'users'   => [],
			'message' => ''
		];

		$args = [
			'fields' => [ 'ID' ],
			'number' => $data['user_limit'],
		];

		if ( ! empty( $data['orderby'] ) ) {
			$args['orderby'] = $data['orderby'];
		}

		if ( ! empty( $data['order'] ) ) {
			$args['order'] = $data['order'];
		}


		if ( ! empty( $data['user_filter_by_domain'] ) && empty( $data['users_lists'] ) ) {
			$args['search']         = '*' . $data['user_filter_by_domain'];
			$args['search_columns'] = array( 'user_email' );
		}

		if ( ! empty( $data['users_lists'] ) ) {
			$args['include'] = wp_list_pluck( $data['users_lists'], 'value' );
		}

		error_log( print_r( $args, true ) . "\n\n", 3, __DIR__ . '/log.txt' );
		$user_lists = wp_list_pluck( get_users( $args ), 'ID' );;

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
					'social'    => [
						'facebook'  => get_user_meta( $user_info->ID, 'cub_facebook', true ),
						'twitter'   => get_user_meta( $user_info->ID, 'cub_twitter', true ),
						'linkedin'  => get_user_meta( $user_info->ID, 'cub_linkedin', true ),
						'gplus'     => get_user_meta( $user_info->ID, 'cub_gplus', true ),
						'pinterest' => get_user_meta( $user_info->ID, 'cub_pinterest', true ),
					],
				];

			}
		} else {
			$send_data['message'] = 'No users found';
		}

		wp_reset_postdata();

		return rest_ensure_response( $send_data );
	}

	public function get_all_users_for_inspector( $data ) {
		$send_data  = [
			'users'   => [],
			'message' => 'success',
		];
		$args       = [
			'fields' => [ 'ID' ],
			'number' => $data['user_limit'],
		];
		$user_lists = wp_list_pluck( get_users( $args ), 'ID' );;
		$count_users = count( $user_lists );
		if ( is_array( $user_lists ) && $count_users > 0 ) {
			foreach ( $user_lists as $user ) {
				$user_info            = get_user_by( 'id', $user );
				$send_data['users'][] = [
					'id'   => esc_html( $user_info->ID ),
					'name' => esc_html( $user_info->display_name ),
				];
			}
		} else {
			$send_data['message'] = 'No users found';
		}
		wp_reset_postdata();

		return rest_ensure_response( $send_data );
	}
}
