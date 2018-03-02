<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 11:10
 */

namespace prevenir\Http\Controllers\TemplateMatch\Index;


use prevenir\Business\Models\Posts\MenuItems;
use share\SharePress\Facades\Config;

class Index
{

	public function index () {
		Config::load('acf');

		$headerMenuItems = [
			MenuItems::load('header-menu-1'),
			MenuItems::load('header-menu-2'),
		];

		$footerMenuItems = [
			MenuItems::load('footer-menu-1'),
			MenuItems::load('footer-menu-2'),
			MenuItems::load('footer-menu-3'),
		];

		$footerDisclaimer = Config::get('acf.footer_disclaimer');

		return view('pages.default', [
			'headerMenuItems' => $headerMenuItems,
			'footerMenuItems' => $footerMenuItems,
			'footerDisclaimer' => $footerDisclaimer,
		]);
	}
}