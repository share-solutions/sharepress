<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\WordPress\Filters\ACF\Fields\Taxonomy;

use share\SharePress\WordPress\FilterObserver;

class Query extends FilterObserver
{
	public $filter = "acf/fields/taxonomy/query";
	public $num_args = 3;
	public function handler ($args, $field, $postId) {
		if ($field['name'] === "categoria_destaque_experimente" || $field['name'] === "receitas_top_category") {
			$args['parent'] = 0;
		}
		return $args;
	}
}