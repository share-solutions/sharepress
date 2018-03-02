<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:47
 */

namespace prevenir\WordPress\Actions;

use prevenir\Business\Models\Posts\Category;
use prevenir\Business\Models\Posts\Post;
use share\SharePress\WordPress\ActionObserver;

class SaveTopCategoryOnSavePost extends ActionObserver
{
	protected $action = "updated_post_meta"; // updated_post_meta is the last action to be executed after post saving

	public $num_args = 4;
	public function handler ($meta_id, $post_id, $meta_key = '', $meta_value = '') {
		$the_post = Post::find($post_id);
		if($the_post->post_type === 'post') {
			foreach ($the_post->categories as $item) {
				if($item->parent == 0) {
					// there's already a top category present, do nothing
					return;
				}
			}
			$topCat = $the_post->categories[0];
			while($topCat->parent != 0) {
				$topCat = Category::find($topCat->parent);
			}
			$allCatsToSave = array_merge($the_post->categories, [$topCat]);
			$allCatsToSave = array_pluck($allCatsToSave, 'term_id');
			//wp_set_post_categories($the_post->ID, $allCatsToSave);
		}

	}
}