<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:47
 */

namespace prevenir\WordPress\Actions;

use share\SharePress\WordPress\ActionObserver;

class RemoveTagsMetaBox extends ActionObserver
{
	protected $action = "admin_menu";
	public function handler () {
		remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' );
	}
}