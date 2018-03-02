<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 01:00
 */
return [
	'controllers' => 'Http/Controllers/REST',
	'suppress_default' => false,
	'routes' => [
		'v1' => [
			'sample' => [
				'methods' => 'GET',
				'args' => array(
					'sample_argument' => array(
						'default' => '',
						'required' => true,
						'validate_callback' => '', // use Validators you should put in app\Forms\Validators implementing share\SharePress\Forms\IValidator
						'sanitize_callback' => '' // use Sanitizers you should put in app\Forms\Sanitizers implementing share\SharePress\Forms\ISanitizer
					)
				)
			],
			'sample@post' => [
				'methods' => 'POST',
				'args' => array(
					'sample_post_argument' => array(
						'default' => '',
						'required' => true,
						'validate_callback' => '', // use Validators you should put in app\Forms\Validators implementing share\SharePress\Forms\IValidator
						'sanitize_callback' => '' // use Sanitizers you should put in app\Forms\Sanitizers implementing share\SharePress\Forms\ISanitizer
					)
				)
			]
		],
		'v2' => [
			'sample' => [
				'methods' => 'GET',
				'args' => array(
					'sample_argument' => array(
						'default' => '',
						'required' => true,
						'validate_callback' => '', // use Validators you should put in app\Forms\Validators implementing share\SharePress\Forms\IValidator
						'sanitize_callback' => '' // use Sanitizers you should put in app\Forms\Sanitizers implementing share\SharePress\Forms\ISanitizer
					)
				)
			],
		],
	]
];