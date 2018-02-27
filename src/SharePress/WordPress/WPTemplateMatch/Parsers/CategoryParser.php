<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:52
 */

namespace share\SharePress\WordPress\WPTemplateMatch\Parsers;

use share\SharePress\Facades\Strings;

class CategoryParser extends BaseParser
{
	public function parse($directory, $pipeline = [])
	{
		global $wp;
		$categoryFilename = isset($wp->query_vars['category_name']) ? Strings::slugToCamelCase($wp->query_vars['category_name'], true) : "";
		return parent::parse($directory, [$categoryFilename]);
	}
}