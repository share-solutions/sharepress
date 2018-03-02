<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:47
 */

namespace prevenir\Http\Controllers\TemplateMatch\_404;

use prevenir\Business\Models\Posts\MenuItems;

class Index
{
	public function __construct()
	{
	}

	// Passar para o novo model
	public function index () {

		$headerMenuItems = [
			MenuItems::load('header-menu-1'),
			MenuItems::load('header-menu-2'),
		];

		return "404";
	}
}