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

class RuleMatch extends FilterObserver
{
	public $filter = "acf/location/rule_match/post_category_ancestor";
	public $num_args = 3;
	public function handler ($match, $rule, $options) {
		// most of this copied directly from acf post category rule
		$terms = 0;
		if (array_key_exists('post_taxonomy', $options)){
			$terms = $options['post_taxonomy'];
		}
		$data = acf_decode_taxonomy_term($rule['value']);
		$term = get_term_by('slug', $data['term'], $data['taxonomy']);
		if (!$term && is_numeric($data['term'])) {
			$term = get_term_by('id', $data['term'], $data['taxonomy']);
		}
		// this is where it's different than ACf
		// get terms so we can look at the parents
		if (is_array($terms)) {
			foreach ($terms as $index => $term_id) {
				$terms[$index] = get_term_by('id', intval($term_id), $term->taxonomy);
			}
		}
		if (!is_array($terms) && $options['post_id']) {
			$terms = wp_get_post_terms(intval($options['post_id']), $term->taxonomy);
		}
		if (!is_array($terms)) {
			$terms = array($terms);
		}
		$terms = array_filter($terms);
		$match = false;
		// collect a list of ancestors
		$ancestors = array();
		if (count($terms)) {
			foreach ($terms as $term_to_check) {
				// this line added to include this term
				// **********************************************************************************
				$ancestors[] = $term_to_check->term_id;
				// **********************************************************************************
				$ancestors = array_merge(get_ancestors($term_to_check->term_id, $term->taxonomy));
			} // end foreach terms
		} // end if
		// see if the rule matches any term ancetor
		if ($term && in_array($term->term_id, $ancestors)) {
			$match = true;
		}

		if ($rule['operator'] == '!=') {
			// reverse the result
			$match = !$match;
		}
		return $match;
	}
}