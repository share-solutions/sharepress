<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 16/02/2018
 * Time: 16:35
 */

namespace prevenir\WordPress\Filters;


use share\SharePress\WordPress\FilterObserver;

class PostTypeLink extends FilterObserver
{
	public $filter = "post_type_link";
	public $num_args = 2;
	public function handler ($post_link, $post) {
		if ( is_object( $post ) && $post->post_type === 'people'){
			$terms = wp_get_object_terms( $post->ID, 'roles'/*, ['orderby' => 'term_order']*/);
			if( $terms ){
				return str_replace( '%roles%' , $terms[0]->slug , $post_link );
			}
			else {
				return str_replace( '%roles%/' , "", $post_link );
			}
		}
		return $post_link;
	}
}