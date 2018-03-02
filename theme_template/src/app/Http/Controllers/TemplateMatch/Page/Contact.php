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
use prevenir\Business\Models\Posts\People;
use prevenir\Business\Models\Posts\RolesTag;
use share\SharePress\Facades\Config;

class Contact
{
	public function index()
	{

		global $post;
		$the_page = new Page($post);



		$footerMenuItems = [
			MenuItems::load('footer-menu-1'),
			MenuItems::load('footer-menu-2'),
			MenuItems::load('footer-menu-3'),
		];

		$footerDisclaimer = Config::get('acf.footer_disclaimer');

		return view('pages.contact', [
			'page' => $the_page,
			'footerMenuItems' => $footerMenuItems,
			'footerDisclaimer' => $footerDisclaimer,
		]);
	}
}