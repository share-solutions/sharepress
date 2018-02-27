<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:19
 */

namespace share\SharePress\ServiceProviders;

use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\WordPress\WPTemplateMatch\Manager;

class TemplateMatchServiceProvider implements IServiceProvider
{
	public function boot()
	{
		if (!!Config::get("app.controllers.template_match")) {
			Container::make(Manager::class, ['controllersConfig' => Config::get("app.controllers.template_match")]);
		}
	}
	public function register()
	{
	}
}