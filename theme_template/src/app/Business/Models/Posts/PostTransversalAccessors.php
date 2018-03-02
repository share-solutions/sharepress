<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 21/02/2018
 * Time: 16:09
 */

namespace prevenir\Business\Models\Posts;


trait PostTransversalAccessors
{
	public function getAttrCategory () {
		$categories = get_the_category($this->ID);

		// return the first non-top-category
		$value = null;
		if(is_array($categories)) {
			$index = 0;
			while(true) {
				if($categories[$index]->parent !== 0) {
					$value = $categories[$index];
					break;
				}
				$value = $categories[$index];
				$index++;
				if($index >= count($categories)) {
					break;
				}
			}
		}
		//$value = is_array($value) ? $value[count($value) - 1] : null;
		if($value !== null) {
			$value = new Category($value);
		}
		return $value;
	}

	public function getAttrCategories () {
		$categories = get_the_category($this->ID);
		$ret = [];
		foreach ($categories as $category) {
			$ret[] = new Category($category);
		}
		return $ret;
	}

	public function getAttrTopCategory () {
		return $this->getAttrCategory()->parent_category;
	}

	public function getAttrCategoriesHierarchy() {
		$currCat = $this->category;
		$ret = [$currCat];
		while($currCat->parent !== 0) {
			$currCat = Category::find($currCat->parent);
			$ret[] = $currCat;
		}
		return array_reverse($ret);
	}

	public function getAttrPermalink () {
		return get_the_permalink($this->ID);
	}

	public function getAttrSplit () {
		$content = $this->post_content;
		if( strpos( $content, '[splitter]' )){
			$splitted_output = explode('[splitter]', $content);
			$output = array(
				'striped_excerpt' => $splitted_output[0],
				'excerpt' => $this->formatPostContent($splitted_output[0]),
				'content' => $this->formatPostContent($splitted_output[1]),
			);
		}else{
			$output = array(
				'striped_excerpt' => '',
				'excerpt' => '',
				'content' => $this->formatPostContent($content),
			);
		}
		return $output;
	}

	public function getAttrTags () {
		$tagsIds = get_field('tags');
		$tags = [];
		if(!!$tagsIds) {
			foreach ($tagsIds as $tagId) {
				$tags[] = Tag::find($tagId);
			}
		}
		return $tags;
	}

	public function getAttrAutores () {
		$posts = get_field('autores', $this->ID);
		$ret   = [];
		if (isset($posts) && !!$posts) {
			foreach ($posts as $post) {
				$ret[] = new People($post['pessoa']);
			}
		}
		return $ret;
	}

	public function getAttrColaboradores () {
		$posts = get_field('colaboradores', $this->ID);
		$ret   = [];
		if (isset($posts) && !!$posts) {
			foreach ($posts as $post) {
				$ret[] = new People($post['pessoa']);
			}
		}
		return $ret;
	}

	public function getAttrTagRelatedThrough()
	{
		return $this->getTagRelatedThrough(3);
	}

	private function getTagRelatedThrough ($numElements) {
		$tagsIds = get_field('tags', $this->ID);
		$relatedPosts = static::set('tax_query',
									[[
										 'taxonomy' => 'post_tag',
										 'field' => 'id',
										 'terms' => $tagsIds,
										 'operator' => 'IN' //Or 'AND' or 'NOT IN'
									 ]])
							  ->set('posts_per_page', $numElements)
							  ->set('post__not_in', [$this->ID])
							  ->load();

		if(count($relatedPosts) < $numElements) {
			$excludePosts = array_pluck($relatedPosts, 'ID');
			$relatedPosts = array_merge($relatedPosts, static::set('post__not_in', array_merge([$this->ID], $excludePosts))
															 ->set('cat', $this->category->term_id)
															 ->set('posts_per_page', $numElements)
															 ->load());

			if(count($relatedPosts) < $numElements && !!$this->category->parent_category) {
				$excludePosts = array_pluck($relatedPosts, 'ID');
				$relatedPosts = array_merge($relatedPosts, static::set('post__not_in', array_merge([$this->ID], $excludePosts))
																 ->set('cat', $this->category->parent_category->term_id)
																 ->set('posts_per_page', $numElements)
																 ->load());
			}
		}
		return array_slice($relatedPosts, 0 , $numElements);
	}

	public function getAttrFeaturedImageUrl () {
		return get_the_post_thumbnail_url($this->ID);
	}

	public function featuredImage ($key, $size = null, $atts = []) {
		$value = get_the_post_thumbnail($this->ID, $size === null ? 'full' : $size, $atts);
		return $key === 'raw' ? $value : $this->resolveArrayValue($value, $key);
	}

	private function formatPostContent ($content) {
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}

}