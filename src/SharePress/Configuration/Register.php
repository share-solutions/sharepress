<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 15:43
 */

namespace share\SharePress\Configuration;


abstract class Register implements IRegister
{
	protected $active = true;

	public function __construct()
	{
		if($this->active) {
			$this->register ();
		}
	}

	public function register () {
		return false;
	}

}