<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:08
 */

namespace share\SharePress\ServiceProviders;

use Illuminate\Database\Capsule\Manager as Capsule;
use share\SharePress\Facades\Container;

class EloquentServiceProvider implements IServiceProvider
{
	public function boot () {
		/**
		 * These are database connectivity and management dependencies
		 */
		$capsule = new Capsule;
		// get values from wp-config
		$capsule->addConnection(
			[
				'driver' => 'mysql',
				'host' => getenv("DBHOST"),
				'database' => getenv("DBNAME"),
				'username' => getenv("DBUSER"),
				'password' => getenv("DBPASS"),
				'charset' => 'utf8',
				'collation' => 'utf8_unicode_ci',
				'prefix' => getenv("WP_TABLE_PREFIX"),
				'strict' => true // otherwise Migrator will fail when adding timestamps due to https://github.com/laravel/framework/issues/3602 / don't forget that we are using an old illuminate/database version due to server php version
			]);
		/*
		// Set the event dispatcher used by Eloquent models... (optional)
			use Illuminate\Events\Dispatcher;
			use Illuminate\Container\Container;
			$capsule->setEventDispatcher(new Dispatcher(new Container));
		*/
		// Make this Capsule instance available globally via static methods... (optional)
		$capsule->setAsGlobal();
		// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
		$capsule->bootEloquent();

		Container::singleton('db', function () use ($capsule) {
			return $capsule;
		});
	}
	public function register()
	{
		// TODO: Implement register() method.
	}
}