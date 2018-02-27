<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 01:13
 */

namespace share\SharePress\Forms;


interface ISanitizer
{
	public function sanitize ($data, $options = []);
}