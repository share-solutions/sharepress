<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace share\SharePress\WordPress\Security\Filters;

use share\SharePress\Facades\Resources;
use share\SharePress\WordPress\FilterObserver;

class RemoveWPVersionFromResources extends FilterObserver
{
	public $filter = [['name' => "style_loader_src", 'num_args' => 1], ['name' => "script_loader_src", 'num_args' => 1]];
	public function handler ($src) {
		if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
	}
}