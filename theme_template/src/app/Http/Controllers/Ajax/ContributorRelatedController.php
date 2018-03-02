<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 16:59
 */

namespace prevenir\Http\Controllers\Ajax;

use prevenir\Business\Models\Posts\Category;
use prevenir\Business\Models\Posts\People;
use prevenir\Business\Models\Posts\Tag;
use prevenir\Business\Repos\Posts\PostsRepo;
use prevenir\Http\Requests\Request;
use share\SharePress\Facades\Config;
use share\SharePress\Http\BaseAjaxController;

class ContributorRelatedController extends BaseAjaxController
{
	protected $localizerHandle = "public.js";

	public function index (Request $request) {

		$this->validateNonce(); // TODO: isto devia de ir para o Request

		Config::load('acf');

		$pageSize = $request->posts_per_page;
		$firstOffset = $request->first_offset;

		$receitasCategory = new Category(get_category(Config::get('acf.receitas_top_category')));

		// exclude contributed recipes
		// get more than one to evaluate the need for ajax
		$contributedPosts = PostsRepo::getRelatedToContributors(intval($request->contributor), $pageSize + 1, $firstOffset + (($request->page - 1) * $pageSize), $receitasCategory->flat_children);

		if (is_array($contributedPosts)) {
			wp_send_json_success( [
				'template_match' => [
					'image' => '.img-container',
					'taxonomy' => '.cpt001__tag a',
					'taxonomy_link' => '!!.cpt001__tag a',
					'title' => '.cpt001__title a',
					'link' => '!!.cpt001__title a',
					'excerpt' => '.cpt001__paragraph',
				],
				'data' => array_map(function ($item) {
					return [
							'image' => $item->featuredImage('raw', 'medium', ['class' => 'cpt001__img']),
							'taxonomy' => $item->category->name,
							'taxonomy_link' => $item->category->permalink,
							'title' => $item->post_title,
							'link' => $item->permalink,
							'excerpt' => $item->split['striped_excerpt'],
						];
				}, array_slice($contributedPosts, 0, $pageSize)),
				'paging' => [
					'next' => count($contributedPosts) > $pageSize ? $request->page + 1 : -1,
					'prev' => $request->page - 1,
				]
			]);
		}
		wp_send_json_error("error");
	}
}