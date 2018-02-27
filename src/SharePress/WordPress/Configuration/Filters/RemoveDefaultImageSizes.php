<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/02/2018
 * Time: 00:26
 */

namespace share\SharePress\WordPress\Configuration\Filters;

use share\SharePress\Facades\Resources;
use share\SharePress\WordPress\FilterObserver;

class RemoveDefaultImageSizes extends FilterObserver
{
	public $filter = [['name' => "intermediate_image_sizes_advanced", 'num_args' => 1], ['name' => "intermediate_image_sizes", 'num_args' => 1]];
	private $defaultSizesToRemove;
	public function __construct($defaultSizes = ['thumbnail', 'medium', 'large', 'medium_large'])
	{
		$this->defaultSizesToRemove = $defaultSizes;
		parent::__construct();
	}

	public function handler ($sizes) {
		$sizesRet = $sizes;
		foreach ($sizes as $sizeIndex => $size) {
			if(in_array($size, $this->defaultSizesToRemove)) {
				unset($sizesRet[$sizeIndex]);
			}
		}
		return $sizesRet;
	}
}