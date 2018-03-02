<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\Support\Packages\TinyMCE\ThemeButtons\Filters;

use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\WordPress\FilterObserver;
use share\SharePress\WordPress\Shortcodes\Registry;

class RegisterThemeButtons extends FilterObserver
{
	public $filter = "mce_buttons";

	public function handler($buttons)
	{
		$buttonsConfiguration = Config::get('tinymce.buttons');
		foreach ($buttonsConfiguration as $key => $item) {
			$post_types = [];
			if (is_string($item->post_type)) {
				$post_types = [$item->post_type];
			} else {
				$temp = json_decode(json_encode($item->post_type), true);
				if (is_array($temp)) {
					$post_types = $temp;
				}
			}
			if (in_array(get_post_type(), $post_types)) {
				array_push($buttons, $key);
			}
		}

		foreach (Container::make(Registry::class) as $tag => $instance) {
			if (method_exists($instance, 'tinymceButton')) {
				$tinymceConfig = $instance->tinymceButton();
				$post_types    = [];

				if (is_string($tinymceConfig['post_type'])) {
					$post_types = [$tinymceConfig['post_type']];
				} else if (is_array($tinymceConfig['post_type'])) {
					$post_types = $tinymceConfig['post_type'];
				}

				if (in_array(get_post_type(), $post_types)) {
					array_push($buttons, $tag);
				}
			}
		}

		return $buttons;
	}
}