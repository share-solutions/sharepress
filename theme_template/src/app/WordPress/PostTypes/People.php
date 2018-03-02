<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 15:37
 */

namespace prevenir\WordPress\PostTypes;

use share\SharePress\Configuration\IRegister;
use share\SharePress\Configuration\Register;

class People extends Register implements IRegister
{
	public function register () {
		$labels = array(
			"name" => __( 'Pessoas', '' ),
			"singular_name" => __( 'Pessoa', '' ),
		);

		$args = array(
			"label" => __( 'Pessoa', '' ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"has_archive" => true,
			"show_in_menu" => true,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			// %roles% is used in slug to enable WordPress\Filters\PostTypeLink
			"rewrite" => array( "slug" => "pessoas/%roles%", "with_front" => false ),
			"query_var" => true,
			"supports" => array( "title", /*"editor", */"thumbnail"/*, "excerpt", "page-attributes"*/),
		);
		register_post_type( "people", $args );
	}
}