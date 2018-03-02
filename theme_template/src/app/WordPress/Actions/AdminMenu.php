<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:47
 */

namespace prevenir\WordPress\Actions;

use share\SharePress\WordPress\ActionObserver;

class AdminMenu extends ActionObserver
{
	protected $action = "admin_menu";
	public function handler () {
		//remove_menu_page( 'edit.php?post_type=acf-field-group' );
		remove_menu_page( 'edit-comments.php' );
	}
}