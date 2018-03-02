<?php
/**
 * Created by PhpStorm.
 * User: Ângelo Marques
 * Date: 27/01/2017
 * Time: 14:07
 */

namespace prevenir\Http\Controllers\REST\v2;

/**
 * Manage the token and api key session
 */

class SampleController
{
	/**
	 * index
	 * @param $request_data \WP_REST_Request
	 * @return \WP_REST_Response
	 */
	function index ( \WP_REST_Request $request_data ){
		$params = $request_data->get_params();
		// Prepare the data to return
		$data = array(
			'error' => array(
				'code' => "",
				'message' => ""
			),
			'data' => array(
				'access_token' => ""
			),
			'request' => $params,
		);

		return new \WP_REST_Response($data);
	}
}