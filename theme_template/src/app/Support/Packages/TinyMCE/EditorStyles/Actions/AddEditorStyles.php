<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:47
 */

namespace prevenir\Support\Packages\TinyMCE\EditorStyles\Actions;

use prevenir\Support\Packages\TinyMCE\EditorStyles\Filters\AddStyleSelectDropdown;
use prevenir\Support\Packages\TinyMCE\EditorStyles\Filters\SetAvailableEditorStyles;
use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\WordPress\ActionObserver;

class AddEditorStyles extends ActionObserver
{
	protected $action = "init";
	public function handler () {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}
		if ( get_user_option( 'rich_editing' ) !== 'true' ) {
			return;
		}
		$editorFiles = json_decode(json_encode(Config::get('app.resources.editor')), true);
		foreach ($editorFiles as $stylesheet) {
			list($tag, $src) = Container::make('resources')->getResourceInfoByName($stylesheet);
			add_editor_style( $src );
		}
		Container::make(AddStyleSelectDropdown::class);
		Container::make(SetAvailableEditorStyles::class);
	}
}