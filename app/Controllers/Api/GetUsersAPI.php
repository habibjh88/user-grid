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
			$args['orderby'] = 'include';
		}

		$user_lists  = get_users( $args );
		$avatar_size = [ 'size' => $data['avatar_dimension'] ?? '300' ];

		$newData = [
			'layout'                 => $data['layout'],
			'name_tag'               => $data['name_tag'],
			'users_lists'            => $data['users_lists'],
			'grid_column'            => $data['grid_column'],
			'content_order'          => $data['content_order'],
			'user_limit'             => $data['user_limit'],
			'users_role'             => $data['users_role'],
			'avatar_dimension'       => $data['avatar_dimension'],
			'user_filter_by_domain'  => $data['user_filter_by_domain'],
			'orderby'                => $data['orderby'],
			'order'                  => $data['order'],
			'avatar_visibility'      => $data['avatar_visibility'],
			'name_visibility'        => $data['name_visibility'],
			'email_visibility'       => $data['email_visibility'],
			'designation_visibility' => $data['designation_visibility'],
			'short_desc_visibility'  => $data['short_desc_visibility'],
			'bio_visibility'         => $data['bio_visibility'],
			'social_visibility'      => $data['social_visibility'],
			'button_visibility'      => $data['button_visibility'],
			'button_style'           => $data['button_style'],
		];

		if ( ! empty( $user_lists ) ) {
			ob_start();
			foreach ( $user_lists as $user ) {
				$user_info               = get_user_by( 'id', $user->ID );
				$newData['user_id']      = $user->ID;
				$newData['display_name'] = $user_info->display_name;
				Fns::get_template( $data['layout'], $newData );
			}
			$markup              = ob_get_clean();
			$send_data['markup'] = $markup;
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
