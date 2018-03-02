<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/01/2018
 * Time: 15:13
 */

namespace prevenir\ServiceProviders;

use prevenir\Support\Packages\TinyMCE\EditorStyles\Actions\AddEditorStyles;
use prevenir\Support\Packages\TinyMCE\ThemeButtons\Actions\ThemeButtons;
use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\ServiceProviders\IServiceProvider;

class TinyMCEServiceProvider implements IServiceProvider
{
	public function boot()
	{
		Config::load('tinymce');

		// ThemeButtons action validates if TinyMCE can be extended and initializes logic
		Container::make(ThemeButtons::class);

		if(Config::get('tinymce.editor_styles')) {
			Container::make(AddEditorStyles::class);
		}
	}

	public function register()
	{

	}
}