<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:47
 */

namespace prevenir\Support\Packages\TinyMCE\ThemeButtons\Actions;

use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\WordPress\ActionObserver;
use share\SharePress\WordPress\Shortcodes\Registry;

class ExtraVars extends ActionObserver
{
	protected $action = "after_wp_tiny_mce";
	public function handler () {
		$data = json_decode(json_encode(Config::get('tinymce.buttons')), true);
		foreach (Container::make(Registry::class) as $key => $instance) {
			if(method_exists($instance, 'tinymceButton')) {
				$data[$key] = $instance->tinymceButton();
			}
		}
		echo view('admin.tinymce.extravars', ['data' => $data]);
	}
}