<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 13:57
 */

namespace share\SharePress\Stores;


interface ILogger
{
	public function __construct($model);
	public function add ($data);
}