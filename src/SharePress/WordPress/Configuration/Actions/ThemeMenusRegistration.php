<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace share\SharePress\WordPress\Configuration\Actions;

use share\SharePress\WordPress\ActionObserver;

class ThemeMenusRegistration extends ActionObserver
{
	public $action = "init";

	private $themeMenus;
	public function __construct($themeMenus)
	{
		$this->themeMenus = json_decode(json_encode($themeMenus), true);
		parent::__construct();
	}

	public function handler () {
		foreach ($this->themeMenus as $menuLocation => $menuDescription) {
			register_nav_menu($menuLocation, $menuDescription);
		}
	}
}