<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:52
 */

namespace share\SharePress\WordPress\WPTemplateMatch\Parsers;

use share\SharePress\Facades\Strings;

class SingleParser extends BaseParser
{
	public function parse($directory, $pipeline = [])
	{
		global $wp;
		//$pageFilename = isset($wp->query_vars['page']) ? Strings::slugToCamelCase($wp->query_vars['page'], true) : "";
		$postTypeFilename = isset($wp->query_vars['post_type']) ? Strings::slugToCamelCase($wp->query_vars['post_type'], true) : "";
		$nameFilename = isset($wp->query_vars['name']) ? Strings::slugToCamelCase($wp->query_vars['name'], true) : "";
		return parent::parse($directory, [
			$postTypeFilename . "/" . $nameFilename,
			$postTypeFilename,
		]);
	}
}