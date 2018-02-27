<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 23/03/2017
 * Time: 11:57
 */

namespace share\SharePress\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use share\SharePress\FileHandling\ClassesNamespaces;
use share\SharePress\Stores\Config;

class Migrator {
    protected $prefix;

    protected $inDevelopment;
    protected $bootstrapDir;

    private $config;
    public function __construct($bootstrapDir, $arguments, $developmentMode = false) {
    	if($developmentMode) {
			$this->inDevelopment = $developmentMode;
			$this->bootstrapDir = $bootstrapDir;
    		$this->setupConfiguration ();
    		$this->setupDatabaseCapsule ();
    		$this->run ($arguments);
		}
    }

    private function run ($args) {
    	switch ($args[0]) {
			case "up":
				$this->create();
				return;
			case "down":
				$this->dropAll();
				return;
		}
	}

    private function setupConfiguration () {
		$this->config          = new Config($this->bootstrapDir);
		$this->config->load('app');
		$this->config->load('database');
	}

	private function setupDatabaseCapsule () {
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
	}

    private function collectMigrations ($directory) {
		$result = [];
		$migrations = scandir($directory);
		foreach ($migrations as $migration) {
			if (stripos($migration, ".") !== 0) {
				if (is_dir($directory . "/" . $migration)) {
					array_merge ($result, self::collectMigrations($directory . "/" . $migration));
				} else {
					$class = ClassesNamespaces::getClass($migration, $directory);
					$result[] = new $class();
				}
			}
		}
        return $result;
    }

    public function dropAll() {
		$migrations = $this->collectMigrations($this->bootstrapDir . "/database/" . $this->config->get('database.migrations'));
		//Seeder::unseed();
		foreach ($migrations as $migration) {
			$migration->down();
		}
    }

    public function create() {
		$migrations = $this->collectMigrations($this->bootstrapDir . "/database/" . $this->config->get('database.migrations'));
		foreach ($migrations as $migration) {
			$migration->up();
		}
    }
}
