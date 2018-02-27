<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:31
 */

namespace share\SharePress\ServiceProviders;

use share\SharePress\Configuration\Loader;
use share\SharePress\Facades\App;
use share\SharePress\Facades\Config;

class AjaxServiceProvider implements IServiceProvider
{
	public function register()
	{
	}

	public function boot()
	{
		$appDir = App::getDirectory('app/');
		$endpointsDirectory = Config::get('app.controllers.ajax');
		if (isset($endpointsDirectory)) {
			$this->ajaxLoader($appDir . $endpointsDirectory);
		}
	}

	private function ajaxLoader($configuration)
	{
		if(isset($configuration['directory'])) {
			Loader::loadAjaxHandlers($configuration['directory'], isset($configuration['namespace']) ? $configuration['namespace'] : null);
		}
		else {
			Loader::loadAjaxHandlers($configuration);
		}
	}
}