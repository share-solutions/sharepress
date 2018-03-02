<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:47
 */

namespace prevenir\Http\Controllers\TemplateMatch\Single;

use prevenir\Business\Models\Posts\Category;
use prevenir\Business\Models\Posts\MenuItems;
use prevenir\Business\Models\Posts\People as PeopleModel;
use prevenir\Business\Models\Posts\RolesTag;
use prevenir\Business\Repos\Posts\PeopleRepo;
use prevenir\Business\Repos\Posts\PostsRepo;
use share\SharePress\Facades\Config;

class People
{
	public function __construct()
	{
	}

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

		$contributedPageSize = 6;

		$specialistsTerm = new RolesTag(get_term(Config::get('acf.specialists_tag'), 'roles'));
		$scientificCouncilTerm = new RolesTag(get_term(Config::get('acf.scientific_council_tag'), 'roles'));

		$person = new PeopleModel(get_post());
		$isSpecialist = false;
		if(!$specialistsTerm instanceof \WP_Error) {
			$isSpecialist = in_array($specialistsTerm->slug, array_pluck($person->roles, 'slug'));
		}

		$receitasCategory = new Category(get_category(Config::get('acf.receitas_top_category')));

		// exclude contributed recipes
		// get more than one to evaluate the need for ajax
		$contributedPosts = PostsRepo::getRelatedToContributors(get_the_ID(), $contributedPageSize + 1, 0, $receitasCategory->flat_children);

		$concelhoCientifico = [];
		if(!$scientificCouncilTerm instanceof \WP_Error) {
			$concelhoCientifico = PeopleRepo::getByRole($scientificCouncilTerm->term_id, 6);
		}
		return view('pages.people', [
			'person' => $person,
			'isSpecialist' => $isSpecialist,
			'contributedPosts' => array_slice($contributedPosts, 0, $contributedPageSize),
			'conselhoCientifico' => $concelhoCientifico,
			'ajaxHandler' => 'contributor_related_handler',
			'nextPage' => count($contributedPosts) > $contributedPageSize ? 1 : -1,
			'loadMore' => count($contributedPosts) > $contributedPageSize ? ['contributor' => get_the_ID(), 'posts_per_page' => $contributedPageSize, 'first_offset' => $contributedPageSize] : false,
			'headerMenuItems' => $headerMenuItems,
			'footerMenuItems' => $footerMenuItems,
			'footerDisclaimer' => $footerDisclaimer,
		]);
	}
}