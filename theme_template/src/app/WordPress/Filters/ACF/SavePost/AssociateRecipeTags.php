<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\WordPress\Filters\ACF\SavePost;

use share\SharePress\WordPress\FilterObserver;

class AssociateRecipeTags extends FilterObserver
{
	public $filter = "acf/save_post";
	public $active = false;
	public function handler($post_id)
	{
		/*
		$topCategory = Category::getPostTopCategory(get_the_ID());
		if (get_post_type() === "post" && $topCategory->slug === 'receitas') {
			$recipeTags = get_field('tags');
			wp_set_object_terms($post_id, $recipeTags, 'recipes_tags', false);
		}
		*/
	}
}