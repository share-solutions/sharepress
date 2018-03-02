<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:39
 */
namespace prevenir\Http\Requests;

use prevenir\Business\Models\Posts\MenuItems;
use share\SharePress\Facades\Config;
use share\SharePress\Http\BaseRequest;

class Request extends BaseRequest
{
	public function __construct($request = null)
	{
		parent::__construct($request);

		Config::load('acf');
		$this->headerMenuItems = [
			MenuItems::load('header-menu-1'),
			MenuItems::load('header-menu-2'),
		];
		$this->footerMenuItems = [
			MenuItems::load('footer-menu-1'),
			MenuItems::load('footer-menu-2'),
			MenuItems::load('footer-menu-3'),
		];

		$this->footerDisclaimer = Config::get('acf.footer_disclaimer');
	}
}