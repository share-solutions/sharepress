<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace prevenir\Support\Packages\TinyMCE\EditorStyles\Filters;

use share\SharePress\Facades\Resources;
use share\SharePress\WordPress\FilterObserver;

class AddStyleSelectDropdown extends FilterObserver
{
	public $filter = "mce_buttons_2";
	public function handler ($buttons) {
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}
}