<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:31
 */

namespace share\SharePress\ServiceProviders;

use share\SharePress\Configuration\Loader;
use share\SharePress\Facades\App;
use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;

class WPExtensionsServiceProvider implements IServiceProvider
{
	public function register()
	{
		Config::load('wordpress');
	}

	public function boot()
	{
		$extensions = Config::get('wordpress.extensions');
		if (isset($extensions)) {
			if (isset($extensions->boot)) {
				foreach ($extensions->boot as $wordpressExtension) {
					//$this->simpleLoader($appDir . $wordpressExtensionsDir);
					Container::make($wordpressExtension);
				}
			}
			if (isset($extensions->init)) {
				$wordpressInitExtensions = $extensions->init;
				add_action('init', function () use ($wordpressInitExtensions) {
					foreach ($wordpressInitExtensions as $wordpressExtension) {
						Container::make($wordpressExtension);
					}
				});
			}
			if (isset($extensions->visual_composer_dependant_shortcodes)) {
				$wordpressVCDepExtensions = $extensions->init;
				// If vc_map exists visual composer is installed and we can instantiate the classes
				if ( function_exists( 'vc_map' ) ) {
					// Add class load delay in order to have everything loaded, including all VC functionality, before VC Registry
					add_action( 'wp_loaded', function () use ($wordpressVCDepExtensions) {
						foreach ($wordpressVCDepExtensions as $wordpressExtension) {
							Container::make($wordpressExtension);
						}
					});
				}
			}
		}
	}
}