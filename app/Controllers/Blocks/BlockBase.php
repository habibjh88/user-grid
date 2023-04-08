<?php

namespace GT\GtUsers\Controllers\Blocks;

use GT\GtUsers\Helpers\Fns;

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