<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 16/02/2018
 * Time: 16:35
 */

namespace prevenir\WordPress\Filters\WPQuery;


use share\SharePress\WordPress\FilterObserver;

class PostsWherePostPeople extends FilterObserver
{
	public $filter = "posts_where";
	public function handler ($where) {
		$where = str_replace("meta_key = 'autores_$", "meta_key LIKE 'autores_%", $where);
		$where = str_replace("meta_key = 'colaboradores_$", "meta_key LIKE 'colaboradores_%", $where);
		return $where;
	}
}