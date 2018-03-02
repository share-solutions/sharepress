<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\WordPress\Filters\ACF\Location;

use share\SharePress\WordPress\FilterObserver;

// https://support.advancedcustomfields.com/forums/topic/rules-for-sub-category/

class RuleTypes extends FilterObserver
{
	public $filter = "acf/location/rule_types";
	public function handler ($choices) {
		if (!isset($choices['Post']['post_category_ancestor'])) {
			$choices['Post']['post_category_ancestor'] = 'Post Category Ancestor';
		}
		if (!isset($choices['Forms']['top_hierarchy_term'])) {
			$choices['Forms']['top_hierarchy_term'] = 'Taxonomy is Master Term';
		}
		return $choices;
	}
}