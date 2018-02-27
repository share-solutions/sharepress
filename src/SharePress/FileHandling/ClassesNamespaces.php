<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 01/02/2018
 * Time: 10:36
 */

namespace share\SharePress\FileHandling;


class ClassesNamespaces
{
	public static function getClass ($file, $directory = "", $namespace = null, $fullQualified = true) {
		$finalNamespace = "";
		// remove loader class file extension
		$loader = basename(preg_replace('/\\.[^.\\s]{3,4}$/', '', $file));
		if($fullQualified) {
			if($namespace !== null) {
				$finalNamespace = $namespace . '\\';
			}
			else {
				$finalNamespace = self::extractNamespace($directory !== "" ? $directory . '/' . $file : $file) . '\\';
			}
		}
		return $finalNamespace . $loader;
	}
	private static function extractNamespace ($file) {
		$src = file_get_contents($file);

		// https://gist.github.com/naholyr/1885879
		// by regexp
		if (preg_match('#^namespace\s+(.+?);$#sm', $src, $m)) {
			return $m[1];
		}
		return null;
	}
}