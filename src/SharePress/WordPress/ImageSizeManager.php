<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 18/02/2018
 * Time: 17:46
 */

namespace share\SharePress\WordPress;


use share\SharePress\Facades\Container;
use share\SharePress\WordPress\Configuration\Filters\RemoveDefaultImageSizes;

class ImageSizeManager extends ActionObserver
{
	public $action = "init";
	private $configuration;
	private $defaultSizes;
	public function __construct($configuration)
	{
		$this->configuration = $configuration;
		$this->defaultSizes = $this->getConfiguredSizes();
		parent::__construct();
	}

	public function handler () {
		if(!!$this->configuration->remove_defaults) {
			if($this->configuration->remove_defaults === true) {
				Container::make(RemoveDefaultImageSizes::class, ['defaultSizes' => $this->defaultSizes]);
			}
			else if (is_array($configuredDefaultsToRemove = json_decode(json_encode($this->configuration->remove_defaults), true))) {
				Container::make(RemoveDefaultImageSizes::class, ['defaultSizes' => $configuredDefaultsToRemove]);
			}
		}
		if(!!$this->configuration->available && count($this->configuration->available) > 0) {
			foreach ($this->configuration->available as $sizeConfig) {
				$this->addImageSize(json_decode(json_encode($sizeConfig), true));
			}
		}
	}
	public function removeSize ($size) {
		remove_image_size($size);
	}

	public function removeAllSizes () {
		foreach ($this->getConfiguredSizes() as $size) {
			$this->removeSize($size);
		}
	}

	public function getConfiguredSizes () {
		return get_intermediate_image_sizes();
	}

	public function addImageSize ($sizeConfig) {
		call_user_func_array('add_image_size', $sizeConfig);
	}
}