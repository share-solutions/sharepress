<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\Support\Packages\TinyMCE\ThemeButtons\Filters;

use share\SharePress\Facades\Resources;
use share\SharePress\WordPress\FilterObserver;

class AddThemeButtons extends FilterObserver
{
	public $filter = "mce_external_plugins";
	public function handler ($plugin_array) {
		list($tag, $src) = Resources::getResourceInfoByName('tinymce.js');
		$plugin_array['custombuttons'] = $src;
		return $plugin_array;
	}
}