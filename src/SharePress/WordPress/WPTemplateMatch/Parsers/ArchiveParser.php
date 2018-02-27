<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:52
 */

namespace share\SharePress\WordPress\WPTemplateMatch\Parsers;

use share\SharePress\Facades\Strings;

class ArchiveParser extends BaseParser
{
	public function parse($directory, $pipeline = [])
	{
		global $wp;
		$postTypeFilename = isset($wp->query_vars['post_type']) ? Strings::slugToCamelCase($wp->query_vars['post_type'], true) : "";
		return parent::parse($directory, [$postTypeFilename]);
	}
}