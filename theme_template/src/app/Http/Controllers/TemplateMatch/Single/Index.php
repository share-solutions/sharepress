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
use prevenir\Business\Models\Posts\Post;
use prevenir\Business\Models\Posts\Recipe;
use prevenir\Business\Repos\Posts\PostsRepo;
use prevenir\Http\Requests\Request;
use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;

class Index
{
	public function __construct()
	{
	}

	// Passar para o novo model
	public function index () {
		Config::load('acf');

		$category = new Category(get_the_category()[0]);
		$receitasCategory = Config::get('acf.receitas_top_category');
		$receitasCategory = new Category(get_category($receitasCategory));
		$controllerMethod = $category->parent_category->slug === $receitasCategory->slug ? 'receitas' : 'posts';
		return Container::call([$this, $controllerMethod], ['category' => $category]);
	}

	public function receitas (Request $request, Category $category) {

		global $post;
		$the_post = new Recipe($post);

		/**
		 * Directional posts
		 */
		$prevPost = get_previous_post(true);
		$nextPost = get_next_post(true);
		$directionalPosts = [
			'prev' => !!$prevPost ? new Recipe($prevPost) : null,
			'next' => !!$nextPost ? new Recipe($nextPost) : null,
		];

		return view('pages.recipe', [
			'post' => $the_post,
			'directionalPosts' => $directionalPosts,
			'headerMenuItems' => $request->headerMenuItems,
			'footerMenuItems' => $request->footerMenuItems,
			'footerDisclaimer' => $request->footerDisclaimer,
		]);
	}

	public function posts (Request $request, Category $category) {
		global $post;
		$the_post = new Post($post);

		add_filter('body_class', function ($classes) use ($the_post) {
			if($the_post->is_sponsored) {
				$classes[] = "article-sponsored-background";
			}
			return $classes;
		});

		/**
		 * Artigos mais lidos
		 */
		$mostRead = PostsRepo::getMostRead();

		/**
		 * Directional posts
		 */
		$prevPost = get_previous_post(true);
		$nextPost = get_next_post(true);
		$directionalPosts = [
			'prev' => !!$prevPost ? new Post($prevPost) : null,
			'next' => !!$nextPost ? new Post($nextPost) : null,
		];

		return view('pages.post', [
			'post' => $the_post,
			'mostRead' => $mostRead,
			'directionalPosts' => $directionalPosts,
			'headerMenuItems' => $request->headerMenuItems,
			'footerMenuItems' => $request->footerMenuItems,
			'footerDisclaimer' => $request->footerDisclaimer,
		]);
	}
}