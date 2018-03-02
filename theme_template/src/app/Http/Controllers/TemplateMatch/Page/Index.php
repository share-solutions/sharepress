<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:47
 */

namespace prevenir\Http\Controllers\TemplateMatch\Page;


use prevenir\Business\Models\Posts\MenuItems;
use prevenir\Business\Models\Posts\Page;
use share\SharePress\Facades\Config;

class Index
{
	public function index()
	{
		global $post;
		$the_page = new Page($post);

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

		return view('pages.page', [
			'page' => $the_page,
			'headerMenuItems' => $headerMenuItems,
			'footerMenuItems' => $footerMenuItems,
			'footerDisclaimer' => $footerDisclaimer,
		]);
	}
}