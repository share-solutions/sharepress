<?php

/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/04/2017
 * Time: 12:53
 */
namespace share\SharePress\Stores;

class Config {

    private $storeData;
    private $bootstrapDir;
    private $directory;

    public function __construct($bootstrapDir) {
    	$this->bootstrapDir = $bootstrapDir;
    	$this->directory = $bootstrapDir . "config/";
		$this->storeData = (object) [];
    }

    public function load ($configFilename) {
		$this->storeData->$configFilename = json_decode(json_encode(include($this->directory . $configFilename . ".php"), JSON_FORCE_OBJECT), false);
	}

    public function get($key) {
        // translate key path
        $path = explode(".", $key);
        $parent = $this->storeData;
        foreach ($path as $part) {
            if (isset($parent->$part)) {
                $parent = $parent->$part;
            } else {
                return null;
            }
        }
        if ($parent === $this->storeData) {
            return null;
        }
        return $parent;
    }

    public function set($key, $value) {
		// translate key path
		$path = explode(".", $key);
		$prop = $this->storeData;
		foreach ($path as $index => $part) {
			if (!isset($prop->$part)) {
				$prop->$part = new \stdClass();
			}
			if($index === count($path) - 1) {
				$prop->$part = $value;
				return true;
			}
			$prop = $prop->$part;
		}
		return null;
	}
}