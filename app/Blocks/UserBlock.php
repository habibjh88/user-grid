<?php

namespace USGR\UserGrid\Blocks;

use USGR\UserGrid\Abstracts\BlockBase;
use USGR\UserGrid\Utils\Attributes;
use USGR\UserGrid\Utils\RenderContent;
use USGR\UserGrid\Utils\RenderSlider;

/**
 * UserBlock Class
 */
class UserBlock extends BlockBase {

	private $prefix;

	private $block_type;

	/**
	 * Class Constructor
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_blocks' ] );
		$this->block_type = 'usgr/user-grid';
	}

	/**
	 * Register Block
	 *
	 * @return void
	 */
	public function register_blocks() {
		register_block_type(
			$this->block_type,
			[
				'render_callback' => [ $this, 'render_block' ],
				'attributes'      => $this->get_attributes(),
			]
		);
	}

	/**
	 * Get attributes
	 *
	 * @param bool $default
	 *
	 * @return array
	 */
	public function get_attributes() {
		$initial = [
			'uniqueId' => [
				'type'    => 'string',
				'default' => '',
			],

			'hasPro'   => [
				'type'    => 'string',
				'default' => usgrUG()->hasPro(),
			],

			'preview'  => [
				'type'    => 'boolean',
				'default' => false,
			],
		];

		return array_merge(
			$initial,
			Attributes::layout(),
			Attributes::query(),
			Attributes::slider(),
			Attributes::visibility(),
			Attributes::image(),
			Attributes::user_name(),
			Attributes::designation(),
			Attributes::email(),
			Attributes::phone(),
			Attributes::biography(),
			Attributes::job_role(),
			Attributes::social(),
			Attributes::button(),
			Attributes::card(),
			Attributes::horizontal_line(),
			Attributes::pagination(),
			Attributes::recent_post(),
		);
	}

	/**
	 * Render Block
	 *
	 * @param $data
	 *
	 * @return false|string
	 */
	public function render_block( $data ) {
		ob_start();
		if ( 'slider' === $data['layout_style'] ) {
			RenderSlider::get_render_content( $data );
		} else {
			RenderContent::get_render_content( $data );
		}
		return ob_get_clean();
	}
}
