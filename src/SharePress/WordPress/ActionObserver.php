<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:45
 */

namespace share\SharePress\WordPress;

use share\SharePress\Facades\Container;
use share\SharePress\Helpers\Reflection\Reflector;

abstract class ActionObserver
{
	public $priority = 10;
	public $num_args = 1;
	public $active = true;
	public function __construct($forceActivation = false)
	{
		if(property_exists($this, "action") && method_exists($this, "handler") && ($this->active || $forceActivation)) {
			if(is_array($this->action)) {
				foreach ($this->action as $action) {
					add_action($action['name'], function () {
						return Container::call(
							[$this, 'handler'],
							Reflector::mapArgumentsToMethod($this, 'handler', func_get_args())
						);
					}, isset($action['priority'])?$action['priority']:null, isset($action['num_args'])?$action['num_args']:null);
				}
			}
			else {
				add_action($this->action, function () {
					return Container::call(
						[$this, 'handler'],
						Reflector::mapArgumentsToMethod($this, 'handler', func_get_args())
					);
				}, $this->priority, $this->num_args);
			}
		}
	}
}