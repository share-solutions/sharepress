<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\WordPress\Filters\ACF\SavePost;

use prevenir\Business\Models\Posts\Category;
use share\SharePress\WordPress\FilterObserver;

class AssociatePeopleTags extends FilterObserver
{
	public $filter = "acf/save_post";

	public function handler($post_id)
	{
		if (get_post_type() === "people") {
			$peopleTags = get_field('papeis');
			wp_set_object_terms($post_id, $peopleTags, 'roles', false);
		}
	}
}