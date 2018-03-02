<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 16:59
 */

namespace prevenir\Http\Controllers\Ajax;

use prevenir\Business\Models\Posts\Category;
use prevenir\Business\Models\Posts\Tag;
use prevenir\Business\Repos\Posts\PostsRepo;
use prevenir\Http\Requests\Request;
use share\SharePress\Facades\Container;
use share\SharePress\Http\BaseAjaxController;
use share\SharePress\WordPress\Shortcodes\Registry;

class TinymceShortcodesController extends BaseAjaxController
{
	protected $localizerHandle = "tinymce.js";

	public function index (Request $request) {

		// $this->validateNonce(); // TODO: isto devia de ir para o Request

		$tag = $request->tag;
		$atts = $request->atts;
		$content = $request->content;

		$instance = Container::make(Registry::class)->get($tag);

		if (true) {
			wp_send_json_success( $instance->run($tag, $atts, $content) );
		}
		wp_send_json_error("error");
	}
}