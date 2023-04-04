<?php

namespace GT\GtUsers\Controllers\Api;

use GT\GtUsers\Helpers\Fns;

class ImageSizeV1{
	public function __construct(){
		add_action("rest_api_init", [$this, 'register_image_size_route']);
	}

	public function register_image_size_route(){
		register_rest_route( 'rttpg/v1', 'image-size',array(
			'methods'  => 'GET',
			'callback' => [$this, 'get_image_sizes'],
			'permission_callback' => function() { return true; }
		));
	}

	public static function get_all_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes       = get_intermediate_image_sizes();
		$image_sizes = array();

		$image_sizes[] = array(
			'value' => 'full',
			'label' => esc_html__( 'Full', 'qubely' ),
		);

		foreach ( $sizes as $size ) {
			if ( in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ), true ) ) {
				$image_sizes[] = array(
					'value' => $size,
					'label' => ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) ),
				);
			} else {
				$image_sizes[] = array(
					'value' => $size,
					'label' => sprintf(
						'%1$s (%2$sx%3$s)',
						ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) ),
						$_wp_additional_image_sizes[ $size ]['width'],
						$_wp_additional_image_sizes[ $size ]['height']
					),
				);
			}
		}
		return $image_sizes;
	}

	public function get_image_sizes(){
		$data = Fns::get_all_image_sizes_guten();
		return rest_ensure_response($data);
	}

}