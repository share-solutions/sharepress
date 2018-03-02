<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 20/02/2018
 * Time: 22:51
 */

namespace prevenir\Business\Models\Posts;


use share\SharePress\Database\Support\BaseModel;

class Category extends BaseModel
{
	protected $queryType = "term";

	public function getAttrPermalink () {
		return get_term_link($this->term_id);
	}

	public function getAttrParentCategory () {
		$topCategory = clone $this;
		//print_r ($topCategory->term_id . "#" . $topCategory->category_parent);
		while(isset($topCategory->parent) && !!$topCategory->parent) {
			$topCategory = new static(get_category($topCategory->parent));
		}
		return $topCategory;
	}

	public function getAttrCor () {
		return get_field('cor', $this->wpInstance);
	}

	public function getAttrFlatChildren () {
		return $this->getChildrenCategoriesIDsFlat($this->term_id);
	}

	private function getChildrenCategoriesIDsFlat ($category) {
		$categoryId = $category;
		if(! $category instanceof \WP_Term) {
			if(is_string($category)) {
				$category = new static(get_category_by_slug($category));
				$categoryId = $category->term_id;
			}
		}
		else {
			$categoryId = $category->cat_ID;
		}
		$ret[] = $categoryId;
		$children = get_categories(
			array( 'parent' => $categoryId )
		);
		foreach ($children as $child) {
			$ret = array_merge($ret, $this->getChildrenCategoriesIDsFlat($child->cat_ID));
		}
		return $ret;
	}
}