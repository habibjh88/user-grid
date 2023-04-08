<?php

namespace GT\GtUsers\Controllers\Api;

class RestApi {
	/**
	 * Register rest route
	 */
	public function __construct() {
		new GetUsersV1();
	}
}