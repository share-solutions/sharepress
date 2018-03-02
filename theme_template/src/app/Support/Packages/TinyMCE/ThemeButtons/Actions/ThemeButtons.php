<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:47
 */

namespace prevenir\Support\Packages\TinyMCE\ThemeButtons\Actions;

use prevenir\Support\Packages\TinyMCE\ThemeButtons\Filters\AddThemeButtons;
use prevenir\Support\Packages\TinyMCE\ThemeButtons\Filters\RegisterThemeButtons;
use share\SharePress\Facades\Container;
use share\SharePress\WordPress\ActionObserver;

class ThemeButtons extends ActionObserver
{
	protected $action = "init";
	public function handler () {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}
		if ( get_user_option( 'rich_editing' ) !== 'true' ) {
			return;
		}
		Container::make(ExtraVars::class);
		Container::make(AddThemeButtons::class);
		Container::make(RegisterThemeButtons::class);
	}
}