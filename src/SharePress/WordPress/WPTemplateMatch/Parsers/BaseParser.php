<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 23:36
 */

namespace share\SharePress\WordPress\WPTemplateMatch\Parsers;

use share\SharePress\Facades\App;
use share\SharePress\Facades\Container;
use share\SharePress\FileHandling\ClassesNamespaces;

abstract class BaseParser
{
	public function parse($directory, $pipeline = [])
	{
		if (!!$pipeline && count($pipeline) > 0) {
			foreach ($pipeline as $item) {
				$controllerResult = $this->tryRunController($directory, $item);
				if (!!$controllerResult) {
					return $controllerResult;
				}
			}
		}
		// Parses index
		return $this->tryRunController($directory, "Index");
	}

	protected function tryRunController($directory, $controller)
	{
		if ($file = $this->isController($directory, $controller)) {
			$class      = ClassesNamespaces::getClass($file);
			$controller = Container::make($class);
			return Container::call([$controller, 'index']);
		}
		return null;
	}

	protected function isController($directory, $filename)
	{
		$appDirectory = App::getDirectory("app");
		$filePath     = "${appDirectory}/${directory}/${filename}.php";
		if (is_file($filePath)) {
			return $filePath;
		} else {
			return false;
		}
	}
}