<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:47
 */

namespace prevenir\Http\Controllers\TemplateMatch\Page;

use prevenir\WordPress\Observers\Actions\Test\PostSaved;

class SamplePage
{
	public function __construct()
	{
	}

	public function index (PostSaved $postSaved) {
		return view('pages.sample-page', ['postSaved' => $postSaved]);
	}
}