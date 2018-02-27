<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 11/02/2018
 * Time: 10:11
 */

namespace share\SharePress\FileHandling;

use share\SharePress\Facades\Config;

class ResourcesLoader implements IResourcesLoader
{
	const FRONTEND = 1;
	const ADMIN = 2;
	const EDITOR = 3;
	private $tags = ['js' => [], 'css' => []];
	private $tagsLoaded = ['js' => [], 'css' => []];
	private $manifests = [];

	public function __construct()
	{
		$this->registerResources();
	}

	public function getRegistered () {
		return $this->tags;
	}

	public function getLoaded () {
		return $this->tagsLoaded;
	}

	public function getResourceInfoByName ($name) {
		$jsKeys = array_keys($this->tags['js']);
		$cssKeys = array_keys($this->tags['css']);
		if(in_array($name, $jsKeys)) {
			return $this->tags['js'][$name];
		}
		else if (in_array($name, $cssKeys)) {
			return $this->tags['css'][$name];
		}
	}

	private function registerResources () {
		$resources = Config::get('app.resources.files');
		$ds = DIRECTORY_SEPARATOR;
		foreach ($resources->output as $outputPath) {
			$files = [];
			$manifest = get_stylesheet_directory() . $ds . $outputPath . $ds . 'rev-manifest.json';
			if ( file_exists($manifest) ) {
				$files = json_decode(file_get_contents($manifest), true);
				$this->manifests[$manifest] = $files;
			}
			foreach ($files as $key => $file) {
				if(!preg_match("/\.map$/", $file)) {
					if(preg_match("/\.js$/", $file)) {
						$this->registerScript($key, get_stylesheet_directory_uri() . $ds . $outputPath . $ds . $file);
					}
					else if(preg_match("/\.css$/", $file)) {
						$this->registerStyle($key, get_stylesheet_directory_uri() . $ds . $outputPath . $ds . $file);
					}
				}
			}
		}
	}

	public function registerScript ($tag, $src, $deps = [], $ver = null, $footer = true) {
		wp_register_script( $tag, $src, $deps, $ver, $footer);
		$this->tags['js'][$tag] = [$tag, $src, $deps, $ver, $footer];
	}

	public function registerStyle ($tag, $src, $deps = [], $ver = null, $media = 'all') {
		wp_register_style( $tag, $src, $deps, $ver, $media );
		$this->tags['css'][$tag] = [$tag, $src, $deps, $ver, $media];
	}

	public function load ($tag) {
		$jsKeys = array_keys($this->tags['js']);
		$cssKeys = array_keys($this->tags['css']);
		if(in_array($tag, $jsKeys)) {
			wp_enqueue_script($tag);
			$this->tagsLoaded['js'][] = $tag;
		}
		else if (in_array($tag, $cssKeys)) {
			wp_enqueue_style($tag);
			$this->tagsLoaded['css'][] = $tag;
		}
	}

	public function loadResources ($type = self::FRONTEND) {
		$adminResources = json_decode(json_encode(Config::get('app.resources.admin')), true);
		$editorResources = json_decode(json_encode(Config::get('app.resources.editor')), true);
		foreach ($this->manifests as $manifest => $files) {
			foreach ($files as $key => $file) {
				$isFrontend = !in_array($key, $adminResources) && !in_array($key, $editorResources);
				$isAdmin = in_array($key, $adminResources) && !in_array($key, $editorResources);
				$isEditor = !in_array($key, $adminResources) && in_array($key, $editorResources);
				if(!preg_match("/\.map$/", $file) &&
				   (
				   	($isFrontend && $type === self::FRONTEND) ||
					($isAdmin && $type === self::ADMIN) ||
					($isEditor && $type === self::EDITOR)
				   )
				   ) {
					$this->load($key);
				}
			}
		}
	}
}