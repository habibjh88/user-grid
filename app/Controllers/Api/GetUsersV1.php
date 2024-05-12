<?php

namespace DOWP\UserGrid\Controllers\Api;

class GetUsersV1 {
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

		$args = [
			'number' => $data['user_limit'] ?? 6,
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
			$args['search_columns'] = array( 'user_email' );
		}

		if ( ! empty( $data['users_lists'] ) ) {
			$args['include'] = wp_list_pluck( $data['users_lists'], 'value' );
		}

		$user_lists  = get_users( $args );
		$avatar_size = [ 'size' => $data['avatar_dimension'] ?? '300' ];

		if ( ! empty( $user_lists ) ) {

			foreach ( $user_lists as $user ) {
				$send_data['users'][] = [
					'id'          => esc_html( $user->ID ),
					'name'        => esc_html( $user->display_name ),
					'email'       => esc_html( $user->user_email ),
					'designation' => get_user_meta( $user->ID, 'user_grid_designation', true ),
					'avatar'      => get_avatar_url( $user->ID, $avatar_size ),
					'desc'        => get_user_meta( $user->ID, 'description', true ),
					'short_desc'  => get_user_meta( $user->ID, 'user_grid_short_desc', true ),
					'social'      => [
						'facebook'  => get_user_meta( $user->ID, 'user_grid_facebook', true ),
						'twitter'   => get_user_meta( $user->ID, 'user_grid_twitter', true ),
						'linkedin'  => get_user_meta( $user->ID, 'user_grid_linkedin', true ),
						'gplus'     => get_user_meta( $user->ID, 'user_grid_gplus', true ),
						'pinterest' => get_user_meta( $user->ID, 'user_grid_pinterest', true ),
					],
				];

			}
		} else {
			$send_data['message'] = 'Sorry! No Users found';
		}

		wp_reset_postdata();

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
