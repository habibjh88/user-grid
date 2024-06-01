<?php

namespace DOWP\UserGrid\Api;

use DOWP\UserGrid\Helpers\Fns;
use DOWP\UserGrid\Utils\RenderContent;

/**
 * GetUsersAPI class
 */
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

		ob_start();
		RenderContent::get_render_content( $data );
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
