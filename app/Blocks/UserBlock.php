<?php

namespace DOWP\UserGrid\Blocks;

use DOWP\UserGrid\Helpers\Fns;
use DOWP\UserGrid\Abstract\BlockBase;
use DOWP\UserGrid\Utils\Attributes;
use DOWP\UserGrid\Utils\RenderContent;

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
		$this->block_type = 'dowp/user-grid';
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
				'default' => userGrid()->hasPro(),
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
		RenderContent::get_render_content( $data );
		return ob_get_clean();
	}
}
