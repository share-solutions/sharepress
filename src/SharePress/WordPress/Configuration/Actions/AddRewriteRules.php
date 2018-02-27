<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace share\SharePress\WordPress\Configuration\Actions;

use share\SharePress\WordPress\ActionObserver;

class AddRewriteRules extends ActionObserver
{
	public $action = "init";

	private $rewriteRules;
	public function __construct($rewriteRules)
	{
		$this->rewriteRules = json_decode(json_encode($rewriteRules), true);
		parent::__construct();
	}

	public function handler () {
		foreach ($this->rewriteRules as $rewriteRule) {
			call_user_func_array('add_rewrite_rule', $rewriteRule);
		}
		// just short it out to save db space, we just need it to validate if they have changed
		$hashedRules = md5(serialize($this->rewriteRules));
		if(get_option('custom_rewrite_hash') !== $hashedRules) {
			flush_rewrite_rules(true);
		}
		update_option('custom_rewrite_hash', $hashedRules);
	}
}