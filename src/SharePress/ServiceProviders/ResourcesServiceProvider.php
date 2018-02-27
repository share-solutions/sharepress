<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:20
 */

namespace share\SharePress\ServiceProviders;


use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\FileHandling\ResourcesLoader;

class ResourcesServiceProvider implements IServiceProvider
{
	public function boot()
	{
		if (!!Config::get("app.resources")) {
			/**
			 * Bootstrap Resources Loader Support
			 */
			$resourcesLoaderClass = Config::get("app.resources.loader");
			if(!$resourcesLoaderClass) {
				$resourcesLoaderClass = ResourcesLoader::class;
			}
			Container::singleton("resources", function () use ($resourcesLoaderClass) {
				$resourcesLoader = new $resourcesLoaderClass();
				return $resourcesLoader;
			});

			add_action('wp_enqueue_scripts', function () {
				Container::make("resources")->loadResources(ResourcesLoader::FRONTEND);
			});
			add_action('admin_enqueue_scripts', function () {
				Container::make("resources")->loadResources(ResourcesLoader::ADMIN);
				//Container::make("resources")->loadResources(ResourcesLoader::EDITOR);
			});
		}
	}
	public function register()
	{
		// TODO: Implement register() method.
	}
}