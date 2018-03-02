<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 21/02/2018
 * Time: 23:59
 */

namespace prevenir\Business\Repos\Posts;

use prevenir\Business\Models\Posts\Category;
use prevenir\Business\Models\Posts\Post;
use prevenir\Business\Models\Posts\Tag;
use share\SharePress\Facades\Config;

final class PostsRepo
{
	public static function getHomepageHighlights($excludePosts = [])
	{
		$highlightsIds = Config::get('acf.destaques_homepage');
		$highlights    = [];
		if (!!$highlightsIds) {
			$highlightsIds = array_pluck($highlightsIds, 'artigo');
			$highlights    = Post::set('posts_per_page', 3)
								 ->set('post__in', $highlightsIds)
								 ->set('post__not_in', $excludePosts)
								 ->load();
		}
		return $highlights;
	}

	public static function getMostRead($excludePosts = [])
	{
		$mostReadIds = Config::get('acf.artigos_mais_lidosmais_populares');
		$mostRead    = [];
		if (!!$mostReadIds) {
			$mostReadIds = array_pluck($mostReadIds, 'artigo');
			$mostReadIds = array_diff($mostReadIds, $excludePosts); // remove excluded
			$mostRead    = Post::set('posts_per_page', 3)
							   ->set('post__in', $mostReadIds)
							   ->load();
		}
		return $mostRead;
	}

	public static function getLastPosts($pageSize, $offset = 0, $excludePosts = [])
	{
		$lastPosts = Post::set('posts_per_page', $pageSize)
						 ->set('offset', $offset)
						 ->set('orderby', 'date')
						 ->set('order', 'DESC')
						 ->set('post__not_in', $excludePosts)
						 ->load();
		return $lastPosts;
	}

	public static function getCategoryPosts(Category $category, $pageSize, $offset = 0, $includeChildrenCategories = false)
	{
		$categoryPostsPrepare = Post::set('posts_per_page', $pageSize)
									->set('offset', $offset);
		if ($includeChildrenCategories) {
			$categoryPostsPrepare->set('category__in', $category->flat_children);
		} else {
			$categoryPostsPrepare->set('cat', $category->term_id);
		}
		$categoryPosts = $categoryPostsPrepare->load();
		return $categoryPosts;
	}

	public static function getTagPosts(Tag $tag, $pageSize, $offset = 0)
	{
		$tagPosts = Post::set('posts_per_page', $pageSize)
						->set('offset', $offset)
						->set('tag_id', $tag->term_id)
						->load();
		return $tagPosts;
	}

	public static function getCategoriesPostsInTags($categoriesIds, $tagsIds, $elementsPerCategory, $pageSize = -1)
	{
		$ret = [];
		foreach ($categoriesIds as $categoryId) {
			$category = new Category(get_category($categoryId));
			$ret      = array_merge(
				$ret,
				Post::set('posts_per_page', $elementsPerCategory)
					->set('category__in', $category->flat_children)
					->set('tag__in', $tagsIds)
					->load());
		}
		if ($pageSize !== -1) {
			$ret = array_slice($ret, 0, $pageSize);
		}
		return $ret;
	}


	public static function getRelatedToContributors($contributorsIds, $postsPerPage, $offset = 0, $excludeCategories = [])
	{
		$relatedByContributor = Post::set('meta_query', [[
															 'key' => 'autores_$_pessoa',
															 'compare' => 'IN',
															 'value' => is_array($contributorsIds) ? $contributorsIds : (is_integer($contributorsIds) ? [$contributorsIds] : ''),
														 ]])
									->set('category__not_in', $excludeCategories)
									->set('posts_per_page', $postsPerPage)
									->set('offset', $offset)
									->load();
		return $relatedByContributor;
	}

	public function getRelatedToContributorsWithRole($roleId, $excludeCategories)
	{
		$contributors    = PeopleRepo::getByRole($roleId, 9);
		$contributorsIds = [];
		if (!!$contributors) {
			$contributorsIds = array_pluck($contributors, 'ID');
		}
		return self::getRelatedToContributors($contributorsIds, 9, $excludeCategories);
	}
}