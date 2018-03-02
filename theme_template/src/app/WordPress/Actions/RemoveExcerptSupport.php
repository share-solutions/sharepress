<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:47
 */

namespace prevenir\WordPress\Actions;

use share\SharePress\WordPress\ActionObserver;

class RemoveExcerptSupport extends ActionObserver
{
	protected $action = "init";
	public function handler () {
		remove_post_type_support('post', 'excerpt');
	}
}