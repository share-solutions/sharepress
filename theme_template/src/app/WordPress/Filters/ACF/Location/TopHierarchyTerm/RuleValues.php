<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\WordPress\Filters\ACF\Location\TopHierarchyTerm;

use share\SharePress\WordPress\FilterObserver;

// https://support.advancedcustomfields.com/forums/topic/rules-for-sub-category/

class RuleValues extends FilterObserver
{
	public $filter = "acf/location/rule_values/top_hierarchy_term";
	public function handler ($choices) {
		$options = ["Options" => ['yes' => 'Yes', 'no' => 'No']];
		$choices = array_pop($options);
		return $choices;
	}
}