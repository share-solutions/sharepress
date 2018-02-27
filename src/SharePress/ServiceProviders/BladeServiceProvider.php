<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 15:13
 */

namespace share\SharePress\ServiceProviders;


use Philo\Blade\Blade as PhiloBlade;
use share\SharePress\Facades\App;
use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\ServiceProviders\IServiceProvider;

class BladeServiceProvider implements IServiceProvider
{
	public function boot()
	{
		$viewsConfiguration = Config::get('app.views');
		if (isset($viewsConfiguration)) {

			$views = App::getDirectory($viewsConfiguration->directory);
			$cache = App::getDirectory($viewsConfiguration->cache);

			$blade = new PhiloBlade($views, $cache);
			$blade->view()->addNamespace('sharepress', App::getFrameworkDirectory('/_resources/views'));

			Container::singleton('blade', function () use ($blade) {
				return $blade;
			});
		}
	}

	public function register()
	{
	}
}