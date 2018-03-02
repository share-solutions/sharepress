<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:47
 */

namespace prevenir\WordPress\Actions;

use share\SharePress\WordPress\ActionObserver;

class ExternalResources extends ActionObserver
{
	protected $action = "wp_enqueue_scripts";
	public function handler () {
		wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	}
}