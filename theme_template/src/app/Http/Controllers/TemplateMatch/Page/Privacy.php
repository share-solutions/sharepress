<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 09/02/2018
 * Time: 22:47
 */

namespace prevenir\Http\Controllers\TemplateMatch\Page;


class Privacy
{
    public function __construct()
    {
    }

    public function index () {
        return view('pages.privacy');
    }
}