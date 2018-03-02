<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\WordPress\Filters\ACF\Location\PostCategoryAncestor;

use share\SharePress\WordPress\FilterObserver;

// https://support.advancedcustomfields.com/forums/topic/rules-for-sub-category/

class RuleValues extends FilterObserver
{
	public $filter = "acf/location/rule_values/post_category_ancestor";
	public function handler ($choices) {
		// copied from acf rules values for post_category
		$terms = acf_get_taxonomy_terms('category');
		if (!empty($terms)) {
			$choices = array_pop($terms);
		}
		return $choices;
	}
}