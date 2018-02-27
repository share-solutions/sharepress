<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace share\SharePress\WordPress\Security\Actions;

use share\SharePress\WordPress\ActionObserver;

class FilterOutOffendingUserAgents extends ActionObserver
{
	public $action = "init";
	public $priority = 100;
	public function handler () {
		if (!empty($_SERVER['HTTP_USER_AGENT']) && preg_match('/WPScan/i', $_SERVER['HTTP_USER_AGENT'])) {
			die('Offending User Agent');
		}
	}
}