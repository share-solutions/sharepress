<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 16:59
 */

namespace prevenir\Http\Controllers\Ajax;

use prevenir\Business\Models\Posts\Category;
use prevenir\Business\Models\Posts\Tag;
use prevenir\Business\Repos\Posts\PostsRepo;
use prevenir\Http\Requests\Request;
use share\SharePress\Http\BaseAjaxController;

class TagPostsController extends BaseAjaxController
{
	protected $localizerHandle = "public.js";

	public function index (Request $request) {

		$this->validateNonce(); // TODO: isto devia de ir para o Request

		$pageSize = $request->posts_per_page;
		$firstOffset = $request->first_offset;
		$tag = new Tag(get_term($request->tag));
		// get one more element than the page size to validate if we need more
		$tagPosts = PostsRepo::getTagPosts(
			$tag,
			$pageSize + 1,
			$firstOffset + (($request->page - 1) * $pageSize)
		);

		if (is_array($tagPosts)) {
			wp_send_json_success( [
				'template_match' => [
					'image' => '.img-container',
					'taxonomy' => '.cpt001__tag',
					'title' => '.cpt001__title a',
					'link' => '!!.cpt001__title a',
					'excerpt' => '.cpt001__paragraph',
				],
				'data' => array_map(function ($item) use ($tag) {
					return [
							'image' => $item->featuredImage('raw', 'medium', ['class' => 'cpt001__img']),
							'taxonomy' => $tag->name,
							'title' => $item->post_title,
							'link' => $item->permalink,
							'excerpt' => $item->split['striped_excerpt'],
						];
				}, array_slice($tagPosts, 0, $pageSize)),
				'paging' => [
					'next' => count($tagPosts) > $pageSize ? $request->page + 1 : -1,
					'prev' => $request->page - 1,
				]
			]);
		}
		wp_send_json_error("error");
	}
}