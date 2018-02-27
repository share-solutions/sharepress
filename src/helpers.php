<?php
/**
 * @return \share\SharePress\App
 */
function app () {
	return \share\SharePress\Facades\Container::make('app');
}
function config ($path) {
	return \share\SharePress\Facades\Config::get($path);
}
function share_log ($data) {
	return \share\SharePress\Facades\Logger::add($data);
}
function view ($view, $data = [], $mergeData = []) {
	return \share\SharePress\Facades\Blade::view()
		->make($view, $data, $mergeData)
		->render();
}