<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace share\SharePress\WordPress\Security\Filters;

use share\SharePress\Facades\Resources;
use share\SharePress\WordPress\FilterObserver;

class DisableXMLRPC extends FilterObserver
{
	public $filter = "xmlrpc_enabled";
	public function handler () {
		return false;
	}
}