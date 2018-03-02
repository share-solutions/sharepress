<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 16:59
 */

namespace prevenir\Http\Controllers\Ajax;

use prevenir\Http\Requests\Request;
use share\SharePress\Http\BaseAjaxController;

class SampleController extends BaseAjaxController
{
	protected $localizerHandle = "public.js";

	public function index (Request $request) {
		$offset = $request->page * 8;
		$args = array(
			'post_status' => 'publish',
			'posts_per_page' => 8,
			'offset' => $offset
		);

		$query = new \WP_Query($args);

		if ($query->have_posts()) {
			wp_send_json_success("ok");
		}
		wp_send_json_error("error");
	}
}