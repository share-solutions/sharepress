<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:47
 */

namespace prevenir\WordPress\Actions\ACF;

use share\SharePress\WordPress\ActionObserver;

class ThemeOptionsPage extends ActionObserver
{
	protected $action = "init";

	public function handler()
	{
		if (function_exists('acf_add_options_page')) {
			acf_add_options_page(
				[
					'page_title' => 'Configurações',
					'menu_title' => 'Opções Prevenir',
					'menu_slug' => 'theme-options',
					'capability' => 'edit_posts',
					'redirect' => false
				]);

			acf_add_options_sub_page(
				[
					'page_title' => 'Editorial',
					'menu_title' => 'Editorial',
					'parent_slug' => 'theme-options',
				]);
			acf_add_options_sub_page(
				[
					'page_title' => 'Textos',
					'menu_title' => 'Textos',
					'parent_slug' => 'theme-options',
				]);
		}
	}
}