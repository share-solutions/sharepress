<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 17:46
 *
 * https://developer.wordpress.org/files/2014/10/wp-hierarchy.png
 *
 */

namespace share\SharePress\WordPress\WPTemplateMatch;


use share\SharePress\Facades\Config;
use share\SharePress\Facades\Container;
use share\SharePress\Traits\GlobalizedTrait;

class Manager
{
	private $controllers;
	private $templates = [
		'embed_template' => 'Embeds',
		'404_template' => '_404',
		'search_template' => 'Search',
		'frontpage_template' => 'Frontpage',
		'home_template' => 'Home',
		'taxonomy_template' => 'Taxonomy',
		'attachment_template' => 'Attachment',
		'single_template' => 'Single',
		'page_template' => 'Page',
		'singular_template' => 'Singular',
		'category_template' => 'Category',
		'tag_template' => 'Tag',
		'author_template' => 'Author',
		'date_template' => 'Date',
		'archive_template' => 'Archive',
		'index_template' => 'Index'
	];

	public function __construct($controllersConfig)
	{
		// TODO: TemplateMatchParsers for most used templates
		$this->controllers = $controllersConfig;
		//add_action('template_include', array($this, 'matchToController'));
		foreach ($this->templates as $filter => $templateDir) {
			$this->addFilter($filter, $templateDir);
		}
	}

	private function addFilter($filter, $templateDir)
	{
		add_filter($filter, function ($templates) use ($filter, $templateDir) {
			$parser = "share\\SharePress\\WordPress\\WPTemplateMatch\\Parsers\\" . $templateDir . "Parser";
			$parser = Container::make($parser);
			$ret    = Container::call([$parser, 'parse'], ['directory' => $this->controllers . "/" . $templateDir]);
			if (!!$ret) {
				echo $ret;
				die;
			}
			return $templates;
		});
	}
}