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

class ConselhoCientifico
{
	public function index()
	{
		Config::load('acf');

		global $post;
		$the_page = new Page($post);

		$people                = [];
		$scientificCouncilTerm = RolesTag::find(Config::get('acf.scientific_council_tag'), 'roles');

		if (!$scientificCouncilTerm instanceof \WP_Error) {
			$people = People::set('tax_query', [
				[
					'taxonomy' => 'roles',
					'field' => 'id',
					'terms' => [$scientificCouncilTerm->term_id],
					'operator' => 'IN'
				]
			])
							->load();
		}

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

		return view('pages.conselho-cientifico', [
			'page' => $the_page,
			'people' => $people,
			'headerMenuItems' => $headerMenuItems,
			'footerMenuItems' => $footerMenuItems,
			'footerDisclaimer' => $footerDisclaimer,
		]);
	}
}