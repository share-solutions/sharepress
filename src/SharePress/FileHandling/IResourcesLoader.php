<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 11/02/2018
 * Time: 10:25
 */

namespace share\SharePress\FileHandling;


interface IResourcesLoader
{
	public function load ($tag);
	public function registerScript ($tag, $src, $deps = [], $ver = '', $footer = true);
	public function registerStyle ($tag, $src, $deps = [], $ver = '', $media = 'all');
	public function loadResources ();
}