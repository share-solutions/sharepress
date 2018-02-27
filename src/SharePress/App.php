<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 01/02/2018
 * Time: 10:51
 */

namespace share\SharePress;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use share\SharePress\ServiceProviders\AjaxServiceProvider;
use share\SharePress\ServiceProviders\BladeServiceProvider;
use share\SharePress\ServiceProviders\CacheServiceProvider;
use share\SharePress\ServiceProviders\CronsServiceProvider;
use share\SharePress\ServiceProviders\CurlServiceProvider;
use share\SharePress\ServiceProviders\EloquentServiceProvider;
use share\SharePress\ServiceProviders\EmailsServiceProvider;
use share\SharePress\ServiceProviders\LogServiceProvider;
use share\SharePress\ServiceProviders\ResourcesServiceProvider;
use share\SharePress\ServiceProviders\RESTServiceProvider;
use share\SharePress\ServiceProviders\TemplateMatchServiceProvider;
use share\SharePress\ServiceProviders\URLServiceProvider;
use share\SharePress\ServiceProviders\WPConfigurationServiceProvider;
use share\SharePress\ServiceProviders\WPExtensionsServiceProvider;
use share\SharePress\ServiceProviders\WPSecurityServiceProvider;
use share\SharePress\Stores\Config;

class App
{
	private $bootstrapDir;
	private $loaded = false;
	private $container;
	private $serviceProviders;
	private $frameworkDir;

	public function __construct($bootstrapDir)
	{
		if (!$this->loaded) {
			$this->frameworkDir = __DIR__;
			$this->bootstrapDir = $bootstrapDir;
			$this->bootstrap();
			$this->loaded = true;
		}
	}

	private function bootstrap()
	{
		$this->setupContainer();
		$this->setupConfiguration();
		$this->setupBlade();

		$this->serviceProviders = $this->collectServiceProviders();
		$this->registerServiceProviders();

		do_action('share_press:loaded');

		$this->bootServiceProviders();

		do_action('share_press:boot');
	}

	private function setupContainer()
	{
		Container::setInstance(new Container());
		$this->container = Container::getInstance();
		// inject app into the container
		$this->container->singleton(App::class, function () {
			return $this;
		});
		$this->container->alias(App::class, 'app');
		//
		$this->container->singleton('container', function () {
			return $this->getContainer();
		});
		Facade::setFacadeApplication($this->container);
	}

	private function setupConfiguration()
	{
		$this->container->singleton(Config::class, function () {
			return new Config($this->bootstrapDir);
		});
		$this->container->alias(Config::class, 'config');
		$config = $this->container->make('config');
		$config->load('app');
	}

	private function setupBlade() {
		$serviceProvider = BladeServiceProvider::class;
		$this->container->singleton($serviceProvider, function () use ($serviceProvider) {
			return new $serviceProvider();
		});
		$this->container
			->make($serviceProvider)
			->register();
		$this->container
			->make($serviceProvider)
			->boot();
	}

	private function collectServiceProviders()
	{
		$serviceProviders = (array) \share\SharePress\Facades\Config::get('app.service_providers');
		return $serviceProviders;
	}

	private function registerServiceProviders()
	{
		foreach ($this->serviceProviders as $serviceProvider) {
			$this->container->singleton($serviceProvider, function () use ($serviceProvider) {
				return new $serviceProvider();
			});
			$this->container
				->make($serviceProvider)
				->register();
		}
	}

	private function bootServiceProviders()
	{
		foreach ($this->serviceProviders as $serviceProvider) {
			$this->container
				->make($serviceProvider)
				->boot();
		}
	}


	public function getContainer()
	{
		return $this->container;
	}

	public function getDirectory($append = "")
	{
		return $this->bootstrapDir . ($append !== "" ? $append : "");
	}

	public function getFrameworkDirectory($append = "")
	{
		return $this->frameworkDir . ($append !== "" ? $append : "");
	}

}