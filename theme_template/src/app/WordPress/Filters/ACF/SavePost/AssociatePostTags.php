<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\WordPress\Filters\ACF\SavePost;

use share\SharePress\WordPress\FilterObserver;

class AssociatePostTags extends FilterObserver
{
	public $filter = "acf/save_post";

	public function handler($post_id)
	{
		if (get_post_type() === "post") {
			$tags = get_field('tags');
			wp_set_object_terms($post_id, $tags, 'post_tag', false);
		}
	}
}