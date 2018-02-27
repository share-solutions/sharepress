<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:16
 */

namespace share\SharePress\ServiceProviders;


use share\SharePress\Facades\Container;
use share\SharePress\Http\Curl;

class CurlServiceProvider implements IServiceProvider
{
	public function boot()
	{
		Container::singleton('curl', function () {
			return new Curl();
		});
	}
	public function register()
	{
		// TODO: Implement register() method.
	}
}