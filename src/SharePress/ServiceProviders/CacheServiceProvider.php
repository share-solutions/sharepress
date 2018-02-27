<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:15
 */

namespace share\SharePress\ServiceProviders;

use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\WordPress\WPCache;

class CacheServiceProvider implements IServiceProvider
{
	public function boot()
	{
		if (!!Config::get("app.cache")) {
			/**
			 * Bootstrap Cache Support
			 */
			$cache = new WPCache();
			Container::singleton('cache', function () use ($cache) {
				return $cache;
			});
		}
	}
	public function register()
	{
		// TODO: Implement register() method.
	}
}