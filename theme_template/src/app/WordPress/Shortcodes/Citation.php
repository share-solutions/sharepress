<?php
/**
 * Created by PhpStorm.
 * User: Ângelo Marques
 * Date: 16/12/2016
 * Time: 15:18
 */

namespace prevenir\WordPress\Shortcodes;

use share\SharePress\WordPress\Shortcodes\Shortcode;

class Citation extends Shortcode
{
	public $tag = "citation";

	public function run($tag, $atts, $content = null)
	{
		$data = array(
			'text' => $content
		);
		return view('shortcodes.citation', ['tag' => $this->tag, 'data' => $data]);
	}

	public function tinymceButton () {
		return [
			'post_type' => 'post',
			'label' => 'Citação',
			'windowLabel' => 'Citação',
			'shortcode' => 'citation',
			'fields' => [
				[
					'type' => 'textbox',
					'name' => 'content',
					'label' => 'Conteúdo',
					//'tooltip' => 'Some nice tooltip to use',
					//'value' => '',
					'multiline' => true,
					'autofocus' => true,
					'minHeight' => 200,
					'minWidth' => 400
				]
			],
		];
	}
}