<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:18
 */

namespace share\SharePress\ServiceProviders;

use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\Stores\ILogger;
use share\SharePress\Stores\Logger;

class LogServiceProvider implements IServiceProvider
{
	public function boot()
	{
		if (!!Config::get("app.logs")) {
			/**
			 * Bootstrap Logger Support
			 */
			$loggerClass = Config::get("app.logs.logger");
			if(!$loggerClass) {
				$loggerClass = Logger::class;
			}
			Container::singleton(ILogger::class, function () use ($loggerClass) {
				$logger = new $loggerClass(Config::get("app.logs.model"));
				return $logger;
			});
			Container::alias(ILogger::class, "logger");
		}
	}
	public function register()
	{
		// TODO: Implement register() method.
	}
}