<?php

namespace DOWP\UserGrid\Controllers\Api;

/**
 * RestApi Class
 */
class RestApi {
	/**
	 * Register rest route
	 */
	public function __construct() {
		new GetUsersAPI();
	}
}