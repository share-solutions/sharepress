<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:16
 */

namespace share\SharePress\ServiceProviders;


use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\WordPress\WPCronManager;

class CronsServiceProvider implements IServiceProvider
{
	public function boot()
	{
		if (!!Config::get("app.crons")) {
			/**
			 * Bootstrap Cron Support
			 */
			$cron = new WPCronManager();
			Container::singleton('cron', function () use ($cron) {
				return $cron;
			});
		}
	}
	public function register()
	{
		// TODO: Implement register() method.
	}
}