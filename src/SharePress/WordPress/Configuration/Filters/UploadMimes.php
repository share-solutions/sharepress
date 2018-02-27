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

class UploadMimes extends FilterObserver
{
	public $filter = "upload_mimes";
	private $mimesToAdd;
	public function __construct($mimesToAdd)
	{
		$this->mimesToAdd = json_decode(json_encode($mimesToAdd), true);
		parent::__construct();
	}

	public function handler ($mimes) {
		$mimes = array_merge($mimes, $this->mimesToAdd);
		return $mimes;
	}
}