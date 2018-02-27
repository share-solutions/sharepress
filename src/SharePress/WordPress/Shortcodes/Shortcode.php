<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 08/02/2018
 * Time: 17:45
 */

namespace share\SharePress\WordPress\Shortcodes;


use share\SharePress\Facades\Container;

abstract class Shortcode
{
	public function __construct()
	{
		if(property_exists($this, "tag") && method_exists($this, "run")) {
			if(method_exists($this, "vc_register")) {
				Container::call([$this, 'vc_register']);
			}
			add_shortcode($this->tag, function () {
				return Container::call([$this, 'run'], func_get_args());
			});
			Container::make(Registry::class)->add($this->tag, $this);
		}
	}
	protected function vc_mapping (array $data) {
		if ( function_exists( 'vc_map' ) ) {
			vc_map ($data);
		}
	}
}