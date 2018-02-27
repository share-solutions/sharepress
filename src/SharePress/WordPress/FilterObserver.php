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

abstract class FilterObserver
{
	public $priority = 10;
	public $num_args = 1;
	public $active = true;
	public function __construct($forceActivation = false)
	{
		if(property_exists($this, "filter") && method_exists($this, "handler") && ($this->active || $forceActivation)) {
			if(is_array($this->filter)) {
				foreach ($this->filter as $filter) {
					add_filter($filter['name'], function () {
						return Container::call(
							[$this, 'handler'],
							Reflector::mapArgumentsToMethod($this, 'handler', func_get_args())
						);
					}, isset($filter['priority'])?$filter['priority']:null, isset($filter['num_args'])?$filter['num_args']:null);
				}
			}
			else {
				add_filter($this->filter, function () {
					return Container::call(
						[$this, 'handler'],
						Reflector::mapArgumentsToMethod($this, 'handler', func_get_args())
					);
				}, $this->priority, $this->num_args);
			}
		}
	}
}