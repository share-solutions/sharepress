<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:31
 */

namespace share\SharePress\ServiceProviders;

use share\SharePress\Facades\App;
use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\Facades\Strings;
use share\SharePress\FileHandling\ClassesNamespaces;

class RESTServiceProvider implements IServiceProvider
{
	private $registeredRoutes;

	public function register()
	{
		$config = Container::make('config');
		$config->load('rest');
	}

	public function boot()
	{
		$appDir             = App::getDirectory('app/');
		$finalEndpointsDir  = $appDir . "Http/Controllers/REST";
		$endpointsDirectory = Config::get('rest.controllers');
		if (isset($endpointsDirectory)) {
			$finalEndpointsDir = $appDir . $endpointsDirectory;
		}
		$routesConfig = Config::get('rest.routes');

		add_action('rest_api_init', function () use ($routesConfig, $finalEndpointsDir) {
			$this->registeredRoutes = $this->registerRoutes($routesConfig, $finalEndpointsDir);
			if (Config::get('rest.suppress_default')) {
				add_filter('rest_endpoints', array($this, 'filter_enabled_endpoints'));
			}
		});
	}

	private function registerRoutes($restNamespaces, $directory)
	{
		$ret = [];
		foreach ($restNamespaces as $namespace => $routes) {
			foreach ($routes as $route => $routeConfiguration) {
				$routeComponents = $this->parseRouteComponents($route, $namespace, $directory);
				$ret[]           = '/' . $namespace . $routeComponents->route;
				register_rest_route($namespace, $routeComponents->route, array(
					'methods' => $routeConfiguration->methods,
					'callback' => function (\WP_REST_Request $request_data) use ($routeComponents) {
						$controller = Container::make($routeComponents->controllerClass);
						// enforce responses are of type WP_REST_Response
						$response = Container::call([$controller, $routeComponents->method], [$request_data]);
						if($response instanceof \WP_REST_Response) {
							return $response;
						}
						return new \WP_Error(510, "Response must be an instance of WP_REST_Response");
					},
					'args' => json_decode(json_encode($routeConfiguration->args), true)
				));
			}
		}
		return $ret;
	}

	private function parseRouteComponents($routeStr, $namespace, $directory)
	{
		$ds = DIRECTORY_SEPARATOR;

		$components = explode("@", $routeStr);

		$routeParts = array_map(function ($str) {
			return Strings::slugToCamelCase($str, true);
		}, explode("/", $components[0]));

		$controllerClassFilename = $routeParts[count($routeParts) - 1] . 'Controller.php';

		$pathToController = array_slice($routeParts, 0, count($routeParts) - 1);
		$pathToController = rtrim($directory . $ds . $namespace . $ds . implode($ds, $pathToController), $ds);

		$controllerClass = ClassesNamespaces::getClass($controllerClassFilename, $pathToController);

		return (object)[
			'route' => '/' . $components[0],
			'controllerClass' => $controllerClass,
			'method' => isset($components[1]) ? $components[1] : 'index'
		];
	}

	public function filter_enabled_endpoints($endpoints)
	{
		foreach ($endpoints as $endpoint => $data) {
			if (!in_array($endpoint, $this->registeredRoutes)) {
				unset($endpoints[$endpoint]);
			}
		}
		return $endpoints;
	}
}