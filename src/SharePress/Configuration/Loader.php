<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 16:45
 */

namespace share\SharePress\Configuration;

use share\SharePress\Facades\Container;
use share\SharePress\FileHandling\ClassesNamespaces;

class Loader
{
	// TODO: refactor for code reuse inside each method
	public static function load($fileOrDirectory, $namespace = null)
	{
		if(is_dir($fileOrDirectory)) {
			$loaders = scandir($fileOrDirectory);
			foreach ($loaders as $loader) {
				if (stripos($loader, ".") !== 0) {
					if (is_dir($fileOrDirectory . "/" . $loader)) {
						self::load($fileOrDirectory . "/" . $loader, $namespace !== null ? $namespace . "\\" . $loader : null);
					} else {
						$class = ClassesNamespaces::getClass($loader, $fileOrDirectory, $namespace);
						$loaderLoaded = Container::make($class, ['configuration' => config('app')]);
					}
				}
			}
		}
		else if(is_file($fileOrDirectory)) {
			$class = ClassesNamespaces::getClass($fileOrDirectory, "", $namespace);
			$loaderLoaded = Container::make($class, ['configuration' => config('app')]);
		}
		// TODO: consider a class name as input
	}

	public static function loadAjaxHandlers($fileOrDirectory, $namespace = null)
	{
		$handlerRegistry = function ($loader, $fileOrDirectory, $namespace) {
			$class   = ClassesNamespaces::getClass($loader, $fileOrDirectory, $namespace);
			$handler = Container::make($class);
			if (method_exists($handler, 'handlerName')) {
				add_action('wp_enqueue_scripts', function () use ($handler) {
					Container::call([$handler, 'scriptLocalizer']);
				});
				add_action('admin_enqueue_scripts', function () use ($handler) {
					Container::call([$handler, 'scriptLocalizer']);
				});
				if (is_user_logged_in()) {
					/**
					 * Fires authenticated AJAX actions for logged-in users.
					 */
					add_action('wp_ajax_' . app()->getContainer()->call([$handler, 'handlerName']) . '_handler', function () use ($handler) {
						Container::call([$handler, 'index']);
					});
				} else {
					/**
					 * Fires non-authenticated AJAX actions for logged-out users.
					 */
					add_action('wp_ajax_nopriv_' . app()->getContainer()->call([$handler, 'handlerName']) . '_handler', function () use ($handler) {
						Container::call([$handler, 'index']);
					});
				}
			}
		};

		if(is_dir($fileOrDirectory)) {
			$loaders = scandir($fileOrDirectory);
			foreach ($loaders as $loader) {
				if (stripos($loader, ".") !== 0) {
					if (is_dir($fileOrDirectory . "/" . $loader)) {
						self::loadAjaxHandlers($fileOrDirectory . "/" . $loader, $namespace !== null ? $namespace . "\\" . $loader : null);
					} else {
						$handlerRegistry($loader, $fileOrDirectory, $namespace);
					}
				}
			}
		}
		else if(is_file($fileOrDirectory)) {
			$handlerRegistry($fileOrDirectory, "", $namespace);
		}
		// TODO: consider a class name as input
	}
}