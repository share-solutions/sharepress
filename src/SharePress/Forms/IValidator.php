<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 01:13
 */

namespace share\SharePress\Forms;


interface IValidator
{
	public function validate ($data, $options = []);
}