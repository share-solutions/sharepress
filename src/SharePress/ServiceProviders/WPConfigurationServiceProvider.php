<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:31
 */

namespace share\SharePress\ServiceProviders;

use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\WordPress\Configuration\Actions\AddRewriteRules;
use share\SharePress\WordPress\Configuration\Actions\ThemeMenusRegistration;
use share\SharePress\WordPress\Configuration\Filters\UploadMimes;
use share\SharePress\WordPress\ImageSizeManager;

class WPConfigurationServiceProvider implements IServiceProvider
{
	public function register()
	{
	}

	public function boot()
	{
		Container::singleton(ImageSizeManager::class, function () {
			return new ImageSizeManager(Config::get('wordpress.image_sizes'));
		});
		Container::alias(ImageSizeManager::class, 'image_size_manager');
		Container::make('image_size_manager');

		Container::make(UploadMimes::class, ['mimesToAdd' => Config::get('wordpress.upload_mime_types')]);

		Container::make(ThemeMenusRegistration::class, ['themeMenus' => Config::get('wordpress.theme_menus')]);

		Container::make(AddRewriteRules::class, ['rewriteRules' => Config::get('wordpress.rewrite_rules')]);
	}
}