<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:52
 */

namespace share\SharePress\WordPress\WPTemplateMatch\Parsers;

use share\SharePress\Facades\Strings;

class PageParser extends BaseParser
{
	public function parse ($directory, $pipeline = []) {
		global $wp;
		$pagenameFilename = Strings::slugToCamelCase($wp->query_vars['pagename'], true);
		return parent::parse($directory, [$pagenameFilename]);
	}
}