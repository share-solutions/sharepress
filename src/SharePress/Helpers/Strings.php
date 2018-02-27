<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 23:05
 */

namespace share\SharePress\Helpers;


class Strings
{
	public function slugToCamelCase ($string, $ucfirst = false) {
		$transform = preg_replace_callback('/[-_](.)/', function ($matches) {
			return strtoupper($matches[1]);
		}, $string);
		return ($ucfirst ? ucfirst($transform) : $transform);
	}

	public function camelCaseToSnake ($string, $lower = true) {
		$snaked = preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", $string);
		return ($lower ? strtolower($snaked) : $snaked);
	}
}