<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 01/03/2018
 * Time: 23:10
 */

namespace share\SharePress\Install;


use share\SharePress\Install\Commands\FirstInstall;
use Symfony\Component\Console\Application;

class Manager
{
	public static $instance;
	private $console;
	public function __construct()
	{
		$this->console = new Application();
		$this->console->add(new FirstInstall());
		$this->console->run();
	}

	public static function install () {
		self::$instance = new self();
	}
}