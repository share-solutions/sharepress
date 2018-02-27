<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 26/02/2018
 * Time: 12:53
 */

namespace share\SharePress\Helpers\Reflection;


class Reflector
{
	public static function mapArgumentsToMethod ($instance, $method, $arguments) {
		$reflector = new \ReflectionMethod($instance, $method);
		$params = [];
		foreach ($reflector->getParameters() as $index => $parameter) {
			if(isset($arguments[$index])) {
				$params[$parameter->name] = $arguments[$index];
			}
		}
		return $params;
	}
}