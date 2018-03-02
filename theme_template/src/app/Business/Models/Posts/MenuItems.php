<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 20/02/2018
 * Time: 22:51
 */

namespace prevenir\Business\Models\Posts;


use share\SharePress\Database\Support\BaseModel;

class MenuItems extends BaseModel
{
	protected $queryType = "disabled";

	protected $postType = "menu";

	protected $customFields = [];

	public $children = [];

	public static function load ($locationName) {
		$menu_name = $locationName;
		$locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
		return self::buildTree($menuitems);
	}

	public static function buildTree ($menuItems) {
		$ret = [];
		foreach ($menuItems as $item) {
			$element = new static($item);
			if(intval($element->menu_item_parent) !== 0) {
				$parentElemIndex = self::getElementWithID ($ret, $element->menu_item_parent);
				if($parentElemIndex !== null) {
					$ret[$parentElemIndex]->addChild($element);
				}
			}
			else {
				$ret[] = $element;
			}
		}
		return $ret;
	}

	public static function getElementWithID ($menuItems, $id) {
		foreach ($menuItems as $index => $menuItem) {
			if(intval($menuItem->ID) === intval($id)) {
				return $index;
			}
		}
		return null;
	}

	public function addChild (MenuItems $item) {
		$this->children[] = $item;
	}

	public function getAttrObjectType () {
		return $this->object;
	}

	public function getAttrCor () {
		if($this->object_type === 'category') {
			$temp = Category::find($this->object_id);
			return $temp->cor;
		}
		return "#000";
	}
}