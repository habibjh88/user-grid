<?php

namespace USGR\UserGrid\Abstract;

use USGR\UserGrid\Helpers\Fns;

abstract class BlockBase {

	abstract public function get_attributes();

	abstract public function render_block( $data );

	/**
	 * Script controller
	 *
	 * @param $data
	 *
	 * @return void
	 */

	public function get_script_depends( $data ) {

	}

}