<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:47
 */

namespace prevenir\Http\Controllers\TemplateMatch\Archive;

class SamplePostType
{
	public function __construct()
	{
	}

	public function index () {
		return view('pages.sample-post-type-archive');
	}
}