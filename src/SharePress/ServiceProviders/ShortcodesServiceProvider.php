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
use share\SharePress\Facades\Container;
use share\SharePress\WordPress\Shortcodes\Registry;

class ShortcodesServiceProvider implements IServiceProvider
{
	public function register()
	{
		Container::singleton(Registry::class, function () {
			return new Registry();
		});
		Container::alias(Registry::class, 'shortcode_registry');
	}

	public function boot()
	{
	}
}