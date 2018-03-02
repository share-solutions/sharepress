<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 16/02/2018
 * Time: 16:35
 */

namespace prevenir\WordPress\Filters;


use share\SharePress\WordPress\FilterObserver;

class PageTemplates extends FilterObserver
{
	public $filter = [
		['name' => "theme_people_templates", 'num_args' => 4],
		['name' => "theme_page_templates", 'num_args' => 4]
	];
	public $num_args = 4;
	public $active = false;
	public function handler ($post_templates, $theme, $post, $post_type) {
		$post_templates['xpto.php'] = 'Teste';
		return $post_templates;
	}
}