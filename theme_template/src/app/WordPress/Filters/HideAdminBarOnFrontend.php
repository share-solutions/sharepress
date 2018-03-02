<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 16/02/2018
 * Time: 16:35
 */

namespace prevenir\WordPress\Filters;


use share\SharePress\WordPress\FilterObserver;

class HideAdminBarOnFrontend extends FilterObserver
{
	public $filter = "show_admin_bar";
	public function handler () {
		return false;
	}
}