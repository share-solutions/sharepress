<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 16:56
 */
return [
	'views' => [
		'directory' => 'resources/views',
		'cache' => '../../../uploads/views_cache'
	],
	'resources' => [
		'files' => json_decode(file_get_contents(__DIR__ . '/../gulp/gulppaths.json')),
		'admin' => [
			'admin.js',
			'tinymce.js',
		],
		'editor' => [
			'editor-styles.css'
		],
		'loader' => null
	],
	'cache' => true,
	'crons' => false,
	'logs' => [
		'model' => \prevenir\Business\Models\App\Log::class,
		'logger' => \prevenir\Support\Stores\SampleLogger::class,
	],
	'emails' => [],
	'controllers' => [
		'template_match' => 'Http/Controllers/TemplateMatch',
		'ajax' => 'Http/Controllers/Ajax',
	],
	'service_providers' => [
		// Framework
		\share\SharePress\ServiceProviders\AjaxServiceProvider::class,
		\share\SharePress\ServiceProviders\CacheServiceProvider::class,
		\share\SharePress\ServiceProviders\CronsServiceProvider::class,
		\share\SharePress\ServiceProviders\CurlServiceProvider::class,
		\share\SharePress\ServiceProviders\EloquentServiceProvider::class,
		\share\SharePress\ServiceProviders\EmailsServiceProvider::class,
		\share\SharePress\ServiceProviders\LogServiceProvider::class,
		\share\SharePress\ServiceProviders\ResourcesServiceProvider::class,
		\share\SharePress\ServiceProviders\RESTServiceProvider::class,
		\share\SharePress\ServiceProviders\ShortcodesServiceProvider::class,
		\share\SharePress\ServiceProviders\TemplateMatchServiceProvider::class,
		\share\SharePress\ServiceProviders\URLServiceProvider::class,
		\share\SharePress\ServiceProviders\WPConfigurationServiceProvider::class,
		\share\SharePress\ServiceProviders\WPExtensionsServiceProvider::class,
		\share\SharePress\ServiceProviders\WPSecurityServiceProvider::class,

		// Application
		\prevenir\ServiceProviders\TinyMCEServiceProvider::class,
	],
];