<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:47
 */

namespace prevenir\Http\Controllers\TemplateMatch\Category;

use prevenir\Business\Models\Posts\Category;
use prevenir\Business\Models\Posts\MenuItems;
use prevenir\Business\Models\Posts\Post;
use prevenir\Business\Repos\Posts\PostsRepo;
use share\SharePress\Facades\Config;

class Index
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

		$category = new Category(get_queried_object());

		/**
		 * Artigos mais lidos
		 */
		$mostRead = PostsRepo::getMostRead();

		$categoryPosts = PostsRepo::getCategoryPosts($category, 7);

		$categoryPostsTop = array_slice($categoryPosts, 0, 1);
		$categoryPostsFirstLine = array_slice($categoryPosts, 1, 2);
		$categoryPostsContinuance = array_slice($categoryPosts, 3, 3);

		return view('pages.category', [
			'category' => $category,
			'mostRead' => $mostRead,
			'categoryPostsTop' => !!$categoryPostsTop ? $categoryPostsTop[0] : [],
			'categoryPostsFirstLine' => $categoryPostsFirstLine,
			'categoryPostsContinuance' => $categoryPostsContinuance,
			'ajaxHandler' => 'category_posts_handler',
			'nextPage' => count($categoryPosts) > 6 ? 1 : -1,
			'loadMore' => count($categoryPosts) > 6 ? ['cat' => $category->term_id, 'posts_per_page' => 8, 'first_offset' => 6] : false,
			'headerMenuItems' => $headerMenuItems,
			'footerMenuItems' => $footerMenuItems,
			'footerDisclaimer' => $footerDisclaimer,
		]);
	}
}