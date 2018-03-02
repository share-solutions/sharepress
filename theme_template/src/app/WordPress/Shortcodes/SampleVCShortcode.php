<?php

/**
 * Created by PhpStorm.
 * User: Ângelo Marques
 * Date: 30/11/2016
 * Time: 15:55
 */

namespace prevenir\WordPress\Shortcodes;

use share\SharePress\WordPress\Shortcodes\Shortcode;

class SampleVCShortcode extends Shortcode
{
	public $tag = "sample_vc_shortcode";

	function vc_register()
	{
		$this->vc_mapping(
			array(
				'name' => __('Sample VC Shortcode'),
				// Shortcode tag
				'base' => $this->tag,
				// Category name in the editor
				'category' => __('Custom'),
			));
	}

	function run($atts)
	{
		$data = array();

		return view('shortcodes.sample-vc', ['tag' => $this->tag]);
	}
}