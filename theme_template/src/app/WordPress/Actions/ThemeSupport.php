<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:47
 */

namespace prevenir\WordPress\Actions;

use share\SharePress\WordPress\ActionObserver;

class ThemeSupport extends ActionObserver
{
	protected $action = "after_setup_theme";
	public function handler () {
		add_theme_support( 'post-thumbnails' );
	}
}