<?php

namespace DOWP\UserGrid\Controllers\Api;

class RestApi {
	/**
	 * Register rest route
	 */
	public function __construct() {
		new GetUsersV1();
	}
}