<?php
/**
 * Created by PhpStorm.
 * User: Ângelo Marques
 * Date: 16/12/2016
 * Time: 15:18
 */

namespace prevenir\WordPress\Shortcodes;

use share\SharePress\WordPress\Shortcodes\Shortcode;

class BlackBar extends Shortcode
{
	public $tag = "black-bar";

	public function run($tag, $atts, $content = null)
	{
		$extraClasses = "";
		$extraBarClass = "";
		$blackBar = false;
		$text = $content;
		switch($atts['type']) {
			case "left-bar":
				$extraClasses = 'cpt004--left-bar';
				$blackBar = true;
				break;
			case "centered":
				$extraClasses = 'cpt004--center';
				break;
			case "just-bar":
				$extraClasses = '';
				$blackBar = true;
				$text = "";
				$extraBarClass = "cpt004__bar--nomargin";
				break;
		}
		return view('shortcodes.black-bar', ['text' => $text, 'extraClasses' => $extraClasses, 'extraBarClass' => $extraBarClass, 'blackBar' => $blackBar]);
	}

	public function tinymceButton () {
		return [
			'post_type' => ['page'],
			'label' => 'Black Bar / Title',
			'windowLabel' => 'Black Bar / Title',
			'shortcode' => 'black-bar',
			'fields' => [
				[
					'type' => 'textbox',
					'name' => 'content',
					'label' => 'Título',
					//'tooltip' => 'Some nice tooltip to use',
					//'value' => '',
					'multiline' => true,
					'autofocus' => true,
					'minHeight' => 200,
					'minWidth' => 400
				],
				[
					'type' => 'listbox',
					'name' => 'type',
					'label' => 'Tipo',
					'values' => [
						['text' => 'Esquerda com Barra', 'value' => 'left-bar'],
						['text' => 'Centrado sem Barra', 'value' => 'centered'],
						['text' => 'Só Barra', 'value' => 'just-bar'],
					],
				]
			]
		];
	}
}