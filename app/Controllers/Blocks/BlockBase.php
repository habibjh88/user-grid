<?php

namespace DOWP\UserGrid\Controllers\Blocks;

use DOWP\UserGrid\Helpers\Fns;

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