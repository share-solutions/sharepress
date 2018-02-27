<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 17/02/2018
 * Time: 14:51
 */

namespace share\SharePress\Facades;

use Illuminate\Support\Facades\Facade;

class Dates extends Facade
{
	protected static function getFacadeAccessor()
	{
		return \share\SharePress\Helpers\Dates::class;
	}
}