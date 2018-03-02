<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 15:37
 */

namespace prevenir\WordPress\Taxonomies;

use share\SharePress\Configuration\IRegister;
use share\SharePress\Configuration\Register;

class Roles extends Register implements IRegister
{
	public function register () {
		$labels = array(
			"name" => __( 'Papeis / Roles', '' ),
			"singular_name" => __( 'Papel / Role', '' ),
			'menu_name' => __( 'Papeis / Roles' )
		);

		$args = array(
			"label" => __( 'Papeis / Roles', '' ),
			"labels" => $labels,
			"public" => true,
			"hierarchical" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => array( 'slug' => 'roles', 'with_front' => true, ),
			"show_admin_column" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"show_in_quick_edit" => true,
			"meta_box_cb" => false,
		);
		register_taxonomy( "roles", array( "people" ), $args );
	}
}