<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\Support\Packages\TinyMCE\EditorStyles\Filters;

use share\SharePress\Facades\Config;
use share\SharePress\WordPress\FilterObserver;

class SetAvailableEditorStyles extends FilterObserver
{
	public $filter = "tiny_mce_before_init";
	public function handler ($init_array) {
		$init_array['style_formats'] = json_encode( Config::get('tinymce.editor_styles') );
		return $init_array;
	}
}