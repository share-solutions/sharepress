<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:08
 */

namespace share\SharePress\ServiceProviders;


interface IServiceProvider
{
	public function register ();
	public function boot ();
}