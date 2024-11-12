<?php

namespace USGR\UserGrid\Api;

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