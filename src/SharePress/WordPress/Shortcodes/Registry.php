<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 23/02/2018
 * Time: 23:43
 */

namespace share\SharePress\WordPress\Shortcodes;


use share\SharePress\Helpers\RegistryIterator;

class Registry extends RegistryIterator
{
	public function __construct()
	{
		parent::__construct();
		$this->data = [];
	}
}