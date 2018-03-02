<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:26
 */

return [
	/*
	 * Use this place to register any wordpress extension and configuration class
	 *
	 * Best eligible:
	 * 	- post types (init)
	 *  - taxonomies (init)
	 * 	- custom fields groups php code from acf (boot)
	 *  - shortcodes (boot / visual_composer_dependant)
	 *  - actions (boot)
	 *  - filters (boot)
	 *
	 * Every other configurations or non-wp-core API's
	 * that need to hook on any action or filter
	 * you should create a class that extends
	 * ActionObserver or FilterObserver and register it here
	 * also, whatever code you would usually just paste in functions.php
	 * you should create a class and register it here in the boot section
	 *
	 * If you wish you can also make a ServiceProvider for each Domain/Topic
	 * and register there your Regular Classes, Actions and Filters,
	 * though Actions and Filters should be placed on boot stage of your ServiceProvider
	 * (don't forget to register the ServiceProvider on config/app.php
	 *
	 */
	'extensions' => [
		'boot' => [
			// Custom Fields
			\prevenir\WordPress\Fields\PostFields::class,

			// Shortcodes
			\prevenir\WordPress\Shortcodes\BlackBar::class,
			\prevenir\WordPress\Shortcodes\Citation::class,
			\prevenir\WordPress\Shortcodes\CrossReference::class,
			\prevenir\WordPress\Shortcodes\GrandHighlight::class,

			// Actions
			\prevenir\WordPress\Actions\ACF\ThemeOptionsPage::class,
			\prevenir\WordPress\Actions\AdminMenu::class,
			\prevenir\WordPress\Actions\ExternalResources::class,
			\prevenir\WordPress\Actions\RemoveExcerptSupport::class,
			\prevenir\WordPress\Actions\RemoveTagsMetaBox::class,
			\prevenir\WordPress\Actions\SaveTopCategoryOnSavePost::class,
			\prevenir\WordPress\Actions\ThemeSupport::class,

			// Filters
				// ACF
			\prevenir\WordPress\Filters\ACF\Fields\Taxonomy\Query::class,
			\prevenir\WordPress\Filters\ACF\Location\PostCategoryAncestor\RuleMatch::class,
			\prevenir\WordPress\Filters\ACF\Location\PostCategoryAncestor\RuleValues::class,
			\prevenir\WordPress\Filters\ACF\Location\TopHierarchyTerm\RuleMatch::class,
			\prevenir\WordPress\Filters\ACF\Location\TopHierarchyTerm\RuleValues::class,
			\prevenir\WordPress\Filters\ACF\Location\RuleTypes::class,
			\prevenir\WordPress\Filters\ACF\SavePost\AssociatePeopleTags::class,
			\prevenir\WordPress\Filters\ACF\SavePost\AssociatePostTags::class,
			\prevenir\WordPress\Filters\ACF\SavePost\AssociateRecipeTags::class,
			\prevenir\WordPress\Filters\ACF\SavePost\CacheOptions::class,
				// WP_Query
			\prevenir\WordPress\Filters\WPQuery\PostsWherePostPeople::class,
				//
			\prevenir\WordPress\Filters\PageTemplates::class,
			\prevenir\WordPress\Filters\PostTypeLink::class,
			\prevenir\WordPress\Filters\HideAdminBarOnFrontend::class,
		],
		'init' => [
			// Post Types
			\prevenir\WordPress\PostTypes\People::class,

			// Taxonomies
			\prevenir\WordPress\Taxonomies\Roles::class,
		],
		'visual_composer_dependant' => [
			\prevenir\WordPress\Shortcodes\SampleVCShortcode::class,
		]
	],
	'image_sizes' => [
		'remove_defaults' => false,
		'available' => [
		    /*
			[
				'name' => 'test',
				'width' => 390,
				'height' => 190,
				'crop' => true
			]
		    */
		]
	],
	'upload_mime_types' => [
		/*
		'svg' => 'image/svg+xml',
		'xml' => 'application/xml'
		*/
	],
	'theme_menus' => [
		'header-menu-1' => __( 'Header Menu - Coluna 1' ),
		'header-menu-2' => __( 'Header Menu - Coluna 2' ),
		'footer-menu-1' => __( 'Footer Menu - Coluna 1' ),
		'footer-menu-2' => __( 'Footer Menu - Coluna 2' ),
		'footer-menu-3' => __( 'Footer Menu - Coluna 3' ),
	],
	'rewrite_rules' => [
		/*
		[
			'regex' => 'testing/([^/]+)(?:/([0-9]+))?/?$',
			'query' => 'index.php?people=$matches[1]',
			'after' => 'top'
		]
		*/
	],
	'offending_useragents' => [

	]
];