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

class RuleMatch extends FilterObserver
{
	public $filter = "acf/location/rule_match/top_hierarchy_term";
	public $num_args = 3;
	public function handler ($match, $rule, $options) {
		if(isset($_GET['tag_ID'])) {
			$term = get_term($_GET['tag_ID']);
			$is_master = false;
			if($term->parent === 0) {
				$is_master = true;
			}
			if ($rule['operator'] === '==') {
				return ($rule['value'] === 'yes' && $is_master) || ($rule['value'] === 'no' && !$is_master);
			}
			else {
				return ($rule['value'] !== 'yes' && $is_master) || ($rule['value'] !== 'no' && !$is_master);
			}
		}
		return false;
	}
}