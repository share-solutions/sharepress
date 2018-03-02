<?php
/**
 * Created by PhpStorm.
 * User: Ângelo Marques
 * Date: 16/12/2016
 * Time: 15:18
 */

namespace prevenir\WordPress\Shortcodes;

use prevenir\Business\Models\Posts\Post;
use share\SharePress\WordPress\Shortcodes\Shortcode;

class CrossReference extends Shortcode
{
	public $tag = "cross_reference";

	public function run($tag, $atts, $content = null)
	{
		$reference = get_field('cross_reference');
		$reference = new Post(get_post($reference));
		return view('shortcodes.cross_reference', ['reference' => $reference]);
	}

	public function tinymceButton () {
		return [
			'post_type' => ['post'],
			'label' => 'Cross Reference',
			'windowLabel' => 'Cross Reference',
			'shortcode' => 'cross_reference',
		];
	}
}