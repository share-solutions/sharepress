<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace share\SharePress\WordPress\Security\Actions;

use share\SharePress\WordPress\ActionObserver;

class PreventUserEnumeration extends ActionObserver
{
	public $action = "init";
	public $priority = 100;
	public function handler () {
		if (!is_admin() && isset($_REQUEST['author'])) {
			status_header(404);
			die();
		}
	}
}