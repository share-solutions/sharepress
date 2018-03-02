<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:47
 */

namespace prevenir\Http\Controllers\TemplateMatch\Taxonomy;

use prevenir\Business\Models\Posts\Category;
use prevenir\Business\Models\Posts\MenuItems;
use prevenir\Business\Models\Posts\Post;
use prevenir\Business\Models\Posts\Tag;
use prevenir\Business\Repos\Posts\PostsRepo;
use share\SharePress\Facades\Config;

class Roles
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

		$tag = new Tag(get_queried_object());

		/**
		 * Artigos mais lidos
		 */
		$mostRead = PostsRepo::getMostRead();

		$categoryPosts = PostsRepo::getTagPosts($tag, 7);

		$categoryPostsTop = array_slice($categoryPosts, 0, 1);
		$categoryPostsFirstLine = array_slice($categoryPosts, 1, 2);
		$categoryPostsContinuance = array_slice($categoryPosts, 3, 3);

		return view('pages.category', [
			'category' => $tag,
			'mostRead' => $mostRead,
			'categoryPostsTop' => !!$categoryPostsTop ? $categoryPostsTop[0] : [],
			'categoryPostsFirstLine' => $categoryPostsFirstLine,
			'categoryPostsContinuance' => $categoryPostsContinuance,
			'ajaxHandler' => 'tag_posts_handler',
			'nextPage' => count($categoryPosts) > 6 ? 1 : -1,
			'loadMore' => count($categoryPosts) > 6 ? ['tag' => $tag->term_id, 'posts_per_page' => 8, 'first_offset' => 6] : false,
			'headerMenuItems' => $headerMenuItems,
			'footerMenuItems' => $footerMenuItems,
			'footerDisclaimer' => $footerDisclaimer,
		]);
	}
}